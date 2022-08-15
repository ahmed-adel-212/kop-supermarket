@extends('layouts.website.app')

@section('title') Page article @endsection

@section('styles')@endsection

@section('pageName')
    <body class="page-article dm-dark"> @endsection

    @section('content')
        <main class="page-main">
            <section class="page-header" style="background-image: url({{ asset('website-assets/img/pages/contacts/latest.jpg') }}">
                <div class="bg-shape grey"></div>
                <div class="container">
                    <div class="page-header-content">
                        <h4>{{ __('general.Latest News') }}</h4>
                        <h2>{!! __('general.blog_title') !!}</h2>
                    </div>
                </div>
            </section><!--/.page-header-->

            <div class="section-first-screen">
                <div class="first-screen__bg"
                     style="background-image: url('{{$article->image}}')"></div>
                <div class="first-screen__content">
                    <div class="uk-container">
                        <div class="first-screen__box">
                            <h2 class="first-screen__title">{{$article['title_'.app()->getLocale()]}}</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="page-content">
                <div class="uk-margin-large-top uk-container uk-container-small">
                    <article class="article-full">
                        <div class="text-center">
                            <div>{{$article['description_'.app()->getLocale()]}}</div>
                        </div>
                    </article>
                </div>
            </div>
        </main>
@endsection
@section('scripts')@endsection
