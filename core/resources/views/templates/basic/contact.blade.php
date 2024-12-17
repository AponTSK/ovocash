@php
    $contactContent = getContent('contact_us.content', true);
@endphp

@extends($activeTemplate . 'layouts.frontend')
@section('content')

    <section class="contact-top section-py pb-60">
        <div class="container">
            <div class="row">
                <div class="section-heading style-three single-style">
                    <h2 class="section-heading__title">{{ __($pageTitle) }}</h2>
                </div>
            </div>

            <div class="row gy-4 justify-content-center">
                <div class="contact-info-wrapper">
                    <div class="contact-item">
                        <div class="contact-item__icon">
                            @php
                                echo @$contactContent->data_values->address_icon;
                            @endphp
                        </div>
                        <div class="contact-item__content">
                            <h4 class="contact-item__title">{{ __($contactContent->data_values->address_title) }}</h4>
                            <p class="contact-item__desc">{{ __($contactContent->data_values->address_short_details) }}</p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="contact-item__icon  phone-icon ">
                            @php
                                echo @$contactContent->data_values->contact_icon;
                            @endphp
                        </div>
                        <div class="contact-item__content">
                            <h4 class="contact-item__title">{{ __($contactContent->data_values->contact_title) }}</h4>
                            <p class="contact-item__number"><a href="tel:{{ $contactContent->data_values->contact_number }}">{{ $contactContent->data_values->contact_number }}</a></p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="contact-item__icon">
                            @php
                                echo @$contactContent->data_values->email_icon;
                            @endphp
                        </div>
                        <div class="contact-item__content">
                            <h4 class="contact-item__title">{{ __($contactContent->data_values->email_title) }}</h4>
                            <p class="contact-item__desc"><a href="mailto:{{ $contactContent->data_values->email_address }}">{{ $contactContent->data_values->email_address }}</a> </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="contact-bottom  pb-120 pt-20">
        <div class="container">
            <div class="row gy-5 flex-wrap-reverse align-items-center">
                <div class="col-lg-6 pe-lg-5">
                    <div class="contact-thumb">
                        <img src="{{ frontendImage('contact_us', @$contactContent->data_values->image) }}" alt="">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="contactus-form">
                        <h3 class="contact__title card-title pb-2">{{ __($pageTitle) }}</h3>
                        <form class="verify-gcaptcha contact-form-box" action="{{ route('contact') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-sm-6 form-group">
                                    <div class="form--group">
                                        <label for="name" class="form-label form--label required">@lang('Your Name')</label>
                                        <input name="name" type="text" class="form-control form--control" value="{{ old('name', @$user->fullname) }}" @if ($user && $user->profile_complete) readonly @endif required
                                            id="name" placeholder="@lang('Your first name')">
                                    </div>
                                </div>
                                <div class="col-sm-6 form-group">
                                    <div class="form--group">
                                        <label for="email" class="form-label form--label required">@lang('Your Email')</label>
                                        <input name="email" type="email" class="form-control form--control" value="{{ old('email', @$user->email) }}" @if ($user) readonly @endif required
                                            id="email" placeholder="@lang('Enter your email')">
                                    </div>
                                </div>
                                <div class="col-lg-12 form-group">
                                    <div class="form--group">
                                        <label for="subject" class="form-label form--label required">@lang('Your Subject')</label>
                                        <input type="text" id="subject" placeholder="@lang('Enter your subject')" name="subject" class="form-control form--control" value="{{ old('subject') }}" required>
                                    </div>
                                </div>
                                <div class="col-lg-12 form-group">
                                    <div class="form--group">
                                        <label for="message" class="form--label required">@lang('How can we help you?')</label>
                                        <textarea id="message" name="message" class="form-control form--control" required></textarea>
                                    </div>
                                </div>
                                <x-captcha />
                                <div class="col-sm-12 form-group">
                                    <button type="submit" class="btn btn--base w-100"> @lang('Submit')</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>


    @if (@$sections->secs != null)
        @foreach (json_decode($sections->secs) as $sec)
            @include($activeTemplate . 'sections.' . $sec)
        @endforeach
    @endif
@endsection
