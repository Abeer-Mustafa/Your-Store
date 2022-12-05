@extends('front.layouts.main')

<!-- *************************** -->
<!-- ***** Head | Sections ***** -->
<!-- *************************** -->

@section('htmlClass')
desktop win mozilla oc30 is-guest route-product-manufacturer store-0 skin-1 desktop-header-active compact-sticky mobile-sticky layout-5
@endsection

@section('Title')
{{ __('home.All Categories') }}
@endsection

@section('TitleURL')
{{ url('/cats')}}
@endsection

@section('TitleImage')
{{ URL::to('/front') }}/image/catalog/logo/logo.png
@endsection

@section('TitleDesc')
All Categories
@endsection

@section('cssAssets')
7e57e9b00b1eabc084a21e4dd7387162fdc9.css?v=7f711446
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
    <li><a href="">{{ __('home.Categories') }}</a></li>
  </ul>
  <h1 class="title page-title"><span>{{ __('home.All Categories') }}</span></h1>
  <?php $categories = App\Models\Category::all(); ?>
  <div id="product-manufacturer" class="container">
   	<div class="row">
    	<div id="content" class="col-sm-12">
    		<h2 id="A" class="title titleRight manufacturer-letter">{{ __('home.Find Your Favorite Category') }}</h2>
		    <div class="manufacturer">
		    	@foreach($categories as $cat)
		      <div class="col-sm-3 col-xs-4 col-xxs-6 col-md-2">
		      	<a href="{{url('/category')}}/{{$cat->id}}" class="image-card">
			      	<img src="{{IMAGE}}images/cats/{{$cat->image}}" alt="{{$cat->name}}" />
			      	<span>{{$cat->name}}</span>
		     		</a>
		     	</div>
		     	@endforeach
		    </div>
		  </div>
		</div>
	</div>
 @endsection

@section('jsFooterScripts')
<script  src="{{ asset('front') }}/theme/assets/608bdd2a8e5cf8cd74b96d306c67d941fdc9.js?v=7f711446" defer></script>

</body>
</html>
@endsection