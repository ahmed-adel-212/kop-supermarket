@extends('layouts.website.app')

@section('title') Gallery @endsection

@section('styles')
    <style>
        .page-item.active .page-link {
            z-index: 1;
            border-color: #6dc405;
            background: #6dc405;
            color: #ffffff;
        }
        .page-item.disabled .page-link {
            color: #ffffff;
            pointer-events: none;
            cursor: auto;
            background-color: inherit;
            border-color: #dee2e6;
        }
        .page-link {
            background-color: inherit;
        }
        .uk-lightbox {
            background: rgba(0, 0, 0, 0.60);
        }
    </style>
@endsection

@section('pageName') <body class="page-catalog dm-dark"> @endsection

@section('content')
    <main class="page-main">
        <div class="section-first-screen">
            <div class="first-screen__bg" style="background-image: url({{asset('website-assets/img/pages/home/gallery.jpg')}})"></div>
            <div class="first-screen__content">
                <div class="uk-container">
                    <div class="first-screen__box">
                        <h2 class="first-screen__title">{{__('general.Gallery')}}</h2>
                        <p class="first-screen__desc">{{__('general.Pictures of pastries kingdom products')}}</p>
                        <div class="first-screen__breadcrumb">
                            <ul class="uk-breadcrumb">
                                <li><a href="/">{{__('menu.Home')}}</a></li>
                                <li><span>{{__('general.Gallery')}}</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-content">
            <div class="uk-container">
                <div class="mt-5">
                    <ul class="js-filter uk-grid uk-grid-small uk-child-width-1-2@s uk-child-width-1-3@m uk-child-width-1-4@l" data-uk-grid>
                        @foreach($galleries as $gallery)
                        <li data-tags="spicy">
                            <div class="product-item">
                                <div class="product-item__box">
                                    <div class="product-item__intro">
                                        <div class="product-item__not-active">
                                            <div class="product-item__media">

                                                <!--<div class="uk-inline-clip uk-transition-toggle uk-light" data-uk-lightbox="data-uk-lightbox">
                                                    <a>
                                                        <img class="h-100 w-100" src="{{asset($gallery->url)}}" alt="{{(app()->getLocale() == 'ar')? $gallery->title_ar : $gallery->title_en}}" />
                                                        <div class="uk-transition-fade uk-position-cover uk-overlay uk-overlay-primary"></div>
                                                        <div class="uk-position-center"><span class="uk-transition-fade" data-uk-icon="icon: search;"></span></div>
                                                    </a>
                                                </div>-->

                                                <div class="uk-child-width-1-1@s m-0 p-0 w-100 h-100 uk-inline-clip uk-transition-toggle" uk-grid uk-lightbox="animation: scale">
                                                    <div class="w-100 h-100 p-0">
                                                        <a class="uk-inline h-100 w-100" href="{{asset($gallery->url)}}" data-caption="{{(app()->getLocale() == 'ar')? $gallery->title_ar : $gallery->title_en}}">
                                                            <img class="h-100 w-100" src="{{asset($gallery->url)}}" alt="{{(app()->getLocale() == 'ar')? $gallery->title_ar : $gallery->title_en}}" />
                                                            <div class="uk-transition-fade uk-position-cover uk-overlay uk-overlay-primary"></div>
                                                            <div class="uk-position-center"><span class="uk-transition-fade" data-uk-icon="icon: search;"></span></div>
                                                        </a>
                                                    </div>
                                                    @foreach($galleries as $gall)
                                                        <div class="d-none">
                                                            <a class="uk-inline" href="{{asset($gall->url)}}" data-caption="{{(app()->getLocale() == 'ar')? $gall->title_ar : $gall->title_en}}">
                                                                <img class="h-100 w-100" src="{{asset($gall->url)}}" alt="{{(app()->getLocale() == 'ar')? $gall->title_ar : $gall->title_en}}" />
                                                            </a>
                                                        </div>
                                                    @endforeach
                                                </div>

{{--                                                <div class="product-item__whish"><i class="fas fa-heart"></i></div>--}}
                                                <div class="product-item__tooltip" data-uk-tooltip="title: {{(app()->getLocale() == 'ar')? $gallery->title_ar : $gallery->title_en}} ; pos: bottom-right"><i class="fas fa-info-circle"></i></div>
                                            </div>
                                            <div class="product-item__title text-center" style="padding: 10px 20px 10px;"><a style="cursor: default">{{(app()->getLocale() == 'ar')? $gallery->title_ar : $gallery->title_en}}</a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                    {{ $galleries->links() }}
                </div>
            </div>
        </div>
    </main>
@endsection

@section('scripts')@endsection
