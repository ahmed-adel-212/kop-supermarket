<!DOCTYPE html>
<html lang="en">

@include('layouts.website.head')
<body class="page-blog dm-dark">
<!-- Loader-->
<div id="page-preloader"><span class="spinner border-t_second_b border-t_prim_a"></span></div>
<!-- Loader end-->

<div class="page-wrapper">

    <div class="login-page vh-100">
        <video loop autoplay muted id="vid" style="object-fit: fill;height: 100%;">
            <source src="{{asset('website2-assets/img/bg.mp4')}}" type="video/mp4">
            <source src="{{asset('website2-assets/img/bg.mp4')}}" type="video/ogg">
            Your browser does not support the video tag.
        </video>
        <div class="d-flex align-items-center justify-content-center vh-100">
            <div class="px-5 col-md-6 ml-auto">
                <div class="px-5 col-10 mx-auto">
                    <a href="{{route('home.page')}}">
                        <img class="logo__img logo__img--full m-auto" style="cursor: pointer;" src="{{asset('website-assets/img/logokop.bmp')}}" alt="logo">
                    </a>
                    <h2 class="text-dark my-0">{{__('general.Welcome Back')}}</h2>
                    <p class="text-50">{{__('general.Sign in to continue')}}</p>
                    @if(Session::has('success'))
                        <div class="row mr-2 ml-2">
                            <button type="text" class="btn btn-lg btn-block btn-outline-success mb-2"
                                    id="type-error">{{Session::get('success')}}
                            </button>
                        </div>
                    @endif
                    @if(Session::has('error'))
                        <div class="row mr-2 ml-2" >
                            <button type="text" class="btn btn-lg btn-block btn-outline-danger mb-2"
                                    id="type-error">{{Session::get('error')}}
                            </button>
                        </div>
                    @endif
                    <form class="mt-5 mb-4" method="post" action="{{route('sign.in')}}">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1" class="text-dark">{{__('general.Email')}}</label>
                            <input type="email" value="{{ old('email') }}" name="email" placeholder="{{__('general.Enter Your E-mail')}}"
                                   class="form-control" id="exampleInputEmail1"
                                   aria-describedby="emailHelp">
                            @error('email')
                            <div class="help-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1" class="text-dark">{{__('general.Password')}}</label>
                            <input type="password" name="password" placeholder="{{__('general.Enter Password')}}" class="form-control"
                                   id="exampleInputPassword1">
                            @error('password')
                            <div class="help-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <button class="btn btn-primary btn-lg btn-block">{{__('general.SIGN IN')}}</button>
                    </form>
                    <a href="{{route('forget.password')}}" class="text-decoration-none">
                        <p class="text-center">{{__('general.Forgot your password?')}}</p>
                    </a>
                    <div class="d-flex align-items-center justify-content-center">
                        <a href="{{route('get.sign.up')}}">
                            <p class="text-center m-0">{{__('general.Don\'t have an account? Sign up')}}</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <button class="light" style="display: inline-block!important;" id="mode-toggler"><span data-uk-icon="paint-bucket"
                                                                                               class="uk-icon"><svg
                    width="20" height="20" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" data-svg="paint-bucket"><path
                        d="M10.21,1 L0,11.21 L8.1,19.31 L18.31,9.1 L10.21,1 L10.21,1 Z M16.89,9.1 L15,11 L1.7,11 L10.21,2.42 L16.89,9.1 Z"></path><path
                        fill="none" stroke="#000" stroke-width="1.1" d="M6.42,2.33 L11.7,7.61"></path><path
                        d="M18.49,12 C18.49,12 20,14.06 20,15.36 C20,16.28 19.24,17 18.49,17 L18.49,17 C17.74,17 17,16.28 17,15.36 C17,14.06 18.49,12 18.49,12 L18.49,12 Z"></path></svg></span>
        </button>
    </footer>

</div>

@include('layouts.website.script')
@yield('scripts')
</body>
</html>
