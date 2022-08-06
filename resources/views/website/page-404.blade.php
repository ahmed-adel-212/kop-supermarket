@extends('layouts.website.app')

@section('title') Page 404 @endsection

@section('styles')@endsection

@section('pageName') <body class="page-404 dm-dark"> @endsection

@section('content')
<main class="page-main">
    <div class="section-first-screen">
        <div class="first-screen__bg" style="background-image: url({{asset('website-assets/img/pages/contacts/bg-first-screen.jpg')}})"></div>
        <div class="first-screen__content">
            <div class="uk-container">
                <div class="first-screen__box">
                    <h2 class="first-screen__title">Page Not Found</h2>
                    <div class="first-screen__breadcrumb">
                        <ul class="uk-breadcrumb">
                            <li><a href="#">Back To Home</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="page-content">
        <div class="uk-section uk-container uk-container-small">
            <div class="page-404-error"> <img class="page-404-error__img" src="{{asset('website-assets/img/pages/404/404.svg')}}" alt="">
                <div class="page-404-error__form">
                    <div class="page-404-error__form-title">Sorry, but the page has not found.</div>
                    <div class="page-404-error__form-desc">We are unable to find the page you has requested, try searching below:</div>
                    <div class="page-404-error-form">
                        <form action="#">
                            <div class="page-404-error-form__box"><input type="email" placeholder="Type a keyword ..."><input class="uk-button" type="submit" value="Search"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@section('scripts')@endsection

