<!DOCTYPE html>
<html class="fontawesome-i2svg-active fontawesome-i2svg-complete" @if (app()->getLocale() == 'ar') dir="rtl" @endif>

@include('layouts.website.head')

@yield('pageName')

<!-- Loader-->
<div id="page-preloader"><span class="spinner border-t_second_b border-t_prim_a"></span></div>
<!-- Loader end-->

<div class="page-wrapper">

    @include('layouts.website.header')

    @yield('content')


    <div id="scrollup">
        <button id="scroll-top" class="scroll-to-top"><i class="las la-arrow-up"></i></button>
    </div>
    @include('layouts.website.footer')

</div>
@auth()
    <div class="modal fade" id="service-modal" tabindex="-1" role="dialog" aria-labelledby="service"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="add-address">{{ __('general.Service Type') }}</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row w-100 m-0">
                        <div class="col-md-6 m-auto">

                            <a id="address-mod" data-toggle="modal" data-target="#address-modal" href="#"
                                class="w-100 text-center h-100 default-btn bg-danger rounded shadow-sm p-2">
                                <h1 class="text-white">
                                    {{ __('general.Delivery') }}</h1>
                                <span></span>
                            </a>
                        </div>
                        <div class="col-md-12 text-center mt-3 mb-3"> {{ __('general.OR') }} </div>
                        <div class="col-md-6 m-auto">
                        
                            <a href="{{ route('takeaway.page') }}"
                                class="w-100 text-center h-100 default-btn bg-success rounded p-2 shadow-sm">
                                <h1 class="text-white" style="font-size:36px">{{ __('general.Take away') }}</h1>
                                <span></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="address-modal" tabindex="-1" role="dialog" aria-labelledby="address" aria-hidden="true">
        <div class="modal-dialog"
            style="@if (isset($addresses)) overflow-y: initial; !important @else height: 100px; @endif"
            role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="add-address">{{ __('general.Delivery Addresses') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="max-height: 500px;overflow-y: auto;">

                    <div class="row w-100 m-0 text-center">
                        @php
                            $request = new \Illuminate\Http\Request();
                            $return = app(\App\Http\Controllers\Api\AddressesController::class)
                                ->index($request)
                                ->getOriginalContent();
                            $addresses = $return['data'];
                        @endphp
                        @if (isset($addresses))
                            @foreach ($addresses as $address)
                                <div class="col-md-12 ">
                                    <div class="bg-white card addresses-item mb-4 shadow">
                                        <a href="{{ route('takeaway.branch', [$address->id, 'delivery']) }}"
                                            style="color:#222222">
                                            <div class="gold-members p-4">
                                                <div class="media">
                                                    <div class="mr-3"><i class="icofont-ui-home icofont-3x"></i>
                                                    </div>
                                                    @if (isset($errorarray))
                                                        @if (array_key_exists('message', $errorarray))
                                                            <span
                                                                class="d-block text-danger mb-2 font-weight-bold">{{ $errorarray['message'] }}</span>
                                                        @endif
                                                    @endif

                                                    <div class="media-body">
                                                        <h6 class="mb-1 text-secondary">

                                                            {{ $address->name }}
                                                            ,
                                                            {{ app()->getLocale() == 'ar' ? $address->city->name_ar : $address->city->name_en }}
                                                            ,
                                                            {{ app()->getLocale() == 'ar' ? $address->area->name_ar : $address->area->name_en }}
                                                        </h6>
                                                        <p class="text-black">
                                                            {{ $address->street }}
                                                            , {{ __('general.BuildNo') }}:
                                                            {{ $address->building_number }}
                                                            , {{ __('general.FloorNo') }}: {{ $address->floor_number }}
                                                            , {{ __('general.Landmark') }}: {{ $address->landmark }}
                                                        </p>
                                                    </div>

                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                                   <div class="text-center w-100">

                                @if($addresses->count() <= 0)
                                    <div class="col-md-12 text-danger text-center">
                                        {{__('general.no_address')}}

                                    </div>
                                @endif
                                <div class="text-center">
                                    <a href="{{route('profile.address')}}" type="button" class="btn btn-primary btn-floating"
                                       style="margin: 20px">
                                        {{__('general.New Address')}} <i class="fas fa-map-marked-alt"></i>
                                    </a>
                                    <a href="{{route('profile.map')}}" type="button" class="btn btn-primary btn-floating"
                                       style="margin: 20px">
                                        {{__('general.use map')}} <i class="fas fa-map-marked-alt"></i>
                                    </a>
                                </div>
                            </div>
                        @endif
                    </div>


                </div>
            </div>
        </div>
    </div>
@endauth

@include('layouts.website.script')
@yield('scripts')

<script>

    @if (session('status') )
    $('#service-modal').modal('toggle');
    {{session()->forget('status')}}
    @endif
    @auth
    $('.cart').click(function (e) {
        @if (session('status') || !session()->has('branch_id'))
        $('#service-modal').modal('toggle');
        return false;
        @endif
        $(this).removeAttr('data-target');
        $(this).removeAttr('data-toggle');
        $(this).trigger('click');

    });
    @endauth
    $('#address-mod').click(function (e) {
        $("#service-modal").modal("hide");
        $('#address-modal').modal('toggle');

    });

    @if(session()->has('err'))
    alert("{{__('general.'.session()->get('err'))}}");
    {{session()->forget('err')}}
    @endif


    $('#searchInput').keypress(function (e) {
        var key = e.which;
        if(key == 13)  // the enter key code
        {
            $('#formSearch').submit();
        }
    });
   @auth
   window.onload = function() {

        $.ajax({
            type: "GET",
            url: '{{route('get.cart-res')}}',
            success: function(response){

                $('.cart-count').text(response.data);
            }
        });
    }
   @endauth

</script>


</body>

</html>
