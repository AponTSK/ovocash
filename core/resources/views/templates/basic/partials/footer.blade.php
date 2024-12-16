@php
    $policyPages = getContent('policy_pages.element', false, orderById: true);
@endphp

<footer class="footer-area">
    <div class="pb-60 pt-120">
        <div class="container">
            <div class="row justify-content-center gy-5">
                <div class="col-xl-3 col-sm-6">
                    <div class="footer-item">
                        <div class="footer-item__logo">
                            <a class="navbar-brand logo" href="{{ route('home') }}"><img src="{{ sitelogo() }}" alt="site-logo"></a>
                        </div>
                        <p class="footer-item__desc"> Nam eget quam at metus iaculis tempor. Class aptent taciti sociosqu ad litora torquent. </p>
                        <ul class="social-list">
                            <li class="social-list__item"><a href="https://www.facebook.com" class="social-list__link"><i class="fab fa-facebook-f"></i></a> </li>
                            <li class="social-list__item"><a href="https://www.twitter.com" class="social-list__link active"> <i class="fab fa-twitter"></i></a></li>
                            <li class="social-list__item"><a href="https://www.linkedin.com" class="social-list__link"> <i class="fab fa-linkedin-in"></i></a></li>
                            <li class="social-list__item"><a href="https://www.pinterest.com" class="social-list__link"> <i class="fab fa-instagram"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-1 d-xl-block d-none"></div>
                <div class="col-xl-2 col-sm-6">
                    <div class="footer-item">
                        <h5 class="footer-item__title">Quick Links</h5>
                        <ul class="footer-menu">
                            <li class="footer-menu__item"><a href="{{ route('home') }}">@lang('Home')</a></li>
                            <li class="footer-menu__item"><a href="{{ route('blogs') }}">@lang('Blog')</a></li>
                            <li class="footer-menu__item"><a href="{{ route('contact') }}">@lang('Contact')</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-2 col-sm-6">
                    <div class="footer-item">
                        <h5 class="footer-item__title">@lang('Policy & Terms')</h5>
                        @foreach ($policyPages as $policy)
                            <li class="footer-menu__item">
                                <a href="{{ route('policy.pages', $policy->slug) }}">
                                    {{ __($policy->data_values->title) }}
                                </a>
                            </li>
                        @endforeach
                        <li class="footer-menu__item">
                            <a href="{{ route('cookie.policy') }}">
                                @lang('Cookie Policy')
                            </a>
                        </li>
                    </div>
                </div>

                <div class="col-xl-1 d-xl-block d-none"></div>
                <div class="col-xl-3 col-sm-6">
                    <div class="footer-item">
                        <h5 class="footer-item__title">Contact Info</h5>
                        <ul class="footer-menu">
                            <li class="footer-menu__item">
                                <a href="mailto:infolab123@gmail.com" class="footer-menu__link">infolab123@gmail.com</a>
                            </li>
                            <li class="footer-menu__item">
                                <a href="tel:00088889999" class="footer-menu__link">000 8888 9999</a>
                            </li>
                            <li class="footer-menu__item">
                                <a href="tel:00066663333" class="footer-menu__link">000 6666 3333</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer Top End-->

    <!-- bottom Footer -->
    <div class="bottom-footer-area section-bg">
        <div class="container">
            <div class="row gy-3">
                <div class="col-md-12 text-center">
                    <div class="bottom-footer   py-4">
                        <div class="bottom-footer-text"> &copy; Copyright 2023 . All rights reserved.</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
