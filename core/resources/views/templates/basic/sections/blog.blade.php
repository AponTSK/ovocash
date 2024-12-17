@php
    $blogContent = getContent('blog.content', true);
    $blogElements = getContent('blog.element', false);
@endphp

<section class="blog py-120">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-heading style-three">
                    <h2 class="section-heading__title">{{ __(@$blogContent->data_values->heading) }}</h2>
                </div>
            </div>
        </div>
        <div class="row gy-4 justify-content-center">
            @foreach ($blogElements as $blogElement)
                <div class="col-lg-4 col-md-6">
                    <div class="blog-item">
                        <div class="blog-item__thumb">
                            <a href="{{ route('blog.details', @$blogElement->slug) }}" class="blog-item__thumb-link">
                                <img src="{{ frontendImage('blog', @$blogElement->data_values->image) }}" alt="">
                            </a>
                        </div>
                        <div class="blog-item__content">
                            <ul class="text-list inline">
                                <li class="text-list__item"> <span class="text-list__item-icon">@php
                                    echo @$blogContent->data_values->person_icon;
                                @endphp</span> {{ __(@$blogElement->data_values->author_name) }}</li>
                                <li class="text-list__item"> <span class="text-list__item-icon">@php
                                    echo @$blogContent->data_values->calender_icon;
                                @endphp</i></span>{{ showDateTime($blogElement->data_values->date) }}</li>
                            </ul>
                            <h4 class="blog-item__title"><a href="{{ route('blog.details', @$blogElement->slug) }}" class="blog-item__title-link">
                                    {{ __(@$blogElement->data_values->title) }}</a>
                            </h4>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

@push('style-lib')
    <link rel="stylesheet" href="{{ asset($activeTemplateTrue . 'css/magnific-popup.css') }}">
@endpush
