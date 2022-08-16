@extends('layouts.profile')

@section('title')
    {{ __('general.Account') }}
@endsection

@section('styles')

@endsection

@section('pageName')

    <body class="page-article dm-light">
    @endsection

    @section('main')

    <div class="tab-pane fade show active" id="account" role="tabpanel"
    aria-labelledby="account-tab">
    <div class="card">
        <div class="card-header default-bg">
            <h4 class="card-title text-white">{{ __('general.Manage account') }}
            </h4>
        </div>
        <div class="card-body">

            <div id="edit_profile">
                <div>
                    @auth
                        <form method="post" action="{{ route('update.profile') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group has-validation mb-3">
                                <div class="form-floating">
                                    <input type="text"
                                        class="form-control @error('name') is-invalid @enderror"
                                        id="floating-name" placeholder="Name" name="name"
                                        value="{{ auth()->user()->name }}" required />
                                    <label for="floating-name">{{ __('general.Name') }}</label>
                                </div>
                                @error('name')
                                    <div class="help-block">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>


                            <div class="form-group has-validation mb-3">
                                <div class="form-floating">
                                    <input type="tel"
                                        class="form-control @error('phone') is-invalid @enderror"
                                        id="floating-phone" name="phone"
                                        value="{{ auth()->user()->first_phone }}"
                                        placeholder="{{ __('general.Phone') }}" required />
                                    <label
                                        for="floating-phone">{{ __('general.Mobile') }}</label>
                                </div>
                                @error('phone')
                                    <div class="help-block">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group has-validation mb-3">
                                <div class="form-floating">
                                    <input type="tel"
                                        class="form-control @error('second_phone') is-invalid @enderror"
                                        id="floating-phone-second" name="second_phone"
                                        value="{{ auth()->user()->second_phone }}"
                                        placeholder="{{ __('general.Phone') }}" />
                                    <label
                                        for="floating-phone-second">{{ __('general.Mobile') }}
                                        2</label>
                                </div>
                                @error('second_phone')
                                    <div class="help-block">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group has-validation mb-3">
                                <div class="form-floating">
                                    <input type="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        id="floating-email" name="email"
                                        value="{{ auth()->user()->email }}" required />
                                    <label
                                        for="floating-email">{{ __('general.Email') }}</label>
                                </div>
                                @error('email')
                                    <div class="help-block">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group has-validation mb-3">
                                <div class="form-floating">
                                    <input type="number"
                                        class="form-control @error('age') is-invalid @enderror"
                                        id="floating-age" name="age"
                                        value="{{ auth()->user()->age }}"
                                        placeholder="{{ __('general.Age') }}" required />
                                    <label for="floating-age">{{ __('general.Age') }}</label>
                                </div>
                                @error('age')
                                    <div class="help-block">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group has-validation mb-3">
                                <div class="">
                                    <label for="formFile" class="form-label">
                                        {{ __('general.profile_photo') }}
                                    </label>
                                    <input
                                        class="form-control @error('image') is-invalid @enderror"
                                        name="image" type="file" id="formFile">
                                </div>
                                @error('image')
                                    <div class="help-block">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="text-start">
                                <button type="submit" class="btn default-btn rounded">
                                    {{ __('general.Save Changes') }}
                                    <span></span>
                                </button>
                            </div>
                        </form>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</div>


    @endsection

    @section('scripts')
        <script src="{{ asset('website2-assets/vendor/select2/js/select2.min.js') }}" type="text/javascript"></script>

        <script src="{{ asset('website2-assets/js/custom.js') }}" type="text/javascript"></script>

        <script>
            let app_url = '{{ url('/') }}';

            $('.select2-cities').select({
                ajax: {
                    url: app_url + "/api/v1/cities/search/",
                    dataType: 'json',
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(city) {
                                return {
                                    id: city.id,
                                    text: city["name_" + "{{ app()->getLocale() }}"]
                                }
                            })
                        };
                    },
                    cache: true
                }
            });


            $('.city').change(function() {
                let app_url = '{{ url('/') }}';
                let city_id = $(this).val();
                let selectele = $(this);
                $.ajax({
                    type: 'get',
                    url: app_url + "/api/cities/" + city_id + "/areas",
                    data: {},
                    success: function(data) {
                        if (data) {
                            selectele.parent().parent().next().first().find('.area').html('');
                            selectele.parent().parent().next().first().find('.area').append(
                                '<option selected value="">{{ __('general.Choose Area') }}</option>');
                            $.each(data, function(index, area) {
                                selectele.parent().parent().next().first().find('.area').append(
                                    '<option value="' + area.id + '">' + area.name_ar +
                                    '</option>');
                            });
                        }
                    },
                    error: function(jqXhr, textStatus, errorMessage) {

                    }
                })

            });
        </script>
    @endsection
