@extends('layouts.website.app')

@section('title')
    Item
@endsection

@section('styles')
    <style>
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
    </style>
@endsection

@section('pageName')

    <body class="page-product dm-dark">
    @endsection

    @section('content')
        <main class="page-main">
            <div class="section-first-screen">
                <div class="first-screen__bg"
                    style="background-image: url({{ asset('website-assets/img/pages/contacts/bg-first-screen.jpg') }})">
                </div>
                <div class="first-screen__content">
                    <div class="uk-container">
                        <div class="first-screen__box">
                            <h2 class="first-screen__title">
                                {{ app()->getLocale() == 'ar' ? $item['name_ar'] : $item['name_en'] }}</h2>
                            <div class="first-screen__breadcrumb">
                                <ul class="uk-breadcrumb">
                                    <li><a href="{{ route('home.page') }}">Home</a></li>
                                    <li><a
                                            href="{{ route('menu.page') }}">{{ app()->getLocale() == 'ar' ? $item['category']['name_ar'] : $item['category']['name_en'] }}</a>
                                    </li>
                                    <li><span>{{ app()->getLocale() == 'ar' ? $item['name_ar'] : $item['name_en'] }}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="page-content">
                <div class="uk-margin-large-top uk-container">
                    <form id="addToCard" action="{{ route('add.cart') }}" method="POST">
                        @csrf

                        <input type="hidden" name="item_id" value="{{ $item['id'] }}">
                        @if ($item['offer'])
                            <input type="hidden" name="offer_id" value="{{ $item['offer']['offer_id'] }}">
                            <input type="hidden" name="offer_price" value="{{ round($item['offer']['offer_price'], 2) }}">
                        @endif
                        <div class="uk-card uk-card-default uk-grid-collapse uk-child-width-1-2@s uk-margin" uk-grid>
                            <div class="uk-card-media-left uk-cover-container">
                                <img src="{{ asset($item->image) }}" alt="pizza-big" uk-cover>
                            </div>
                            <div>
                                <div class="uk-card-body" style="padding: 15px 30px;">
                                    <h3 class="uk-card-title"
                                        data-uk-tooltip="title: {{ app()->getLocale() == 'ar' ? $item['name_ar'] : $item['name_en'] }}; pos: bottom-right">
                                        {{ app()->getLocale() == 'ar' ? $item['name_ar'] : $item['name_en'] }}
                                    </h3>
                                    <p>
                                        {{ app()->getLocale() == 'ar' ? $item['description_ar'] : $item['description_en'] }}
                                    </p>

                                    {{-- <hr class="uk-divider-icon"> --}}

                                    <div class="product-full-card__category"><span>{{ __('general.Category') }}:
                                        </span><a
                                            href="{{ route('menu.page') }}">{{ app()->getLocale() == 'ar' ? $item['category']['name_ar'] : $item['category']['name_en'] }}</a>
                                    </div>
                                    <div class="product-full-card__category"><span>{{ __('home.Calories') }}:
                                            {{ $item->calories }}</span></div>
                                            <style>
                                                .dough label.active{
                                                    border-color: #fe3000!important;
                                                    background-color: #fe3000!important;
                                                    background: #fe3000!important;
                                                    color: #fff !important;
                                                }
                                            </style>

                                            <div class="btn-group btn-group-toggle dough" data-toggle="buttons" style="width: 60%;" >
                                                @foreach ($item['dough_type'] as $dough)
                                                    <label class="btn btn-light"><input id="d{{$dough->id}}" type="radio" name="dough_type"
                                                                value="{{ $dough['name_ar'] }},{{ $dough['name_en'] }}"><span>{{ app()->getLocale() == 'ar' ? $dough->name_ar : $dough->name_en }}</span></label>
                                                    
                                                @endforeach
                                              </div>

                                        <div class="product-full-card__inf mt-3">
                                            <div class="product-full-card__price">
                                                <span>{{ __('home.Price') }}: </span><span class="value"
                                                    @if ($item['offer']) style="text-decoration: line-through;font-size: 20px;" @endif>
                                                    {{ round($item->price, 2) }} </span>
                                                @if ($item['offer'])
                                                    <span style="font-size: 26px;color:#6dc405;text-decoration: none">
                                                        {{ round($item['offer']['offer_price'], 2) }} </span>
                                                @endif
                                                @lang('general.SR')
                                            </div>
                                            <div class="product-full-card__btns"><span class="counter"><span
                                                        class="minus">-</span><input type="text" name="quantity"
                                                        value="1"><span class="plus">+</span></span>
                                                <button class="uk-button" type="submit">
                                                    @if (app()->getLocale() == 'ar')
                                                        <span data-uk-icon="cart"></span> {{ __('home.Add to Cart') }}
                                                    @else
                                                        {{ __('home.Add to Cart') }} <span data-uk-icon="cart"></span>
                                                    @endif
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </main>
    @endsection

    @section('scripts')
        <script>
            $('.btnAdd').click(function(e) {
                e.preventDefault();
                let selectele = $(this);
                if (selectele.next().find('.food-item').hasClass('text-danger')) {
                    selectele.next().find('.food-item').removeClass('text-danger').addClass('text-success');
                    selectele.next().find('.checkExtra').attr('checked', 'checked');
                } else if (selectele.next().find('.food-item').hasClass('text-success')) {
                    selectele.next().find('.food-item').removeClass('text-success').addClass('text-danger');
                    selectele.next().find('.checkExtra').attr('checked', '');
                }
            });
        </script>
    @endsection
