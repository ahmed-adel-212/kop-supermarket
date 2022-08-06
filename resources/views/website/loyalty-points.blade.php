@extends('layouts.website.app')

@section('title')  Loyalty Points @endsection

@section('styles')
    <style type="text/css">

        .numberCircle {
            display: inline-block;

            border-radius: 50%;
            border: 2px solid;

            font-size: 32px;
        }

        .numberCircle:before,
        .numberCircle:after {
            content: '\200B';
            display: inline-block;
            line-height: 0px;

            padding-top: 50%;
            padding-bottom: 50%;
        }

        .numberCircle:before {
            padding-left: 8px;
        }

        .numberCircle:after {
            padding-right: 8px;
        }
    </style>
@endsection

@section('pageName')
    <body class="page-article dm-dark"> @endsection

    @section('content')
        <main class="page-main">
            <div class="section-first-screen">
                <div class="first-screen__bg"
                     style="background-image: url({{asset('website-assets/img/pages/contacts/bg-first-screen.jpg')}})"></div>
                <div class="first-screen__content">
                    <div class="uk-container">
                        <div class="first-screen__box">
                            <h2 class="first-screen__title">{{__('general.Loyalty Points')}}</h2>
                            <div class="first-screen__breadcrumb">
                                <ul class="uk-breadcrumb">
                                    <li><a href="{{route('home.page')}}">{{__('contact_us.Home')}}</a></li>
                                    <li><span>{{__('general.Points')}}</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="page-content">

                <div class="uk-margin-large-top uk-container uk-container-small">


                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-md-0">
                                <div class="bg-white card addresses-item mb-4 shadow">
                                    <div class="gold-members p-4">
                                        <div class="media">

                                            <div class="media-body ">
                                                <p class="mb-0 mt-0 text-black font-weight-bold">
                                                    <button data-toggle="modal"
                                                            data-target="#add-address-modal "
                                                            href="#" type="button"
                                                            class="btn btn-primary btn-floating">
                                                        <i class="fa fa-question-circle" aria-hidden="true"></i>
                                                    </button>
                                                    {{__('general.To Know How To Use Points Please Click Here!')}}
                                                </p>
                                            </div>

                                            <div class="modal fade"
                                                 id="add-address-modal"
                                                 tabindex="-1" role="dialog"
                                                 aria-labelledby="add-address"
                                                 aria-hidden="true">
                                                <div
                                                    class="modal-dialog modal-dialog-centered"
                                                    role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title"
                                                                id="add-address">{{__('general.Loyalty Program')}}</h5>
                                                            <button type="button"
                                                                    class="close"
                                                                    data-dismiss="modal"
                                                                    aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>1) {{__('general.Buy using the app to collect points.')}}</p>
                                                            <p>2) {{__('general.For each 10 SR you pay you will get 1 point.')}}</p>
                                                            <p>3) {{__('general.you can replace each 50 points with 10 SR purchase.')}}</p>
                                                            <p>4) {{__('general.you can benefit from the points for one year of getting the points.')}}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <span class="numberCircle">
                                @if(isset($points))
                                    {{$points['user_points']}}
                                @endif
                            </span>
                        </div>
                        <div class="row justify-content-center">

                            <div class="table-responsive offset-top-10" style="border-radius: 10px;">
                                <table class="table table-shopping-cart mt-4">
                                    <tbody>

                                        <tr style="height: 30px"></tr>
                                        @for ($i = 1; $i < ($points['user_points']/100); $i++)
                                        <tr style="  !important;box-shadow: 0.1rem 0rem 1.5rem rgb(0 0 0 / 20%);border-radius: 5px; margin-bottom: 10px">
                                            <td class="p-4" style="width: 170px;height: 170px">
                                                <div class="">
                                                    <div class="product-image"><img
                                                            src="{{asset('points/points.jpeg')}}"
                                                            class="img-thumbnail"
                                                            style="border-radius: 10px;" width="100%" height="100%"
                                                            alt="">
                                                    </div>
                                                </div>
                                            </td>
                                            <td style="min-width: 340px;">
                                                <div class="text-left"><span
                                                        class="h5 text-sbold product-brand text-italic"
                                                        style="font-size: 25px;">{{__('general.Points')}}</span>
                                                    <div class="offset-top-0">{{__('general.Exchange 100 Points for')}} {{$points['points_value']}} {{__('general.SR')}}
                                                    </div>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="inset-left-20" style="padding-top:20px">
                                                    <a href="@if(!session()->has('point_claim_value')){{route('exchange.points')}}@endif"
                                                        @if(session()->has('point_claim_value')) onclick="alert('{{__('general.You had claimed point before.')}}')" @endif
                                                        style="font-size: 20px;" class="btn btn-outline-danger link-gray-lightest text-danger">
                                                        <i class="fa fa-exchange" aria-hidden="true"></i> {{__('general.Exchange')}}
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr style="height: 30px"></tr>
                                        @endfor
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
@endsection

@section('scripts')@endsection

