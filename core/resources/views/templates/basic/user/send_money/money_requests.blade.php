@extends($activeTemplate . 'layouts.master')
@section('content')
    <div>
        <h1>{{ $pageTitle }}</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>@lang('Requested By')</th>
                    <th>@lang('Amount')</th>
                    <th>@lang('Status')</th>
                    <th>@lang('Actions')</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($moneyRequests as $request)
                    <tr>
                        <td>{{ $request->sender->username }}</td>
                        <td>{{ showAmount($request->amount, currencyFormat: false) }}</td>

                        <td>
                        @if ($request->status == 0)
                            <span class="bg--warning">@lang('Pending')</span>
                        @elseif ($request->status == 1)
                            <span class="bg--success">@lang('Accepted')</span>
                        @elseif ($request->status == 2)
                            <span class="bg--danger">@lang('Declined')</span>
                        @endif
                        </td>
                        <td>
                            @if ($request->status == '0')
                            <div class="d-flex align-items-center gap-2 justify-content-end">
                                    <a type="submit" class="btn btn--sm btn-success accept-request" data-id="{{ $request->id }}" ><i class="las la-check-square"></i></a>

                                    <a type="submit" class="btn btn--sm btn-danger decline_request" data-id="{{ $request->id }}"><i class="las la-window-close"></i></a>
                            </div>
                            @else
                            <div class="d-flex align-items-center gap-2 justify-content-end">
                                    <a href="{{ route('user.accept.money.request',$request->id) }}" type="submit" class="btn btn--sm btn-success disabled" ><i class="las la-check-square"></i></a>

                                    <a href="{{ route('user.decline.money.request',$request->id) }}" type="submit" class="btn btn--sm btn-danger disabled"><i class="las la-window-close"></i></a>
                            </div>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection

