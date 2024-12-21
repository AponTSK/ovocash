@extends('admin.layouts.app')
@section('panel')
    <form action="{{ route('admin.setting.charge.store') }}" class="disableSubmission" method="POST">
        <div class="row gy-4">
            @csrf
            <div class="col-lg-6">
                <div class="card border border--gray h-100">
                    <h5 class="card-header bg--gray fs-20">@lang('Send Money Range')</h5>
                    <div class="card-body">
                        <div class="form-group">
                            <label>@lang('Minimum Amount')</label>
                            <div class="input-group input--group">
                                <input type="number" step="any" class="form-control" name="send_money_min_limit" value="{{ getAmount(gs('send_money_fixed_charge')) }}" required />
                                <div class="input-group-text"> {{ __(gs('cur_text')) }} </div>
                            </div>
                            <span class="text--danger fs-13 d-none minimum-error">@lang('The minimum amount must be greater than the fixed charge')</span>
                        </div>
                        <div class="form-group">
                            <label>@lang('Maximum Amount')</label>
                            <div class="input-group input--group">
                                <input type="number" step="any" class="form-control" name="send_money_max_limit" value="{{ getAmount(gs('send_money_max_limit')) }}" required />
                                <div class="input-group-text"> {{ __(gs('cur_text')) }} </div>
                            </div>
                            <span class="text--danger fs-13 maximum-error d-none">@lang('The maximum amount must be greater than the minimum amount')</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card border border--gray h-100">
                    <h5 class="card-header bg--gray fs-20">@lang(' Send Money Charge')</h5>
                    <div class="card-body">
                        <div class="form-group">
                            <label>@lang('Fixed Charge')</label>
                            <div class="input-group input--group">
                                <input type="number" step="any" class="form-control" name="send_money_fixed_charge" value="{{ getAmount(gs('send_money_fixed_charge')) }}" required />
                                <div class="input-group-text"> {{ __(gs('cur_text')) }} </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>@lang('Percent Charge')</label>
                            <div class="input-group input--group">
                                <input type="number" step="any" class="form-control" name="send_money_percent_charge" value="{{ gs('send_money_percent_charge') }}" required>
                                <div class="input-group-text">%</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <x-admin.ui.btn.submit class="submit-btn mb-3" />
            </div>
        </div>
    </form>

    <form action="{{ route('admin.setting.request.money.charge.store') }}" class="disableSubmission" method="POST">
        <div class="row gy-4">
            @csrf
            <div class="col-lg-6">
                <div class="card border border--gray h-100">
                    <h5 class="card-header bg--gray fs-20">@lang('Request Money Range')</h5>
                    <div class="card-body">
                        <div class="form-group">
                            <label>@lang('Minimum Amount')</label>
                            <div class="input-group input--group">
                                <input type="number" step="any" class="form-control" name="request_money_min_limit" value="{{ getAmount(gs('request_money_fixed_charge')) }}" required />
                                <div class="input-group-text"> {{ __(gs('cur_text')) }} </div>
                            </div>
                            <span class="text--danger fs-13 d-none minimum-error">@lang('The minimum amount must be greater than the fixed charge')</span>
                        </div>
                        <div class="form-group">
                            <label>@lang('Maximum Amount')</label>
                            <div class="input-group input--group">
                                <input type="number" step="any" class="form-control" name="request_money_max_limit" value="{{ getAmount(gs('request_money_max_limit')) }}" required />
                                <div class="input-group-text"> {{ __(gs('cur_text')) }} </div>
                            </div>
                            <span class="text--danger fs-13 maximum-error d-none">@lang('The maximum amount must be greater than the minimum amount')</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card border border--gray h-100">
                    <h5 class="card-header bg--gray fs-20">@lang('Request Money Charge')</h5>
                    <div class="card-body">
                        <div class="form-group">
                            <label>@lang('Fixed Charge')</label>
                            <div class="input-group input--group">
                                <input type="number" step="any" class="form-control" name="request_money_fixed_charge" value="{{ getAmount(gs('request_money_fixed_charge')) }}" required />
                                <div class="input-group-text"> {{ __(gs('cur_text')) }} </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>@lang('Percent Charge')</label>
                            <div class="input-group input--group">
                                <input type="number" step="any" class="form-control" name="request_money_percent_charge" value="{{ gs('request_money_percent_charge') }}" required>
                                <div class="input-group-text">%</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <x-admin.ui.btn.submit class="submit-btn" />
            </div>
        </div>
    </form>
@endsection


@push('script')
    <script>
        (function($) {
            "use strict";

            $("input[name=send_money_min_limit],input[name=send_money_max_limit],input[name=send_money_fixed_charge]").on('input change', function() {
                validation();
            });

            const validation = () => {
                const minLimit = Number($('input[name=send_money_min_limit]').val());
                const maxLimit = Number($('input[name=send_money_max_limit]').val());
                const fixedCharge = Number($('input[name=send_money_fixed_charge]').val());
                var minAmountValidate, maxAmountValidate = false;

                if (minLimit && (minLimit <= fixedCharge)) {
                    $(".minimum-error").removeClass('d-none');
                    minAmountValidate = false;
                } else {
                    $(".minimum-error").addClass('d-none');
                    minAmountValidate = true;
                }

                if (maxLimit <= minLimit && (minLimit && maxLimit)) {
                    maxAmountValidate = false;
                    $(".maximum-error").removeClass('d-none');
                } else {
                    $(".maximum-error").addClass('d-none');
                    maxAmountValidate = true;
                }

                if (minAmountValidate && maxAmountValidate) {
                    $(".submit-btn").removeClass('disabled').attr("disabled", false);
                } else {
                    $(".submit-btn").addClass('disabled').attr("disabled", true);
                }
            }
        })(jQuery);
    </script>
    <script>
        (function($) {
            "use strict";

            $("input[name=request_money_min_limit],input[name=request_money_max_limit],input[name=request_money_fixed_charge]").on('input change', function() {
                validation();
            });

            const validation = () => {
                const minLimit = Number($('input[name=request_money_min_limit]').val());
                const maxLimit = Number($('input[name=request_money_max_limit]').val());
                const fixedCharge = Number($('input[name=request_money_fixed_charge]').val());
                var minAmountValidate, maxAmountValidate = false;

                if (minLimit && (minLimit <= fixedCharge)) {
                    $(".minimum-error").removeClass('d-none');
                    minAmountValidate = false;
                } else {
                    $(".minimum-error").addClass('d-none');
                    minAmountValidate = true;
                }

                if (maxLimit <= minLimit && (minLimit && maxLimit)) {
                    maxAmountValidate = false;
                    $(".maximum-error").removeClass('d-none');
                } else {
                    $(".maximum-error").addClass('d-none');
                    maxAmountValidate = true;
                }

                if (minAmountValidate && maxAmountValidate) {
                    $(".submit-btn").removeClass('disabled').attr("disabled", false);
                } else {
                    $(".submit-btn").addClass('disabled').attr("disabled", true);
                }
            }
        })(jQuery);
    </script>
@endpush
