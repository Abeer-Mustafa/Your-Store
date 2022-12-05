@extends('front.layouts.main')

<!-- *************************** -->
<!-- ***** Head | Sections ***** -->
<!-- *************************** -->
@section('htmlClass')
desktop win mozilla oc30 is-guest route-product-category category-109 store-0 skin-1 desktop-header-active compact-sticky mobile-sticky layout-3 one-column column-left
@endsection

@section('Title')
 {{ __('home.All Products') }}
@endsection

@section('TitleURL')
{{ url('/products')}}
@endsection

@section('TitleImage')
{{ URL::to('/front') }}/image/catalog/logo/logo.png
@endsection

@section('TitleDesc')
All Products
@endsection

@section('cssAssets')
26e393dff2cfccb73d5f3c8433be85d2fdc9.css?v=7f711446
@endsection

@section('cssfile')
style_cat
@endsection

@section('jsAssets')
c4cd4981133c7c0f792cf762de2922c8fdc9.js?v=7f711446
@endsection

@section('jsLibraries')
  @include('front.includes.tooltip') 
@endsection


<!-- ******************** -->
<!-- ***** Contents ***** -->
<!-- ******************** -->
@section('content')
  <ul class="breadcrumb">
    <li><a href="{{ url('/') }}"><i class="fa fa-home"></i>{{ __('home.Home') }}</a></li>
    <li><a href="{{ url('/products') }}">{{ __('home.All Products') }}</a></li>
  </ul>
  <h1 class="title page-title"><span>{{ __('home.All Products') }}</span></h1>

  @include('front.includes.hidden_values') 

  <div class="container">
    <div class="row">
            
      <aside id="column-left" class="side-column">
        <div class="grid-rows">
          <div class="grid-row grid-row-column-left-1">
            <div class="grid-cols">
              <!-- Filter -->
              @include('front.includes.filter') 
            </div>
          </div>
        </div>
      </aside>

      <div id="content">
        <div class="main-products-wrapper">
          <div class="products-filter">
            <div class="grid-list">
              <button id="btn-grid-view" class="view-btn active" data-toggle="tooltip" title="{{ __('home.Grid') }}" data-view="grid"></button>
              <button id="btn-list-view" class="view-btn " data-toggle="tooltip" title="{{ __('home.List') }}" data-view="list"></button>
            </div>
            <div class="select-group">
              <!-- Sort By -->
              <div class="input-group input-group-sm sort-by">
                <label class="input-group-addon" for="input-sort-cat">{{ __('home.Sort By') }}:</label>
                <select onchange="sortFilter(this, '/updateEveryThingProducts')" class="input-sort-cat form-control" id="SortItems" name="SortItems">
                  <option value="created_DESC" selected="selected">{{ __('home.Default') }}</option>
                  <option value="name_ASC">{{ __('home.Name (A - Z)') }}</option>
                  <option value="name_DESC">{{ __('home.Name (Z - A)') }}</option>
                  <option value="price_ASC">{{ __('home.Price (Low &gt; High)') }}</option>
                  <option value="price_DESC">{{ __('home.Price (High &gt; Low)') }}</option>
                  <option value="rating_DESC">{{ __('home.Rating (Highest)') }}</option>
                  <option value="rating_ASC">{{ __('home.Rating (Lowest)') }}</option>
                </select>
              </div>
              
              <!-- Show -->
              <div class="input-group input-group-sm per-page">
                <label class="input-group-addon" for="input-limit-cat">{{ __('home.Show') }}:</label>
                <select  onchange="limitFilter(this, '/updateEveryThingProducts')" class="input-limit-cat form-control" id="NumItems" name="NumItems">
                  <option value="1000000" selected="selected">{{ __('home.All') }}</option>
                  <option value="6">6</option>
                  <option value="12">12</option>
                  <option value="25">25</option>
                  <option value="50">50</option>
                  <option value="75">75</option>
                  <option value="100">100</option>
                </select>
              </div>
            </div>
          </div>
          
          <div id="allProducts" class="main-products product-grid">
            @include('front.layouts.updateProducts') 
          </div>

        </div>
      </div>
    </div>
  </div>
@endsection

<!-- ******************* -->
<!-- ***** Scripts ***** -->
<!-- ******************* -->
@section('jsFooterScripts')
<script src="{{ asset('front') }}/theme/assets/4840c61106915951c2761defefddff13fdc9.js?v=7f711446"> </script>
<script  src="{{ asset('front') }}/js/filter.js"></script>
<script  src="{{ asset('front') }}/js/cart.js"></script>
@include('front.includes.trans_select') 

</body>
</html>
@endsection
