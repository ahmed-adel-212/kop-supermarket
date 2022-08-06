@extends('layouts.website.app')

@section('title') About us @endsection

@section('styles')
    <style>
    .about-p p{
        font-size: 18px;   
    }
    </style>
@endsection

@section('pageName') <body class="page-article dm-dark"> @endsection

@section('content')
    <main class="page-main">
        <div class="section-first-screen">
            <div class="first-screen__bg" style="background-image: url({{asset('website-assets/img/pages/home/aboutus.jpg')}})"></div>
            <div class="first-screen__content">
                <div class="uk-container">
                    <div class="first-screen__box">
                        <h2 class="first-screen__title">
                            {{$about["title_".app()->getLocale()] ?? 'About Us'}}
                        </h2>
                        <div class="first-screen__breadcrumb">
                            <ul class="uk-breadcrumb">
                                <li><a href="/">{{__('menu.Home')}}</a></li>
                                <li>
                                    <span>
                                        {{$about["title_".app()->getLocale()] ?? 'About Us'}}
                                    </span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-content">

            <div class="uk-margin-large-top uk-container uk-container-small">
                <div class="about-p">{!!$about["description_".app()->getLocale()] ?? 'about us'!!}</div>
            </div>

        </div>
    </main>
@endsection

@section('scripts')@endsection
