<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\MoneyRequest;
use App\Models\SendMoney;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class SendMoneyController extends Controller
{
    public function send()
    {
        $pageTitle = 'Send Money History';
        $sendMoney = SendMoney::with('receiver', 'sender')->get();
        return view('Template::user.send_money.history', compact('pageTitle', 'sendMoney'));
    }
    public function createSendMoney()
    {
        $pageTitle = 'Send Money';
        return view('Template::user.send_money.new', compact('pageTitle'));
    }

    public function searchUser(Request $request)
    {
        $username = $request->username;

        $user = User::where('username', $username)->first();

        if ($user)
        {
            return response()->json(['success' => true, 'user' => $user]);
        }

        return response()->json(['success' => false, 'message' => 'User not found.']);
    }

    public function processSendMoney(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'amount' => 'required|numeric|gt:0',
        ]);

        $receiver = User::active()->where('username', $request->username)->first();
        $sender = auth()->user();
        if (!$receiver)
        {
            $notify[] = ['error', 'The receiver user is not found.'];
            return back()->withNotify($notify);
        }

        if ($sender->id === $receiver->id)
        {
            $notify[] = ['error', 'You cannot send money to yourself.'];
            return back()->withNotify($notify);
        }

        //charge
        $generalSetting = gs();
        $fixedCharge =  $generalSetting->send_money_fixed_charge;
        $percentCharge = $generalSetting->send_money_percent_charge;
        // $minAmount = $generalSetting->send_money_min_amount;
        // $maxAmount = $generalSetting->send_money_max_amount;

        $amount = $request->amount;
        $charge = $fixedCharge + $amount / 100 * $percentCharge;
        $finalAmount = $amount + $charge;

        if ($sender->balance < $finalAmount)
        {
            $notify[] = ['error', 'Insufficient balance.'];
            return back()->withNotify($notify);
        }

        $sendMoney = new SendMoney();
        $sendMoney->sender_id = $sender->id;
        $sendMoney->receiver_id = $receiver->id;
        $sendMoney->amount = $request->amount;

        $sendMoney->trx = getTrx();
        $sendMoney->save();

        $sender->balance -= $finalAmount;
        $sender->save();

        $senderTransaction = new Transaction();
        $senderTransaction->user_id = $sender->id;
        $senderTransaction->amount = $amount;
        $senderTransaction->charge = $charge;
        $senderTransaction->post_balance = $sender->balance;
        $senderTransaction->trx_type = '-';
        $senderTransaction->details = 'Sent money to ' . $receiver->username;
        $senderTransaction->trx = $sendMoney->trx;
        $senderTransaction->remark = 'send_money';
        $senderTransaction->save();


        $receiver->balance += $amount;
        $receiver->save();


        $receiverTransaction = new Transaction();
        $receiverTransaction->user_id = $receiver->id;
        $receiverTransaction->amount = $amount;
        $receiverTransaction->charge = 0;
        $receiverTransaction->post_balance = $receiver->balance;
        $receiverTransaction->trx_type = '+';
        $receiverTransaction->details = 'Received money from ' . $sender->username;
        $receiverTransaction->trx = $sendMoney->trx;
        $receiverTransaction->remark = 'receive_money';
        $receiverTransaction->save();


        notify($receiver, 'RECEIVE_MONEY', [
            'sender_username' => $sender->username,
            'amount' => showAmount($sendMoney->amount, currencyFormat: false),
            'post_balance' => showAmount($receiver->balance, currencyFormat: false),
            'trx' => $receiverTransaction->trx,
        ]);

        $notify[] = ['success', 'Money sent successfully.'];
        return back()->withNotify($notify);
    }


    public function sendMoneyPreview($id)
    {
        $pageTitle = 'Send Money Preview';
        $sendMoney = SendMoney::where('status', 0)->with('receiver')->findOrFail($id);
        return view('Template::user.send_money_preview', compact('sendMoney', 'pageTitle'));
    }





    public function createMoneyRequest()
    {
        $pageTitle = 'Request Money';
        $requestMoney = MoneyRequest::with('receiver', 'sender')->get();
        return view('Template::user.send_money.request_money', compact('pageTitle', 'requestMoney'));
    }

    public function processRequestMoney(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'amount' => 'required|numeric|gt:0',
        ]);

        $sender = auth()->user();
        $receiver = User::active()->where('username', $request->username)->first();
        if (!$receiver)
        {
            $notify[] = ['error', 'The receiver user is not found.'];
            return back()->withNotify($notify);
        }

        if ($sender->id === $receiver->id)
        {
            $notify[] = ['error', 'You cannot request money from yourself.'];
            return back()->withNotify($notify);
        }


        $moneyRequest = new MoneyRequest();
        $moneyRequest->sender_id = $sender->id;
        $moneyRequest->receiver_id = $receiver->id;
        $moneyRequest->amount = $request->amount;
        $moneyRequest->status = '0';
        $moneyRequest->save();

        notify($receiver, 'REQUEST_MONEY', [
            'sender_username' => $sender->username,
            'amount' => showAmount($moneyRequest->amount, currencyFormat: false),
        ]);

        $notify[] = ['success', 'Money request sent successfully.'];
        return back()->withNotify($notify);
    }


    public function moneyRequests()
    {
        $pageTitle = 'Money Requests';
        $moneyRequests = MoneyRequest::with('sender')->where('sender_id', auth()->id())->get();
        return view('Template::user.send_money.requests', compact('pageTitle', 'moneyRequests'));
    }

    public function requestMoney()
    {
        $pageTitle = 'Requests For Money';
        $moneyRequests = MoneyRequest::with('receiver')->where('receiver_id', auth()->id())->get();
        return view('Template::user.send_money.money_requests', compact('pageTitle', 'moneyRequests'));
    }


    public function acceptMoneyRequest($id)
    {
        $user = auth()->user();
        $moneyRequest = MoneyRequest::where('receiver_id', $user->id)->find($id);
        $amount = $moneyRequest->amount;

        $requestMoneyFixedCharge = gs('request_money_fixed_charge');
        $requestMoneyPercentCharge = gs('request_money_percent_charge');
        $charge = $requestMoneyFixedCharge + $requestMoneyPercentCharge * $amount / 100;
        $receivableAmount = $amount - $charge;

        if ($moneyRequest->receiver->balance < $amount)
        {
            $notify[] = ['error', 'Insufficient balance.'];
            return back()->withNotify($notify);
        }

        $sender = $moneyRequest->sender;
        $sender->balance += $receivableAmount;
        $sender->save();

        $moneyRequest->status = '1';
        $moneyRequest->charge = $charge;
        $moneyRequest->save();

        $receiver = $moneyRequest->receiver;
        $receiver->balance -= $moneyRequest->amount;
        $receiver->save();

        $senderTransaction = new Transaction();
        $senderTransaction->user_id = $sender->id;
        $senderTransaction->amount = $moneyRequest->amount;
        $senderTransaction->charge = $charge;
        $senderTransaction->post_balance = $sender->balance;
        $senderTransaction->trx_type = '+';
        $senderTransaction->details = 'Received money from ' . $receiver->username;
        $senderTransaction->trx = getTrx();
        $senderTransaction->remark = 'receive_money';
        $senderTransaction->save();

        $receiverTransaction = new Transaction();
        $receiverTransaction->user_id = $receiver->id;
        $receiverTransaction->amount = $moneyRequest->amount;
        $receiverTransaction->charge = 0;
        $receiverTransaction->post_balance = $receiver->balance;
        $receiverTransaction->trx_type = '-';
        $receiverTransaction->details = 'Received money from ' . $sender->username;
        $receiverTransaction->trx = getTrx();
        $receiverTransaction->remark = 'sent_request_money';
        $receiverTransaction->save();
        notify($receiver, 'REQUEST_MONEY', [
            'sender_username' => $sender->username,
            'amount' => showAmount($moneyRequest->amount, currencyFormat: false),
        ]);

        $notify[] = ['success', 'Money request accepted!'];
        return back()->withNotify($notify);
    }

    public function declineMoneyRequest(Request $request)
    {
        $moneyRequest = MoneyRequest::find($request->id);
        $moneyRequest->status = '2';
        $moneyRequest->save();

        $sender = $moneyRequest->sender;
        $senderTransaction = new Transaction();
        $senderTransaction->user_id = $sender->id;
        $senderTransaction->amount = 0;
        $senderTransaction->charge = 0;
        $senderTransaction->post_balance = $sender->balance;
        $senderTransaction->trx_type = '-';
        $senderTransaction->details = 'Declined money request from ' . $moneyRequest->receiver->username;
        $senderTransaction->trx = getTrx();
        $senderTransaction->remark = 'decline_money_request';
        $senderTransaction->save();

        $notify[] = ['success', 'Money request declined !'];
        return back()->withNotify($notify);
    }
}
