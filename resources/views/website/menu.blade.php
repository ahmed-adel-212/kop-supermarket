@extends('layouts.website.app')

@section('title') Menu @endsection

@section('styles')
    <style>
        .categoriesActive{
            border-color: #6dc405;
            background-color: #6dc405;
        }
    </style>
@endsection

@section('pageName')
    <body class="page-catalog dm-dark"> @endsection

    @section('content')

<section class="page-header">
            <div class="bg-shape grey"></div>
            <div class="container">
                <div class="page-header-content">
                    <h4>Our Food Menu</h4>
                    <h2>Experience The Taste <br>of Italian Food.</h2>
                    <p>Food is any substance consumed to provide nutritional <br>support for an organism.</p>
                </div>
            </div>
        </section><!--/.page-header-->

        <section class="food-menu bg-grey padding">
            <div class="container">
                <ul class="food-menu-filter">
                    <li class="active" data-filter="*">All</li>
                    @foreach($menu['categories'] as $index => $category)
                    <li data-filter=".{{$category->id}}">{{(app()->getLocale() == 'ar')? $category->name_ar : $category->name_en}}</li>
                    @endforeach
                </ul>
                <div class="row product-items">
                @foreach($menu['categories'] as $index => $category)    
                    @foreach($category->items as $dealItem)
                    <div class="col-lg-4 col-md-6 padding-15 isotop-grid {{$dealItem->category->id}}">
                        <div class="product-item wow fadeInUp" data-wow-delay="200ms">
                           <!-- <div class="sale"></div> -->
                            <div class="product-thumb">
                                <img src="{{$dealItem->image}}" alt="food">
                                <div><a @auth @if(!session()->has('branch_id')) data-toggle="modal" data-target="#service-modal" @endif @endauth href="{{url('item/'.$dealItem->category_id.'/'.$dealItem->id)}}" class="order-btn">Order Now</a></div>
                            </div>
                            <div class="food-info">
                               <ul class="ratting">
                                   <li>{{$dealItem['name_'.app()->getLocale()]}}</li>
                                   <li><i class="las la-star"></i></li>
                                    <li><i class="las la-star"></i></li>
                                    <li><i class="las la-star"></i></li>
                                    <li><i class="las la-star"></i></li>
                                    <li><i class="las la-star"></i></li>
                               </ul>
                                <h3>{{$dealItem['description_'.app()->getLocale()]}}</h3>
                                <div class="price">
                                    <h4>@lang('home.Price'): <span>{{$dealItem->price}} @lang('general.SR')</span> </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                @endforeach
            </div>
        </section><!--/.food-menu-->

        @endsection

@section('scripts')
    <script>
        $('.cat').click(function () {
            $('img.cat').removeClass('categoriesActive');
            $(this).addClass('categoriesActive');
            var styleOffer = '';
            var offerPrice = '';
            var doughTypes = '';
            $.ajax({
                type:'post',
                url:'{{url('api/menu/categories/')}}' + '/' + $(this).attr('id') + '/items',
                data:{
                    "_token": "{{ csrf_token() }}",
                    'branch_id': {{(session()->has('branch_id'))? session()->get('branch_id'): 0}}
                },
                success:function (data){
                    if(data.success === true)
                    {
                        console.log(data.data);
                        $('.items').html('');
                        $.each(data.data, function(index, item) {
                            if(! item.is_hidden)
                            {
                                styleOffer = '';
                                offerPrice = '';
                                doughTypes = '';
                                if(item.offer) {
                                    styleOffer = 'style="text-decoration: line-through;font-size: 20px;"';
                                    offerPrice = '<span style="font-size: 26px;color:#6dc405;text-decoration: none">' + (parseFloat(item['offer']['offer_price'])).toFixed(2) + '</span>';
                                }
                                $.each(item.dough_type, function(index2, dough) {
                                    doughTypes+= '<li><label class="mb-0">';
                                    if(index2 == 0){
                                        doughTypes+= '<input type="radio" name="thickness-' + item.id + '" checked="checked" /><span>'+
                                            @if(app()->getLocale() == 'ar')
                                                dough.name_ar +
                                            @else
                                                dough.name_en +
                                            @endif
                                                '</span></label></li>';
                                    }
                                    else {
                                        doughTypes+= '<input type="radio" name="thickness-' + item.id + '" /><span>'+
                                            @if(app()->getLocale() == 'ar')
                                                dough.name_ar +
                                            @else
                                                dough.name_en +
                                            @endif
                                                '</span></label></li>';
                                    }
                                });
                                $('.items').append(
                                    '<div class="col-md-3 col-s-12">'+
                                    '<div class="product-item shadow mb-5 rounded">'+
                                    '<div class="product-item__box">'+

                                    '<div class="product-item__intro">'+

                                    '<div class="product-item__not-active">'+

                                    '<div class="product-item__media">'+
                                    '<a href="{{url('/item/')}}'+ '/' + item.category_id + '/' + item.id + '">'+
                                    '<div class="uk-inline-clip p-4 uk-transition-toggle uk-light" style="background-color: #d6d6d6;">'+
                                    '<img class="w-100 h-100" src="' + item.image + '" alt="Image"/>'+
                                    '</div>'+
                                    '</a>'+
                                    '</div>'+

                                    '<div class="product-item__title uk-text-truncate">'+
                                    '<a href="{{url('/item/')}}'+ '/' + item.category_id + '/' + item.id + '">' +
                                    @if(app()->getLocale() == 'ar')
                                        item.name_ar +
                                    @else
                                        item.name_en +
                                    @endif
                                        '</a>'+
                                    '</div>'+

                                    '<div class="product-item__desc">'+
                                    @if(app()->getLocale() == 'ar')
                                        item.description_ar +
                                    @else
                                        item.description_en +
                                    @endif
                                        '</div>'+

                                    '<div class="product-item__price">{{__('home.Calories')}}: ' + item.calories + '</div>'+

                                    '<div class="product-item__select">'+
                                    '<div class="select-box select-box--thickness">'+
                                    '<ul>'+
                                    doughTypes
                                    +'</ul>'+
                                    '</div>'+
                                    '</div>'+

                                    '</div>'+

                                    '</div>'+

                                    '<div class="product-item__info">'+
                                    '<div class="product-item__price">'+
                                    '<span>{{__('home.Price')}}: </span>'+
                                    '<span class="value"'+ styleOffer + '>' + (parseFloat(item.price)).toFixed(2) + '</span>'+
                                    offerPrice
                                    + ' @lang('general.SR')'
                                    +'</div>'+
                                    '<div class="product-item__addcart">'+
                                    '<a @auth @if(!session()->has('branch_id')) data-toggle="modal" data-target="#service-modal" @endif @endauth class="uk-button uk-button-default cart" href="{{url('/item/')}}'+ '/' + item.category_id + '/' + item.id + '">'+
                                    @if(app()->getLocale() == 'ar')
                                        '<span data-uk-icon="cart"></span> {{__('home.Add to Cart')}}'+
                                    @else
                                        '{{__('home.Add to Cart')}} <span data-uk-icon="cart"></span>'+
                                    @endif
                                        '</a>'+
                                    '</div>'+
                                    '</div>'+
                                    '</div>'+
                                    '</div>'+
                                    '</div>');

                            }
                        });
                    }//end success
                },
                error:function (reject){
                }
            })
        });
    </script>
@endsection