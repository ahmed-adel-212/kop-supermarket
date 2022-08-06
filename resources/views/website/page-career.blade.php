@extends('layouts.website.app')

@section('title') Career Info @endsection

@section('styles')
    <style>
        h5 {
            font-family: "Open Sans";
        }
    </style>


@endsection

@section('pageName')
    <body class="page-404 dm-dark"> @endsection

    @section('content')
        <main class="page-main">
            <div class="section-first-screen">
                <div class="first-screen__bg"
                     style="background-image: url({{asset('website-assets/img/pages/home/careers.jpg')}})"></div>
                <div class="first-screen__content">
                    <div class="uk-container">
                        <div class="first-screen__box">
                            <h2 class="first-screen__title">{{__('general.Job Information')}}</h2>
                            <div class="first-screen__breadcrumb">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="page-content">
                <div class="uk-section uk-container uk-container-small">

                    @if(isset($job))
                        <div class="article-full__info">
                        </div>

                        <div class="article-full__content">
                            <div class="article-full__content">
                                <article class="article-intro">

                                    <div class="article-intro__body">
                                        <div class="article-intro__info">
                                        </div>
                                        <h2 class="article-intro__title">{{$job['title_'.app()->getLocale()]}}</h2>
                                        @if(app()->getLocale()=='ar')

                                            <h5>{{__('general.Description')}}</h5>
                                            <div class="article-intro__content">
                                                <ul>
                                                    @foreach($arr_description_ar as $r_ar)
                                                        <li>{{$r_ar}}</li>
                                                    @endforeach
                                                </ul>

                                            </div>
                                            <div class="article-intro__content">
                                                <h5>{{__('general.responsibilities')}}</h5>
                                                <ul>

                                                    @foreach($arr_responsibilities_ar as $r_ar)
                                                        <li>{{$r_ar}}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @else
                                            <h5>{{__('general.Description')}}</h5>
                                            <div class="article-intro__content">
                                                <ul>
                                                    @foreach($arr_description_en as $r_en)
                                                        <li>{{$r_en}}</li>
                                                    @endforeach
                                                </ul>

                                            </div>
                                            <div class="article-intro__content">
                                                <h5>{{__('general.responsibilities')}}</h5>
                                                <ul>
                                                    @foreach($arr_responsibilities_en as $r_en)
                                                        <li>{{$r_en}}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                        <div class="article-intro__bottom">
                                            <div class="article-full__date">
                                                <div ><a
                                                        class="btn btn-warning "   href="{{route('apply.form',$job->id)}}">{{__('general.Apply Now')}}</a></div>
                                            </div>
                                        </div>
                                    </div>
                                </article>


                                @endif


                            </div>
                        </div>

                </div>
            </div>
        </main>
@endsection

@section('scripts')

@endsection

