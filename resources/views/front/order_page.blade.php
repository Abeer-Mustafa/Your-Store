@extends('front.layouts.main')

<!-- *************************** -->
<!-- ***** Head | Sections ***** -->
<!-- *************************** -->

@section('htmlClass')
desktop win mozilla oc30 is-guest route-account-login store-0 skin-1 desktop-header-active compact-sticky mobile-sticky layout-6 one-column column-right
@endsection

@section('Title')
{{ __('home.Order Information') }}
@endsection

@section('TitleURL')
{{ url('/orders')}}
@endsection

@section('TitleImage')
{{ URL::to('/front') }}/image/catalog/logo/logo.png
@endsection

@section('TitleDesc')
My Wish list
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
    <li><a href="{{ url('/orders') }}">{{ __('home.My Orders') }}</a></li>
    <li><a href="">{{ __('home.Order Information') }}</a></li>
  </ul>
  <h1 class="title page-title"><span>{{ __('home.Order Information') }} #{{$order[0]->order_id}}</span></h1>
  <?php $totalPrice=0; $symbol='$'; ?>
  <div id="content" class="col-sm-9 container">
    <!-- Table contents -->
	  <div class="table-responsive">
	   	<table class="table table-bordered table-hover">
	      <thead>
	        <tr>
	          <td class="text-center td-image">{{ __('home.Image') }}</td>
	          <td class="text-center td-name">{{ __('home.Name') }}</td>
	          <td class="text-center td-model">{{ __('home.Info') }}</td>
	          <td class="text-center td-price">{{ __('home.Unit Price') }}</td>
	          <td class="text-center td-qty">{{ __('home.Quantity') }}</td>
	          <td class="text-center td-total">{{ __('home.Total') }}</td>
	        </tr>
	      </thead>
	      <tbody>
	        @foreach($order as $item)
	          <?php $product = \App\Models\Product::find($item->product_id); ?>
	          <tr>
	            <td width="10%" class="text-center td-image"><a href="{{url('/product')}}/{{$product->id}}"><img src="{{IMAGE}}images/products/{{$product->image}}" alt="{{$product->name}}" title="{{$product->name}}" /></a></td>
	            <td width="15%"class="text-center td-name"><a href="{{url('/product')}}/{{$product->id}}">{{$product->name}}</a></td>
	            <?php $brand = \App\Models\Brand::find($product->brand_id); ?>
	            <td width="20%" class="td-model">
	              <ul style="list-style: none; padding-left:0px;">
	              <li><span>{{ __('home.Brand') }}: </span><a href="{{url('/brand')}}/{{$brand->id}}">{{$brand->name}}</a></li>
	              @if($product->color)<li><span>{{ __('home.Color') }}: {{$product->color}}</span></li>@endif
	              @if($product->size)<li><span>{{ __('home.Size') }}: {{$product->size}}</span></li>@endif
	              </ul>
	            </td>
	            <td width="15%" class="text-center td-price">
	              <div class="price">
	                <?php 
	                  $old_price = $product->price;
	                  $new_price = $old_price - $product->discount * $old_price /100 ;
	                  $act_price = $new_price*$item->qty;
	                  $totalPrice += $act_price;
	                  ?>
	                  @if($product->discount)
	                    <b style="color:rgba(46, 175, 35, 1);">{{ $symbol .' '. $new_price }}</b>
	                    &nbsp<s><del style="color: #e7284d;">{{ $old_price }}</del></s>
	                  @else
	                  <b style="color:rgba(46, 175, 35, 1);">{{ $symbol .' '. $old_price }}</b>
	                  @endif
	              </div>
	            </td>
	            <td width="15%" class="text-center td-qty"> {{$item->qty}} </td>
	            <td width="15%" class="text-center td-total"><b style="color:rgba(46, 175, 35, 1);">{{ $symbol .' '. $act_price }}</b></td>
	          </tr>
	        @endforeach
	      </tbody>
	    </table>
	  </div>

	  <!-- Total Price -->
    <div class="panels-total">
      <div class="cart-total">
        <table class="table table-bordered">
          <tr>
            <td class="text-left"><strong>{{ __('home.Total Price') }}:</strong></td>
            <td class="text-center"><b style="color:rgba(46, 175, 35, 1);">{{ $symbol .' '. $totalPrice }}</b></td>
          </tr>
        </table>
      </div>
    </div>
  </div>
@endsection

@section('jsFooterScripts')
<script  src="{{ asset('front') }}/theme/assets/608bdd2a8e5cf8cd74b96d306c67d941fdc9.js?v=7f711446" defer></script>

</body>
</html>
@endsection