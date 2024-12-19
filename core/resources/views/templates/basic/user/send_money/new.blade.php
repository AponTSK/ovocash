@extends($activeTemplate . 'layouts.master')
@section('content')
    <div>
        <h1>{{ $pageTitle }}</h1>
        <form class="sendMoneyForm" method="post" action="{{ route('user.send.money') }}">
            @csrf
            <div class="form-group">
                <label class="form-label"> @lang('Username')</label>
                <input type="text" name="username" value="{{ old('username') }}" placeholder="@lang('Enter username')" class="form-control  form--control usernameInput" required>
                <p id="userDetails" class="text-success mt-2"></p>
            </div>
            <div class="form-group">
                <label class="form-label"> @lang('Amount')</label>
                <input type="number" name="amount" value="{{ old('amount') }}" placeholder="@lang('Enter amount')" class="form-control form--control" required>
                <p id="balanceDetails" class="text-danger mt-2"></p>
            </div>
            <div class="form-group">
                <ul class="list-group list-group-flush">
                    <li class=" list-group-item d-flex flex-wrap justify-content-between gap-2">
                        <span>@lang('Amount')</span>
                        <span>@lang('0.00') {{ __(gs('cur_text')) }} </span>
                    </li>
                    <li class=" list-group-item d-flex flex-wrap justify-content-between gap-2">
                        <span>@lang('Charge')</span>
                        <span>@lang('0.00') {{ __(gs('cur_text')) }} </span>
                    </li>
                    <li class=" list-group-item d-flex flex-wrap justify-content-between gap-2">
                        <span>@lang('Final Amount')</span>
                        <span>@lang('0.00') {{ __(gs('cur_text')) }} </span>
                    </li>
                </ul>
            </div>
            <div class="form-group">
                <button class="btn btn-sm btn--base sendMoneyBtn" >@lang('Send Money')</button>
            </div>

        </form>
    </div>

    <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">@lang('Confirmation Modal')</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>@lang('Are you sure you want to send money')?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang('No')</button>
                <button type="button" class="btn btn--base confirmYesButton">@lang('Yes')</button>
            </div>
            </div>
        </div>
        </div>

@endsection


@push('script-lib')
    <script>
        $(document).ready(function() {
            $('[name="username"]').on('focusout', function() {
                let username = $(this).val();
                if (username == '') {
                    $('#userDetails').text('Please enter a username');
                    $('#userDetails').removeClass('text-success mt-2').addClass('text-danger mt-2');
                } else {
                    $.ajax({
                        url: "{{ route('user.search.user') }}",
                        method: "POST",
                        data: {
                            username: username,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            if (response.success) {
                                $('#userDetails').text(`User Found: ${response.user.username}`);
                                $('#userDetails').removeClass('text-danger mt-2').addClass('text-success mt-2');
                            } else {
                                $('#userDetails').text(response.message);
                                $('#userDetails').removeClass('text-success mt-2').addClass('text-danger mt-2');

                            }
                        },
                        error: function() {
                            alert('An error occurred.');
                        }
                    });
                }

            });
        });


    // Prevent default form submission and show the confirmation modal
    $('.sendMoneyForm').on('submit', function (e) {
        e.preventDefault();
        $('#confirmModal').modal('show');
    });

    // Submit the form when 'Yes' button in the modal is clicked
    $(document).on('click', '.confirmYesButton', function () {
        $('.sendMoneyForm').off('submit').submit(); // Remove previous event listener and submit the form
    });




        $('[name="amount"]').on('input', function() {
            let amount = parseFloat($(this).val());
            let fixedCharge = parseFloat('{{ gs('send_money_fixed_charge') }}');
            let percentCharge = parseFloat('{{ gs('send_money_percent_charge') }}');

            if (amount > 0) {
                let charge = fixedCharge + (amount / 100) * percentCharge;
                let finalAmount = amount + charge;

                if (finalAmount > {{ auth()->user()->balance }}) {
                    $('#balanceDetails').text('insufficient balance');
                    $('.sendMoneyBtn').attr('disabled', true);
                    return;
                }
                $('.sendMoneyBtn').attr('disabled', false);

                $('li:has(span:contains("Charge")) span:last-child').text(charge.toFixed(2) + ' {{ __(gs('cur_text')) }}');
                $('li:has(span:contains("Amount")) span:last-child').text(amount.toFixed(2) + ' {{ __(gs('cur_text')) }}');
                $('li:has(span:contains("Final Amount")) span:last-child').text(finalAmount.toFixed(2) + ' {{ __(gs('cur_text')) }}');
            } else {
                $('li:has(span:contains("Charge")) span:last-child').text('0.00 {{ __(gs('cur_text')) }}');
                $('li:has(span:contains("Amount")) span:last-child').text('0.00 {{ __(gs('cur_text')) }}');
                $('li:has(span:contains("Final Amount")) span:last-child').text('0.00 {{ __(gs('cur_text')) }}');

            }

        });
    </script>
@endpush
