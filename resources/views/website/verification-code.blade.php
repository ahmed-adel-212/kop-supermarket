@extends('layouts.website.app')

@section('title') Verification Account @endsection

@section('styles')
    <style>


        form {
            padding-top: 10px;
            font-size: 14px;
            margin-top: 30px;
        }

        .card-title {
            font-weight: 300;
        }

        .btn {
            font-size: 14px;
            margin-top: 20px;
        }

        .login-form {
            width: 320px;
            margin: 20px;
        }

        .sign-up {
            text-align: center;
            padding: 20px 0 0;
        }

        span {
            font-size: 14px;
        }
    </style>
@endsection

@section('pageName')
    <body class="page-article dm-dark">
    @endsection

    @section('content')
        <main class="page-main">
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
                 <div class="container padding-bottom-3x mb-2">
                    <div class="row justify-content-center">
                        <div class="col-lg-8 col-md-10">
                            <form class="card mt-4" id="verification"  method="get">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="email-for-pass">{{__('auth.Enter Your Verification Code')}}</label>
                                        <input class="form-control" type="email" id="email-for-pass"
                                               value="@if(isset($email)){{$email}}@else{{old('email')}}@endif" name="email" hidden>
                                        <input class="form-control" type="text" id="token-for-pass" value="{{old('token')}}" placeholder="- - - - -" name="token">
                                        <div class="help-block" style="display: none"></div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button class="btn btn-primary" id="save" type="submit" formaction="{{route('verifyCode.save')}}">{{__('general.Send')}}</button>
                                    <button class="btn btn-default font-weight-bold" style="color: #0f7ae5; @if(app()->getLocale() == 'ar') float:left; @else float:right; @endif" type="submit" formaction="{{route('verifyCode.resend')}}">{{__('auth.resend code')}}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
         </main>
@endsection

@section('scripts')
    <script>
        window.onload = function () {
            $('#verification').keypress(function (e) {
                var key = e.which;
                if(key == 13)  // the enter key code
                {
                    e.preventDefault();
                    return false;
                }
            });
            $('#save').click(function (e) {
                if($('#token-for-pass').val() == '{{auth()->user()->activation_token}}'){
                    $(this).submit();
                }
                else {
                    e.preventDefault();
                    $('.help-block').show();
                    $('.help-block').text('{{__('auth.verification code is wrong.')}}');
                    return false;
                }
            });

        };
    </script>
@endsection

