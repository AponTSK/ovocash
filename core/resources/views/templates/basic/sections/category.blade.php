@php
    $categoryContent = getContent('category.content', true);
    $categoryElements = getContent('category.element', false);
@endphp

<div class="categories pb-120 pt-60">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-heading style-center">
                    <h2 class="section-heading__title">{{ __(@$categoryContent->data_values->heading) }}</h2>
                </div>
            </div>
        </div>
        <div class="categories-wrapper">
            @foreach ($categoryElements->reverse() as $categoryElement)
                <div class="categories-item">
                    <div class="categories-item__icon">
                        <a href="#"><img src="{{ frontendImage('category', @$categoryElement->data_values->category_image) }}" alt=""></a>
                    </div>
                    <h6 class="categories-item__title"> <a href="#">{{ __(@$categoryElement->data_values->category_name) }}</a></h6>
                </div>
            @endforeach

        </div>
    </div>
</div>
