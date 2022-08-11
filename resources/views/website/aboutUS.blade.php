@extends('layouts.website.app')

@section('title')
    About us
@endsection

@section('styles')
    <style>
        .about-p p {
            font-size: 18px;
        }
        .feat:hover {
            transition: all ease-in .3s;
            background-color: white;
            box-shadow: 0 0 5px #000;
        }
        .carousel-inner li {
            display: none;
        }
        .card-img-overlay-custom {
            text-align: center;
            width: 100%;
            position: absolute;
            bottom: 0;
        }

        .card-title {
            background: #0000008c;
            color: #fff;
        }

        .image-card img:hover {
            cursor: pointer;
            transform: scale(1.5);
            transition: all ease-in .3s;
        }

        button.close {
            position: absolute;
            top: 1rem;
            right: 1rem;
            color: #fff;
            opacity: 1;
            padding: 5px 10px;
            border-radius: 6px;
            border: 1px solid #000;
            z-index: 999999;
        }

        .close:hover {
            color: gray;
            border-color: #fff;
        }
        .carousel-caption {
            bottom: 15%;
        }
        .carousel-caption h5 {
            background: #0000008c;
            color: #fff;
        }
    </style>
@endsection

@section('pageName')

    <body class="page-article dm-dark">
    @endsection

    @section('content')
        <main class="page-main">
            <div class="section-first-screen">
                <div class="first-screen__bg"
                    style="background-image: url({{ asset('website-assets/img/pages/home/aboutus.jpg') }})"></div>
                <div class="first-screen__content">
                    <div class="uk-container">
                        <div class="first-screen__box">
                            <h3 class="text-white">
                                {{__('general.story')}}
                            </h3>
                            <h2 class="first-screen__title text-uppercase">
                                {{ $about['title_' . app()->getLocale()] ?? 'About Us' }}
                            </h2>
                            <div class="first-screen__breadcrumb">
                                <ul class="uk-breadcrumb">
                                    <li><a href="/">{{ __('menu.Home') }}</a></li>
                                    <li>
                                        <span>
                                            {{ $about['title_' . app()->getLocale()] ?? 'About Us' }}
                                        </span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="page-content">

                @php
                    $ft = $sections->where('type', 'first')->first();
                @endphp
                <div class='row' style="margin-top: -55px;">
                    <div class='col-11 mx-auto bg-white p-4 card-body text-center rounded-lg'>
                        <h2 class="">
                            {{ $ft['title_' . app()->getLocale()] }}
                        </h2>
                        <div class="card-body">
                            {{ $ft['description_' . app()->getLocale()] }}
                        </div>
                    </div>
                </div>

                @php
                    $snd = $sections->where('type', 'bg-st')->first();
                @endphp
                <div class='row my-3'>
                    <div class='col-11 mx-auto bg-white p-4 card-body text-center rounded'
                        style="background: url({{ $snd->image }}) no-repeat center center fixed; 
                    -webkit-background-size: cover;
                    -moz-background-size: cover;
                    -o-background-size: cover;
                    background-size: cover;">
                        <div class="row">
                            <div class="col-1 col-md-6"></div>
                            <div class="col-10 col-md-5 mx-auto card-body bg-white">
                                <h2 class="">
                                    {{ $snd['title_' . app()->getLocale()] }}
                                </h2>
                                <div class="card-body">
                                    {{ $snd['description_' . app()->getLocale()] }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- features --}}
                @php
                    $features = $sections->where('type', 'feat')->all();
                @endphp
                <div class="row my-3">
                    <div class='col-11 mx-auto p-4 card-body text-center rounded'>
                        <div class="row">
                            @foreach ($features as $feat)
                                <div class="col-12 col-sm-6 col-md-4 px-2 feat rounded-lg">
                                    <div class="card-body text-center">
                                        <h2 class="d-flex justify-content-center my-0 pb-2 text-primary" style="font-size: 2.5rem">
                                            <i style="display: block" class="fas {{$feat->icon}}"></i>
                                        </h2>
                                        <h3 class="my-0">
                                            {{ $feat['title_' . app()->getLocale()] }}
                                        </h3>
                                        <div class="card-body text-muted pt-0">
                                            {{ $feat['description_' . app()->getLocale()] }}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>


                @php
                    $bgSnd = $sections->where('type', 'bg-nd')->first();
                @endphp
                <div class='row my-3'>
                    <div class='col-11 mx-auto bg-white p-4 card-body text-center rounded'
                        style="background: url({{ $bgSnd->image }}) no-repeat center center fixed; 
                    -webkit-background-size: cover;
                    -moz-background-size: cover;
                    -o-background-size: cover;
                    background-size: cover;">
                        <div class="row">
                            <div class="col-10 col-md-5 mx-auto card-body bg-white">
                                <h2 class="">
                                    {{ $bgSnd['title_' . app()->getLocale()] }}
                                </h2>
                                <div class="card-body">
                                    {{ $bgSnd['description_' . app()->getLocale()] }}
                                </div>
                            </div>
                            <div class="col-0 col-md-6"></div>
                        </div>
                    </div>
                </div>

                <div class="row my-3">
                    <div class="card-body">
                        <h2 class="text-center m-0 p-0">
                            OUR GALLERY
                        </h2>
                        <div class="uk-container position-relative" style="margin-top: -20px;">
                            <div class="mt-5" x-data="{
                                showModal: false,
                                active: 0,
                            }">
                                <div class="d-flex flex-row flex-wrap align-items-center justify-content-between">
                                    @foreach ($galleries as $gallery)
                                        <div class="col-4 my-2 image-card">
                                            <div class="card overflow-hidden">
                                                <img class="card-img" src="{{ $gallery->url }}"
                                                    alt="{{ app()->getLocale('ar') ? $gallery->title_ar : $gallery->title_en }}"
                                                    x-on:click.prevent="active = {{ $loop->index }};showModal = true;" uk-img />
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                {{-- </ul> --}}
                                <div class="position-relative">
                                    <div class="position-fixed modal-backdrop w-100 h-100" x-show="showModal"
                                        x-on:click.outside="showModal = false" x-on:keydown.esc="showModal = false">
                                        <div id="carousel-images-modal" class="carousel slide w-100 h-100" data-ride="carousel">
                                            <ol class="carousel-indicators">
                                                @foreach ($galleries as $gallery)
                                                    <li data-target="#carousel-images-modal" x-bind:data-slide-to="active"
                                                        x-bind:class="{
                                                            'active': active === {{ $loop->index }}
                                                        }">
                                                    </li>
                                                @endforeach
                                            </ol>
                                            <div class="carousel-inner">
                                                @foreach ($galleries as $gallery)
                                                    <li data-target="#carousel-images-modal" x-bind:data-slide-to="active"
                                                        x-bind:class="{
                                                            'active': active === {{ $loop->index }}
                                                        }">
                                                    </li>
                                                    <div class="carousel-item position-relative"
                                                        x-bind:class="{
                                                            'active': active === {{ $loop->index }}
                                                        }">
                                                        <img class="w-100" style="object-fit: cover;max-height: 100%" src="{{ $gallery->url }}"
                                                            alt="{{ app()->getLocale('ar') ? $gallery->title_ar : $gallery->title_en }}" uk-img />
                                                        <div class="carousel-caption d-none d-md-block">
                                                            <h5 class="rounded">{{ app()->getLocale('ar') ? $gallery->title_ar : $gallery->title_en }}
                                                            </h5>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                            <button type="button" class="close" aria-label="Close"
                                                x-on:click.prevent="showModal = false">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            <a class="carousel-control-prev" href="#carousel-images-modal" role="button"
                                                data-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Previous</span>
                                            </a>
                                            <a class="carousel-control-next" href="#carousel-images-modal" role="button"
                                                data-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Next</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </main>
    @endsection

    @section('scripts')
    @endsection
