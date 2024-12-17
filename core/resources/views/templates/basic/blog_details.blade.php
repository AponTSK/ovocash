@php
    $blogIcon = getContent('blog.content', true);
@endphp

@extends($activeTemplate . 'layouts.frontend')
@section('content')
    <section class="blog-detials section-py pb-60">
        <div class="container">
            <div class="row gy-5 justify-content-center">
                <div class="col-lg-8">
                    <div class="blog-details">
                        <div class="blog-details__thumb">
                            <img src="{{ frontendImage('blog', @$blog->data_values->image) }}" class="w-100 mb-3" alt="Blog">
                        </div>

                        <div class="blog-details__content">

                            <ul class="text-list d-flex align-items-center gap-4 justify-content-center">
                                <li class="text-list__item">
                                    <span class="text-list__item-icon">
                                        @php
                                            echo @$blogIcon->data_values->person_icon;
                                        @endphp
                                    </span>
                                    {{ __(@$blog->data_values->author_name) }}
                                </li>
                                <li class="text-list__item">
                                    <span class="text-list__item-icon">
                                        @php
                                            echo @$blogIcon->data_values->calender_icon;
                                        @endphp
                                    </span>
                                    {{ showDateTime($blog->data_values->date) }}
                                </li>
                            </ul>
                            <h3 class="blog-details__title"> {{ __(@$blog->data_values->title) }} </h3>
                            <p class="mt-2">
                                @php echo $blog->data_values->description @endphp
                            </p>

                            <div class="blog-details__share mt-4 d-flex align-items-center flex-wrap">
                                <h5 class="social-share__title mb-0 me-sm-3 me-1 d-inline-block">@lang('Share This')</h5>
                                <ul class="social-list">
                                    <ul class="social-list">
                                        <li class="social-list__item">
                                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" class="social-list__link flex-center" target="_blank">
                                                <i class="fab fa-facebook-f"></i>
                                            </a>
                                        </li>
                                        <li class="social-list__item">
                                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode(@$blog->data_values->title) }}" class="social-list__link flex-center"
                                                target="_blank">
                                                <i class="fab fa-twitter"></i>
                                            </a>
                                        </li>
                                        <li class="social-list__item">
                                            <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(url()->current()) }}&title={{ urlencode(@$blog->data_values->title) }}"
                                                class="social-list__link flex-center" target="_blank">
                                                <i class="fab fa-linkedin-in"></i>
                                            </a>
                                        </li>
                                        <li class="social-list__item">
                                            <a href="https://pinterest.com/pin/create/button/?url={{ urlencode(url()->current()) }}&media={{ urlencode(frontendImage('blog', @$blog->data_values->image)) }}&description={{ urlencode(@$blog->data_values->title) }}"
                                                class="social-list__link flex-center" target="_blank">
                                                <i class="fab fa-pinterest"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </ul>
                                <div class="fb-comments" data-href="{{ url()->current() }}" data-numposts="5"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="recent-blog pt-60 pb-120">
        <div class="container">
            <div class="row">
                <div class="section-heading style-three single-style">
                    <h2 class="section-heading__title">@lang('Recent Blog')</h2>
                </div>
            </div>
            <div class="row">
                <div class="recent-slider">
                    @foreach ($recentBlogs as $item)
                        <div class="blog-item">
                            <div class="blog-item__thumb">
                                <a href="{{ route('blog.details', $item->slug) }}" class="blog-item__thumb-link">
                                    <img src="{{ frontendImage('blog', 'thumb_' . @$item->data_values->image) }}" alt="image">
                                </a>
                            </div>
                            <div class="blog-item__content">
                                <ul class="text-list inline">
                                    <li class="text-list__item"> <span class="text-list__item-icon"><i class="fas fa-user"></i></span>{{ __(@$blog->data_values->author_name) }}</li>
                                    <li class="text-list__item"> <span class="text-list__item-icon"><i class="fas fa-calendar-alt"></i></span> {{ showDateTime($blog->data_values->date) }}</li>
                                </ul>
                                <h4 class="blog-item__title"><a href="{{ route('blog.details', $item->slug) }}" class="blog-item__title-link">{{ __(@$item->data_values->title) }}</a></h4>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection

@push('fbComment')
    @php echo loadExtension('fb-comment') @endphp
@endpush

@push('style-lib')
    <link rel="stylesheet" href="{{ asset($activeTemplateTrue . 'css/slick.css') }}">
@endpush

@push('script-lib')
    <script src="{{ asset($activeTemplateTrue . 'js/slick.min.js') }}"></script>
@endpush
