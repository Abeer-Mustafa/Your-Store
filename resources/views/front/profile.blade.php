@extends('front.layouts.main')

<!-- *************************** -->
<!-- ***** Head | Sections ***** -->
<!-- *************************** -->
@section('htmlClass')
desktop win mozilla oc30 is-guest route-account-login store-0 skin-1 desktop-header-active compact-sticky mobile-sticky layout-6 one-column column-right
@endsection

@section('Title')
{{__('home.My Account')}}
@endsection

@section('TitleURL')
{{ url('/profile')}}
@endsection

@section('TitleImage')
{{IMAGE}}images/users/{{$user->image}}
@endsection

@section('TitleDesc')
My Account
@endsection

@section('cssAssets')
26e393dff2cfccb73d5f3c8433be85d2fdc9.css?v=7f711446
@endsection

@section('cssfile')
profile
@endsection

@section('jsAssets')
c4cd4981133c7c0f792cf762de2922c8fdc9.js?v=7f711446
@endsection

@section('jsLibraries')
	<link href="{{ asset('front') }}/js/bootstrap/css/bootstrap.minfdc9.css?v=7f711446" type="text/css" rel="stylesheet" media="all" />
	<link href="{{ asset('front') }}/js/font-awesome/css/font-awesome.minfdc9.css?v=7f711446" type="text/css" rel="stylesheet" media="all" />
	<link href="{{ asset('front') }}/theme/icons/style.minimalfdc9.css?v=7f711446" type="text/css" rel="stylesheet" media="all" />
	<link href="{{ asset('front') }}/theme/lib/swiper/swiper.minfdc9.css?v=7f711446" type="text/css" rel="stylesheet" media="all" />
	<!-- <link href="{{ asset('front') }}/theme/stylesheet/stylefdc9.css?v=7f711446" type="text/css" rel="stylesheet" media="all" /> -->
	<script src="{{ asset('front') }}/theme/lib/modernizr/modernizr-customfdc9.js?v=7f711446"> </script> 
	<script src="{{ asset('front') }}/theme/lib/jquery/jquery-2.1.1.minfdc9.js?v=7f711446"> </script>
	<script src="{{ asset('front') }}/js/bootstrap/js/bootstrap.minfdc9.js?v=7f711446"> </script>
	<script src="{{ asset('front') }}/js/commonfdc9.js?v=7f711446"></script>
@endsection

@section('content')
  <ul class="breadcrumb">
    <li><a href="{{ url('/') }}"><i class="fa fa-home"></i>{{__('home.Home')}}</a></li>
    <li><a href="">{{__('home.Accounts')}}</a></li>
  </ul>
  <h1 class="title page-title"><span>{{$user->name}}</span></h1>

	<div id="profile_content" class="container">

    <div class="my-account">
      <h2 class="title titleRight" style="padding: 10px;">{{__('home.My Account')}}</h2>
      <ul class="list-unstyled account-list" style="margin-bottom: 25px;">
        <li class="edit-info"><a href="{{ url('/editProfile') }}">{{__('home.Edit Account Info')}}</a></li>
        <li class="edit-cat"><a href="{{ url('/cart') }}">{{__('home.Modify Shopping Cart')}}</a></li>
        <li class="edit-wishlist"><a href="{{ url('/wishlist') }}">{{__('home.Modify WishList')}}</a></li>
        <li class="edit-order"><a href="{{ url('/orders') }}">{{__('home.View Order History')}}</a></li>
      </ul>
    </div>
  </div>
@endsection

<!-- ******************* -->
<!-- ***** Scripts ***** -->
<!-- ******************* -->
@section('jsFooterScripts')
<!-- <script  src="{{ asset('front') }}/theme/assets/608bdd2a8e5cf8cd74b96d306c67d941fdc9.js?v=7f711446" defer></script> -->
<script  src="{{ asset('front') }}/js/profile.js"></script>

<script src="{{ asset('front') }}/theme/lib/anime/anime.minfdc9.js?v=7f711446"> </script>
<script src="{{ asset('front') }}/theme/lib/vanilla-lazyload/lazyload.minfdc9.js?v=7f711446"> </script>
<script src="{{ asset('front') }}/theme/lib/countdown/jquery.countdown.minfdc9.js?v=7f711446"> </script>
<script src="{{ asset('front') }}/theme/lib/typeahead/typeahead.jquery.minfdc9.js?v=7f711446"> </script>
<script  src="{{ asset('front') }}/theme/lib/hoverintent/jquery.hoverIntent.minfdc9.js?v=7f711446"> </script>
<script src="{{ asset('front') }}/theme/lib/cjs/cjsfdc9.js?v=7f711446"> </script>
<script src="{{ asset('front') }}/theme/lib/swiper/swiper.minfdc9.js?v=7f711446"> </script>
<script src="{{ asset('front') }}/theme/js/commonfdc9.js?v=7f711446"> </script>
<script src="{{ asset('front') }}/theme/js/journalfdc9.js?v=7f711446"> </script>

</body>
</html>
@endsection