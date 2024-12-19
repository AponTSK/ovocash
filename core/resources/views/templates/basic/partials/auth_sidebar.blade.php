@php
    $user = auth()->user();
@endphp

<div class="sidebar-menu">
    <span class="sidebar-menu__close d-lg-none d-block"><i class="las la-times"></i></span>
    <div class="sidebar-menu__profile text-center">
        <div class="thumb">
            <img src="{{ @$user->image_src }}" alt="">
        </div>
        <h5 class="title">
            {{ $user->username }}
        </h5>
        <span>{{ showDateTime($user->created_at) }}</span>

        <div class="balance-box balance-check-toggle mt-4">
            <span class="balance-check">@lang('Check Balance')</span>
            <span class="balance-value">{{ showAmount($user->balance) }}</span>
        </div>

    </div>

    <ul class="sidebar-menu-list">
        <li class="sidebar-menu-list__item {{ menuActive('user.home*') }}">
            <a href="{{ route('user.home') }}" class="sidebar-menu-list__link">
                <span class="icon"><i class="las la-home"></i></span>
                <span class="text">@lang('Dashboard')</span>
            </a>
        </li>
        <li class="sidebar-menu-list__item {{ menuActive('user.deposit.history*') }}">
            <a href="{{ route('user.deposit.history') }}" class="sidebar-menu-list__link">
                <span class="icon"><i class="las la-coins"></i></span>
                <span class="text">@lang('Deposit')</span>
            </a>
        </li>
        <li class="sidebar-menu-list__item {{ menuActive('user.withdraw.history*') }}">
            <a href="{{ route('user.withdraw.history') }}" class="sidebar-menu-list__link">
                <span class="icon"><i class="las la-wallet"></i></span>
                <span class="text">@lang('Withdraw')</span>
            </a>
        </li>
        <li class="sidebar-menu-list__item {{ menuActive('user.send*') }}">
            <a href="{{ route('user.send') }}" class="sidebar-menu-list__link">
                <span class="icon"><i class="las la-money-bill-wave"></i></span>
                <span class="text">@lang('Send Money')</span>
            </a>
        </li>
        <li class="sidebar-menu-list__item {{ menuActive('user.request*') }}">
            <a href="{{ route('user.request') }}" class="sidebar-menu-list__link">
                <span class="icon"><i class="las la-dollar-sign"></i></span>
                <span class="text">@lang('Request Money')</span>
            </a>
        </li>
        <li class="sidebar-menu-list__item {{ menuActive('ticket.index*') }}">
            <a href="{{ route('ticket.index') }}" class="sidebar-menu-list__link">
                <span class="icon"><i class="las la-ticket-alt"></i></span>
                <span class="text">@lang('My Ticket')</span>
            </a>
        </li>
        <li class="sidebar-menu-list__item {{ menuActive('user.transactions*') }}">
            <a href="{{ route('user.transactions') }}" class="sidebar-menu-list__link">
                <span class="icon"><i class="las la-file-invoice-dollar"></i></span>
                <span class="text"> @lang('Transactions')</span>
            </a>
        </li>
        <li class="sidebar-menu-list__item {{ menuActive('user.change.password*') }}">
            <a href="{{ route('user.change.password') }}" class="sidebar-menu-list__link">
                <span class="icon"><i class="las la-key"></i></span>
                <span class="text"> @lang('Change Password')</span>
            </a>
        </li>
        <li class="sidebar-menu-list__item {{ menuActive('user.twofactor*') }}">
            <a href="{{ route('user.twofactor') }}" class="sidebar-menu-list__link">
                <span class="icon"><i class="las la-shield-alt"></i></span>
                <span class="text"> @lang('2FA Security')</span>
            </a>
        </li>
    </ul>
</div>
