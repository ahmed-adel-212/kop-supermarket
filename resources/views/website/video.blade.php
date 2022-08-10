@extends('layouts.website.app')

@section('title')
    {{ __('general.Video') }}
@endsection

@section('styles')
<style>
    .list-group-item {
        cursor: pointer;
    }
</style>
@endsection

@section('pageName')

    <body class="page-catalog dm-dark">
    @endsection

    @section('content')
        <main class="page-main">
            <div class="section-first-screen">
                <div class="first-screen__bg"
                    style="background-image: url({{ asset('website-assets/img/pages/home/video.jpg') }})"></div>
                <div class="first-screen__content">
                    <div class="uk-container">
                        <div class="first-screen__box">
                            <h2 class="first-screen__title">{{ __('general.Video') }}</h2>
                            <p class="first-screen__desc">{{ __('general.Video Library') }}</p>
                            <div class="first-screen__breadcrumb">
                                <ul class="uk-breadcrumb">
                                    <li><a href="/">{{ __('menu.Home') }}</a></li>
                                    <li><span>{{ __('general.Video') }}</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="page-content">
                <div class="uk-container">
                    {{-- <div class="mt-5 w-100" style="height: 490px"> --}}
                    {{-- @if (count($videos) > 0)
                    <div class="col-md-9 col-sm-12">
                        <iframe class="the-iframe" style="width: 100%; height: 100%"
                                src="{{asset($videos['current']->url)}}?controls=0" frameborder="0" allowfullscreen>
                        </iframe>
                    </div>
                    <div class="col-md-3 col-sm-12" style="overflow-y: auto">
                         @foreach ($videos['allRemain'] as $vedio)
                            <div class="row w-100 mb-4" style="height: 75px">
                                <div class="offset-2 col-md-5 col-x-5 p-0 text-right">
                                    <h3 style="font-size: medium" class="text-truncate">
                                        <a style="color: #6dc405" href="{{route('video.page',$vedio->id)}}">{{(app()->getLocale() == 'ar')? $vedio->title_ar : $vedio->title_en }}</a>
                                    </h3>
                                    <h5 style="font-size: small" class="m-1">{{$vedio->author}}</h5>
                                    <h6 style="font-size: x-small" class="m-1 text-right">{{$vedio->created_at}}</h6>
                                </div>
                                <div class="col-md-5 col-s-5 h-100">
                                        <iframe class="the-iframe" style="cursor: pointer;width: 100%; height: 100%"
                                                src="{{asset($vedio->url)}}" sandbox>
                                        </iframe>
                                </div>
                            </div>
                        @endforeach

                    </div>
                    @endif --}}
                    <div class="row mt-5" x-data="{
                        active: '{{ $videos->items()[0]->url }}'
                    }">
                        <div class="col-9">
                            <div class="embed-responsive embed-responsive-16by9">
                                <iframe class="the-iframe" style="width: 100%; height: 100%"
                                    x-bind:src="active + '?controls=0&autoplay=1'" frameborder="0" allowfullscreen>
                                </iframe>
                            </div>
                        </div>
                        <div class="col-3">
                            <ul class="list-group list-group-flush">
                                @foreach ($videos as $v)
                                    <li class="list-group-item"
                                        x-bind:class="{
                                            'active': active === '{{ $v->url }}',
                                        }" x-on:click="active = '{{ $v->url }}'">
                                        <video controls width="250" preload="none">                                        
                                            <source src="{{$v->url}}"
                                                    type="video/mp4">
                                            Sorry, your browser doesn't support embedded videos.
                                        </video>
                                        {{ $v->title_ar }}
                                    </li>
                                @endforeach

                            </ul>
                        </div>
                    </div>
                    <div>
                        {{ $videos->links() }}
                    </div>
                    {{-- </div> --}}
                </div>
            </div>
        </main>
    @endsection

    @section('scripts')
        <script>
            $('.the-iframe').load(function(ev) {
                const new_style_element = document.createElement("style");
                new_style_element.textContent =
                    'body {' +
                    '  margin: 0!important;' +
                    '}' +
                    'video {' +
                    '  margin: 0!important;' +
                    '  width: 100%!important;' +
                    '  height: 100%!important;' +
                    '}'
                ev.target.contentDocument.head.appendChild(new_style_element);
            });
        </script>
    @endsection
