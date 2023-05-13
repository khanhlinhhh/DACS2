
@include('layouts.inc.frontend.head') 

<body>
   

        @include('layouts.inc.frontend.header')
        {{-- @include('frontend.index') --}}

 
   <main class="py-4">
      @yield('content')
      {{-- @include('layouts.inc.frontend.home') --}}
        </main>
        @include('layouts.inc.frontend.footer')
    </div>


      <!-- Scripts -->
      {{-- <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}" ></script> 
      <script src="{{ asset('assets/js/jquery-3.6.1.min.js') }}" ></script> --}}
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
{{-- <script>
       alertify.set('notifier','position', 'top-right');
       alertify.success('Current position');
</script> --}}
 <script src="{{asset('fe/assets/js/vendor/modernizr-3.6.0.min.js')}}"></script>
<script src="{{asset('fe/assets/js/vendor/jquery-3.6.0.min.js')}}"></script>
<script src="{{asset('fe/assets/js/vendor/jquery-migrate-3.3.0.min.js')}}"></script>
<script src="{{asset('fe/assets/js/vendor/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('fe/assets/js/plugins/slick.js')}}"></script>
<script src="{{asset('fe/assets/js/plugins/jquery.syotimer.min.js')}}"></script>
<script src="{{asset('fe/assets/js/plugins/wow.js')}}"></script>
<script src="{{asset('fe/assets/js/plugins/jquery-ui.js')}}"></script>
<script src="{{asset('fe/assets/js/plugins/perfect-scrollbar.js')}}"></script>
<script src="{{asset('fe/assets/js/plugins/magnific-popup.js')}}"></script>
<script src="{{asset('fe/assets/js/plugins/select2.min.js')}}"></script>
<script src="{{asset('fe/assets/js/plugins/waypoints.js')}}"></script>
<script src="{{asset('fe/assets/js/plugins/counterup.js')}}"></script>
<script src="{{asset('fe/assets/js/plugins/jquery.countdown.min.js')}}"></script>
<script src="{{asset('fe/assets/js/plugins/images-loaded.js')}}"></script>
<script src="{{asset('fe/assets/js/plugins/isotope.js')}}"></script>
<script src="{{asset('fe/assets/js/plugins/scrollup.js')}}"></script>
<script src="{{asset('fe/assets/js/plugins/jquery.vticker-min.js')}}"></script>
<script src="{{asset('fe/assets/js/plugins/jquery.theia.sticky.js')}}"></script>
<script src="{{asset('fe/assets/js/plugins/jquery.elevatezoom.js')}}"></script>
<!-- Template  JS -->
<script src="{{asset('fe/assets/js/main.js?v=3.3')}}"></script>
<script src="{{asset('fe/assets/js/shop.js?v=3.3')}}"></script>

      @livewireScripts
      @stack('scripts')
</body>
</html>
