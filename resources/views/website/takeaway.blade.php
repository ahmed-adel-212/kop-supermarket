@extends('layouts.website.app')

@section('title') {{__('general.Branches')}} @endsection

@section('styles')
    <style>
        .text-primary {
            color: #e23744 !important;
            text-decoration: none !important;
        }
    </style>
@endsection

@section('pageName') <body class="page-catalog dm-dark"> @endsection

@section('content')
    <main class="page-main">
        <div class="page-content">
            <div class="uk-container">
                <div>
                    <div class="py-2">
                        <h2 class="mb-3 mt-0">{{__('general.Branches')}}</h2>
                        <div class="row">
                            @foreach($branches as $branche)
                            <div class="custom-control col-md-4 custom-radio mb-3 p-2 position-relative border-custom-radio">
                                <input type="radio" id="customRadioInline{{$branche->id}}" name="customRadioInline"
                                       class="custom-control-input" @if(session()->has('branch_id')) {{(session()->get('branch_id') == $branche->id)? "checked" : "" }} @endif>
                                <label class="custom-control-label w-100 h-100" for="customRadioInline{{$branche->id}}">
                                    <a href="{{route('takeaway.branch',[$branche->id,'takeaway'])}}">
                                        <div class="w-100 h-100">
                                            <div class="bg-white shadow-sm rounded p-4 w-100 h-100">
                                                <p class="h6 mb-3"><span class="feather-home text-primary"></span><span
                                                        class="ml-3 font-weight-bold">{{(app()->getLocale() == 'ar')? $branche->name_ar : $branche->name_en }}</span></p>
                                                <p class="mb-4">{{(app()->getLocale() == 'ar')? $branche->address_description_ar .' '. $branche->city->name_ar .' '. $branche->area->name_ar : $branche->address_description_en .' '. $branche->city->name_en .' '. $branche->area->name_en }}</p>
                                                @if($branche->working_hours->count()>0)
                                                    @foreach($branche->working_hours as $working_hour)
                                                        <p class="m-1" style="font-size: 14px;"><span
                                                                class="font-weight-bold">Working hours &nbsp;</span><span
                                                                class="text-info">From: {{$working_hour->time_from}}&nbsp;&nbsp; To: {{$working_hour->time_to}}</span>
                                                        </p>
                                                    @endforeach
                                                @endif

                                            </div>
                                        </div>
                                    </a>
                                </label>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('scripts')@endsection
