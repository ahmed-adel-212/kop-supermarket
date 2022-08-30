@extends('layouts.website.app')

@section('title') Offers @endsection

@section('styles')
<style>
   h6,h5,h4,h3,h2{
        font-family: inherit;
    }
    .line-clamp5 {
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        line-height: 20px;     /* fallback */
        max-height: 32px;      /* fallback */
        -webkit-line-clamp: 3; /* number of lines to show */
        -webkit-box-orient: vertical;
    }
    .food-carousel .product-item h3 {
        line-height: 20px;
    }
</style>

@endsection

@section('pageName')
    <body class="page-article dm-light"> @endsection

    @section('content')

    <section class="page-header" style="background-image: url({{asset('website2-assets/img/page-header-theme.jpg')}})">
            <div class="bg-shape grey"></div>
            <div class="container">
                <div class="page-header-content">
                    <h4>
                    {{__('general.Offers')}}
                    </h4>
                    <h2>
                        {{__('general.offers_title')}}
                    </h2>
                </div>
            </div>
        </section><!--/.page-header-->

        <section class="food-menu bg-grey pt-80">
            <div class="container">
                <div class="heading-wrap">
                    <div class="section-heading mb-30">
                        <h4>Offers</h4>
                        <h2>Our Popular <span>Dishes</span></h2>
                        <p>Food is any substance consumed to provide nutritional <br> support for an organism.</p>
                    </div>
                    <div>
                        <p>Food is any substance consumed to provide nutritional <br> support for an organism.</p>
                        <a href="{{route('menu.page')}}" class="default-btn"><i class="fas fa-utensils"></i>Full Menu <span></span></a>
                    </div>
                </div>
                @if(isset($offers))
                <div class="nav-outside">
                  <div class="food-carousel swiper-container nav-visible">
                       <div class="swiper-wrapper">
                       
                        @foreach($offers as $offer)
                            <div class="swiper-slide">
                                <div class="product-item">
                                @if($offer->offer_type =='discount')
                                   <div class="sale">-{{$offer->discount->discount_value}}%</div>
                                @endif
                                    <div class="product-thumb">
                                        <img src="{{asset($offer->website_image_menu)}}" alt="food">
                                        <div><a @auth @if(!session()->has('branch_id')) data-toggle="modal" data-target="#service-modal" @endif @endauth href="{{route('offer.item',$offer->id)}}" class="order-btn cart">Order Now</a></div>
                                    </div>
                                    <div class="food-info">
                                       <ul class="ratting">
                                           <li>{{(app()->getLocale() == 'ar') ?$offer->title_ar:$offer->title}}</li>
                                           <li><i class="las la-star"></i></li>
                                            <li><i class="las la-star"></i></li>
                                            <li><i class="las la-star"></i></li>
                                            <li><i class="las la-star"></i></li>
                                            <li><i class="las la-star"></i></li>
                                       </ul>
                                        <h3 class="line-clamp5">{{(app()->getLocale() == 'ar') ?$offer->description_ar:$offer->description}}
                                            <br>
                                         
                                        </h3>
                                        
                                        <div class="price">
                                            <h4>{{__('general.Offer')}}:<span>{{$offer->offer_type}}</span></h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        </div>
                        <div class="dl-slider-controls style-2">
                            <div class="dl-slider-button-prev"><i class="las la-arrow-left"></i></div>
                            <div class="dl-swiper-pagination"></div>
                            <div class="dl-slider-button-next"><i class="las la-arrow-right"></i></div>
                        </div>
                        <div class="carousel-preloader"><div class="dot-flashing"></div></div>
                   </div>
                </div>
                @endif
            </div>
        </section><!--/.food-menu-->

    @endsection

@section('scripts')@endsection