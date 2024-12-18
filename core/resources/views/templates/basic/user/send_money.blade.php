@extends($activeTemplate . 'layouts.master')
@section('content')
    <div>
        <h1>{{ $pageTitle }}</h1>
        <form action="{{ route('user.send.money') }}" method="post">
            @csrf
        <input type="text" id="usernameInput" name="username" value="{{ old('username') }}" placeholder="Enter username" class="form-control mb-2">
     
        <p id="userDetails" class="mt-2"></p>

        <div id="sendMoneySection" class="d-none">
                <input type="number" name="amount" value="{{ old('amount') }}" step="any"  placeholder="Enter amount"  class="form-control mb-2" required>
                <button class="btn btn-sm btn--base" >@lang('Send Money')</button>
            </div>
        </form>

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
            $('[name="username"]').on('focusout',function() {
                let username = $(this).val();

                if (username == '') {
                    notify('error','Please enter a username to search for')
                    return;
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
        });
    </script>
@endpush
