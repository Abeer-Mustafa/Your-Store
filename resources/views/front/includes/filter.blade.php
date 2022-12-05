
<div class="grid-col grid-col-column-left-1-2">
  <div class="grid-items">
    <div class="grid-item grid-item-column-left-1-2-1">
      <div class="module module-filter module-filter-36">
        <h3 class="title module-title titleRight">
          <span>{{ __('home.Filter') }}</span>
          <button 
          id="reset-filter" 
          @if(Route::is('products.show'))
            onclick="clearFilter('/updateEveryThingProducts')" 
          @elseif(Route::is('search.show'))
            onclick="clearFilter('/updateEveryThingSearch')"
          @elseif(Route::is('brand.show'))
            onclick="clearFilter('/updateEveryThingBrand')"
          @elseif(Route::is('category.show'))
            onclick="clearFilter('/updateEveryThing')" 
          @endif
          class="resetFilter btn">{{ __('home.Clear') }}</button>
          <a class="x"></a>
        </h3>
        <div class="module-body">
          <div class="panel-group">
            <!-- Price -->
            <div class="module-item module-item-p panel panel-active">
              <div class="panel-heading">
                <div class="panel-title">
                  <a href="#filter-5f17d069aa0eb-collapse-1"
                    class="accordion-toggle " data-toggle="collapse"
                    aria-expanded="true" data-filter="p">
                    {{ __('home.Price') }}
                    <i class="fa fa-caret-down"></i>
                  </a>
                </div>
              </div>
              <div class="panel-collapse collapse in" id="filter-5f17d069aa0eb-collapse-1">
                <div class="panel-body">
                  <div class="filter-price"  id="filter-filter-5f17d069aa0eb-1" style="width: 98%; padding-left: 2%;">
                    <div >
                      <input type="text" id="amount" readonly style="border:0; color:#0089db; font-weight:bold;">
                      <div id="slider-range"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Subcategories -->
            <div id="updateSubCats" class="module-item module-item-c panel panel-active">
              <div class="panel-heading">
                <div class="panel-title">
                  <a href="#Subcategories"
                    class="accordion-toggle " data-toggle="collapse"
                    aria-expanded="true" data-filter="c">
                    @if(Route::is('category.show'))
                      {{ __('home.Subcategories') }}
                    @else
                      {{ __('home.Categories') }}
                    @endif
                    <i class="fa fa-caret-down"></i>
                  </a>
                </div>
              </div>
              <div class="panel-collapse collapse in"
                id="Subcategories">
                <div class="panel-body">
                  <div class="filter-radio">
                    <?php 
                    if(Route::is('category.show')){
                      foreach($childrenCats as $cat){ ?>
                        <label>
                          <input
                            onclick="subcatsFilter(this, '/updateEveryThing')" 
                          type="radio" class="subcats" name="subcats" value="{{$cat->id}}">
                          <img 
                            src="{{IMAGE}}images/cats/{{$cat->image}}"
                            srcset="{{IMAGE}}images/cats/{{$cat->image}} 1x,{{IMAGE}}images/cats/{{$cat->image}}  2x"
                            width="39" height="39" 
                            alt="{{$cat->name}}" title="{{$cat->name}}"
                            class="img-responsive" />
                          <span class="links-text">{{$cat->name}}</span>
                          <span class="count-badge ">4</span>
                        </label> <?php 
                      }
                    } 
                    else {
                      foreach($cats as $childrenCat){
                        $cat = \App\Models\Category::find($childrenCat);?>
                        <label>
                          <input
                          @if(Route::is('products.show'))
                            onclick="subcatsFilter(this, '/updateEveryThingProducts')"
                          @elseif(Route::is('search.show'))
                            onclick="subcatsFilter(this, '/updateEveryThingSearch')"
                          @elseif(Route::is('brand.show'))
                            onclick="subcatsFilter(this, '/updateEveryThingBrand')"
                          @elseif(Route::is('category.show'))
                            onclick="subcatsFilter(this, '/updateEveryThing')" 
                          @endif
                          type="radio" class="subcats" name="subcats" value="{{$cat->id}}">
                          <img 
                            src="{{IMAGE}}images/cats/{{$cat->image}}"
                            srcset="{{IMAGE}}images/cats/{{$cat->image}} 1x,{{IMAGE}}images/cats/{{$cat->image}}  2x"
                            width="39" height="39" 
                            alt="{{$cat->name}}" title="{{$cat->name}}"
                            class="img-responsive" />
                          <span class="links-text">{{$cat->name}}</span>
                          <span class="count-badge ">4</span>
                        </label> <?php 
                      } 
                    } ?>
                  </div>
                </div>
              </div>
            </div>

            <!-- Brands -->
            @if(!Route::is('brand.show'))
            <div id="updateBrands" class="module-item module-item-m image-only panel panel-active">
              <div class="panel-heading">
                <div class="panel-title">
                  <a href="#Brands"
                    class="accordion-toggle " data-toggle="collapse"
                    aria-expanded="true" data-filter="m">
                    {{ __('home.Brands') }}
                    <i class="fa fa-caret-down"></i>
                  </a>
                </div>
              </div>
              <div class="panel-collapse collapse in"
                id="Brands">
                <div class="panel-body">
                  <div class="filter-radio">
                    <?php for($i=0; $i<count($brands); $i++) { $brand = \App\Models\Brand::find($brands[$i]); ?>
                      <label>
                        <input
                        @if(Route::is('products.show'))
                          onclick="brandsFilter(this, '/updateEveryThingProducts')"
                        @elseif(Route::is('search.show'))
                          onclick="brandsFilter(this, '/updateEveryThingSearch')"
                        @elseif(Route::is('category.show'))
                          onclick="brandsFilter(this, '/updateEveryThing')" 
                        @endif
                        type="radio" name="brands" class="brands" value="{{$brand->id}}">
                        <img 
                          src="{{IMAGE}}images/brands/{{$brand->image}}"
                          srcset="{{IMAGE}}images/brands/{{$brand->image}} 1x, {{IMAGE}}images/brands/{{$brand->image}} 2x"
                          width="39" height="39" 
                          alt="{{$brand->name}}" title="{{$brand->name}}" 
                          class="img-responsive"
                          data-toggle="tooltip"
                          data-tooltip-class="filter-tooltip-36"
                          data-placement="top" 
                          data-original-title="{{$brand->name}}"/>
                        <span class="links-text">{{$brand->name}}</span>
                        <span class="count-badge ">4</span>
                      </label>
                    <?php } ?>      
                  </div>
                </div>
              </div>
            </div>
            @endif

            <!-- Color -->
            <div id="updateColor" class="module-item module-item-o11 text-only panel panel-collapsed">
              <div class="panel-heading">
                <div class="panel-title">
                  <a href="#Color"
                    class="accordion-toggle " data-toggle="collapse"
                    data-filter="o11">
                    {{ __('home.Color') }}
                    <i class="fa fa-caret-down"></i>
                  </a>
                </div>
              </div>
              <div class="panel-collapse collapse" id="Color">
                <div class="panel-body">
                  <div class="filter-checkbox">
                    <?php for($i=0; $i<count($colors); $i++) { ?>
                      <label>
                        <input
                        @if(Route::is('products.show'))
                          onclick="colorFilter(this, '/updateEveryThingProducts')"
                        @elseif(Route::is('search.show'))
                          onclick="colorFilter(this, '/updateEveryThingSearch')"
                        @elseif(Route::is('brand.show'))
                          onclick="colorFilter(this, '/updateEveryThingBrand')"
                        @elseif(Route::is('category.show'))
                          onclick="colorFilter(this, '/updateEveryThing')" 
                        @endif
                        type="checkbox" class="color" name="{{$colors[$i]}}" value="{{$colors[$i]}}">
                        <span class="links-text"
                          data-toggle="tooltip"
                          data-tooltip-class="module-products-27 module-products-grid wishlist-tooltip"
                          data-placement="right" title="{{$colors[$i]}}">
                          {{$colors[$i]}}
                        </span>
                      </label>
                    <?php } ?> 
                  </div>
                </div>
              </div>
            </div>

            <!-- Size -->
            <div id="updateSize" class="module-item module-item-o11 text-only panel panel-collapsed">
              <div class="panel-heading">
                <div class="panel-title">
                  <a href="#Size"
                    class="accordion-toggle " data-toggle="collapse"
                     data-filter="o11">
                    {{ __('home.Size') }}
                    <i class="fa fa-caret-down"></i>
                  </a>
                </div>
              </div>
              <div class="panel-collapse collapse"
                id="Size">
                <div class="panel-body">
                  <div class="filter-checkbox">
                    <?php for($i=0; $i<count($sizes); $i++) { ?>
                      <label>
                        <input 
                        @if(Route::is('products.show'))
                          onclick="sizeFilter(this, '/updateEveryThingProducts')" 
                        @elseif(Route::is('search.show'))
                          onclick="sizeFilter(this, '/updateEveryThingSearch')"
                        @elseif(Route::is('brand.show'))
                          onclick="sizeFilter(this, '/updateEveryThingBrand')"
                        @elseif(Route::is('category.show'))
                          onclick="sizeFilter(this, '/updateEveryThing')" 
                        @endif
                        type="checkbox" class="size" name="{{$sizes[$i]}}" value="{{$sizes[$i]}}">
                        <span class="links-text"
                          data-toggle="tooltip"
                          data-tooltip-class="module-products-27 module-products-grid wishlist-tooltip"
                          data-placement="right" title="{{$sizes[$i]}}">
                          {{$sizes[$i]}}
                        </span>
                      </label>
                    <?php } ?> 
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
