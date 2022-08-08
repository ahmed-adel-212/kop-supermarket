@extends('layouts.website.app')

@section('title') Careers @endsection

@section('styles')
<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<style>
.panel-default>.panel-heading {
  background-color: white;
  color: #2387aa;
  cursor: pointer;
  padding: 18px;
  width: 100%;
  border: none;
  text-align: left;
  outline: none;
  font-size: 20px;
  margin: 5px;
}
.panel-title>a
{
    color: #2387aa;
    font-size: 20px;
}

.panel-heading:hover 
{
  background-color: #c3c3c3c3;
}


.article-intro__date span{
    color: #898989;
    font-size: 16px;
    padding-left: 5px;
}
.svg-inline--fa.fa-w-14 {
    width: 0.875em;
    color: #6dc405;
}
.panel-group{
    margin:20px;
}

.article-intro__bottom .uk-button
{    margin-top: -15%;
    font-size: 11px;
}
</style>
@if(app()->getLocale()=='ar')
<style>
.article-intro__bottom .uk-button {
    margin-top: -44%;
    line-height: 50px;
}
.brief_desc
{
    float: left;
    padding-left: 3%;
}
.panel .article-intro__bottom{
    float: left;
    padding-left: 1%;
    line-height: 50px;

}
</style>
@else
<style>
.brief_desc
{
    float: right;
    padding-right: 3%;
}
.panel .article-intro__bottom{
    float: right;
    padding-right: 3%;
    
}
</style>
@endif
@endsection

@section('pageName')
    <body class="page-home dm-dark"> @endsection

    @section('content')
        <main class="page-main">
            <div class="section-first-screen">
                <div class="first-screen__bg"
                     style="background-image: url({{asset('website-assets/img/pages/contacts/career.jpg')}})"></div>
                <div class="first-screen__content">
                    <div class="uk-container">
                        <div class="first-screen__box">
                            <h2 class="first-screen__title">{{__('general.Careers')}}</h2>
                            <div class="first-screen__breadcrumb">

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="page-content" style="background-color:#f2f2f2;">
                <div class="uk-section ">
                    @if(Session::has('success'))
                        <div class="row mr-2 ml-2">
                            <button type="text" class="btn btn-lg btn-block btn-outline-success mb-2"
                                    id="type-error">{{Session::get('success')}}
                            </button>
                        </div>
                    @endif
                    @if(Session::has('error'))
                        <div class="row mr-2 ml-2" >
                            <button type="text" class="btn btn-lg btn-block btn-outline-danger mb-2"
                                    id="type-error">{{Session::get('error')}}
                            </button>
                        </div>
                    @endif
                    @if(isset($jobs))
                    @foreach($jobs as $job)
                    <div class="panel-group" >
                   
                        <div class="panel panel-default">

                            <div class="article-intro__bottom">
                                    <div class="article-full__date">
                                        <a class="uk-button" href="{{route('apply.form',$job->id)}}"><span style="display: table-cell;vertical-align: middle;text-align:center;">{{__('general.Apply Now')}}</span></a>
                                    </div>
                            </div>

                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" href="#collapse{{$job->id}}">{{$job['title_'.app()->getLocale()]}}</a>
                                    <hr>
                                    <div class="article-intro__date">
                                            <i class="fas fa-calendar-alt"></i>
                                            <span>{{$job->created_at}}</span>
                                            @if(app()->getLocale()=='ar')
                                            <span class="brief_desc">{{$job->brief_description_ar}}</span>
                                            @else
                                            <span class="brief_desc">{{$job->brief_description_en}}</span>
                                            @endif
                                    </div>
                                </h4>
                                
                        </div>
                        <div id="collapse{{$job->id}}" class="panel-collapse collapse">
                            <div class="panel-body">  @if(app()->getLocale()=='ar')

                                <h5>{{__('general.Description')}}</h5>
                                <div class="article-intro__content">
                                    <ul>
                                        @foreach($job->arr_description_ar as $r_ar)
                                            <li>{{$r_ar}}</li>
                                        @endforeach
                                    </ul>

                                </div>
                                <div class="article-intro__content">
                                    <h5>{{__('general.responsibilities')}}</h5>
                                    <ul>

                                        @foreach($job->arr_responsibilities_ar as $r_ar)
                                            <li>{{$r_ar}}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @else
                                <h5>{{__('general.Description')}}</h5>
                                <div class="article-intro__content">
                                    <ul>
                                        @foreach($job->arr_description_en as $r_en)
                                            <li>{{$r_en}}</li>
                                        @endforeach
                                    </ul>

                                </div>
                                <div class="article-intro__content">
                                    <h5>{{__('general.responsibilities')}}</h5>
                                    <ul>
                                        @foreach($job->arr_responsibilities_en as $r_en)
                                            <li>{{$r_en}}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif
                            </div>

                        </div>
                        </div>
                    </div>
                    @endforeach
                    @endif
                   
                </div>
            </div>
        </main>
@endsection

@section('scripts')

@endsection

