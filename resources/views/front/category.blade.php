@extends('front.layouts.main')

<!-- *************************** -->
<!-- ***** Head | Sections ***** -->
<!-- *************************** -->
@section('htmlClass')
desktop win mozilla oc30 is-guest route-product-category category-109 store-0 skin-1 desktop-header-active compact-sticky mobile-sticky layout-3 one-column column-left
@endsection

@section('Title')
{{ $cat->name }}
@endsection

@section('TitleURL')
{{ url('/category').'/'. $cat->id}}
@endsection

@section('TitleImage')
{{ URL::to('/storage') }}/images/cats/{{$cat->image}}
@endsection

@section('TitleDesc')
{{ $cat->description }}
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
    <?php 
      $parentCats = [];
      $parent = \App\Models\Category::where('id', $cat->id)->first();
      array_push($parentCats, $parent);
      while ($parent->parent_id > 0){
          $parent = \App\Models\Category::where('id', $parent->parent_id)->first();
          array_push($parentCats, $parent);
      }
      $parentCats=array_reverse($parentCats);
    ?>
    @foreach($parentCats as $parent)
      <li><a href="{{ url('/category').'/'.$parent->id }}">{{$parent->name}}</a></li>
    @endforeach
  </ul>

  <h1 class="title page-title"><span>{{$cat->name}}</span></h1>
    
  @include('front.includes.hidden_values') 
  
  <div class="container">
    <div class="row">

      <aside id="column-left" class="side-column">
        <div class="grid-rows">
          <div class="grid-row grid-row-column-left-1">
            <div class="grid-cols">
              <!-- All Categories -->
              <div class="grid-col grid-col-column-left-1-1">
                <div class="grid-items">
                  <div class="grid-item grid-item-column-left-1-1-1">
                    <div class="accordion-menu accordion-menu-19">
                      <h3 class="title module-title titleRight">{{ __('home.All Categories') }}</h3>
                      <ul class="j-menu">
                        <?php $main_cats = \App\Models\Category::where('parent_id', 0)->get(); ?>
                        @foreach($main_cats as $main_cat)
                          <?php
                            $catActive = false;
                            if(in_array($main_cat, $parentCats)) $catActive = true;
                            $child_cats = \App\Models\Category::where('parent_id', $main_cat->id)->get();
                          ?>
                          @if($child_cats->count() > 0)
                            <li class="menu-item accordion-menu-item accordion-menu-item <?php if($catActive) echo ' open active'; ?>">
                              <a href="{{ url('/category').'/'.$main_cat->id }}">
                                <span class="links-text <?php if($catActive) echo ' activeCat'; ?>">{{$main_cat->name}}</span>
                                <span 
                                  class="open-menu collapsed" 
                                  data-toggle="collapse" 
                                  data-target="#collapse-{{$main_cat->id}}"
                                  <?php if($catActive) echo 'aria-expanded="true" '; ?>
                                  role="heading">
                                  <i class="fa fa-plus"></i>
                                </span>
                              </a>
                              <div class="collapse <?php if($catActive) echo 'in '; ?>" id="collapse-{{$main_cat->id}}">
                                <ul class="j-menu">
                                  @foreach($child_cats as $child_cat)
                                    <?php
                                      $catActive = false;
                                      if(in_array($child_cat, $parentCats)) $catActive = true; 
                                      $grand1_cats = \App\Models\Category::where('parent_id', $child_cat->id)->get(); 
                                    ?>
                                    @if($grand1_cats->count() > 0)
                                      <li class="menu-item menu-item-c105 <?php if($catActive) echo ' open active'; ?>">
                                        <a href="{{ url('/category').'/'.$child_cat->id }}">
                                          <span class="links-text <?php if($catActive) echo ' activeCat'; ?>">{{$child_cat->name}}</span>
                                          <span class="count-badge ">3</span>
                                          <span 
                                            class="open-menu collapsed"
                                            data-toggle="collapse"
                                            data-target="#collapse-{{$child_cat->id}}"
                                            <?php if($catActive) echo 'aria-expanded="true" '; ?>
                                            role="heading">
                                            <i class="fa fa-plus"></i>
                                          </span>
                                        </a>
                                          <div class="collapse <?php if($catActive) echo 'in '; ?>" id="collapse-{{$child_cat->id}}">
                                            <ul class="j-menu">
                                              @foreach($grand1_cats as $grand1_cat)
                                                <?php 
                                                  $catActive = false;
                                                  if(in_array($grand1_cat, $parentCats)) $catActive = true; 
                                                  $grand2_cats = \App\Models\Category::where('parent_id', $grand1_cat->id)->get(); 
                                                ?>
                                                @if($grand2_cats->count() > 0)
                                                <li class="menu-item menu-item-c105 <?php if($catActive) echo ' open active'; ?>">
                                                    <a href="{{ url('/category').'/'.$grand1_cat->id }}">
                                                      <span class="links-text <?php if($catActive) echo ' activeCat'; ?>">{{$grand1_cat->name}}</span>
                                                      <span class="count-badge ">3</span>
                                                      <span 
                                                        class="open-menu collapsed"
                                                        data-toggle="collapse"
                                                        data-target="#collapse-{{$grand1_cat->id}}"
                                                        <?php if($catActive) echo 'aria-expanded="true" '; ?>
                                                        role="heading">
                                                        <i class="fa fa-plus"></i>
                                                      </span>
                                                    </a>
                                                    <div class="collapse <?php if($catActive) echo 'in '; ?>" id="collapse-{{$grand1_cat->id}}">
                                                      <ul class="j-menu">
                                                        @foreach($grand2_cats as $grand2_cat)
                                                          <?php 
                                                            $catActive = false;
                                                            if(in_array($grand2_cat, $parentCats)) $catActive = true; 
                                                            $grand3_cats = \App\Models\Category::where('parent_id', $grand2_cat->id)->get(); 
                                                          ?>
                                                          @if($grand3_cats->count() > 0)
                                                          <li class="menu-item menu-item-c105 <?php if($catActive) echo ' open active'; ?>">
                                                              <a href="{{ url('/category').'/'.$grand2_cat->id }}">
                                                                <span class="links-text <?php if($catActive) echo ' activeCat'; ?>">{{$grand2_cat->name}}</span>
                                                                <span class="count-badge ">3</span>
                                                                <span 
                                                                  class="open-menu collapsed"
                                                                  data-toggle="collapse"
                                                                  data-target="#collapse-{{$grand2_cat->id}}"
                                                                  <?php if($catActive) echo 'aria-expanded="true" '; ?>
                                                                  role="heading">
                                                                  <i class="fa fa-plus"></i>
                                                                </span>
                                                              </a>
                                                              <div class="collapse <?php if($catActive) echo 'in '; ?>" id="collapse-{{$grand2_cat->id}}">
                                                                <ul class="j-menu">
                                                                  @foreach($grand3_cats as $grand3_cat)
                                                                    <?php  
                                                                      $catActive = false;
                                                                      if(in_array($grand3_cat, $parentCats)) $catActive = true; 
                                                                      $grand3_cats = \App\Models\Category::where('parent_id', $grand3_cat->id)->get(); 
                                                                    ?>
                                                                    @if($grand3_cats->count() > 0)
                                                                    <li class="menu-item menu-item-c105 <?php if($catActive) echo ' open active'; ?>">
                                                                      <a href="{{ url('/category').'/'.$grand3_cat->id }}">
                                                                        <span class="links-text <?php if($catActive) echo ' activeCat'; ?>">{{$grand3_cat->name}}</span>
                                                                        <span class="count-badge ">3</span>
                                                                        <span 
                                                                          class="open-menu collapsed"
                                                                          data-toggle="collapse"
                                                                          data-target="#collapse-{{$grand3_cat->id}}"
                                                                          <?php if($catActive) echo 'aria-expanded="true" '; ?>
                                                                          role="heading">
                                                                          <i class="fa fa-plus"></i>
                                                                        </span>
                                                                      </a>
                                                                      <div class="collapse <?php if($catActive) echo 'in '; ?>" id="collapse-{{$grand3_cat->id}}">
                                                                        <ul class="j-menu">
                                                                          @foreach($grand3_cats as $grand3_cats)
                                                                          <?php  
                                                                            $catActive = false;
                                                                            if(in_array($grand3_cats, $parentCats)) $catActive = true; 
                                                                            $grand4_cats = \App\Models\Category::where('parent_id', $grand3_cats->id)->get(); 
                                                                          ?>
                                                                          <li class="menu-item menu-item-c152 <?php if($catActive) echo ' open active'; ?>">
                                                                            <a href="{{ url('/category').'/'.$grand3_cats->id }}">
                                                                              <span class="links-text <?php if($catActive) echo ' activeCat'; ?>">{{$grand3_cats->name}}</span>
                                                                              <span class="count-badge count-zero ">0</span>
                                                                            </a>
                                                                          </li>
                                                                          @endforeach
                                                                        </ul>
                                                                      </div>
                                                                    </li>
                                                                    @else
                                                                    <li class="menu-item menu-item-c105 <?php if($catActive) echo ' open active'; ?>">
                                                                      <a href="{{ url('/category').'/'.$grand2_cat->id }}">
                                                                        <span class="links-text <?php if($catActive) echo ' activeCat'; ?>">{{$grand2_cat->name}}</span>
                                                                        <span class="count-badge count-zero">0</span>
                                                                      </a>
                                                                    </li>
                                                                    @endif
                                                                  @endforeach
                                                                </ul>
                                                              </div>
                                                          </li>
                                                          @else
                                                          <li class="menu-item menu-item-c105 <?php if($catActive) echo ' open active'; ?>">
                                                            <a href="{{ url('/category').'/'.$grand2_cat->id }}">
                                                              <span class="links-text <?php if($catActive) echo ' activeCat'; ?>">{{$grand2_cat->name}}</span>
                                                              <span class="count-badge count-zero">0</span>
                                                            </a>
                                                          </li>
                                                          @endif
                                                        @endforeach
                                                      </ul>
                                                    </div>
                                                </li>
                                                @else
                                                <li class="menu-item menu-item-c105 <?php if($catActive) echo ' open active'; ?>">
                                                  <a href="{{ url('/category').'/'.$grand1_cat->id }}">
                                                    <span class="links-text <?php if($catActive) echo ' activeCat'; ?>">{{$grand1_cat->name}}</span>
                                                    <span class="count-badge count-zero">0</span>
                                                  </a>
                                                </li>
                                                @endif
                                              @endforeach
                                            </ul>
                                          </div>
                                      </li>
                                    @else
                                      <li class="menu-item menu-item-c105 <?php if($catActive) echo ' open active'; ?>">
                                        <a href="{{ url('/category').'/'.$child_cat->id }}">
                                          <span class="links-text <?php if($catActive) echo ' activeCat'; ?>">{{$child_cat->name}}</span>
                                          <span class="count-badge count-zero">0</span>
                                        </a>
                                      </li>
                                    @endif
                                  @endforeach
                                </ul>
                              </div>
                            </li>
                          @else
                            <li class="menu-item accordion-menu-item accordion-menu-item <?php if($catActive) echo ' open active'; ?>">
                            <a href="{{ url('/category').'/'.$main_cat->id }}">
                              <span class="links-text <?php if($catActive) echo ' activeCat'; ?>">{{$main_cat->name}}</span>
                              <span class="count-badge count-zero">0</span>
                            </a>
                          @endif
                        @endforeach
                      </ul>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Filter -->
              @include('front.includes.filter') 
              
            </div>
          </div>
        </div>
      </aside>

      <div id="content">
        <!-- Description -->
        <div id="content-top">
          <div class="grid-rows">
            <div class="grid-row grid-row-content-top-1">
              <div class="grid-cols">
                <div class="grid-col grid-col-content-top-1-1">
                  <div class="grid-items">
                    <div class="grid-item grid-item-content-top-1-1-1">
                      <div class="module module-blocks module-blocks-262 blocks-grid">
                        <div class="module-body">
                          <div class="module-item module-item-1">
                            <div class="block-body expand-block">
                              <div class="block-wrapper">
                                <div class="block-content expand-content block-description">
                                  <h5> <span class="amp"></span>{{ __('home.Category Description') }}</h5>
                                  <b>{{$cat->name}}:</b>
                                  <p>{{$cat->description}}&nbsp;</p>
                                  <div class="block-expand-overlay">
                                    <a class="block-expand btn"></a>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Sub Categories -->
        <div class="refine-categories refine-carousel">
          <div class="swiper"
            data-items-per-row='{"c0":{"0":{"items":8,"spacing":10},"1024":{"spacing":10,"items":7},"760":{"spacing":10,"items":4},"470":{"spacing":10,"items":3}},"c1":{"0":{"items":7,"spacing":10},"1024":{"spacing":10,"items":5},"760":{"spacing":10,"items":4},"470":{"items":3,"spacing":10}},"c2":{"0":{"items":6,"spacing":10},"1024":{"items":4,"spacing":10},"470":{"items":3,"spacing":10}},"sc":{"0":{"items":1,"spacing":15}}}'
            data-options='{"speed":500,"autoplay":false,"pauseOnHover":true,"loop":false}'>
            <div class="swiper-container">
              <div class="swiper-wrapper">
                @foreach($childrenCats as $childrenCat)
                <div class="refine-item swiper-slide">
                  <a href="{{ url('/category').'/'.$childrenCat->id }}">
                    <img src="{{IMAGE}}images/cats/{{$childrenCat->image}}"
                      data-srcset=" 1x,  2x"
                      alt="{{$childrenCat->name}}" />
                    <span class="refine-name">
                      <span class="links-text">{{$childrenCat->name}}</span>
                      <span class="count-badge ">4</span>
                    </span>
                  </a>
                </div>
                @endforeach
              </div>
            </div>
            <div class="swiper-buttons">
              <div class="swiper-button-prev"></div>
              <div class="swiper-button-next"></div>
            </div>
            <div class="swiper-pagination"></div>
          </div>
        </div>

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
                <select onchange="sortFilter(this, '/updateEveryThing')" class="input-sort-cat form-control" id="SortItems" name="SortItems">
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
                <select onchange="limitFilter(this, '/updateEveryThing')" class="input-limit-cat form-control" id="NumItems" name="NumItems">
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