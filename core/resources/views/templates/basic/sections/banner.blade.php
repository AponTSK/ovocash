@php
    $bannerContent = getContent('banner.content',true);
@endphp

<section class="banner-section section-bg">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xl-5 col-lg-6 col-md-10">
                <div class="banner-content">
                    <h1 class="banner-content__title">{{ __(@$bannerContent->data_values->heading) }}</h1>
                    <p class="banner-content__desc">{{ __(@$bannerContent->data_values->subheading) }}</p>
                </div>
            </div>
            <div class="col-xl-7 col-lg-6 d-none d-lg-block">
              <div class="banner-content__thumbs text-end">
                  <img src="{{ frontendImage('banner', @$bannerContent->data_values->banner_one) }}" class="main-banner" alt="">
                  <img src="{{ frontendImage('banner', @$bannerContent->data_values->banner_shape_one) }}"  class="banner-shape profile" alt="">
                  <img src="{{ frontendImage('banner', @$bannerContent->data_values->banner_shape_two) }}" class="banner-shape girl" alt="">
                  <img src="{{ frontendImage('banner', @$bannerContent->data_values->banner_shape_three) }}"  class="banner-shape like" alt="">
                  <img src="{{ frontendImage('banner', @$bannerContent->data_values->tiktok_image) }}" class="banner-shape tiktok" alt="">
              </div>
            </div>
        </div>
    </div>
  </section>