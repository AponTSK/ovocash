@php
    $activeLang = $languages->where('code', config('app.locale') ?? 'en')->first();
@endphp

<header class="header" id="header">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="navbar-brand logo" href="{{ route('home') }}"><img src="{{ sitelogo() }}" alt="site-logo"></a>
            <button class="navbar-toggler header-button" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span id="hiddenNav"><i class="las la-bars"></i></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav nav-menu ms-auto">
                    <li class="nav-item d-block d-lg-none">
                        <div class="top-button d-flex flex-wrap justify-content-between align-items-center">
                            <div class="language-box">
                                <select class="select">
                                    <option selected>English</option>
                                    <option value="1">Bangla</option>
                                    <option value="2">French</option>
                                    <option value="3">Spenich</option>
                                </select>
                            </div>
                            <ul class="login-registration-list d-flex flex-wrap align-items-center">
                                @auth
                                    <li class="login-registration-list__item">
                                        <a class="login-registration-list__link btn btn--base btn--sm" href="{{ route('user.home') }}">@lang('Dashboard')</a>
                                    </li>
                                @else
                                    <li class="login-registration-list__item"><a href="{{ route('user.login') }}" class="login-registration-list__link"><span class="login-registration-list__icon"><i
                                                    class="fas fa-user"></i></span>
                                            Login</a></li>
                                    <li class="login-registration-list__item"><a href="{{ route('user.register') }}" class="login-registration-list__link btn btn--base btn--sm">Register</a></li>
                                @endauth
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{ route('home') }}">Home</a>
                    </li>
                    @foreach ($pages as $k => $data)
                        <li class="nav-item">
                            <a class="nav-link text-white" aria-current="page" href="{{ route('pages', [$data->slug]) }}">{{ __($data->name) }}
                            </a>
                        </li>
                    @endforeach
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"> Blog
                            <span class="nav-item__icon"><i class="las la-angle-down"></i></span></a>
                        <ul class="dropdown-menu">
                            <li class="dropdown-menu__list"><a class="dropdown-item dropdown-menu__link" href="{{ route('blogs') }}">Blog</a></li>
                            <li class="dropdown-menu__list"><a class="dropdown-item dropdown-menu__link" href="blog-details.html">Blog Details</a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('contact') }}">Contact</a>
                    </li>
                </ul>

                <div class="d-none d-lg-block">
                    <ul class="header-login list primary-menu">
                        @if (gs('multi_language'))
                            <div class="ml-auto">
                                @php
                                    $appLocal = strtoupper(config('app.locale')) ?? 'en';
                                @endphp
                                <select class="langSel select language-select form-control form--control form-select">
                                    @foreach ($languages as $language)
                                        <option value="{{ $language->code }}" @selected($appLocal == strtoupper($language->code))>
                                            {{ $language->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        @endif
                        @auth
                            <li class="header-login__item">
                                <a class="btn btn--base btn--sm" href="{{ route('user.home') }}">@lang('Dashboard')</a>
                            </li>
                        @else
                            <li class="header-login__item">
                                <a class="herader-btn" href="{{ route('user.login') }}"> Login</a>
                            </li>

                            <li class="header-login__item">
                                <a class="btn btn--base btn--sm" href="registration.html"> Register </a>
                            </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</header>
