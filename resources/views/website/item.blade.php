@extends('layouts.website.app')

@section('title')
    Item
@endsection

@section('styles')
    <style>
       /* .dough label.active 
       {
            border-color: #cc3333 !important;
            background-color: #cc3333 !important;
            background: #cc3333 !important;
            color: #fff !important;
        }

        .card-header.active {
            background: #cc3333;
            color: #fff !important;
        }

        .card-header.active button {
            color: #fff;
        
        * {
            font-family: Cairo !important;
        } */
        .text-danger {
            color: #f32129;
        }

        .food-item {
            border: 1px solid;
            border-radius: 2px;
            display: inline-block;
            font-size: 8px;
            height: 13px;
            line-height: 11px;
            text-align: center;
            width: 13px;
        }

        [class*=" icofont-"],
        [class^=icofont-] {
            font-family: IcoFont !important;
            speak: none;
            font-style: normal;
            font-weight: 400;
            font-variant: normal;
            text-transform: none;
            white-space: nowrap;
            word-wrap: normal;
            direction: ltr;
            -webkit-font-feature-settings: "liga";
            -webkit-font-smoothing: antialiased;
        }

        h6 {
            font-family: inherit;
            font-weight: 600;
        }

        body.dm-light {
            background: #f5f5f5 !important;
        }

        .dot-borderd {
            border: 1px solid;
            width: 15px;
            height: 15px;
            text-align: center;
            border-radius: 3px;
            font-size: 35px;
            line-height: 7px;
        }
    </style>
@endsection

@section('pageName')

    <body class="page-product dm-dark" x-data="{
                items: [],
                activeItem: '',
                buy_items: {},
                addItem: function() {
                    const dough = document.querySelectorAll('[name=dough_type]');
                    let active = '';
            
                    for (let d of dough) {
                        if (d.checked) {
                            active = d;
                        }
                    }
            
                    this.items.push({
                        uid: Math.floor(Math.random() * 100000000),
                        item_id: {{ $item['id'] }},
                        title: '{{ app()->getLocale() == 'ar' ? $item['name_ar'] : $item['name_en'] }}',
                        info: '{{ app()->getLocale() == 'ar' ? $item['description_ar'] : $item['description_en'] }}',
                        category: '{{ app()->getLocale() == 'ar' ? $item['category']['name_ar'] : $item['category']['name_en'] }}',
                        calories: {{ $item->calories }},
                        dough: active.value,
                        real_price: {{ round($item->price, 2) }},
                        price: {{ round(isset($item['offer']) ? $item['offer']['offer_price'] : $item->price, 2) }},
                        offer_price: {{ isset($item['offer']) ? round($item['offer']['offer_price'], 2) : 0 }},
                        extras: [],
                        withouts: [],
                    });
                },
                removeItem: function(itemId) {
                    this.items.splice(
                        this.items.findIndex(x => x.uid === itemId),
                        1
                    );
            
                    const qty = document.querySelector('#quantity');
                    qty.value = parseInt(qty.value) - 1;
                },
                addToItem: function(type, id, name, price) {
                    this.items.map(x => {
                        if (x.uid === this.activeItem) {
                            const found = x[type].findIndex(x => x.id === id);
                            if (found < 0) {
                                x[type].push({
                                    id: id,
                                    name: name,
                                    price: price
                                });
                            }
                        }
                        return x;
                    });
                },
                getItems: function() {
                    const it = JSON.parse(JSON.stringify(this.items));
                    it.map(x => {
                        x.extras = x.extras.map(ex => ex.id);
                        x.withouts = x.withouts.map(wi => wi.id);
                        return x;
                    });
                    return JSON.stringify(it);
                },
            }" x-on:add-item.window="addItem" x-init="addItem();
            activeItem = items[0].uid" x-ref="form">
    @endsection

    @section('content')
        <div class="site-preloader-wrap">
            <div class="spinner"></div>
        </div><!-- /.site-preloader-wrap -->

        <section class="page-header">
            <div class="bg-shape grey"></div>
            <div class="container">
                <div class="page-header-content">
                    <h2> {{ app()->getLocale() == 'ar' ? $item['name_ar'] : $item['name_en'] }}</h2>
                    <p>Food is any substance consumed to provide nutritional <br>support for an organism.</p>
                </div>
            </div>
        </section><!--/.page-header-->
        
        <section class="food-details bg-grey pt-80">
            <div class="container" >
            <form id="addToCard" action="{{ route('add.cart') }}" method="POST" >
            @csrf
            @if ($item['offer'])
                <input type="hidden" name="offer_id" value="{{ $item['offer']['offer_id'] }}">
                <input type="hidden" name="offer_price" value="{{ round($item['offer']['offer_price'], 2) }}">
            @endif
            <input type="hidden" name="item_id" value="{{ $item['id'] }}">
            <input type='hidden' name='add_items' x-bind:value="getItems" />
            <input type='hidden' name='quantity' x-bind:value="items.length" />
                <div class="row">
                    <div class="col-md-6 sm-padding product-details-wrap">
                        <div class="food-details-thumb">
                            <img src="{{ asset($item->image) }}" alt="food">
                            <a class="img-popup" data-gall="gallery01" href="{{ asset($item->image) }}"><i class="fas fa-expand"></i></a>
                        </div>
                    </div>
                    <div class="col-md-6 sm-padding">
                        <div class="product-details">
                            <div class="product-info">
                                <div class="product-inner">
                                    <ul class="category">
                                       <li><a href="{{ route('menu.page') }}">{{ app()->getLocale() == 'ar' ? $item['category']['name_ar'] : $item['category']['name_en'] }}</a></li>
                                    </ul>
                                </div>
                                <h3>{{ app()->getLocale() == 'ar' ? $item['name_ar'] : $item['name_en'] }}</h3>
                                <h4 class="price"><span  @if ($item['offer']) style="text-decoration: line-through;font-size: 20px;color:#ff0000;" @endif>{{ round($item->price, 2) }}</span>
                                @if ($item['offer'])
                                        <span style="font-size: 26px;color:#6dc405;text-decoration: none">{{ round($item['offer']['offer_price'], 2) }} </span>
                                @endif
                                  @lang('general.SR')</h4>

                                <style>
                                        .dough label.active {
                                            border-color: #cc3333 !important;
                                            background-color: #cc3333 !important;
                                            background: #cc3333 !important;
                                            color: #fff !important;
                                        }

                                        .card-header.active {
                                            background: #cc3333;
                                            color: #fff !important;
                                        }

                                        .card-header.active button {
                                            color: #fff;
                                        }

                                        * {
                                            font-family: Cairo !important;
                                        }
                                    </style>

                                    <div class="btn-group btn-group-toggle dough" data-toggle="buttons" style="width: 60%;">
                                        @foreach ($item['dough_type'] as $dough)
                                            <label class="btn btn-light" for="{{ $dough['name_en'] }}"><input
                                                    id="{{ $dough['name_en'] }}" type="radio" name="dough_type"
                                                    value="{{ $dough['name_ar'] }},{{ $dough['name_en'] }}"
                                                    @if ($loop->first) checked @endif><span>{{ app()->getLocale() == 'ar' ? $dough->name_ar : $dough->name_en }}</span></label>
                                        @endforeach
                                    </div>

                                <p>{{ app()->getLocale() == 'ar' ? $item['description_ar'] : $item['description_en'] }}</p>
                                
                                <div class="product-btn">
                                        <input type="number" name="quantity" id="quantity"
                                        min="1" max="100" step="1" value="1">
                                    <div> <button class="purchase-btn" type="submit">{{ __('home.Add to Cart') }}</button></div>
                                </div>
                                <ul class="product-meta">
                                    <li>Categories:<a href="#">{{$item->calories}}</a></li>
                                </ul>
                                <ul class="social-icon">
                                    <li>Share:</li>
                                    <li><a href="#"><i class="lab la-facebook-f"></i></a></li>
                                    <li><a href="#"><i class="lab la-twitter"></i></a></li>
                                    <li><a href="#"><i class="lab la-behance"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                                    </form>
            </div>
        </section><!--Shop Section-->
        
        <section class="product-description bg-grey padding">
            <div class="container">
                <ul class="nav tab-navigation" id="product-tab-navigation" role="tablist">
                    @if ($item['category']['extras']->count() > 0)
                    <li role="presentation">
                        <button class="active" id="extra-tab" data-bs-toggle="tab" data-bs-target="#extra" type="button" role="tab" aria-controls="extra" aria-selected="true"> {{ __('general.Extra') }}</button>
                    </li>
                    @endif
                    @if ($item['category']['withouts']->count() > 0)
                    <li role="presentation">
                        <button id="without-tab" data-bs-toggle="tab" data-bs-target="#without" type="button" role="tab" aria-controls="without" aria-selected="false">{{ __('general.Without') }}</button>
                    </li>
                    @endif
                    <!-- <li role="presentation">
                        <button id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Reviews (2)</button>
                    </li> -->
                </ul>
                <div class="tab-content" id="product-tab-content">
                @if ($item['category']['extras']->count() > 0)
                    <div class="tab-pane fade show active description" id="extra" role="tabpanel" aria-labelledby="extra-tab">
                        <table class="table product-table">
                                <thead>
                                    <tr>
                                        <th scope="col">Extra</th>
                                        <th scope="col">Select</th>
                                    </tr>
                                </thead>
                                <tbody>
                        @foreach ($item['category']['extras'] as $extra)
                                <tr>
                                <td><b style="color:black;"> {{ app()->getLocale() == 'ar' ? $extra['name_ar'] : $extra['name_en'] }}</b>
                                    <br>
                                        <span>
                                            {{ __('home.Calories') }}:
                                            {{ $extra['calories'] }}
                                        </span>
                                        <span>
                                            ({{ round($extra['price'], 2) }}
                                            {{ __('general.SR') }})
                                        </span>
                                
                                    </td>
                                    <td> <input type="checkbox" value="{{ $extra['id'] }}" name="extras[]" class="checkExtra"  x-on:check="addToItem(
                                                                    'extras',
                                                                    {{ $extra['id'] }},
                                                                    '{{ app()->getLocale() == 'ar' ? $extra['name_ar'] : $extra['name_en'] }}',
                                                                    {{ round($extra['price'], 2) }}
                                                                )"></td>
                            
                                    
                                </tr>
                        @endforeach
                                </tbody>
                            </table>
                    </div>
                @endif
                @if ($item['category']['withouts']->count() > 0)
                    <div class="tab-pane fade show  description" id="without" role="tabpanel" aria-labelledby="without-tab">
                        <table class="table product-table">
                            <thead>
                                <tr>
                                <th scope="col">Without</th>
                                    <th scope="col">Select</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($item['category']['withouts'] as $without)
                            <tr>
                            <td><b style="color:black;"> {{ app()->getLocale() == 'ar' ? $without['name_ar'] : $without['name_en'] }}</b>
                                <br>
                                    <span>
                                        {{ __('home.Calories') }}:
                                        {{ $without['calories'] }}
                                    </span>
                                    <span>
                                        ({{ round($without['price'], 2) }}
                                        {{ __('general.SR') }})
                                    </span>
                               
                                </td>
                                <td> <input type="checkbox" x-data value="{{ $without['id'] }}" name="without[]" class="checkExtra"  x-on:click="addToItem(
                                                                    'withouts',
                                                                    {{ $without['id'] }},
                                                                    '{{ app()->getLocale() == 'ar' ? $without['name_ar'] : $without['name_en'] }}',
                                                                    {{ round($without['price'], 2) }}
                                                                )"></td>
                          
                                
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
                </div>
            </div>
        </section><!--Product Description-->

		<div id="scrollup">
            <button id="scroll-top" class="scroll-to-top"><i class="las la-arrow-up"></i></button>
        </div>
        @endsection

   