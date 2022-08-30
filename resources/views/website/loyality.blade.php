@extends('layouts.profile')

@section('title')
    {{ __('general.Loyalty Program') }}
@endsection

@section('styles')
    <style>
        .point-value .branches-list {
            transition: all ease-in .3s;
            cursor: pointer;
        }

        .point-value .branches-list:hover {
            box-shadow: 0 0 5px #000;
        }
        .point-value .branches-list.active {
            background-color: #ff9d2d;
            color: #fff;
        }
        .branches-list h3 {
            padding: 0;
            margin: 0;
            background: transparent;
        }
        .branches-list ul li {
            margin-bottom: 0;
        }
    </style>
@endsection

@section('pageName')

    <body class="page-article dm-light">
    @endsection

    @section('main')
        <div class="tab-pane fade show active bg-grey" id="loyality" role="tabpanel" aria-labelledby="loyality-tab">
            <div class="card-body default-bg shadow px-5">
                <div class="row text-white">
                    <div class='col-8'>
                        <h1 class="text-white">
                            @if (isset($points))
                                {{ $points['user_points'] }}
                            @else
                                0
                            @endif
                        </h1>
                        <p>
                            {{ __('general.loyality_earned') }}
                        </p>
                    </div>
                    <div class="col-4">
                        <i class="fas fa-tree fa-4x"></i>
                    </div>
                </div>
            </div>

            <div class="row my-5">
                <div class="col-12">
                    <div class="my-3">
                        <div class="alert alert-danger alert-cart" role="alert" style="display: none">
                            {{ __('general.cart_empty') }}
                        </div>
                        <div class="alert alert-danger alert-amount" role="alert" style="display: none">
                            {{ __('general.cart_amount') }}
                        </div>
                    </div>
                    <div class='row branches-lists'>
                        @foreach ($pointValues as $val)
                            <a href="{{ $cartHasItems && $points['user_points'] >= $val->for ? (session('point_claim_value') == $val->value ? route('loyalty.unset') : route('loyalty.set', [$val->value, $val->for])) : 'javascript:void(0)' }}" style="display: flex;"
                                class="col-4 point-value rounded text-dark @unless($cartHasItems) show-modal @endif @if ($points['user_points'] < $val->for) show-amount @endif">
                                <div class="branches-list p-3 py-5 rounded @if (session('point_claim_value') == $val->value) active text-white @endif">
                                    <ul>
                                        <li>
                                            <h3 style="color: inherit;font-size: 1.3rem">
                                                {{ $val->value }} {{ __('general.SR') }} <span style="color: inherit;font-size: .9rem;">{{ __('general.on') }}</span>
                                            </h3>
                                        </li>
                                        <li><h3 style="color: inherit;font-size: 1.3rem;">
                                            {{ $val->for }} {{ __('general.Points') }}
                                        </h3></li>
                                    </ul>
                                    {{-- <h4 class="d-inline">
                                        <span class="text-warning">{{ $val->value }}</span> {{ __('general.SR') }}
                                    </h4> <span class="text-sm">{{ __('general.on') }}</span> <br>
                                    <h3>
                                        <span class="text-primary">{{ $val->for }}</span> {{ __('general.Points') }}
                                    </h3> --}}
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="row my-5">
                <div class="col-10">
                    <div class="card border-0 bg-transparent">
                        <div class="card-header bg-transparent border-0">
                            <h3 class="card-title">
                                {{ __('general.loyality_earned') }}
                            </h3>
                        </div>
                        <div class="card-body bg-transparent">
                            @foreach ($history as $h)
                                <div class="card-body my-2 bg-white rounded">
                                    <div class="row">
                                        <div class="col-8 p-4">
                                            <h5 class="card-title">
                                                <a href="{{route('order.details', [$h->order_id])}}">{{ __('general.ORDER') }}:&nbsp;
                                                {{ $h->order_id }}</a>
                                            </h5>
                                            <p class="card-text">
                                                <i class="fas fa-clock mx-1"></i>
                                                {{ optional($h->created_at)->format('d-M-Y h:i:sa') }}
                                            </p>
                                        </div>
                                        <div class="col-4 d-flex align-items-center justify-content-center">
                                            <h5
                                                class="@if ($h->points < 0) text-danger @else text-success @endif">
                                {{ $h->points }}
                                </h5>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        </div>
        </div>
        </div>
        </div>
    @endsection
    @section('scripts')
        <script>
            $(document).ready(function() {
                $('.col-12.col-sm-9.mt-4.position-relative').addClass('bg-grey');
                $('.rounded.shadow-sm.p-4.bg-white').removeClass('bg-white');

                $('.show-modal').click(function() {
                    $('.alert-cart').fadeIn();

                    setTimeout(() => {
                        $('.alert-cart').fadeOut();
                    }, 3000);
                });

                $('.show-amount').click(function() {
                    $('.alert-amount').fadeIn();

                    setTimeout(() => {
                        $('.alert-amount').fadeOut();
                    }, 3000);
                });

                
            });
        </script>
    @endsection
