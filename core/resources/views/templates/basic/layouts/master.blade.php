@extends($activeTemplate . 'layouts.app')
@section('app-content')
    @include('Template::partials.auth_header')
    <div class="dashboard py-120 section-py section-bg-two">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-lg-4 pe-xl-4">
                    @include('Template::partials.auth_sidebar')
                </div>
                <div class="col-xl-9 col-lg-8">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
    @include('Template::partials.footer')
@endsection
