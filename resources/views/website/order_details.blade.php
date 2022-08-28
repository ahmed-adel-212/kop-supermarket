@extends('layouts.website.app')

@section('title')
    {{ __('general.order_details') }}
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('website2-assets/css/style2.css') }}">
    <style>
        .page-header__top {
            margin: 20px 0px 30px !important;
        }

        a:hover,
        a:focus {
            color: #ff0000;
            text-decoration: none;
        }

        .stepper-type-2 .stepper-arrow.up {
            top: 0;
            margin-top: -5px;
        }

        .stepper-type-2 .stepper-arrow.down {
            top: 100%;
            margin-top: -20px;
            font-size: 20px;
        }

        td {
            border: 0 !important;
        }
    </style>
@endsection

@section('pageName')

    <body class="page-article dm-light">
    @endsection

    @section('content')
        <main class="page-main">
            <section class="page-header"
                style="background-image: url({{ asset('website-assets/img/pages/home/careers.jpg') }})">
                <div class="bg-shape grey"></div>
                <div class="container">
                    <div class="page-header-content">
                        <h4 class="text-white">
                            {{ __('general.My Orders') }}
                        </h4>
                        <h2 class="text-warning">
                            {!! __('general.find_your_orders') !!}
                        </h2>
                    </div>
                </div>
            </section>
            <!--/.page-header-->

            <section class="cart-section bg-grey padding">
                <div class="container">
                    <div class="row cart-header">
                        <div class="col-lg-6">
                            {{ __('general.Name') }}
                        </div>
                        <div class="col-lg-3">
                            {{ __('general.Quantity') }}
                        </div>
                        <div class="col-lg-1">
                            {{ __('menu.Calories') }}
                        </div>
                        <div class="col-lg-1">
                            {{ __('menu.Price') }}
                        </div>
                        <div class="col-lg-1"></div>
                    </div>
                    @foreach ($items as $item)
                        <div class="row cart-body pb-30 cart2{{ $item->id }}">
                            <div class="col-lg-6">
                                <div class="cart-item">
                                    <img src="{{ asset($item->image) }}" alt="food">
                                    <div class="cart-content">
                                        <h3><a
                                                href="{{ url('item/' . $item->category_id . '/' . $item->id) }}">{{ app()->getLocale() == 'ar' ? $item->name_ar : $item->name_en }}</a>
                                        </h3>
                                        <p> {{ app()->getLocale() == 'ar' ? $item->description_ar : $item->description_en }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4 col-lg-3">
                                <div class="form-group stepper-type-2 quantity-up-{{ $item->id }}">
                                    <input style="width: 25%;" type="number"
                                        class="form-control text-bold quantity_ch quantity_change{{ $item->id }}"
                                        value="{{$item->pivot->quantity}}" readonly>
                                </div>
                            </div>
                            <div class="col-3 col-lg-1">
                                <div class="cart-item">
                                    <p>{{ $item->calories }}
                                    </p>
                                </div>
                            </div>
                            <div class="col-3 col-lg-1">
                                <div class="cart-item">
                                    <p>{{ ($order->offer_id ? $order->offer_price : $item->price) * 1 }}
                                        {{ __('general.SR') }}</p>
                                </div>
                            </div>
                            <div class="col-2 col-lg-1 ">
                                <div class="cart-item delete_cart" data-id="">
                                    {{-- <a class="remove" href="#"><i class="las la-times"></i></a> --}}
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <form action="" method="get">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="card-header mt-30">
                                    <h5 class='card-title'>
                                        {{__('general.Description')}}
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div class="card-text">
                                        {{$order->description_box}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 ">
                                <ul class="cart-total mt-30">
                                    <li>
                                        {{ __('general.Sub Total') }}: </b> <span
                                            id="subtotal"style="font-size: smaller;">{{ $order['subtotal'] }}
                                            {{ __('general.SR') }}</span>
                                        <input id="subtotalinput" hidden name="subtotal"value="{{ $order['subtotal'] }}" />
                                    </li>
                                    <li><b class="inset-right-5 text-gray-light">{{ __('general.Taxes') }}
                                            : </b>
                                        <span id="taxes" style="font-size: smaller;">{{ $order['taxes'] }}
                                            {{ __('general.SR') }}</span>
                                        <input id="taxesinput" hidden name="taxes" value="{{ $order['taxes'] }}" />
                                    </li>
                                    <li><b class="inset-right-5 text-gray-light">{{ __('general.Delivery Fees') }}
                                            : </b> <span id="delivery_fees"
                                            style="font-size: smaller;">{{ $order['delivery_fees'] }}
                                            {{ __('general.SR') }}</span>
                                        <input id="delivery_feesnput" hidden name="delivery_fees"
                                            value="{{ $order['delivery_fees'] }}" />
                                    </li>
                                    @if (isset($order['points']))
                                        <li><b class="inset-right-5 text-gray-light">{{ __('general.Loyality Discount') }}
                                                : </b> <span id="points" style="font-size: smaller;"> -
                                                {{ round($order['points_paid'], 2) }} {{ __('general.SR') }}</span>
                                            <input id="pointsinput" hidden name="points_paid"
                                                value="{{ $order['points_paid'] }}" />

                                        </li>
                                    @endif
                                    <li><b class="inset-right-5 text-gray-light">{{ __('general.Total') }}
                                            : </b> <span style="font-size: smaller;" id="total">{{ $order['total'] }}
                                            {{ __('general.SR') }}</span>
                                        <input id="totalinput" hidden name="total" value="{{ $order['total'] }}" />
                                    </li>
                                    @if (strpos(request()->getUri(), 'reorder') > -1)
                                        <li>
                                            <p>{{ __('general.continue') }}</p>
                                            {{-- <button type="submit" class="default-btn"
                                                style="border-radius: 5px;">
                                                {{ __('general.Checkout') }}<span></span>
                                            </button> --}}
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn default-btn rounded checkout-btn">
                                                <i class="fas fa-spinner fa-spin" style="display: none"></i>
                                                {{ __('general.Checkout') }}
                                                <span></span>
                                            </button>
                                        </li>
                                    @endif
                                    <!-- Modal -->
                                    <div class="modal fade" id="reorder-error" tabindex="-1"
                                        aria-labelledby="reorder-errorLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content"
                                                style="color: #842029;
                                            background-color: #f8d7da;
                                            border-color: #f5c2c7;">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="reorder-errorLabel">
                                                        {{ __('general.reorder_err') }}
                                                    </h5>
                                                    <button type="button" class="btn-close" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <span id="message"></span>
                                                </div>
                                                <div class="modal-footer">
                                                    <a href="{{ route('menu.page') }}" class="btn default-btn rounded">
                                                        {{ __('menu.Menu') }}
                                                        <span></span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </ul>
                            </div>
                        </div>
                    </form>
                </div>
                </div>
            </section>
            <!--/.cart-section-->
        </main>
    @endsection

    @section('scripts')
        {{-- <script src="{{ asset('website2-assets/js/core.min.js') }}"></script>
        <script src="{{ asset('website2-assets/js/script.js') }}"></script> --}}
        <script>
            $(document).ready(function() {
                let busy = false;
                const reorderErrorModal = new bootstrap.Modal('#reorder-error', {
                    backdrop: 'static',
                    keyboard: false,
                });
                $('.checkout-btn').click(function() {
                    if (busy) return false;
                    busy = true;

                    $('.fa-spin').css('display', 'inline-block');

                    $.ajax({
                        url: "{{ route('re-order-check', $order->id) }}",
                        method: 'post',
                        headers: {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}",
                        },
                        data: {
                            points_paid: {{ $order['points'] === null ? 0 : $order['points'] }},
                        },
                        success: function(res) {
                            if (!res.validation) {
                                // show alert with message
                                $('span#message').text(res.message);
                                // $('#confirm-modal').addClass('');
                                reorderErrorModal.show();
                                // hide reorder button
                                $('.checkout-btn').css('display', 'none');
                                return;
                            }

                            window.location.href = "{{route('get.cart')}}";
                        },
                        error: function(err) {
                            // console.log(err);
                        },
                        complete: function() {
                            busy = false;
                            $('.fa-spin').css('display', 'none');
                        }
                    });
                })
            });
        </script>
    @endsection
