@extends('layouts.profile')

@section('title')
    {{ __('general.loyality') }}
@endsection

@section('styles')
@endsection

@section('pageName')

    <body class="page-article dm-light">
    @endsection

    @section('main')
        <div class="tab-pane fade show active" id="loyality" role="tabpanel" aria-labelledby="loyality-tab">
            <div class="card">
                {{-- <div class="card-header default-bg">
                    <h4 class="card-title text-white">{{ __('general.loyality') }}
                    </h4>
                </div> --}}

                <div class="card-body default-bg">
                    <div class="row text-white">
                        <div class='col-8'>
                            <h1 class="text-white">
                                {{ $points }}
                            </h1>
                            <p>
                                {{__('general.Loyalty Program')}}
                            </p>
                        </div>
                        <div class="col-4">
                            <i class="fas fa-tree fa-4x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
