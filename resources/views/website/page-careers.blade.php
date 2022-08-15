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

/* .panel-heading:hover 
{
  background-color: #c3c3c3c3;
} */


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
    margin:5px;
    margin-left:10px;
}

.article-intro__bottom .uk-button
{    margin-top: -15%;
    font-size: 11px;
}
.affix {
          top: 20px;
          z-index: 9999 !important;
          position: sticky;

      }
    
</style>

@endsection

@section('pageName')
    <body class="page-home dm-dark"> @endsection

    @section('content')
        <main class="page-main">
            <section class="page-header" style="background-image: url({{asset('website-assets/img/pages/home/careers.jpg')}})">
                <div class="bg-shape grey"></div>
                 <div class="container">
                     <div class="page-header-content">
                         <h4>{{__('general.Job Information')}}</h4>
                         <h2>{!! __('general.carrer_title') !!}</h2>
                     </div>
                 </div>
             </section><!--/.page-header-->

             <section class="blog-section bg-grey padding">
                <div class="bg-shape white"></div>
                <div class="container">
                    <div class="row">
                        
                    </div>
                </div>
             </section>

            
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
                    <div class="col-md-8" >
                    @foreach($jobs as $job)
                    <div class="panel-group " >
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                <a data-toggle="collapse" href="#collapse{{$job->id}}" style="color:#cbcbcb;font-size: 25px;"><i class="fas fa-angle-right left"></i></a>
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
                    <div class="content-wrapper col-md-4" data-spy="affix">
                        <section class="content">
                            <div class="container-fluid">
                                <div class="card card-primary">
                                    <div class="card-header">
                                    <h3 class="card-title">APPLY NOW</h3>
                                    </div>
                                    <form method="post" action="{{route('career.request')}}" enctype="multipart/form-data">
                                     @csrf
                                    <div class="card-body">
                                        <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                            <label for="name">{{__('general.Name')}}</label>
                                            <input type="text" class="form-control " id="name" placeholder="Enter Full Name" name="name" required>
                                            {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                                            </div>
                                        </div>
                                    
                                        <div class="col-md-6">
                                            <div class="form-group">
                                            <label for="phone"> {{__('general.Mobile')}}</label>
                                            <input type="text" class="form-control {!! $errors->first('phone', 'is-invalid') !!}" id="phone" placeholder="Enter Phone" name="phone" required>
                                            </div>

                                        </div>
                                        </div>
                                        <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                            <label for="email">{{__('general.Email')}}</label>
                                            <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" required>
                                            {!! $errors->first('email', '<p class="help-block">:message</p>') !!}

                                            </div>
                                        </div>
                                        </div>
                                        
                                        <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                            <label for="job_id">{{__('general.Careers')}}</label>
                                            <select class="select " data-placeholder="Select a Role" style="width: 100%;" name="job_id">
                                                @foreach($jobs as $job)
                                                <option value="{{$job->id}}">{{$job['title_'.app()->getLocale()]}}</option>
                                                @endforeach
                                            </select>
                                            {!! $errors->first('roles', '<p class="help-block">:message</p>') !!}

                                            </div>
                                        </div>
                                        </div>
                                        <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                            <label for="description"> {{__('general.Details')}}</label>
                                            <textarea name="description" class="form-control" rows="2"  cols="20">{{old('description')}}</textarea>
                                                    @error('description')
                                                        <div class="help-block">{{ $message }}</div>
                                                    @enderror
                                            </div>

                                        </div></div>
                                        <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                            <label for="cv_file"> C.V</label>
                                            <input  type="file" name="cv_file" id="cv_file" class="form-group"/>
                                                @error('cv_file')
                                                <div class="help-block">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            </div>
                                    </div>
                                    
                                    <div class="row">
                                        <button type="submit" class="btn btn-primary float-right" style="margin-left: 35%;margin-right: 35%;width: 30%;">Submit</button>
                                    </div>
                                    </form>
                                </div>
                                </div>
                        </section>
<!-- </div><br> -->
                    </div>
                    @endif
                   
                </div>
            </div>
        </main>
@endsection

@section('scripts')

@endsection

