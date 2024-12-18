@php
    $user = auth()->user();
@endphp

@extends($activeTemplate . 'layouts.master')
@section('content')
    <div class="dashboard-body">

        <div class="col-md-12">
            @php
                $kyc = getContent('kyc.content', true);
            @endphp
            @if (auth()->user()->kv == Status::KYC_UNVERIFIED && auth()->user()->kyc_rejection_reason)
                <div class="alert alert-danger" role="alert">
                    <div class="d-flex justify-content-between">
                        <h4 class="alert-heading">@lang('KYC Documents Rejected')</h4>
                        <button class="btn btn-outline-secondary " data-bs-toggle="modal" data-bs-target="#kycRejectionReason">@lang('Show Reason')</button>
                    </div>
                    <hr>
                    <p class="mb-0">{{ __(@$kyc->data_values->reject) }} <a href="{{ route('user.kyc.form') }}">@lang('Click Here to Re-submit Documents')</a>.</p>
                    <br>
                    <a href="{{ route('user.kyc.data') }}">@lang('See KYC Data')</a>
                </div>
            @elseif(auth()->user()->kv == Status::KYC_UNVERIFIED)
                <div class="alert alert-info" role="alert">
                    <h4 class="alert-heading">@lang('KYC Verification required')</h4>
                    <hr>
                    <p class="mb-0">{{ __(@$kyc->data_values->required) }} <a href="{{ route('user.kyc.form') }}">@lang('Click Here to Submit Documents')</a></p>
                </div>
            @elseif(auth()->user()->kv == Status::KYC_PENDING)
                <div class="alert alert-warning" role="alert">
                    <h4 class="alert-heading">@lang('KYC Verification pending')</h4>
                    <hr>
                    <p class="mb-0">{{ __(@$kyc->data_values->pending) }} <a href="{{ route('user.kyc.data') }}">@lang('See KYC Data')</a></p>
                </div>
            @endif
        </div>
        <div class="dashboard-body__bar d-lg-none d-block">
            <span class="dashboard-body__bar-icon"><i class="las la-bars"></i></span>
        </div>

        <div class="row gy-4 justify-content-center">
            <div class="col-xl-4 col-lg-6 col-sm-6">
                <div class="dashboard-card">
                    <div class="dashboard-card__icon">
                        <i class="las la-coins"></i>
                    </div>
                    <div class="dashboard-card__content">
                        <p class="dashboard-card__title">@lang('Total Deposits')</p>
                        <h4 class="dashboard-card__amount">{{ showAmount($user->deposits->sum('amount')) }}</h4>
                    </div>
                </div>


            </div>
            <div class="col-xl-4 col-lg-6 col-sm-6">
                <div class="dashboard-card">
                    <div class="dashboard-card__icon">
                        <i class="las la-hand-holding-usd"></i>
                    </div>
                    <div class="dashboard-card__content">
                        <p class="dashboard-card__title">@lang('Total Withdraw')</p>
                        <h4 class="dashboard-card__amount">{{ showAmount($withdrawalAmount) }}</h4>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6 col-sm-6">
                <div class="dashboard-card">
                    <div class="dashboard-card__icon">
                        <i class="las la-file-invoice-dollar"></i>
                    </div>
                    <div class="dashboard-card__content">
                        <p class="dashboard-card__title">@lang('Pending withdraw')</p>
                        <h4 class="dashboard-card__amount">{{ showAmount($pendingAmount) }}</h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="dashboard-table mt-5 d-none">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-header__title mb-0 text-dark">
                        Dashboard Table
                    </h5>
                </div>
                <div class="card-body">
                    <table class="table table--responsive--xl">
                        <thead>
                            <tr>
                                <th>Hiring number</th>
                                <th>Username</th>
                                <th>Amount/Delivery</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td data-label="Invoice No">#95954</td>
                                <td data-label="Customer">
                                    <div class="customer">
                                        <div class="customer__content">
                                            <h6 class="customer__name">Tomaslau</h6>
                                        </div>
                                    </div>
                                </td>
                                <td data-label="Date">10.00$</td>
                                <td data-label="Status"><span>Pending</span></td>
                                <td data-label="Action">
                                    <div class="dropdown table-action">
                                        <span href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false" class="">
                                            <i class="fas fa-ellipsis-h"></i>
                                        </span>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink" style="">
                                            <li>
                                                <a class="dropdown-item" href="#">Action</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="#">Edit</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="#">Add</a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td data-label="Invoice No">#95954</td>
                                <td data-label="Customer">
                                    <div class="customer">
                                        <div class="customer__content">
                                            <h6 class="customer__name">Erwin E. Brown</h6>
                                        </div>
                                    </div>
                                </td>
                                <td data-label="Date">10.00$</td>
                                <td data-label="Status"><span>Pending</span></td>
                                <td data-label="Action">
                                    <div class="dropdown table-action">
                                        <span href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false" class="">
                                            <i class="fas fa-ellipsis-h"></i>
                                        </span>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink" style="">
                                            <li>
                                                <a class="dropdown-item" href="#">Action</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="#">Edit</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="#">Add</a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td data-label="Invoice No">#95954</td>
                                <td data-label="Customer">
                                    <div class="customer">
                                        <div class="customer__content">
                                            <h6 class="customer__name">
                                                Margeret V. Ligon
                                            </h6>
                                        </div>
                                    </div>
                                </td>
                                <td data-label="Date">10.00$</td>
                                <td data-label="Status"><span>Pending</span></td>
                                <td data-label="Action">
                                    <div class="dropdown table-action">
                                        <span href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false" class="">
                                            <i class="fas fa-ellipsis-h"></i>
                                        </span>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink" style="">
                                            <li>
                                                <a class="dropdown-item" href="#">Action</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="#">Edit</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="#">Add</a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td data-label="Invoice No">#95954</td>
                                <td data-label="Customer">
                                    <div class="customer">
                                        <div class="customer__content">
                                            <h6 class="customer__name">Jose D. Delacruz</h6>
                                        </div>
                                    </div>
                                </td>
                                <td data-label="Date">10.00$</td>
                                <td data-label="Status"><span>Pending</span></td>
                                <td data-label="Action">
                                    <div class="dropdown table-action">
                                        <span href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false" class="">
                                            <i class="fas fa-ellipsis-h"></i>
                                        </span>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink" style="">
                                            <li>
                                                <a class="dropdown-item" href="#">Action</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="#">Edit</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="#">Add</a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td data-label="Invoice No">#95954</td>
                                <td data-label="Customer">
                                    <div class="customer">
                                        <div class="customer__content">
                                            <h6 class="customer__name">Luke J. Sain</h6>
                                        </div>
                                    </div>
                                </td>
                                <td data-label="Date">10.00$</td>
                                <td data-label="Status"><span>Pending</span></td>
                                <td data-label="Action">
                                    <div class="dropdown table-action">
                                        <span href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false" class="">
                                            <i class="fas fa-ellipsis-h"></i>
                                        </span>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink" style="">
                                            <li>
                                                <a class="dropdown-item" href="#">Action</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="#">Edit</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="#">Add</a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td data-label="Invoice No">#95954</td>
                                <td data-label="Customer">
                                    <div class="customer">
                                        <div class="customer__content">
                                            <h6 class="customer__name">Jamal Burnett</h6>
                                        </div>
                                    </div>
                                </td>
                                <td data-label="Date">10.00$</td>
                                <td data-label="Status"><span>Pending</span></td>
                                <td data-label="Action">
                                    <div class="dropdown table-action">
                                        <span href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false" class="">
                                            <i class="fas fa-ellipsis-h"></i>
                                        </span>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink" style="">
                                            <li>
                                                <a class="dropdown-item" href="#">Action</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="#">Edit</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="#">Add</a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td data-label="Invoice No">#95954</td>
                                <td data-label="Customer">
                                    <div class="customer">
                                        <div class="customer__content">
                                            <h6 class="customer__name">Jamal Burnett</h6>
                                        </div>
                                    </div>
                                </td>
                                <td data-label="Date">10.00$</td>
                                <td data-label="Status"><span>Pending</span></td>
                                <td data-label="Action">
                                    <div class="dropdown table-action">
                                        <span href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false" class="">
                                            <i class="fas fa-ellipsis-h"></i>
                                        </span>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink" style="">
                                            <li>
                                                <a class="dropdown-item" href="#">Action</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="#">Edit</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="#">Add</a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    @if (auth()->user()->kv == Status::KYC_UNVERIFIED && auth()->user()->kyc_rejection_reason)
        <div class="modal fade" id="kycRejectionReason">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">@lang('KYC Document Rejection Reason')</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>{{ auth()->user()->kyc_rejection_reason }}</p>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
