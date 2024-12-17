@php
    $registerContent = getContent('login_register.content', true);
@endphp

@extends($activeTemplate . 'layouts.app')
@section('app-content')
    @if (gs('registration'))
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-7 col-xl-6">
                    <div class="card ">
                        <div class="card-header">
                            <h5 class="card-title">@lang('Register')</h5>
                        </div>
                        <div class="card-body">
                            @include($activeTemplate . 'partials.social_login')
                            <form action="{{ route('user.register') }}" method="POST" class="verify-gcaptcha ">
                                @csrf
                                <div class="row">
                                    @if (session()->get('reference') != null)
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="referenceBy" class="form-label">@lang('Reference by')</label>
                                                <input type="text" name="referBy" id="referenceBy" class="form-control form--control" value="{{ session()->get('reference') }}" readonly>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="form-group col-sm-6">
                                        <label class="form-label">@lang('First Name')</label>
                                        <input type="text" class="form-control form--control" name="firstname" value="{{ old('firstname') }}" required>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label class="form-label">@lang('Last Name')</label>
                                        <input type="text" class="form-control form--control" name="lastname" value="{{ old('lastname') }}" required>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label">@lang('E-Mail Address')</label>
                                            <input type="email" class="form-control form--control checkUser" name="email" value="{{ old('email') }}" required>
                                            <span class="exists-error d-none"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">@lang('Password')</label>
                                            <input type="password" class="form-control form--control" name="password" required>
                                            <x-strong-password />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">@lang('Confirm Password')</label>
                                            <input type="password" class="form-control form--control" name="password_confirmation" required>
                                        </div>
                                    </div>
                                    <x-captcha />
                                </div>

                                @if (gs('agree'))
                                    @php
                                        $policyPages = getContent('policy_pages.element', false, orderById: true);
                                    @endphp
                                    <div class="form-group">
                                        <input type="checkbox" id="agree" @checked(old('agree')) name="agree" required>
                                        <label for="agree">@lang('I agree with')</label> <span>
                                            @foreach ($policyPages as $policy)
                                                <a href="{{ route('policy.pages', $policy->slug) }}" target="_blank">{{ __($policy->data_values->title) }}</a>
                                                @if (!$loop->last)
                                                    ,
                                                @endif
                                            @endforeach
                                        </span>
                                    </div>
                                @endif
                                <div class="form-group">
                                    <button type="submit" id="recaptcha" class="btn btn--base w-100">
                                        @lang('Register')
                                    </button>
                                </div>
                                <p class="mb-0">
                                    @lang('Already have an account?') <a href="{{ route('user.login') }}">@lang('Login')</a>
                                </p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>





        <section class="account-section py-60">
            <div class="account-inner">
                <div class="container">
                    <div class="row gy-4 align-items-center flex-wrap-reverse">
                        <div class="col-lg-6">
                            <div class="account-info text-center">
                                <div class="account-info__thumb mb-4">
                                    <a href="{{ route('home') }}"><img src="{{ frontendImage('login_register', @$registerContent->data_values->image) }}" alt="image"></a>
                                </div>
                                <div class="account-info__content">
                                    <h4 class="account-info__title">{{ __(@$registerContent->data_values->heading) }}</h4>
                                    <p>{{ __(@$registerContent->data_values->subheading) }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="account-form">
                                <div class="account-form__content mb-4">
                                    <h3 class="account-form__title mb-2"> {{ __(@$registerContent->data_values->register_title) }}</h3>
                                    <p class="account-form__desc">{{ __(@$registerContent->data_values->register_subtitle) }}</p>
                                </div>
                                <form action="{{ route('user.register') }}" method="POST" class="verify-gcaptcha ">
                                    <div class="row">
                                        @if (session()->get('reference') != null)
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="referenceBy" class="form-label">@lang('Reference by')</label>
                                                    <input type="text" name="referBy" id="referenceBy" class="form-control form--control" value="{{ session()->get('reference') }}" readonly>
                                                </div>
                                            </div>
                                        @endif
                                        <div class="form-group col-sm-6">
                                            <div class="form-group">
                                                <label for="name" class="form-label form--label">@lang('First Name')</label>
                                                <input type="text" class="form-control form--control" name="firstname" value="{{ old('firstname') }}" required id="name" placeholder="@lang('First Name')">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="username" class="form--label">User Name</label>
                                                <input type="text" class="form--control" id="username" placeholder="User Name">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="email" class="form--label">Email Address</label>
                                                <input type="text" class="form--control" id="email" placeholder="Email Address">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="Number" class="form--label">Mobile</label>
                                                <input type="number" class="form--control" id="number" placeholder="+008">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="your-password" class="form--label">Password</label>
                                                <div class="input-group">
                                                    <input id="your-password" type="password" class="form-control form--control" value="Password">
                                                    <div class="password-show-hide fas fa-eye toggle-password fa-eye-slash" id="#your-password"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="confirm-password" class="form--label">Confirm Password</label>
                                                <div class="input-group">
                                                    <input id="confirm-password" type="password" class="form-control form--control" value="Confirm Password">
                                                    <div class="password-show-hide fas fa-eye toggle-password fa-eye-slash" id="#confirm-password"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <div class="form--check">
                                                    <input class="form-check-input" type="checkbox" value="" id="remember">
                                                    <div class="form-check-label">
                                                        <label class="" for="remember"> I agree with Licences Info,</label>
                                                        <a href="#" class="text--base">Terms of Service</a>
                                                        <label class="" for="remember"> , Privacy Policy </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn--base w-100">Sign Up</button>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="have-account text-center">
                                                <p class="have-account__text">Already Have An Account? <a href="login.html" class="have-account__link text--base">Login Now</a></p>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @else
        @include($activeTemplate . 'partials.registration_disabled')
    @endif

@endsection
@if (gs('registration'))
    @push('style')
        <style>
            .social-login-btn {
                border: 1px solid #cbc4c4;
            }
        </style>
    @endpush

    @push('script')
        <script>
            "use strict";
            (function($) {

                $('.checkUser').on('focusout', function(e) {
                    var url = "{{ route('user.checkUser') }}";
                    var value = $(this).val();
                    var token = '{{ csrf_token() }}';

                    var data = {
                        email: value,
                        _token: token
                    }

                    $.post(url, data, function(response) {
                        if (response.data == true) {
                            $(".exists-error").html(`
                                @lang('You’re already part of our community!')
                                <a class="ms-1" href="{{ route('user.login') }}">@lang('Login now')</a>
                            `).removeClass('d-none').addClass("text-danger mt-1 d-block");
                            $(`button[type=submit]`).attr('disabled', true).addClass('disabled');
                        } else {
                            $(".exists-error").empty().addClass('d-none').removeClass(
                                "text-danger mt-1 d-block");
                            $(`button[type=submit]`).attr('disabled', false).removeClass('disabled');
                        }
                    });
                });
            })(jQuery);
        </script>
    @endpush
@endif
