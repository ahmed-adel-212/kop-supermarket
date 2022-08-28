@extends('layouts.website.app')

@section('title')
    {{ __('general.cart') }}
@endsection

@section('styles')
    {{-- <link rel="stylesheet" href="{{asset('website2-assets/css/style2.css')}}"> --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
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

        .list-group-item {
            background-color: transparent;
            padding: 2px;
        }

        .small * {
            font-size: 14px;
        }
    </style>
@endsection

@section('pageName')

    <body class="page-article dm-light">
    @endsection

    @section('content')
        <section class="page-header" style="background-image: url({{ asset('website2-assets/img/page-header-theme.jpg') }})">
            <div class="bg-shape grey"></div>
            <div class="container">
                <div class="page-header-content">
                    <h4>
                        {{ __('general.cart') }}
                    </h4>
                    <h2>
                        {{ __('general.my_cart') }}
                    </h2>
                </div>
            </div>
        </section>
        <!--/.page-header-->

        <section class="cart-section bg-grey padding">
            <div class="container">
                <div class="row cart-header">
                    <div class="col-lg-6">{{ __('general.Name') }}</div>
                    <div class="col-lg-3">{{ __('general.Quantity') }}</div>
                    <div class="col-lg-1">{{ __('menu.Price') }}</div>
                    <div class="col-lg-1">{{ __('general.Total') }}</div>
                    <div class="col-lg-1"></div>
                </div>
                @if ($carts->count())
                    @foreach ($carts as $cart)
                        <div class="row cart-body pb-30 cart2{{ $cart->id }}">
                            <div class="col-lg-6">
                                <div class="cart-item">
                                    <img src="{{ asset($cart->item->image) }}" alt="food">
                                    <div class="cart-content">
                                        <h3><a
                                                href="{{ url('item/' . $cart->item->category_id . '/' . $cart->item->id) }}">{{ app()->getLocale() == 'ar' ? $cart->item->name_ar : $cart->item->name_en }}</a>
                                        </h3>
                                        {{-- <p> {{ app()->getLocale() == 'ar' ? $cart->item->description_ar : $cart->item->description_en }}
                                        </p> --}}
                                        <div style="font-size: 10px" class="small">
                                            @if (isset($cart['dough_type_' . app()->getLocale()]))
                                            <p>
                                                {{ __('general.Dough Type') }}:
                                                <b>{{ $cart['dough_type_' . app()->getLocale()] }}</b>
                                            </p>
                                            @endif
                                            @if (count($cart->extras_objects))
                                                <p>
                                                    <b class="text-primary">{{ __('general.Extra') }}:</b>
                                                <ul class="list-group list-group-horizontal">
                                                    @foreach ($cart->extras_objects as $extra)
                                                        <li class="list-group-item px-1">
                                                            {{ $extra['name_' . app()->getLocale()] }}
                                                        </li>
                                                    @endforeach
                                                </ul>
                                                </p>
                                            @endif
                                            @if (count($cart->withouts_objects))
                                                <p>
                                                    <b class="text-danger">{{ __('general.Without') }}:</b>
                                                <ol class="list-group list-group-horizontal list-group-numbered">
                                                    @foreach ($cart->withouts_objects as $without)
                                                        <li class='list-group-item px-1'>
                                                            {{ $without['name_' . app()->getLocale()] }}
                                                        </li>
                                                    @endforeach

                                                </ol>
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4 col-lg-3">
                                <div class="form-group stepper-type-2 quantity-up-{{ $cart->id }}">
                                    <input style="width: 25%;" type="number"
                                        @if ($cart->offer_id && !$cart->dough_type_ar) disabled @endif data-zeros="true"
                                        value="{{ $cart->quantity }}" min="1" max="20" readonl
                                        data-id="{{ $cart->id }}" data-price="{{ $cart->price }}"
                                        data-prev="{{ $cart->quantity }}"
                                        data-url="{{ route('item.page', [$cart->item->category_id, $cart->item]) }}"
                                        class="form-control text-bold quantity_ch quantity_change{{ $cart->id }}">
                                </div>
                            </div>
                            <div class="col-3 col-lg-1">
                                <div class="cart-item" style="flex-direction: column;">
                                    @if ($cart->offer_id)
                                        <p class="text-danger">
                                            @isset($cart->extras_objects)
                                                <del>{{ $cart->item->price + collect($cart->extras_objects)->sum('price') }}
                                                    {{ __('general.SR') }}</del>
                                            @else
                                                <del>{{ $cart->item->price }} {{ __('general.SR') }}</del>
                                            @endisset

                                        </p>
                                    @endif
                                    <p>

                                        {{ $cart->price }}
                                        {{ __('general.SR') }}
                                    </p>
                                </div>
                            </div>
                            <div class="col-3 col-lg-1">
                                <div class="cart-item">
                                    <p> <span id="total{{ $cart->id }}">{{ $cart->price * $cart->quantity }}</span>
                                        {{ __('general.SR') }}</p>
                                </div>
                            </div>
                            <div class="col-2 col-lg-1 ">
                                <div @auth
                                        @if (!session()->has('branch_id')) data-toggle="modal" data-target="#service-modal" @endif
                                    @endauth class="cart-item delete_cart cart" data-id="{{ $cart->id }}">
                                    <a class="remove" href="#"><i class="las la-times"></i></a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
                <form action="{{ route('checkout') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6 offset-lg-6">
                            <ul class="cart-total mt-30">
                                <li>
                                    {{ __('general.Sub Total') }}: </b> <span
                                        id="subtotal"style="font-size: smaller;">{{ $arr_check['subtotal'] - round($arr_check['subtotal'] - $arr_check['subtotal'] / 1.15, 2) }}
                                        {{ __('general.SR') }}</span>
                                    <input id="subtotalinput" hidden
                                        name="subtotal"value="{{ $arr_check['subtotal'] - round($arr_check['subtotal'] - $arr_check['subtotal'] / 1.15, 2) }}" />
                                </li>
                                <li><b class="inset-right-5 text-gray-light">{{ __('general.Taxes') }}
                                        : </b>
                                    <span id="taxes"
                                        style="font-size: smaller;">{{ round($arr_check['subtotal'] - $arr_check['subtotal'] / 1.15, 2) }}
                                        {{ __('general.SR') }}</span>
                                    <input id="taxesinput" hidden name="taxes"
                                        value="{{ $arr_check['subtotal'] - $arr_check['subtotal'] / 1.15 }}" />
                                </li>
                                <li><b class="inset-right-5 text-gray-light">{{ __('general.Delivery Fees') }}
                                        : </b> <span id="delivery_fees"
                                        style="font-size: smaller;">{{ $arr_check['delivery_fees'] }}
                                        {{ __('general.SR') }}</span>
                                    <input id="delivery_feesnput" hidden name="delivery_fees"
                                        value="{{ $arr_check['delivery_fees'] }}" />
                                </li>
                                @if (isset($arr_check['points']))
                                    <li><b class="inset-right-5 text-gray-light">{{ __('general.Loyality Discount') }}
                                            : </b> <span> -
                                            <span id="points"
                                                style="font-size: smaller;">{{ round($arr_check['points'], 2) }}
                                                {{ __('general.SR') }}</span></span>
                                        <input id="pointsinput" hidden name="points_paid"
                                            value="{{ $arr_check['points'] }}" />
                                        <input id="pointsValue" hidden name="points_value"
                                            value="{{ $arr_check['points_value'] }}" />
                                    </li>
                                @endif
                                <li><b class="inset-right-5 text-gray-light">{{ __('general.Total') }}
                                        : </b> <span style="font-size: smaller;" id="total">{{ $arr_check['total'] }}
                                        {{ __('general.SR') }}</span>
                                    <input id="totalinput" hidden name="total" value="{{ $arr_check['total'] }}" />
                                </li>

                                <li>
                                    <p>{{ __('general.continue') }}</p><button type="submit" class="default-btn"
                                        style="border-radius: 5px;">
                                        {{ __('general.Checkout') }}<span></span></button>
                                </li>
                            </ul>
                        </div>
                    </div>
            </div>
        </section>
        <!--/.cart-section-->

        <!-- Modal -->
        <div class="modal fade" id="incressItemQuantity" tabindex="-1" aria-labelledby="incressItemQuantityLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="incressItemQuantityLabel">
                            {{ __('general.confirm') }}
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        {{ __('general.add_item_confirm') }}
                    </div>
                    <div class="modal-footer">
                        <a class="btn default-btn rounded shadow-sm bg-danger item-link">
                            {{ __('general.open_item') }}
                            <span></span>
                        </a>
                        <button type="button" class="btn default-btn rounded shadow-sm bg-primary confirm">
                            {{ __('general.confirm_txt') }}
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>


    @endsection

    @section('scripts')
        {{-- <script src="{{asset('website2-assets/js/core.min.js')}}"></script>
    <script src="{{asset('website2-assets/js/script.js')}}"></script> --}}
        <script>
            $(document).ready(function() {
                const quantityConfirm = new bootstrap.Modal('#incressItemQuantity', {
                    keyboard: false,
                    backdrop: 'static',
                });
                $(document).on('click', '.delete_cart', function(e) {
                    e.preventDefault();
                    var id = $(this).attr('data-id');

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: 'post',
                        url: '{{ route('delete.cart') }}',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            'cart_id': id,
                        },
                        success: function(data) {
                            $.each(data.carts, function(index, deletedCart) {
                                $(`.cart1${deletedCart.id}`).hide();
                                $(`.cart2${deletedCart.id}`).hide();
                                $(`.cart3${deletedCart.id}`).hide();
                            });
                            $('.cart-count').text((parseInt($('.cart-count').first().text(), 10) -
                                1));
                            // $('#itemcount').text((parseInt($('#itemcount').text())) - data.carts.length);


                            $('#subtotal').text(data.arr_check.taxes);
                            $('#taxes').text((data.arr_check.taxes - (data.arr_check.taxes /
                                1.15)).toFixed(2));
                            $('#total').text(data.arr_check.total);
                            $('#delivery_fees').text(data.arr_check.delivery_fees);
                            @if (isset($arr_check['points']))
                                $('#points').text(data.arr_check.points);
                            @endif
                            // if(((parseInt($('#itemcount').text())) - data.carts.length) == -1){
                            //     window.location.reload();
                            // }
                        },
                        error: function(reject) {
                            console.log(reject);
                        }
                    });
                });

                $(document).on('change', '.quantity_ch', function(ev) {
                    ev.preventDefault();

                    var elem = $(this);
                    var quantity = $(this).val();
                    var id = $(this).attr('data-id');
                    var price = $(this).attr('data-price');
                    var href = $(this).attr('data-url');

                    $('.confirm').attr('data-id', id).attr('data-price', price).attr('quantity', parseInt(
                        quantity));
                    $('.item-link').attr('href', href);

                    var val = parseInt(elem.val(), 10);
                    var prev = parseInt(elem.attr('data-prev'), 10);
                    if (val <= 0) {
                        return;
                    }

                    // console.log(val, prev);

                    if (val === prev - 1) {
                        // console.log(quantity);
                        elem.attr('data-prev', val);
                        elem.val(val);
                        $('.confirm').click();
                        return;
                    }




                    quantityConfirm.show();
                    elem.val(parseInt(elem.val() - 1));

                    // add these attrs to confirm button
                    // $('.confirm').attr('quantity', parseInt(
                    //     quantity));
                });

                $('.confirm').click(function() {
                    var quantity = $(this).attr('quantity');
                    var id = $(this).attr('data-id');
                    var price = $(this).attr('data-price');
                    $(".cart2" + id + ' .quantity_ch').attr('readonly', true);

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: 'post',
                        url: '{{ route('update.quantity') }}',
                        data: {
                            'cart_id': id,
                            'quantity': quantity,
                        },
                        success: function(data) {
                            console.log(data);
                            $('#subtotal').text((data.taxes).toFixed(2) +
                                ' {{ __('general.SR') }}');
                            $('#subtotalinput').val(data.taxes);

                            $('#taxes').text((data.subtotal - (data.subtotal / 1.15)).toFixed(2) +
                                ' {{ __('general.SR') }}');
                            $('#taxesinput').val(data.subtotal - (data.subtotal / 1.15));

                            $('#total').text((data.total).toFixed(2) + ' {{ __('general.SR') }}');
                            $('#totalinput').val(data.total);

                            $('#delivery_fees').text((data.delivery_fees).toFixed(2) +
                                ' {{ __('general.SR') }}');
                            $('#delivery_feesinput').val(data.delivery_fees);

                            $(".cart2" + id + ' .quantity_ch').val(quantity);
                            $(".cart2" + id + ' .quantity_ch').attr('data-prev', quantity);
                            // $('.quantity_ch').parent().parent().parent().next().next().find('.price-item')
                            //     .first().html('{{ __('home.Price') }}: ' + (quantity * price)
                            //         .toFixed(2) + ' {{ __('general.SR') }}');
                            $('#total' + id).text((quantity * price).toFixed(2));

                            @if (isset($arr_check['points']))
                                $('#points').text(data.points);
                                $('#pointsnput').val(data.points);
                            @endif

                            quantityConfirm.hide();
                            $(".cart2" + id + ' .quantity_ch').attr('readonly', false);

                        },
                        error: function(reject) {
                            quantityConfirm.hide();
                            $(".cart2" + id + ' .quantity_ch').attr('readonly', false);
                            // $(".cart2" + id + ' .quantity_ch').data('prev', quantity);
                            console.log(reject);
                        }
                    });
                });
            });
        </script>
    @endsection
    @push('scripts')
    @endpush
