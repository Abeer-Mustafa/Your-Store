@extends('front.layouts.main')

<!-- *************************** -->
<!-- ***** Head | Sections ***** -->
<!-- *************************** -->

@section('htmlClass')
desktop win mozilla oc30 is-guest route-account-login store-0 skin-1 desktop-header-active compact-sticky mobile-sticky layout-6 one-column column-right
@endsection

@section('Title')
{{__('home.Shopping Cart')}}
@endsection

@section('TitleURL')
{{ url('/cart')}}
@endsection

@section('TitleImage')
{{ URL::to('/front') }}/image/catalog/logo/logo.png
@endsection

@section('TitleDesc')
Shopping Cart
@endsection

@section('cssAssets')
26e393dff2cfccb73d5f3c8433be85d2fdc9.css?v=7f711446
@endsection

@section('cssfile')
home
@endsection

@section('jsAssets')
c4cd4981133c7c0f792cf762de2922c8fdc9.js?v=7f711446
@endsection

@section('jsLibraries')
@endsection

@section('content')
  <ul class="breadcrumb">
    <li><a href="{{ url('/') }}"><i class="fa fa-home"></i>{{__('home.Home')}}</a></li>
    <li><a href="">{{__('home.Shopping Cart')}}</a></li>
  </ul>
  <h1 class="title page-title"><span>{{__('home.My Shopping Cart')}}</span></h1>
  
  <div id="content" class="col-sm-9 container">
    @include('front.layouts.cart') 
  </div>
@endsection

@section('jsFooterScripts')
<script  src="{{ asset('front') }}/theme/assets/608bdd2a8e5cf8cd74b96d306c67d941fdc9.js?v=7f711446" defer></script>
<script  src="{{ asset('front') }}/js/home.js"></script>

</body>
</html>
@endsection