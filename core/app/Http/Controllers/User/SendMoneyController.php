<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\SendMoney;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class SendMoneyController extends Controller
{
    public function send()
    {
        $pageTitle = 'Send Money History';
        return view('Template::user.send_money.history', compact('pageTitle'));
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

        $notify[] = ['success', 'Send Money request created successfully.'];
        return back()->withNotify($notify);
    }


    public function sendMoneyPreview($id)
    {
        $pageTitle = 'Send Money Preview';
        $sendMoney = SendMoney::where('status', 0)->with('receiver')->findOrFail($id);
        return view('Template::user.send_money_preview', compact('sendMoney', 'pageTitle'));
    }
}
