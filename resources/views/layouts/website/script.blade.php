<script src="{{asset('website-assets/js/jquery.min.js')}}"></script>
<script src="{{asset('website-assets/js/darkmode.min.js')}}"></script>
<script src="{{asset('website-assets/js/uikit.min.js')}}"></script>
<script src="{{asset('website-assets/js/uikit-icons.min.js')}}"></script>
<script src="{{asset('website-assets/js/main.js')}}"></script>
<script src="{{asset('website-assets/js/fontawesome.all.min.js')}}"></script>

<script src="{{asset('website2-assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('website2-assets/vendor/slick/slick.min.js')}}"></script>
<script src="{{asset('website2-assets/vendor/sidebar/hc-offcanvas-nav.js')}}"></script>
<script src="{{asset('website2-assets/js/osahan.js')}}"></script>
<script src="{{ asset('admin-assets/js/jquery.validate.min.js') }}"></script>

<!-- Bootstrap RTL -->
@if(LaravelLocalization::getCurrentLocaleName() == 'Arabic')
    <script
        src="https://cdn.rtlcss.com/bootstrap/v4.5.3/js/bootstrap.min.js"
        integrity="sha384-VmD+lKnI0Y4FPvr6hvZRw6xvdt/QZoNHQ4h5k0RL30aGkR9ylHU56BzrE2UoohWK"
        crossorigin="anonymous"></script>
@endif

