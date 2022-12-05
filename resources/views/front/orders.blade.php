@extends('front.layouts.main')

<!-- *************************** -->
<!-- ***** Head | Sections ***** -->
<!-- *************************** -->

@section('htmlClass')
desktop win mozilla oc30 is-guest route-account-login store-0 skin-1 desktop-header-active compact-sticky mobile-sticky layout-6 one-column column-right
@endsection

@section('Title')
{{ __('home.My Orders') }}
@endsection

@section('TitleURL')
{{ url('/orders')}}
@endsection

@section('TitleImage')
{{ URL::to('/front') }}/image/catalog/logo/logo.png
@endsection

@section('TitleDesc')
My Orders
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
    <li><a href="">{{ __('home.My Orders') }}</a></li>
  </ul>
  <h1 class="title page-title"><span>{{ __('home.My Orders') }}</span></h1>
  
  <div id="content" class="col-sm-9 container">
    <?php 
    if(count($orders) == 0) echo '<div><p style="text-align: center; color:#888; font-size:20px;">'. __('home.history is empty') .'</p></div>'; 
    else { ?>
    <!-- Table Content -->
    <div class="table-responsive">
      <table class="table table-bordered table-hover">
        <thead>
          <tr>
            <td class="text-center">{{ __('home.Order ID') }}</td>
            <td class="text-center">{{ __('home.Customer') }}</td>
            <td class="text-center">{{ __('home.Status') }}</td>
            <td class="text-center">{{ __('home.Total') }}</td>
            <td class="text-center">{{ __('home.Date Added') }}</td>
            <td></td>
          </tr>
        </thead>
        <tbody>
        	@foreach($orders as $order)
	          <tr>
	            <td class="text-center">#{{$order->id}}</td>
	            <td class="text-center">{{Auth::user()->name}}</td>
	            <td class="text-center">{{$order->status}}</td>
	            <td class="text-center">${{$order->payment_amount}}</td>
	            <td class="text-center">{{$order->created_at}}</td>
	            <td class="text-center">
	            	<a href="{{ url('/order').'/'. $order->id}}" data-toggle="tooltip" title="{{ __('home.View') }}" class="btn btn-info">
	            		<i class="fa fa-eye"></i>
	            	</a>
	            </td>
	          </tr>
          @endforeach
       
        </tbody>
      </table>
    </div>
   
    <!-- Buttons -->
    <div class="buttons clearfix">
      <div class="pull-left"><a href="{{ url('/') }}" class="btn btn-default"><span>{{ __('home.Continue Shopping') }}</span></a></div>
      <div class="pull-right"><a href="{{ url('/checkout') }}" class="btn btn-success"><span>{{ __('home.Checkout') }}</span></a></div>
    </div>
    <?php } ?>
  </div>
@endsection

@section('jsFooterScripts')
<script  src="{{ asset('front') }}/theme/assets/608bdd2a8e5cf8cd74b96d306c67d941fdc9.js?v=7f711446" defer></script>

</body>
</html>
@endsection