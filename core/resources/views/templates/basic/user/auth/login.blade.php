@php
    $loginContent = getContent('login_register.content', true);
@endphp

@extends($activeTemplate . 'layouts.app')
@section('app-content')
    <section class="account-section py-5">
        <div class="account-inner">
            <div class="container">
                <div class="row gy-4 align-items-center flex-wrap-reverse">
                    <div class="col-lg-6">
                        <div class="account-info text-center">
                            <div class="account-info__thumb mb-4">
                                <a href="{{ route('home') }}"><img src="{{ frontendImage('login_register', @$loginContent->data_values->image) }}" alt="image"></a>
                            </div>
                            <div class="account-info__content">
                                <h4 class="account-info__title">{{ __(@$loginContent->data_values->heading) }}</h4>
                                <p>{{ __(@$loginContent->data_values->subheading) }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="account-form">
                            <div class="account-form__content mb-4">
                                <h4 class="account-form__title mb-2"> {{ __(@$loginContent->data_values->login_title) }} </h4>
                                <p class="account-form__desc">{{ __(@$loginContent->data_values->login_subtitle) }}</p>
                            </div>
                            <form method="POST" action="{{ route('user.login') }}" class="verify-gcaptcha">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="email" class="form--label">@lang('Username or Email')</label>
                                            <input type="text" name="username" value="{{ old('username') }}" class="form-control form--control" required id="email" placeholder="@lang('Enter Username or Email')">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="your-password" class="form--label">@lang('Password')</label>
                                            <div class="input-group">
                                                <input id="password" type="password" class="form-control form--control" name="password" required placeholder="@lang('Enter Password')" type="password" value="Password">
                                                <div class="password-show-hide fas fa-eye toggle-password fa-eye-slash" id="#password"></div>
                                            </div>
                                        </div>

                                        <x-captcha />

                                    </div>

                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <div class="d-flex flex-wrap justify-content-between">
                                                <div class="form--check">
                                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="remember">@lang('Remember me')</label>
                                                </div>
                                                <a href="{{ route('user.password.request') }}" class="forgot-password text--base">@lang('Forgot Your Password?')</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <button type="submit" id="recaptcha" class="btn btn--base w-100 mb-4">@lang('Sign In')</button>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="have-account text-center">
                                            <p class="have-account__text mb-0">@lang('Don\'t have any account?')<a href="{{ route('user.register') }}" class="have-account__link text--base">@lang('Create Account')</a></p>
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
@endsection
