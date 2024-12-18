@extends($activeTemplate . 'layouts.master')
@section('content')
    <div>
        <h1>{{ $pageTitle }}</h1>
        <input type="text" id="usernameInput" placeholder="Enter username" class="form-control mb-2">
        <button class="btn btn--sm btn--base" id="searchButton">@lang('Search')</button>
        <p id="userDetails" class="mt-2"></p>

        <div id="sendMoneySection" class="d-none">
            <input type="number" id="amountInput" placeholder="Enter amount" class="form-control mb-2">
            <button class="btn btn-sm btn-primary" id="sendMoneyButton">@lang('Send Money')</button>
        </div>

        <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmationModalLabel">@lang('Confirmation')</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>@lang('Are you sure you want to send ')<span id="confirmAmount"></span> @lang('to') <span id="confirmUsername"></span>?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">
                            @lang('Cancel')
                        </button>
                        <button type="button" class="btn btn-primary" id="confirmSendButton">@lang('Send')</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('script-lib')
    <script>
        $(document).ready(function() {
            $('#searchButton').click(function() {
                let username = $('#usernameInput').val();

                if (username == '') {
                    alert('Please enter a username to search for');
                    return false;
                }

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
                            $('#sendMoneySection').removeClass('d-none').addClass('d-block');
                        } else {
                            $('#userDetails').text(response.message);
                            $('#sendMoneySection').removeClass('d-block').addClass('d-none');
                        }
                    },
                    error: function() {
                        alert('An error occurred.');
                    }
                });
            });

            $('#sendMoneyButton').click(function() {
                let username = $('#usernameInput').val();
                let amount = $('#amountInput').val();

                $('#confirmUsername').text(username);
                $('#confirmAmount').text(amount);
                $('#confirmationModal').modal('show');
            });

            $('#confirmSendButton').click(function() {
                let username = $('#usernameInput').val();
                let amount = $('#amountInput').val();

                $.ajax({
                    url: "{{ route('user.send.money') }}",
                    method: "POST",
                    data: {
                        username: username,
                        amount: amount,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        alert(response.message);
                        $('#confirmationModal').modal('hide');
                    },
                    error: function() {
                        alert('An error occurred.');
                    }
                });
            });
        });
    </script>
@endpush
