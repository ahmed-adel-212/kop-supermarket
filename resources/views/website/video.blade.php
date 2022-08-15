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
            <section class="page-header"
                style="background-image: url({{ asset('website-assets/img/pages/home/video.jpg') }})">
                <div class="bg-shape grey"></div>
                <div class="container">
                    <div class="page-header-content">
                        <h4>
                            {{ __('general.Video') }}
                        </h4>
                        <h2>
                            {{ __('general.Video Library') }}
                        </h2>
                    </div>
                </div>
            </section>
            <!--/.page-header-->
            
            <section class="gallery-section bg-grey padding">
                <div class="bg-shape white"></div>
                <div class="container">
                    <div class="row">
                        @foreach ($videos as $video)
                            <div class="col-lg-4 col-sm-6 padding-15">
                                <div class="gallery-item">
                                    @if(is_null($video->img))
                                    <div class="p-4 bg-dark rounded d-flex align-items-center justify-content-center" style="height:300px">
                                        <svg class="w-100 h-100 animate__animated animate__faster animate__heartBeat animate__infinite" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" fill="currentColor" viewBox="0 0 384 512"><path d="M361 215C375.3 223.8 384 239.3 384 256C384 272.7 375.3 288.2 361 296.1L73.03 472.1C58.21 482 39.66 482.4 24.52 473.9C9.377 465.4 0 449.4 0 432V80C0 62.64 9.377 46.63 24.52 38.13C39.66 29.64 58.21 29.99 73.03 39.04L361 215z"/></svg>
                                    </div>
                                    @else
                                        <img src="{{$video->img}}" width='500' height='300' alt="img">
                                    @endif
                                    <a class="img-popup" data-gall="gallery01"
                                        href="{{ $video->url }}" data-autoplay="true" data-vbtype="video" title="{{$video['title_'. app()->getLocale()]}}"><i class="fas fa-expand"></i></a>
                                    <p class="text-center">
                                        {{$video['title_'. app()->getLocale()]}}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="text-center mt-40">
                        {{-- <a href="#" class="default-btn">Load More <span></span></a> --}}
                        {{$videos->links()}}
                    </div>
                </div>
            </section>
            <!--/.gallery-section-->
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
