@extends('layouts.website.app')

@section('title') choose service @endsection

@section('styles')@endsection

@section('pageName') <body class="page-catalog dm-dark"> @endsection

@section('content')
    <main class="page-main" style="margin-top: 10%;">
        <div class="page-content">
            <div class="uk-container">
                <div class="mt-5">
                    <div class="osahan-cart-item mb-3 rounded shadow-sm bg-white overflow-hidden">
                        <div class="osahan-cart-item-profile bg-white p-3">
                            <div class="d-flex flex-column">
                                <div class="row">
                                    <div class="card custom-control col-md-5 custom-radio mb-3 p-0 position-relative border-custom-radio">
                                        <input type="radio" id="customRadioInline1" name="customRadioInline1"
                                               class="custom-control-input">
                                        <label class="custom-control-label w-100 h-100" for="customRadioInline1">
                                            <div class="w-100 h-100">
                                                <div class="bg-danger rounded shadow-sm w-100 h-100">
                                                    <div class="w-100 text-center h-100">
                                                        <a href="{{route('delivery.page')}}"><h1 class="m-0 w-100 h-100" style="color: #fff;padding: 12%;">{{__('general.Delivery')}}</h1></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </label>
                                    </div>
                                    <div class="col-md-2">
                                    </div>
                                    <div class="card custom-control col-md-5 custom-radio mb-3 p-0 position-relative border-custom-radio">
                                        <input type="radio" id="customRadioInline2" name="customRadioInline1"
                                               class="custom-control-input">
                                        <label class="custom-control-label w-100 h-100" for="customRadioInline2">
                                            <div class="w-100 h-100">
                                                <div class="bg-success rounded shadow-sm w-100 h-100">
                                                    <div class="w-100 text-center h-100">
                                                        <a href="{{route('takeaway.page')}}"><h1 class="m-0 w-100 h-100 bg" style="color: #fff;padding: 12%;">{{__('general.Take away')}}</h1></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </label>
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

@section('scripts')@endsection
