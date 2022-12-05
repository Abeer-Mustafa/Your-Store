@extends('front.layouts.main')

<!-- *************************** -->
<!-- ***** Head | Sections ***** -->
<!-- *************************** -->
@section('htmlClass')
desktop win mozilla oc30 is-guest route-product-category category-109 store-0 skin-1 desktop-header-active compact-sticky mobile-sticky layout-3 one-column column-left
@endsection

@section('Title')
{{ __('about.About Us') }}
@endsection

@section('TitleURL')
{{ url('/about')}}
@endsection

@section('TitleImage')
{{ URL::to('/front') }}/image/catalog/logo/logo.png
@endsection

@section('TitleDesc')
About Us
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
    <li><a href="{{ url('/') }}"><i class="fa fa-home"></i>{{ __('home.Home') }}</a></li>
    <li><a href="">{{ __('about.About Us') }}</a></li>
  </ul>
  <h1 class="title page-title"><span>{{ __('about.About Us') }}</span></h1>

  <div id="content" class="col-sm-9 container">
    <div class="content">
      <blockquote>
        <!-- <span class="drop-cap">{{ __('about.S') }}</span> -->
        {{ __('about.About Desc1') }}
      </blockquote>
      <blockquote>{{ __('about.About Desc2') }} </blockquote>
      <blockquote>{{ __('about.About Desc3') }} </blockquote>   
      <blockquote>{{ __('about.About Desc4') }} </blockquote>      
      <blockquote>{{ __('about.About Desc5') }} </blockquote>      
      <blockquote>{{ __('about.About Desc6') }} </blockquote>      
      <p><a class="btn" href="{{ url('/products') }}">{{ __('home.Start Shopping') }}</a></p>
    </div>
  </div>
@endsection

<!-- ******************* -->
<!-- ***** Scripts ***** -->
<!-- ******************* -->
@section('jsFooterScripts')
<script  src="{{ asset('front') }}/theme/assets/608bdd2a8e5cf8cd74b96d306c67d941fdc9.js?v=7f711446" defer></script>

</body>
</html>
@endsection
