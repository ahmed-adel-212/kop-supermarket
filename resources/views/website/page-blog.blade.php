@extends('layouts.website.app')

@section('title')
    Page blog
@endsection

@section('styles')
    <style>
        body.dm-light .article-intro__body {
            border: 1px solid #d6d6d6;
        }

        div.article-intro__body:hover {
            border: 1px solid #888585;
        }

        .article-full__body,
        .article-intro__body {
            padding: 15px 30px 40px;
            border-top: none !important;
        }

        .line-clamp2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .line-clamp5 {
            display: -webkit-box;
            -webkit-line-clamp: 5;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .post-navigation {
            align-items: unset;
        }
    </style>
@endsection
@section('pageName')

    <body class="page-blog dm-dark">
    @endsection

    @section('content')
        <main class="page-main">
            <section class="page-header"
                style="background-image: url({{ asset('website-assets/img/pages/contacts/latest.jpg') }}">
                <div class="bg-shape grey"></div>
                <div class="container">
                    <div class="page-header-content">
                        <h4>{{ __('general.Latest News') }}</h4>
                        <h2>
                            {!! __('general.blog_title') !!}
                        </h2>
                    </div>
                </div>
            </section>
            <!--/.page-header-->

            <section class="blog-section bg-grey padding">
                <div class="bg-shape white"></div>
                <div class="container">
                    <div class="row blog-posts">
                        <div class="col-lg-8 sm-padding">
                            <div class="row grid-layout">
                                @foreach ($articles as $ar)
                                    <div class="col-md-6 padding-15 d-flex">
                                        <div class="post-card">
                                            <div class="post-thumb">
                                                <img src="{{ asset($ar->image) }}" alt="img">
                                            </div>
                                            <div class="post-content">
                                                <ul class="post-meta">
                                                    <li><i class="far fa-calendar-alt"></i><a href="{{route('news.archive', [$ar->updated_at->year, $ar->updated_at->format('m')])}}">
                                                            {{ $ar->updated_at->translatedFormat('d M Y') }}
                                                        </a></li>
                                                    {{-- <li><i class="far fa-user"></i><a href="#">Jonathan Smith</a></li> --}}
                                                </ul>
                                                <h3><a href="{{ route('get.new', $ar->id) }}">
                                                        {{ $ar['title_' . app()->getLocale()] }}
                                                    </a></h3>
                                                <p>
                                                    {{ Str::limit($ar['description_' . app()->getLocale()], 60) }}
                                                </p>
                                                <a href="{{ route('get.new', $ar->id) }}" class="read-more">
                                                    {{__('general.Read More')}} <i
                                                        class="las la-long-arrow-alt-right"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="row text-center">
                                {{ $articles->links() }}
                            </div>
                        </div>
                        <div class="col-lg-4 sm-padding">
                            @include('website.page-blog-sidebar')
                        </div>
                    </div>
                </div>
            </section>
            </div>
        </main>
    @endsection

    @section('scripts')
    @endsection
