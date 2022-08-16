@extends('layouts.profile')

@section('title')
    {{ __('general.address') }}
@endsection

@section('styles')
@endsection

@section('pageName')

    <body class="page-article dm-light">
    @endsection

    @section('main')
        <div class="row">
            @if (isset($addresses))
                @foreach ($addresses as $address)
                    <div class="col-md-6">
                        <div class="bg-white card addresses-item mb-4 shadow">
                            <div class="gold-members p-4">
                                <div class="media">
                                    <div class="@if (app()->getLocale() == 'en') mr-3 @else ml-3 @endif">
                                        <i class="icofont-ui-home icofont-3x text-dark"></i>
                                    </div>
                                    @if (isset($errorarray))
                                        @if (array_key_exists('message', $errorarray))
                                            <span
                                                class="d-block text-danger mb-2 font-weight-bold">{{ $errorarray['message'] }}</span>
                                        @endif
                                    @endif

                                    <div class="media-body">
                                        <h6 class="mb-1 text-secondary">

                                            {{ $address->name }}</h6>
                                        <p class="text-black">
                                            {{ app()->getLocale() == 'ar' ? $address->city->name_ar : $address->name_en }}
                                            ,
                                            {{ app()->getLocale() == 'ar' ? $address->area->name_ar : $address->area->name_en }}
                                            , {{ $address->street }}
                                            ,{{ __('general.BuildNo') }}:
                                            {{ $address->building_number }}
                                            ,{{ __('general.FloorNo') }}:{{ $address->floor_number }}
                                            ,{{ __('general.Landmark') }}:{{ $address->landmark }}
                                        </p>
                                        <p class="mb-0 text-black font-weight-bold">
                                            <a class="text-primary mr-3  " data-toggle="modal"data-bs-toggle="modal"
                                                data-bs-target="#edit-address-modal{{ $address->id }}"
                                                data-target="#edit-address-modal{{ $address->id }}" href="#"><i
                                                    class="icofont-ui-edit  "></i>
                                                {{ __('general.EDIT') }}</a> <a class="text-danger" data-toggle="modal"
                                                data-target="#delete-address-modal{{ $address->id }}"
                                                href="{{ route('delete_address', $address->id) }}"><i
                                                    class="icofont-ui-delete"></i>
                                                {{ __('general.DELETE') }}</a>
                                        </p>
                                    </div>

                                    <div class="modal fade" id="edit-address-modal{{ $address->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="add-address" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title text-dark" id="add-address">
                                                        {{ __('general.Edit Delivery Address') }}
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('update_address', $address->id) }}"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="form-row">
                                                            <div class="form-group col-md-12">
                                                                <label for="inputPassword4"
                                                                    class="text-dark">{{ __('general.Delivery Area') }}</label>
                                                                <div class="input-group">
                                                                    <input type="text" class="form-control"
                                                                        placeholder="{{ __('general.Address Name') }}"
                                                                        name="name" value="{{ $address->name }}"
                                                                        required>
                                                                    <div class="input-group-append">
                                                                    </div>
                                                                </div>
                                                                @if (isset($errorarray))
                                                                    @if (array_key_exists('name', $errorarray))
                                                                        <span
                                                                            class="d-block text-danger mb-2 font-weight-bold">{{ $errorarray['name'] }}</span>
                                                                    @endif
                                                                @endif
                                                            </div>
                                                            <div class="form-group col-md-12 wrapCity">
                                                                <label for="inputPassword4" class="text-dark">
                                                                    {{ __('general.City') }}
                                                                </label>
                                                                <div class="input-group">
                                                                    <select
                                                                        class="form-control select2-cities city w-100 select2-cities"
                                                                        name="city_id" required>
                                                                        <option value="{{ $address->city_id }}">
                                                                            {{ $address->city['name_' . app()->getLocale()] }}
                                                                        </option>

                                                                    </select>
                                                                    <div class="input-group-append">

                                                                    </div>

                                                                </div>
                                                                @if (isset($errorarray))
                                                                    @if (array_key_exists('city_id', $errorarray))
                                                                        <span
                                                                            class="d-block text-danger mb-2 font-weight-bold">{{ $errorarray['city_id'] }}</span>
                                                                    @endif
                                                                @endif
                                                            </div>
                                                            <div class="form-group col-md-12 wrapArea">
                                                                <label for="inputPassword4" class="text-dark">
                                                                    {{ __('general.Area') }}
                                                                </label>
                                                                <div class="input-group">
                                                                    <select class="form-control area w-100" name="area_id"
                                                                        required>
                                                                        <option value="{{ $address->area->id }}">
                                                                            {{ app()->getLocale() == 'ar' ? $address->area->name_ar : $address->area->name_en }}
                                                                        </option>

                                                                    </select>
                                                                    <div class="input-group-append">
                                                                        <button class="btn " type="button">
                                                                        </button>
                                                                        @if (isset($errorarray))
                                                                            @if (array_key_exists('area_id', $errorarray))
                                                                                <span
                                                                                    class="d-block text-danger mb-2 font-weight-bold">{{ $errorarray['area_id'] }}</span>
                                                                            @endif
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-md-12">
                                                                <label for="inputPassword5"
                                                                    class="text-dark">{{ __('general.Street') }}
                                                                </label>
                                                                <div class="input-group">
                                                                    <input type="text" class="form-control"
                                                                        placeholder="{{ __('general.Delivery Area') }}"
                                                                        name="street" value="{{ $address->street }}">
                                                                    <div class="input-group-append">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-md-12">
                                                                <label for="inputPassword5" class="text-dark">
                                                                    {{ __('general.BuildNo') }}
                                                                </label>
                                                                <div class="input-group">
                                                                    <input type="text" class="form-control"
                                                                        placeholder="{{ __('general.BuildNo') }} "
                                                                        name="building_number"
                                                                        value="{{ $address->building_number }}">
                                                                    <div class="input-group-append">

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-md-12">
                                                                <label for="inputPassword5" class="text-dark">
                                                                    {{ __('general.FloorNo') }}
                                                                </label>
                                                                <div class="input-group">
                                                                    <input type="text" class="form-control"
                                                                        placeholder="{{ __('general.FloorNo') }}"
                                                                        name="floor_number"
                                                                        value="{{ $address->floor_number }}">
                                                                    <div class="input-group-append">

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-md-12">
                                                                <label for="inputPassword6" class="text-dark">
                                                                    {{ __('general.Landmark') }}
                                                                </label>
                                                                <div class="input-group">
                                                                    <input type="text" class="form-control"
                                                                        placeholder="{{ __('general.Landmark') }}"
                                                                        name="landmark" value="{{ $address->landmark }}">
                                                                    <div class="input-group-append">

                                                                    </div>
                                                                </div>
                                                            </div>


                                                        </div>
                                                        <div class="modal-footer d-flex">
                                                            <button type="button"
                                                                class="btn text-center btn-outline-primary"
                                                                data-dismiss="modal" style="width: 48%!important;">
                                                                {{ __('general.Cancel') }}
                                                            </button>
                                                            <button type="submit"
                                                                class="btn text-center btn-outline-primary"
                                                                style="width: 48%!important;">
                                                                {{ __('general.SUBMIT') }}
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>

                                            </div>
                                        </div>
                                    </div>


                                    <div class="modal fade" id="delete-address-modal{{ $address->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="delete-address" aria-hidden="true">
                                        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title text-dark" id="delete-address">
                                                        {{ __('general.DELETE') }}
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p class="mb-0 text-black">
                                                        {{ __('general.Are you sure you want to delete this Address') }}?
                                                    </p>
                                                </div>
                                                <div class="modal-footer" style="justify-content:center ">
                                                    <button type="button"
                                                        class="btn d-flex w-50 text-center justify-content-center btn-outline-primary"
                                                        data-dismiss="modal">
                                                        {{ __('general.Cancel') }}
                                                    </button>
                                                    <a href="{{ route('delete_address', $address->id) }}">
                                                        <button type="button"
                                                            class="btn d-flex w-100 text-center justify-content-center btn-primary">
                                                            {{ __('general.DELETE') }}
                                                        </button>
                                                    </a>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif

        </div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-0">
                    <div class="bg-white card addresses-item mb-4 shadow">
                        <div class="gold-members p-4">
                            <div class="media">

                                <div class="media-body ">

                                    <p class="mb-0 text-black font-weight-bold">
                                        <button data-toggle="modal" data-target="#add-address-modal " href="#"
                                            type="button" class="btn btn-primary btn-floating">
                                            <i class="fas fa-plus"></i>
                                        </button>

                                    </p>
                                </div>

                                <div class="modal fade" id="add-address-modal" tabindex="-1" role="dialog"
                                    aria-labelledby="add-address" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title text-dark" id="add-address">
                                                    {{ __('general.Add Delivery Address') }}
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="post" action="{{ route('new.address') }}"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="form-row">
                                                        <div class="form-group col-md-12">
                                                            <label for="inputPassword4"
                                                                class="text-dark">{{ __('general.Delivery Area') }}</label>
                                                            <div class="input-group">
                                                                <input type="text" class="form-control"
                                                                    placeholder="{{ __('general.Address Name') }}"
                                                                    name="name" value="" required>
                                                                <div class="input-group-append">
                                                                </div>
                                                            </div>
                                                            @if (isset($errorarray))
                                                                @if (array_key_exists('name', $errorarray))
                                                                    <span
                                                                        class="d-block text-danger mb-2 font-weight-bold">{{ $errorarray['name'] }}</span>
                                                                @endif
                                                            @endif
                                                        </div>
                                                        <div class="form-group col-md-12 wrapCity">
                                                            <label for="inputPassword4" class="text-dark">
                                                                {{ __('general.City') }}
                                                            </label>
                                                            <div class="input-group">
                                                                <select
                                                                    class="form-control select2-cities city w-100 select2-cities"
                                                                    name="city_id" required>
                                                                    <option value="">
                                                                        {{ __('general.Select City') }}
                                                                    </option>


                                                                </select>
                                                                <div class="input-group-append">

                                                                </div>

                                                            </div>
                                                            @if (isset($errorarray))
                                                                @if (array_key_exists('city_id', $errorarray))
                                                                    <span
                                                                        class="d-block text-danger mb-2 font-weight-bold">{{ $errorarray['city_id'] }}</span>
                                                                @endif
                                                            @endif
                                                        </div>
                                                        <div class="form-group col-md-12 wrapArea">
                                                            <label for="inputPassword4" class="text-dark">
                                                                {{ __('general.Area') }}
                                                            </label>
                                                            <div class="input-group">
                                                                <select class="form-control area w-100" name="area_id"
                                                                    required>
                                                                    <option value="">

                                                                    </option>

                                                                </select>
                                                                <div class="input-group-append">
                                                                    <button class="btn " type="button">
                                                                    </button>
                                                                    @if (isset($errorarray))
                                                                        @if (array_key_exists('area_id', $errorarray))
                                                                            <span
                                                                                class="d-block text-danger mb-2 font-weight-bold">{{ $errorarray['area_id'] }}</span>
                                                                        @endif
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-12">
                                                            <label for="inputPassword5"
                                                                class="text-dark">{{ __('general.Street') }}
                                                            </label>
                                                            <div class="input-group">
                                                                <input type="text" class="form-control"
                                                                    placeholder="{{ __('general.Delivery Area') }}"
                                                                    name="street" value="">
                                                                <div class="input-group-append">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-12">
                                                            <label for="inputPassword5" class="text-dark">
                                                                {{ __('general.BuildNo') }}
                                                            </label>
                                                            <div class="input-group">
                                                                <input type="text" class="form-control"
                                                                    placeholder="{{ __('general.BuildNo') }} "
                                                                    name="building_number" value="">
                                                                <div class="input-group-append">

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-12">
                                                            <label for="inputPassword5" class="text-dark">
                                                                {{ __('general.FloorNo') }}
                                                            </label>
                                                            <div class="input-group">
                                                                <input type="text" class="form-control"
                                                                    placeholder="{{ __('general.FloorNo') }}"
                                                                    name="floor_number" value="">
                                                                <div class="input-group-append">

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-12">
                                                            <label for="inputPassword6" class="text-dark">
                                                                {{ __('general.Landmark') }}
                                                            </label>
                                                            <div class="input-group">
                                                                <input type="text" class="form-control"
                                                                    placeholder="{{ __('general.Landmark') }}"
                                                                    name="landmark" value="">
                                                                <div class="input-group-append">

                                                                </div>
                                                            </div>
                                                        </div>


                                                    </div>
                                                    <div class="modal-footer d-flex">
                                                        <button type="button" class="btn text-center btn-outline-primary"
                                                            data-dismiss="modal" style="width: 48%!important;">
                                                            {{ __('general.Cancel') }}
                                                        </button>
                                                        <button type="submit" class="btn text-center btn-outline-primary"
                                                            style="width: 48%!important;">
                                                            {{ __('general.SUBMIT') }}
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
