@extends('layouts.website.app')

@section('title') Home @endsection
@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.css" integrity="sha512-wR4oNhLBHf7smjy0K4oqzdWumd+r5/+6QO/vDda76MW5iug4PT7v86FoEkySIJft3XA0Ae6axhIvHrqwm793Nw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css" integrity="sha512-17EgCFERpgZKcm0j0fEq1YCJuyAWdz9KUtv1EjVuaOz8pDnh/0nZxmU6BBXwaaxqoi9PQXnRWqlcDB027hgv9A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
      .slick-next:before{
        content:none!important;
      }
      .slick-prev:before{
        content:none!important;
      }
      [dir=rtl] .slick-prev {
        right: auto;
        left: -15px;
      }
      [dir=rtl] .slick-prev i {
        margin-right: -20px;
      }
     

      

        .line-clamp5 {
            display: -webkit-box;
            -webkit-line-clamp: 7;
            -webkit-box-orient: vertical;
            overflow: hidden;
            min-height: 180px;
            max-height: 180px;
        }
        .about-section .content-img-holder {
    /* position: absolute !important;
    top: 0 !important;
    /* padding-top: 13% !important; 
    margin-left: 5% !important; */

}
.about-info {
    /* margin-left: 58% !important;
    position: absolute !important;
    top: 0 !important;
    padding-top: 9% !important;*/} 
   
    </style>
@endsection


@section('pageName')
    <body class="page-home dm-dark"> @endsection

    @section('content')
    <div class="site-preloader-wrap">
            <div class="spinner"></div>
        </div><!-- /.site-preloader-wrap -->

     

        <!-- <div id="popup-search-box">
            <div class="box-inner-wrap d-flex align-items-center">
                <form id="form" action="#" method="get" role="search">
                    <input id="popup-search" type="text" name="s" placeholder="Type keywords here..." />
                    <button id="popup-search-button" type="submit" name="submit"><i class="las la-search"></i></button>
                </form>
            </div>
        </div>/#popup-search-box -->

        <div id="main-slider" class="main-slider" >
            <div class="single-slide">
                <div class="bg-img kenburns-top" style="background-image: url({{asset('website2-assets/img/slider-bg-01.jpg')}});"></div>
                <div class="slider-shape" style="background-image: url({{asset('website2-assets/img/slider-shape-01.png')}});" data-animation="fade-in-right" data-delay="0.5s"></div>
                <div class="food-img" style="background-image: url({{asset('website2-assets/img/food-img-01.png')}});" data-animation="fade-in-right" data-delay="1s"></div>
                <div class="food-design" style="background-image: url({{asset('website2-assets/img/slider-elements.png')}});" data-animation="zoomIn" data-delay="1.3s"></div>
                <div class="slider-content-wrap d-flex align-items-center">
                    <div class="container">
                        <div class="slider-content">
                            <div class="slider-caption medium"><div class="inner-layer"><div data-animation="fade-in-top" data-delay="0.5s">Eat Sleep And</div></div></div>
                            <div class="slider-caption big"><div class="inner-layer"><div data-animation="reveal-text" data-delay="1s">{{__('home.Order Today, While It’s Hot!')}}</div></div>
                            </div>
                            <div class="slider-caption small"><div class="inner-layer"><div data-animation="fade-in-bottom" data-delay="2s">{{__('home.Eat Delicious & Tasty Fast-Foods With Real Flavours')}}</div></div></div>
                            <div class="slider-btn-group justify-content-left">
                                <div class="inner-layer">
                                    <a href="{{route('menu.page')}}" class="slider-btn" data-animation="fade-in-bottom" data-delay="2.5s">{{__('footer.Our Menu')}}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--Slide-1-->
            <div class="single-slide center">
                <div class="bg-img kenburns-top" style="background-image: url({{asset('website2-assets/img/slider-bg-02.jpg')}});"></div>
                <div class="slider-shape" style="background-image: url({{asset('website2-assets/img/slider-shape-01.png')}});" data-animation="fade-in-right" data-delay="0.5s"></div>
                <div class="slider-shape left" style="background-image: url({{asset('website2-assets/img/slider-shape-02.png')}});" data-animation="fade-in-left" data-delay="0.5s"></div>
                <div class="food-img" style="background-image: url({{asset('website2-assets/img/food-img-02.png')}});" data-animation="fade-in-bottom" data-delay="1s"></div>
                <div class="food-design" style="background-image: url({{asset('website2-assets/img/slider-elements-center.png')}});" data-animation="zoomIn" data-delay="1.3s"></div>
                <div class="slider-content-wrap d-flex align-items-center text-center">
                    <div class="container">
                        <div class="slider-content">
                           <div class="slider-caption medium"><div class="inner-layer"><div data-animation="fade-in-top" data-delay="0.5s">Eat Sleep And</div></div></div>
                            <div class="slider-caption big"><div class="inner-layer"><div class="char-top" data-delay="1s" data-splittin>Tasty Pizza</div></div>
                            </div>
                            <div class="slider-caption small"><div class="inner-layer"><div data-animation="fade-in-bottom" data-delay="1.5s">Food is any substance consumed to provide nutritional <br>support for an organism.</div></div></div>
                            <div class="slider-btn-group justify-content-center">
                                <div class="inner-layer">
                                    <a href="reservation.html" class="slider-btn" data-animation="fade-in-bottom" data-delay="2s">Book A Table</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--Slide-2-->
            <div class="single-slide right">
                <div class="bg-img kenburns-top" style="background-image: url({{asset('website2-assets/img/slider-bg-03.jpg')}});"></div>
                <div class="slider-shape left" style="background-image: url({{asset('website2-assets/img/slider-shape-02.png')}});" data-animation="fade-in-left" data-delay="0.5s"></div>
                <div class="food-img" style="background-image: url({{asset('website2-assets/img/food-img-03.png')}});" data-animation="fade-in-top" data-delay="1s"></div>
                <div class="food-design" style="background-image: url({{asset('website2-assets/img/slider-elements.png')}});" data-animation="zoomIn" data-delay="1.3s"></div>
                <div class="slider-content-wrap d-flex align-items-center text-right">
                    <div class="container">
                        <div class="slider-content">
                           <div class="slider-caption medium"><div class="inner-layer"><div data-animation="fade-in-top" data-delay="0.5s">ewewEat Sleep And</div></div></div>
                            <div class="slider-caption big"><div class="inner-layer"><div class="char-right" data-delay="1s" data-splittin>Fried masala <br>in town!</div></div>
                            </div>
                            <div class="slider-caption small"><div class="inner-layer"><div data-animation="fade-in-bottom" data-delay="2s">wwwwwwFood is any suwwwewebstance consumed to provide nutritional <br>support for an organism.</div></div></div>
                            <div class="slider-btn-group justify-content-left">
                                <div class="inner-layer">
                                    <a href="reservation.html" class="slider-btn" data-animation="fade-in-bottom" data-delay="2.5s">Book A Table</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--Slide-3-->
        </div><!-- slider-section -->
          
        <section class="promo-section bg-grey padding">
            <div class="bg-shape white"></div>
            <div class="container">
            <div class="section-heading mb-30 text-center wow fadeInUp" data-wow-delay="200ms">
                    <h4>recommended Dishes</h4>
                    <h2>Our Delicious <span>Foods</span></h2>
                </div>
                <div class="nav-outside">
                  <div class="food-carousel swiper-container nav-visible"> 
                       <div class="swiper-wrapper">
                        @foreach($menu['recommended'] as $recommended)
                           <div class="swiper-slide">
                               <div class="food-item">
                                    <div class="food-icon">
                                        <i class="fi fi-pizza-slice"></i>
                                    </div>
                                    <div class="food-content">
                                        <h3>{{(app()->getLocale() == 'ar') ?$recommended->name_ar:$recommended->name_en}}</h3>
                                        <p>{{(app()->getLocale() == 'ar') ?$recommended->description_ar:$recommended->description_en}}</p>
                                    </div>
                                    <div class="food-thumb">
                                        <img src="{{asset($recommended->website_image)}}" alt="img">
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
            </div>
        </section><!--/.promo-section-->
        
        <div id="main-slider1" dir="ltr">
            @foreach($menu['main_offer'] as $main_offer)
            <div>
            <section class="about-section padding">
                <div class="bg-shape grey"></div>
                <div class="container" dir="{{app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
                    <div class="row align-items-center">
                    <div class="col-md-6 wow fadeInLeft" data-wow-delay="200ms">
                        <div class="content-img-holder">
                            <img src="{{asset($main_offer->image)}}" alt="img">
                            <div class="sale">
                            @if($main_offer->discount)
                                <div>
                                    <h4>Get </h4>
                                    @if($main_offer->discount->discount_type==1)
                                        <h2><span>{{$main_offer->discount->discount_value}}%</span>Off Now</h2>
                                        @else
                                        <h2><span>{{$main_offer->discount->discount_value}} @lang('general.SR')</span>Off Now</h2>
                                        @endif
                                    </div>
                                @else
                                <div>
                                <h4>buy & get</h4>
                                </div>
                                @endif    
                                </div>
                        </div>
                    </div>
                        <div class="col-md-6 wow fadeInRight" data-wow-delay="400ms">
                            <div class="about-info">
                                <h2>{{(app()->getLocale() == 'ar') ?$main_offer->title_ar:$main_offer->title}}</h2>
                                <p>{{(app()->getLocale() == 'ar') ?$main_offer->description_ar:$main_offer->description}}</p>
                                <ul class="check-list">
                                    <li><i class="fas fa-check"></i>Delicious &amp; Healthy Foods</li>
                                    <li><i class="fas fa-check"></i>Spacific Family And Kids Zone</li>
                                    <li><i class="fas fa-check"></i>Music &amp; Other Facilities</li>
                                    <li><i class="fas fa-check"></i>Fastest Food Home Delivery</li>
                                </ul>
                            
                                <a  @auth @if(!session()->has('branch_id')) data-toggle="modal" data-target="#service-modal" @endif @endauth href="{{route('offer.item',$main_offer->id)}}" class="default-btn cart">Order Now <span></span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </section><!--/.about-section--> 
            </div>
            @endforeach
        </div>
        
        <section class="food-menu bg-grey padding">
            <div class="container">
                <div class="section-heading mb-30 text-center wow fadeInUp" data-wow-delay="200ms">
                    <h4>BEST SELLER ITEMS</h4>
                    <h2>Our Delicious <span>Foods</span></h2>
                    <p>Food is any substance consumed to provide nutritional <br> support for an organism.</p>
                </div>
                <ul class="food-menu-filter">
                    <li class="active" data-filter="*">All</li>
                    @foreach($menu['categories'] as $index => $category)
                    @if(in_array($category->id,$menu['categoryof_dealitems']))
                    <li data-filter=".{{$category->id}}">{{(app()->getLocale() == 'ar')? $category->name_ar : $category->name_en}}</li>
                    @endif
                    @endforeach
                </ul>
                <div class="row product-items">
                    @foreach($menu['dealItems'] as $dealItem)
                    <div class="col-lg-4 col-md-6 padding-15 isotop-grid {{$dealItem->category_id}}">
                        <div class="product-item wow fadeInUp" data-wow-delay="200ms">
                           <div class="sale">-15%</div>
                           <div class="product-thumb">
                                <img src="{{asset($dealItem->website_image)}}" alt="food">
                                <div><a @auth @if(!session()->has('branch_id')) data-toggle="modal" data-target="#service-modal" @endif @endauth href="{{url('item/'.$dealItem->category_id.'/'.$dealItem->id)}}" class="order-btn cart">Order Now</a></div>
                            </div>
                            <div class="food-info">
                               <ul class="ratting">
                                   <li>{{$dealItem['name_'.app()->getLocale()]}}</li>
                                 
                               </ul>
                                <h3>{{$dealItem['description_'.app()->getLocale()]}}</h3>
                                <div class="price">
                                    <h4>@lang('home.Price'): <span>{{$dealItem->price}} @lang('general.SR')</span> </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section><!--/.food-menu-->

        <section class="content-section" style="height: 400px;">
            <div class="bg-shape white"></div>
            <div class="bg-shape grey"></div>
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6 wow fadeInLeft" data-wow-delay="200ms">
                        <div class="content-info">
                        <h2>{{(app()->getLocale() == 'ar') ?$menu['anoucement'][0]->name_ar:$menu['anoucement'][0]->name_en}}</h2>
                            <p>{{(app()->getLocale() == 'ar') ?$menu['anoucement'][0]->description_ar:$menu['anoucement'][0]->description_en}}</p>
                           
                        </div>
                    </div>
                    <div class="col-md-6 wow fadeInRight" data-wow-delay="400ms">
                        <div class="content-img-holder">
                            <img src="{{asset($menu['anoucement'][0]->image)}}" alt="img">
                            
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--/.content-section-->
 
        <section class="delivery-section padding">
           <div class="bg-shape grey"></div>
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6 wow fadeInLeft" data-wow-delay="200ms">
                        <div class="delivery-info">
                            <h2>A Moments Of Delivered <br> On <span>Right Time</span> &amp; Place</h2>
                            <p>The restaurants in Hangzhou also catered to many northern Chinese who had fled south from Kaifeng during the Jurchen invasion of the 1120s, while it is also known that many restaurants were run by families.</p>
                            <div class="order-content">
                               <a href="{{route('menu.page')}}" class="default-btn">{{ __('header.Menu')}}<span></span></a>
                                <h3><span>Order Number</span> <a href="tel:920001939" style="color: #f99839;">
                                920001939</a></h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                       <div class="delivery-boy-wrap">
                           <img class="delivery" src="{{asset('website2-assets/img/cloud.png')}}" alt="img">
                            <div class="delivery-boy"></div>
                       </div>
                    </div>
                </div>
            </div>
        </section><!--/.delivery-section-->

        <section class="banner-section padding">
           <div class="bg-shape grey"></div>
            <div class="container">
                <div class="row banner-wrapper">
                   <div class="col-md-6 wow fadeInUp" data-wow-delay="200ms">
                       <div class="banner-item">
                            <img src="{{asset($menu['homeitem'][0]->image)}}" alt="banner">
                            <div class="banner-content">
                                <h2>{{(app()->getLocale() == 'ar') ?$menu['homeitem'][0]->description_ar:$menu['homeitem'][0]->description_en}}</h2>
                                <p>Sale off 50% only this week</p>
                                <a href="{{url('item/'.$menu['homeitem'][0]->category_id.'/'.$menu['homeitem'][0]->id)}}"@auth @if(!session()->has('branch_id')) data-toggle="modal" data-target="#service-modal" @endif @endauth class="order-btn cart">Order Now</a>
                            </div>
                        </div>
                   </div>
                    <div class="col-md-6">
                       <div class="row">
                           <div class="col-md-6 wow fadeInUp" data-wow-delay="400ms">
                           <div class="banner-item">
                            <img src="{{asset($menu['homeitem'][1]->image)}}" alt="banner">
                            <div class="banner-content">
                                <h2>{{(app()->getLocale() == 'ar') ?$menu['homeitem'][1]->description_ar:$menu['homeitem'][1]->description_en}}</h2>
                                <p>Sale off 50% only this week</p>
                                <a href="{{url('item/'.$menu['homeitem'][1]->category_id.'/'.$menu['homeitem'][1]->id)}}"  @auth @if(!session()->has('branch_id')) data-toggle="modal" data-target="#service-modal" @endif @endauth class="order-btn cart">Order Now</a>
                            </div>
                        </div>
                           </div>
                           <div class="col-md-6 wow fadeInUp" data-wow-delay="600ms">
                           <div class="banner-item">
                            <img src="{{asset($menu['homeitem'][2]->image)}}" alt="banner">
                            <div class="banner-content">
                                <h2>{{(app()->getLocale() == 'ar') ?$menu['homeitem'][2]->description_ar:$menu['homeitem'][2]->description_en}}</h2>
                                <p>Sale off 50% only this week</p>
                                <a href="{{url('item/'.$menu['homeitem'][2]->category_id.'/'.$menu['homeitem'][2]->id)}}" @auth @if(!session()->has('branch_id')) data-toggle="modal" data-target="#service-modal" @endif @endauth class="order-btn cart">Order Now</a>
                            </div>
                        </div>
                           </div>
                           <div class="col-md-12 wow fadeInUp" data-wow-delay="800ms">
                           <div class="banner-item">
                            <img src="{{asset($menu['homeitem'][3]->image)}}" alt="banner">
                            <div class="banner-content">
                                <h2>{{(app()->getLocale() == 'ar') ?$menu['homeitem'][3]->description_ar:$menu['homeitem'][3]->description_en}}</h2>
                                <p>Sale off 50% only this week</p>
                                <a href="{{url('item/'.$menu['homeitem'][3]->category_id.'/'.$menu['homeitem'][3]->id)}}" @auth @if(!session()->has('branch_id')) data-toggle="modal" data-target="#service-modal" @endif @endauth class="order-btn cart">Order Now</a>
                            </div>
                        </div>
                           </div>
                       </div>
                    </div>
                </div>
            </div>
        </section><!--/.banner-section-->
  
        <section class="blog-section bg-grey padding">
           <div class="bg-shape white"></div>
            <div class="container">
                <div class="section-heading mb-30 text-center wow fadeInUp" data-wow-delay="200ms">
                    <h4>Latest Blog Posts</h4>
                    <h2>This Is All About <span>Foods</span></h2>
                    <p>Food is any substance consumed to provide nutritional <br> support for an organism.</p>
                </div>
                <div class="row blog-posts">
                @if(isset($menu['news']))
                    @foreach($menu['news'] as $new)
                    <div class="col-lg-4 col-md-6 sm-padding wow fadeInUp" style="margin-bottom: 2%;" data-wow-delay="200ms">
                        <div class="post-card">
                            <div class="post-thumb">
                                <img src="{{asset($new->image)}}" alt="img">
                                <div class="category"><a href="{{route('get.new',$new->id)}}">{{$new['title_'.app()->getLocale()]}}</a></div>
                            </div>
                            <div class="post-content">
                                <ul class="post-meta">
                                   <li><i class="far fa-calendar-alt"></i><a href="#">{{$new->created_at}}</a></li>
                                   
                                </ul>
                                <p class="line-clamp5">{{$new['description_'.app()->getLocale()]}}</p>
                                <a href="{{route('get.new',$new->id)}}" class="read-more">@lang('general.Read More')<i class="las la-long-arrow-alt-right"></i></a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @endif
                </div>
            </div>
        </section><!-- /.blog-section -->


		{{-- <div id="scrollup">

            <button id="scroll-top" class="scroll-to-top"><i class="las la-arrow-up"></i></button>
        </div>  --}}

@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js" integrity="sha512-XtmMtDEcNz2j7ekrtHvOVR4iwwaD6o/FUJe6+Zq+HgcCsk3kj4uSQQR8weQ2QVj1o0Pk6PwYLohm206ZzNfubg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready(function(){
        $('#main-slider1').slick({
        dots: true,
        infinite: true,
        speed: 300,
        slidesToShow: 1,
        adaptiveHeight: true,
        rtl: false
        });
    });

</script>

@endsection
