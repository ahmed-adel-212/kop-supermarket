@extends('layouts.profile')

@section('title')
    {{ __('general.Loyalty Program') }}
@endsection

@section('styles')
    <style>
        .point-value {
            transition: all ease-in .3s;
            cursor: pointer;
        }

        .point-value:hover {
            box-shadow: 0 0 5px #000;
        }
    </style>
@endsection

@section('pageName')

    <body class="page-article dm-light">
    @endsection

    @section('main')
        <div class="tab-pane fade show active" id="loyality" role="tabpanel" aria-labelledby="loyality-tab">
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
                    <div class='row'>
                        @foreach ($pointValues as $val)
                            <a href="{{ ($cartHasItems && ($points['user_points'] >= $val->for)) ? route('loyalty.set', [$val->value, $val->for]) : 'javascript:void(0)' }}"
                                class="col-4 point-value rounded @unless($cartHasItems) show-modal @endif @if($points['user_points'] < $val->for) show-amount @endif @if(session('point_claim_value') == $val->value) active bg-info @endif">
                                <div class="card-body">
                                    <h4 class="d-inline">
                                        <span class="text-warning">{{ $val->value }}</span> {{ __('general.SR') }}
                                    </h4> <span class="text-sm">{{ __('general.on') }}</span> <br>
                                    <h3>
                                        <span class="text-primary">{{ $val->for }}</span> {{ __('general.Points') }}
                                    </h3>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="row my-5">
                <div class="col-10">
                    <div class="card border-0">
                        <div class="card-header default-bg">
                            <h5 class="card-title text-white">
                                {{ __('general.loyality_earned') }}
                            </h5>
                        </div>
                        <div class="card-body">
                            @foreach ($history as $h)
                                <div class="card-body">
                                    <div class="row border-bottom pb-1">
                                        <div class="col-8">
                                            <h5 class="card-title">
                                                {{ __('general.ORDER') }}:&nbsp;
                                                {{ $h->order_id }}
                                            </h5>
                                            <p class="card-text">
                                                <i class="fas fa-clock mx-1"></i>
                                                {{ optional($h->created_at)->format('d-M-Y h:i:sa') }}
                                            </p>
                                        </div>
                                        <div class="col-4 d-flex align-items-center justify-content-center">
                                            <h5
                                                class="@if ($points < 0) text-danger @else text-success @endif">
                                                {{ abs($h->points) }}
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
