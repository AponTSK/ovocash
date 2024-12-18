@extends($activeTemplate . 'layouts.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card custom--card">
                    <div class="card-header">
                        <h5 class="card-title">{{ __($pageTitle) }}</h5>
                    </div>
                    <div class="card-body p-5 text-center">
                        <form action="{{ route('user.send.money.confirm', $sendMoney->id) }}" method="post">
                            @csrf

                            <ul class="list-group text-center list-group-flush">
                                <li class="list-group-item d-flex justify-content-between">
                                    @lang('Receiver Usernamr'):
                                    <strong>{{ $sendMoney->receiver->username}}</strong>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    @lang('You will send '):
                                    <strong>{{ showAmount($sendMoney->amount) }}</strong>
                                </li>
                            </ul>
                            <button class="btn btn--base w-100 mt-3"  >@lang('Confirm Sendmoney')</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection