<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container">
        <a class="navbar-brand logo" href="{{ route('home') }}"><img src="{{ sitelogo() }}" alt="site-logo"></a>
        <button class="navbar-toggler header-button" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
            <span id="hiddenNav"><i class="las la-bars"></i></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav nav-menu ms-auto">
                <li class="nav-item d-block d-lg-none">
                    <div class="top-button d-flex flex-wrap justify-content-between align-items-center">
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

                    </div>
                </li>

                <div class="d-none d-lg-block">
                    <ul class="header-login list primary-menu">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="{{ route('home') }}">@lang('Home')</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('blogs') }}">@lang('Blog')</a>

                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('contact') }}">@lang('Contact')</a>
                        </li>

                        <li class="header-login__item">
                            <a class="btn btn--base btn--sm" href="{{ route('user.logout') }}">@lang('Logout')</a>
                        </li>
                    </ul>
                </div>
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
                </ul>
            </div>
        </div>
    </div>
</nav>
