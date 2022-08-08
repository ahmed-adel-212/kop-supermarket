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
  width: 99%;
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
    margin:0px;
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
.affix {
          top: 20px;
          z-index: 9999 !important;
          position: sticky;

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
                    <div class="col-md-6">
                    @foreach($jobs as $job)
                    <div class="panel-group " >
                   
                        <div class="panel panel-default">

                            <!-- <div class="article-intro__bottom">
                                    <div class="article-full__date">
                                        <a class="uk-button" href="{{route('apply.form',$job->id)}}"><span style="display: table-cell;vertical-align: middle;text-align:center;">{{__('general.Apply Now')}}</span></a>
                                    </div>
                            </div> -->

                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" href="#collapse{{$job->id}}">{{$job['title_'.app()->getLocale()]}}</a>
                                    <hr style="margin-bottom: 10px;">
                                    <div class="article-intro__date">
                                            <i class="fas fa-calendar-alt"></i>
                                            <span>{{$job->created_at}}</span>
                                          
                                    </div>
                                 
                                </h4>
                                @if(app()->getLocale()=='ar')
                                            <span class="panel-title">{{$job->brief_description_ar}}</span>
                                            @else
                                            <span class="panel-title">{{$job->brief_description_en}}</span>
                                            @endif
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
</div>
                    <div class="col-md-6" style="background-color:white;width: 49%;" data-spy="affix">
                    <br>
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
                                        <div class="col-md-8 offset-2" style="padding-left: 25px;padding-bottom: 4%;">
                                            <button type="submit" class="btn btn-primary ">{{__('general.Apply')}}</button>
                                            
                                        </div>
                                        
                                    </div>

                                </form>
                    </div>
                    @endif
                   
                </div>
            </div>
        </main>
@endsection

@section('scripts')

@endsection

