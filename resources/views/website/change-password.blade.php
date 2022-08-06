@extends('layouts.website.app')

@section('title') Change Password @endsection

@section('styles')
    <style>


    </style>
@endsection

@section('pageName')
    <body class="page-article dm-dark">
    @endsection

    @section('content')
        <main class="page-main">

            <div class="container padding-bottom-3x mb-2">
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-10">
                        @if(Session::has('success'))
                            <div class="row mr-2 ml-2">
                                <button type="text" class="btn btn-lg btn-block btn-outline-success mb-2"
                                        id="type-error">{{Session::get('success')}}
                                </button>
                            </div>
                        @endif
                        @if(Session::has('error'))
                            <div class="row mr-2 ml-2">
                                <button type="text" class="btn btn-lg btn-block btn-outline-danger mb-2"
                                        id="type-error">{{Session::get('error')}}
                                </button>
                            </div>
                        @endif
                    <!--Section: Block Content-->
                        @if(isset($email) && isset($token))
                            <section class="mb-5 text-center">

                                <p>{{__('general.Set a new password')}}</p>

                                <form action="{{route('password.get-reset')}}" method="POST" id="change_password">
                                    @csrf
                                    <input type="email" id="email" name="email" value="{{$email}}" hidden>
                                    <input type="text" id="token" name="token" value="{{$token}}" hidden>

                                    <div class="md-form md-outline">
                                        <label data-error="wrong" data-success="right" for="newPass">{{__('general.New Password')}}</label>
                                        <input type="password" id="password"
                                               name="password" class="form-control"
                                        placeholder="{{__('general.Enter Password')}}">
                                        @error('password')
                                        <div class="help-block err">{{ $message }}</div>
                                        @enderror

                                    </div>
                                    <label data-error="wrong" data-success="right" for="newPassConfirm">{{__('general.Confirm Password')}}</label>
                                    <div class="md-form md-outline">
                                        <input type="password" id="password_confirmation" name="password_confirmation"
                                               class="form-control"
                                               placeholder="{{__('general.Confirm Password')}}">

                                        @error('password_confirmation')
                                        <div class="help-block err">{{ $message }}</div>
                                        @enderror

                                    </div>

                                    <button type="submit" class="btn btn-primary mt-4">{{__('general.Change password')}}</button>


                                </form>

{{--                                <div class="d-flex justify-content-between align-items-center mb-2">--}}

{{--                                    <u><a href="https://mdbootstrap.com/docs/jquery/admin/auth/login/">Back to Log--}}
{{--                                            In</a></u>--}}

{{--                                    <u><a href="https://mdbootstrap.com/docs/jquery/admin/auth/register/">Register</a></u>--}}

{{--                                </div>--}}

                            </section>
                            <!--Section: Block Content-->
                        @endif
                    </div>

                </div>
            </div>
        </main>
    @endsection

    @section('scripts')
        <script>
            $(document).ready(function () {
                $('#change_password').validate({
                    errorClass: 'text-danger',

                    rules: {
                        password: {
                            required: true,
                         },
                        password_confirmation: {
                            required: true,
                             equalTo: "#password"
                        }
                    }, messages: {
                         password: {
                            required: "{{__('general.Password is required')}}",
                          },
                        password_confirmation:{
                            required: "{{__('general.Password is required')}}",
                            equalTo:"{{__('general.Password Don\'t match')}}"
                        }
                     },

                });
            });
        </script>
@endsection

