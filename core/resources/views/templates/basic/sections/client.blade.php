@php
    $clientElements = getContent('client.element', false);
@endphp

<div class="client pt-120 pb-60">
    <div class="container">
        <div class="client-logos client-slider">
            @foreach ($clientElements as $clientElement)
                <img src="{{ frontendImage('client', @$clientElement->data_values->image) }}" alt="image">
            @endforeach
        </div>
    </div>
</div>


@push('style-lib')
    <link rel="stylesheet" href="{{ asset($activeTemplateTrue . 'css/slick.css') }}">
@endpush

@push('script-lib')
    <script src="{{ asset($activeTemplateTrue . 'js/slick.min.js') }}"></script>
@endpush
