@php
    $howWorksContent = getContent('how_work.content', true);
    $howWorksElements = getContent('how_work.element', false);
@endphp

<div class="how-work-section">
    <img src="{{ frontendImage('how_work', @$howWorksContent->data_values->shape_one) }}" class="shape-01" alt="">
    <img src="{{ frontendImage('how_work', @$howWorksContent->data_values->shape_two) }}" class="shape-02" alt="">
    <div class="how-work py-120 section-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-heading style-center">
                        <h2 class="section-heading__title">{{ __(@$howWorksContent->data_values->heading) }}</h2>
                    </div>
                </div>
            </div>
            <div class="row gy-4">
                @foreach ($howWorksElements->reverse() as $howWorksElement)
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="work-item work-01  text-center">
                            @if (!$loop->last)
                                <div class="work-item__arrow">
                                    <img src="{{ frontendImage('how_work', @$howWorksContent->data_values->arrow_image) }}" alt="">
                                </div>
                            @endif
                            <div class="work-item__icon">
                                <img src="{{ frontendImage('how_work', @$howWorksElement->data_values->icon_image) }}" alt="">
                            </div>
                            <h5 class="work-item__title">
                                {{ __(@$howWorksElement->data_values->title) }}
                            </h5>
                            <p class="work-item__subtitle">
                                {{ __(@$howWorksElement->data_values->subtitle) }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
