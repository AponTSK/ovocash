@php
    $aboutContent = getContent('about.content', true);
    $aboutElements = getContent('about.element', false);
@endphp

<div class="counter-area py-60" style="background-image: url('{{ frontendImage('about', @$aboutContent->data_values->background_image) }}');">

    <div class="container">
        <div class="row gy-4 align-items-center">
            @foreach ($aboutElements as $aboutElement)
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="counterup-item text-center">
                        <div class="counterup-item__content">
                            <div class="counterup-item__number">
                                <h1 class="counterup-item__title"><span class="odometer" data-odometer-final="{{ @$aboutElement->data_values->counter_digit }}">0</span></h1>
                            </div>
                            <h6 class="counterup-item__text mb-0">{{ __(@$aboutElement->data_values->counter_title) }}</h6>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>


@push('style-lib')
    <link rel="stylesheet" href="{{ asset($activeTemplateTrue . 'css/odometer.css') }}">
@endpush

@push('script-lib')
    <script src="{{ asset($activeTemplateTrue . 'js/odometer.min.js') }}"></script>
@endpush
