@php
    $testimonialContent = getContent('testimonial.content', true);
    $testimonialElements = getContent('testimonial.element', false);
@endphp


<section class="testimonials py-120 section-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-heading style-center">
                    <h2 class="section-heading__title">{{ __(@$testimonialContent->data_values->heading) }}</h2>
                </div>
            </div>
        </div>
        <div class="testimonial-slider">
            @foreach ($testimonialElements as $testimonialElement)
                <div class="testimonails-card">
                    <div class="testimonial-item">
                        <div class="testimonial-item__quate"><i class="fas fa-quote-right"></i></div>
                        <div class="testimonial-item__content">
                            <div class="testimonial-item__info">
                                <div class="testimonial-item__thumb">
                                    <img src="{{ frontendImage('testimonial', @$testimonialElement->data_values->image) }}" alt="">
                                </div>
                                <div class="testimonial-item__details">
                                    <h5 class="testimonial-item__name">{{ __(@$testimonialElement->data_values->title) }}</h5>
                                    <span class="testimonial-item__designation">{{ __(@$testimonialElement->data_values->subtitle) }}</span>
                                </div>
                            </div>
                        </div>
                        <p class="testimonial-item__desc">{{ __(@$testimonialElement->data_values->description) }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>


@push('style-lib')
    <link rel="stylesheet" href="{{ asset($activeTemplateTrue . 'css/slick.css') }}">
@endpush

@push('script-lib')
    <script src="{{ asset($activeTemplateTrue . 'js/slick.min.js') }}"></script>
@endpush
