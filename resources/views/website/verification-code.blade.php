@extends('layouts.website.app')

@section('title') {{__('general.verification')}} @endsection

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
            <section class="page-header"
            {{-- style="background-image: url({{ asset('website-assets/img/pages/contacts/bg-first-screen.jpg') }})" --}}
            style="background-image: url('{{asset('website2-assets/img/page-header-theme.jpg')}}')"
            >
            <div class="bg-shape grey"></div>
            <div class="container">
                <div class="page-header-content">
                    <h4 class="text-">
                        {{ __('general.verification') }}
                    </h4>
                    <h2 class="text-">
                        {{ __('general.verification_title') }}
                    </h2>
                </div>
            </div>
        </section>
        <!--/.page-header-->
            <div class="col-10 text-center mx-auto">
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
            </div>
                 <div class="container padding-bottom-3x mb-2">
                    <div class="row justify-content-center">
                        <div class="col-lg-8 col-md-10">
                            <form class="card mt-4" id="verification"  method="get">
                                @csrf
                                    <input hidden type="text" id="number" name="phone" value="{{$phone}}">
                                    <input hidden  type="text" id="number" name="user_id" value="{{$user_id}}">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="email-for-pass">{{__('auth.Enter Your Verification Code')}}</label>
                                        <input class="form-control" type="email" id="email-for-pass"
                                               value="@if(isset($email)){{$email}}@else{{old('email')}}@endif" name="email" hidden>
                                        <input class="form-control" type="text" id="token-for-pass"  placeholder="- - - - -" name="token">
                                        <div id="recaptcha-container"></div>
                                        <button  id="otp_token" type="button" class="btn btn-primary mt-3" onclick="sendOTP()">Send OTP</button>
                                        <div class="help-block" style="display: none"></div>
                                    </div>
                                </div>
                                <div class="card-footer" id='submit_form' style="display:none;">
                                    <button class="btn btn-primary" id="save" type="submit" formaction="{{route('verifyCode.save')}}">{{__('general.Send')}}</button>
                                    <button class="btn btn-default font-weight-bold" style="color: #0f7ae5; @if(app()->getLocale() == 'ar') float:left; @else float:right; @endif" type="submit" onclick="sendOTP()">{{__('auth.resend code')}}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
         </main>
@endsection

@section('scripts')
  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Firebase App (the core Firebase SDK) is always required and must be listed first -->
    <script src="https://www.gstatic.com/firebasejs/6.0.2/firebase.js"></script>

    <script>
        var firebaseConfig = {
            apiKey: "API_KEY",
            authDomain: "PROJECT_ID.firebaseapp.com",
            databaseURL: "https://PROJECT_ID.firebaseio.com",
            projectId: "PROJECT_ID",
            storageBucket: "PROJECT_ID.appspot.com",
            messagingSenderId: "SENDER_ID",
            appId: "APP_ID"
        };
        firebase.initializeApp(firebaseConfig);
    </script>
    <script type="text/javascript">
        window.onload = function () {
            render();
        };
        function render() {
            window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container');
            recaptchaVerifier.render();
        }
        function sendOTP() {
            var number = $("#number").val();
            firebase.auth().signInWithPhoneNumber(number, window.recaptchaVerifier).then(function (confirmationResult) {
                window.confirmationResult = confirmationResult;
                coderesult = confirmationResult;
                console.log(coderesult);
                $("#successAuth").text("Message sent");
                $("#successAuth").show();
                document.getElementById('otp_token').style.display = 'none';
                document.getElementById('submit_form').style.display = 'block';
            }).catch(function (error) {
                $("#error").text(error.message);
                $("#error").show();
            });
        }
        function verify() {
            var code = $("#verification").val();
            coderesult.confirm(code).then(function (result) {
                var user = result.user;
                console.log(user);
                $("#successOtpAuth").text("Auth is successful");
                $("#successOtpAuth").show();
            }).catch(function (error) {
                $("#error").text(error.message);
                $("#error").show();
            });
        }
    </script>
@endsection 

