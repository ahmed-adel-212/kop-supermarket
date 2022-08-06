@extends('layouts.website.app')

@section('title') Page article @endsection

@section('styles')@endsection

@section('pageName')
    <body class="page-article dm-dark"> @endsection

    @section('content')
        <main class="page-main">
            <div class="section-first-screen">
                <div class="first-screen__bg"
                     style="background-image: url({{$article->image}})"></div>
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
