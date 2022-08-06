@extends('layouts.website.app')

@section('title') Apply Career @endsection

@section('styles')@endsection

@section('pageName')
    <body class="page-404 dm-dark"> @endsection

    @section('content')
        <main class="page-main">
            <div class="section-first-screen">
                <div class="first-screen__bg"
                     style="background-image: url({{asset('website-assets/img/pages/contacts/bg-first-screen.jpg')}})"></div>
                <div class="first-screen__content">
                    <div class="uk-container">
                        <div class="first-screen__box">
                            <h2 class="first-screen__title"> {{__('general.Apply Career')}}</h2>
                            <div class="first-screen__breadcrumb">
                                {{--                        <ul class="uk-breadcrumb">--}}
                                {{--                            <li><a href="#">Back To Home</a></li>--}}
                                {{--                        </ul>--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="page-content">
                <div class="uk-section uk-container uk-container-small">

                    @if(isset($job))
                        <div class="container clearfix">
                            <section>
                                <form method="POST" action="{{route('career.request' , $job->id)}}"
                                      enctype="multipart/form-data">
                                    @csrf
                                     <div class="row">
                                        <div class="col-md-12 d-flex p-3">
                                            <div class="col-md-2">
                                                <span>{{__('general.Name')}}</span>
                                            </div>
                                            <div class="col-md-10">
                                                <input name="name"  class="form-control"  type="text"
                                                       value="{{old('name')}}"/>

                                                @error('name')
                                                <div class="help-block">{{ $message }}</div>
                                                @enderror
                                            </div>

                                        </div>
                                        <div class="col-md-12 d-flex p-3">
                                            <div class="col-md-2">
                                                <span>{{__('general.Email')}}</span>
                                            </div>
                                            <div class="col-md-10 ">
                                                <input name="email"  class="form-control" type="email"
                                                       value="{{old('email')}}"/>

                                                @error('email')
                                                <div class="help-block">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12 d-flex p-3">
                                            <div class="col-md-2">
                                                <span>{{__('general.Mobile')}}</span>
                                            </div>
                                            <div class="col-md-10">
                                                <input name="phone"  class="form-control" type="tel"
                                                       value="{{old('phone')}}"/>
                                                @error('phone')
                                                <div class="help-block">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12 d-flex p-3">
                                            <div class="col-md-2">
                                                <span>{{__('general.Details')}}</span>
                                            </div>
                                            <div class="col-md-10">
                                                <textarea name="description" class="form-control" rows="2"
                                                          cols="20">{{old('description')}}</textarea>
                                                @error('description')
                                                <div class="help-block">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12 d-flex p-3">
                                            <div class="col-md-2">
                                                <span>C.V</span>
                                            </div>
                                            <div class="col-md-10">
                                                <input name="cv_file"  class="form-group" type="file"
                                                value="{{old('cv_file')}}"/>
                                                @error('cv_file')
                                                <div class="help-block">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-8 offset-2" style="padding-left: 25px;">
                                            <button type="submit" class="btn btn-primary ">{{__('general.Apply')}}</button>
                                        </div>
                                    </div>

                                </form>
                            </section>
                        </div>



                    @endif

                </div>
            </div>


        </main>
@endsection

@section('scripts')

@endsection

