@extends($activeTemplate . 'layouts.master')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h1>{{ $pageTitle }}</h1>
                <div class=" d-flex justify-content-between mb-4 flex-wrap">
                    <form>
                        <div class="input-group">
                            <input type="search" name="search" class="form-control form--control search-form__btn"
                                value="{{ request()->search }}" placeholder="@lang('Search by transactions')">
                            <button class="input-group-text btn--base text-white">
                                <i class="las la-search"></i>
                            </button>
                        </div>
                    </form>
                    <a href="{{ route('user.create.money.request') }}" class="btn btn--base btn-sm">@lang('New Request Money')</a>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>@lang('Sender')</th>
                            <th>@lang('Receiver')</th>
                            <th>@lang('Amount')</th>
                            <th>@lang('Charge')</th>
                            <th>@lang('Status')</th>
                            <th>@lang('Date')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($moneyRequests as $request)
                            <tr>
                                <td>{{ $request->sender->username }}</td>
                                <td>{{ $request->receiver->username }}</td>
                                <td>{{ $request->amount }}</td>
                                <td>{{ $request->charge }}</td>
                                <td>{{ $request->status }}</td>
                                <td>{{ $request->created_at }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection