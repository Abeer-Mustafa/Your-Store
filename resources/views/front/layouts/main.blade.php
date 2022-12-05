@include('front.layouts.head')
@include('front.layouts.header')

@yield('slider')
@yield('content')

@include('front.layouts.footer')

<script src="{{ asset('front') }}/js/myJS.js"></script>
@yield('jsFooterScripts')

