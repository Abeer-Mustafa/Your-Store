
<?php $top_sales20 = top_sales20(); ?>
<div class="grid-row grid-row-top-4">
  <div class="grid-cols">
    <div class="grid-col grid-col-top-4-1">
      <div class="grid-items">
        <div class="grid-item grid-item-top-4-1-1">
          <div class="module module-products module-products-27 module-products-grid">
            <div class="module-body">
              <div class="tab-container">
                <ul class="nav nav-tabs">
                  <li class="tab-1 active">
                    <a href="#products-5f17d084eccdb-tab-1" data-toggle="tab">{{ __('home.Latest') }}</a></li>
                  <li class="tab-2">
                    <a href="#products-5f17d084eccdb-tab-2" data-toggle="tab">{{ __('home.Offers') }}</a></li>
                  <li class="tab-3">
                    <a href="#products-5f17d084eccdb-tab-3" data-toggle="tab">{{ __('home.Best Rated') }}</a></li>
                  <li class="tab-4">
                    <a href="#products-5f17d084eccdb-tab-4" data-toggle="tab">{{ __('home.Best Sales') }}</a></li>
                  <li class="tab-5">
                    <a href="{{ url('/products') }}">{{ __('home.See All Products') }}</a></li>
                </ul>

                <div class="tab-content">
                  <!-- Latest -->
                  <div class="module-item module-item-1 tab-pane active" id="products-5f17d084eccdb-tab-1">
                    <div class="product-grid">
                      <?php 
                        $products= \App\Models\Product::orderBy('created_at', 'desc')->get(); 
                        $codes = array();
                        foreach ($products as $key => $pro) {
                            if( in_array($pro->code, $codes) ) $products->forget($key);
                            else array_push($codes, $pro->code);
                        }
                        $products = $products->take(8);
                      ?>
                      @foreach($products as $pro)
                      <div class="product-layout  has-extra-button">
                        <div class="product-thumb">
                          <div class="image">
                            <!-- Quickview -->
                            <div class="quickview-button">
                              <a class="btn btn-quickview" data-toggle="modal" data-target="#ProductQuickView_{{$pro->id}}"
                                data-tooltip-class="module-products-27 module-products-grid quickview-tooltip"
                                data-placement="top" title="{{ __('home.Quickview') }}">
                                <span class="btn-text">{{ __('home.Quickview') }}</span>
                              </a>
                            </div>
                            <!-- Image -->
                            <a href="{{ url('/product').'/'.$pro->id}}"
                              class="product-img has-second-image">
                              <div>
                                <img
                                  src="{{IMAGE}}images/products/{{$pro->image}}"
                                  data-src="{{IMAGE}}images/products/{{$pro->image}}"
                                  data-srcset="{{IMAGE}}images/products/{{$pro->image}} 1x, {{IMAGE}}images/products/{{$pro->image}} 2x"
                                  width="250" height="250" alt="{{$pro->name}}"
                                  title="{{$pro->name}}" class="img-responsive img-first lazyload" /> 
                                <img
                                  src="{{IMAGE}}images/products/{{$pro->image}}"
                                  data-src="{{IMAGE}}images/products/{{$pro->image}}"
                                  data-srcset="{{IMAGE}}images/products/{{$pro->image}} 1x, {{IMAGE}}images/products/{{$pro->image}} 2x"
                                  width="250" height="250" alt="{{$pro->name}}"
                                  title="{{$pro->name}}" class="img-responsive img-second lazyload" />
                              </div>
                            </a>

                            <!-- Labels -->
                            <div class="product-labels">
                              <?php $news= \App\Models\Product::orderBy('created_at', 'desc')->pluck('id')->take(30)->toArray();?>
                              @if(in_array($pro->id, $news))<span class="product-label product-label-29 product-label-default"><b>{{ __('home.New') }}</b></span>@endif
                              @if($pro->stock == 0)<span class="product-label product-label-146 product-label-diagonal"><b>{{ __('home.Out of Stock') }}</b></span>@endif
                              @if($pro->discount)<span class="product-label product-label-28 product-label-default"><b>-{{$pro->discount}}%</b></span>@endif
                              @if(array_key_exists($pro->id,$top_sales20))<span class="product-label product-label-217 product-label-default"><b>{{ __('home.Top Sales') }}</b></span>@endif
                            </div>
                          </div>

                          <div class="caption">
                            <div class="stats">
                              <span class="stat-1">
                                <span class="stats-label">{{ __('home.Brand') }}:</span>
                                <span>
                                  <?php $brand = \App\Models\Brand::where('id', '=', $pro->brand_id)->first();?>
                                  <a href="{{ url('/brand').'/'.$brand->id}}">{{$brand->name}}</a>
                                </span>
                              </span>
                            </div>
                            <div class="name"> <a href="{{ url('/product').'/'.$pro->id}}">{{$pro->name}}</a> </div>
                            <div class="price">
                              <?php 
                                $currency = session()->get('cur_currency');
                                $symbol = session()->get('cur_symbol');
                                $old_price = $pro->price*$currency;
                                $new_price = $old_price - $pro->discount * $old_price /100 ;
                              ?>
                              <div>
                                @if($pro->discount)
                                <span class="price-new">{{ $symbol .' '. $new_price }}</span>
                                <span class="price-old">{{ $old_price }}</span>
                                @else
                                <span class="price-normal">{{ $symbol .' '. $old_price }}</span>
                                @endif
                              </div>
                            </div>
                            <!-- Cart | Wishlist -->
                            <div class="buttons-wrapper">
                              <div class="button-group">
                                <!-- Add to Cart -->
                                <div class="cart-group">
                                  <a class="btn btn-cart" data-toggle="modal" data-target="#ProductOptions_{{$pro->id}}">
                                    <span class="btn-text">{{ __('home.Add to Cart') }}</span>
                                  </a>
                                </div>
                                <!-- Add to Wishlist -->
                                
                              </div>
                            </div>

                            <!-- Buy Now | Add to Wishlist-->
                            <div class="extra-group">
                              <div>
                                <a class="btn btn-extra btn-extra-46"
                                  data-toggle="modal" data-target="#Buy_Now_{{$pro->id}}" >
                                  <span class="btn-text GreenText">{{ __('home.Buy Now') }}</span>
                                </a>
                                <a class="btn btn-extra btn-extra-93 add_to_wish_list"
                                  data-product-id="{{$pro->id}}"
                                  data-loading-text="<span class='btn-text'>{{__('home.Add to Wishlist')}}</span>">
                                  <span class="btn-text RedText">{{ __('home.Add to Wishlist') }}</span>
                                </a>
                              </div>
                            </div>

                          </div>
                        </div>
                      </div>

                      <!-- Modal | QuickView -->
                      <div class="modal fade" id="ProductQuickView_{{$pro->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                          <div class="modal-content">
                            <div class="modal-header backgroundBlue">
                              <h5 class="modal-title ModelName" style="text-align:center;" id="exampleModalLongTitle">{{$pro->name}}</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true" style="position: absolute; top: -27px; right: 10px;">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body backgroundGray">
                              <div class="row">
                                <div class="product-info has-extra-button ">
                                  <!-- Main Image -->
                                  <div class="product-left">
                                    <div class="product-image direction-horizontal position-bottom">
                                      <div class="swiper main-image swiper-has-pages" data-options='{"speed":0,"autoplay":false,"pauseOnHover":false,"loop":false}'>
                                        <div class="swiper-container swiper-container-horizontal">
                                          <div class="swiper-wrapper" style="transform: translate3d(0px, 0px, 0px); transition-duration: 0ms;">
                                            <div class="swiper-slide swiper-slide-visible swiper-slide-active" style="width: 331px;">
                                              
                                              <img
                                                src="{{IMAGE}}images/products/{{$pro->image}}"
                                                srcset="{{IMAGE}}images/products/{{$pro->image}} 2x"
                                                alt="{{$pro->name}}" title="{{$pro->name}}" width="550" height="550" />
                                            </div>

                                          </div>
                                          <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
                                        </div>

                                        <!-- Labels -->
                                          <div class="product-labels">
                                            <?php $news= \App\Models\Product::orderBy('created_at', 'desc')->pluck('id')->take(30)->toArray();?>
                                            @if(in_array($pro->id, $news))<span class="product-label product-label-29 product-label-default"><b>{{ __('home.New') }}</b></span>@endif
                                            @if(array_key_exists($pro->id,$top_sales20))<span class="product-label product-label-217 product-label-default"><b>{{ __('home.Top Sales') }}</b></span>@endif
                                            @if($pro->stock == 0)<span class="product-label product-label-146 product-label-diagonal"><b>{{ __('home.Out of Stock') }}</b></span>@endif
                                            @if($pro->discount)<span class="product-label product-label-28 product-label-default"><b>-{{$pro->discount}}%</b></span>@endif
                                          </div>
                                      </div>
                                    </div>
                                  </div>

                                  <div class="product-right">
                                    <div id="product" class="product-details">
                                      <div class="title page-title ">{{$pro->name}}</div>
                                      
                                      <!-- Description -->
                                      <div class="description">
                                        <p>{{$pro->description}}</p>
                                      </div>
                                       
                                      <!-- Stock | Brand -->
                                      <div class="product-stats">
                                        <ul class="list-unstyled">
                                          <?php 
                                            $brand = \App\Models\Brand::where('id', $pro->brand_id)->first();
                                            $codes = \App\Models\Product::where('code', $pro->code)->get(); 
                                            $stock = 0;
                                            foreach ($codes as $code) $stock += $code->stock;
                                          ?>
                                          <li class="product-stock in-stock"><b>{{ __('home.Stock') }}:</b> <span>{{$stock}}</span></li>
                                          <li class="product-manufacturer"><b>{{ __('home.Brand') }}:</b><a href="{{url('/brand')}}/{{$brand->id}}" target="_blank">{{$brand->name}}</a></li>
                                        </ul>
                                      </div>

                                      <!-- Price -->
                                      <div class="product-price-group">
                                        <div class="price-wrapper">
                                          <div class="price-group">
                                            <?php 
                                              $currency = session()->get('cur_currency');
                                              $symbol = session()->get('cur_symbol');
                                              $old_price = $pro->price*$currency;
                                              $new_price = $old_price - $pro->discount * $old_price /100 ;
                                            ?>
                                            @if($pro->discount)
                                              <div class="product-price-new">{{ $symbol .' '. $new_price }}</div>
                                              <div class="product-price-old">{{ $old_price }}</div>
                                            @else
                                              <div class="product-price-new">{{ $symbol .' '. $new_price }}</div>
                                            @endif
                                          </div>
                                          <!-- <div class="product-tax">Ex Tax: $999.00</div> -->
                                        </div>
                                      </div>

                                      <!-- Rating -->
                                      <div class="product-stats">
                                        <ul class="list-unstyled">
                                          <li class="product-stock in-stock"><b>{{ __('home.Rating') }}: </b>
                                            <div class="rating-stars">
                                              
                                              <span class="fa fa-stack" style=" color: rgba(255, 214, 0, 1); ">
                                                <?php 
                                                  if($pro->rating < 1 && $pro->rating > 0) echo '<i class="fa fa-star-half fa-stack-1x" ></i>';
                                                  elseif($pro->rating < 1) echo '<i class="fa fa-star-o fa-stack-1x" ></i>';
                                                  else echo '<i class="fa fa-star fa-stack-1x" ></i>';
                                                ?>
                                              </span>
                                              <span class="fa fa-stack" style=" color: rgba(255, 214, 0, 1); ">
                                                <?php 
                                                  if($pro->rating < 2 && $pro->rating > 1) echo '<i class="fa fa-star-half fa-stack-1x" ></i>';
                                                  elseif($pro->rating < 2) echo '<i class="fa fa-star-o fa-stack-1x" ></i>';
                                                  else echo '<i class="fa fa-star fa-stack-1x" ></i>';
                                                ?>
                                              </span>
                                              <span class="fa fa-stack" style=" color: rgba(255, 214, 0, 1); ">
                                                <?php 
                                                  if($pro->rating < 3 && $pro->rating > 2) echo '<i class="fa fa-star-half fa-stack-1x" ></i>';
                                                  elseif($pro->rating < 3) echo '<i class="fa fa-star-o fa-stack-1x" ></i>';
                                                  else echo '<i class="fa fa-star fa-stack-1x" ></i>';
                                                ?>
                                              </span>
                                              <span class="fa fa-stack" style=" color: rgba(255, 214, 0, 1); ">
                                                <?php 
                                                  if($pro->rating < 4 && $pro->rating > 3) echo '<i class="fa fa-star-half fa-stack-1x" ></i>';
                                                  elseif($pro->rating < 4) echo '<i class="fa fa-star-o fa-stack-1x" ></i>';
                                                  else echo '<i class="fa fa-star fa-stack-1x" ></i>';
                                                ?>
                                              </span>
                                              <span class="fa fa-stack" style=" color: rgba(255, 214, 0, 1); ">
                                                <?php 
                                                  if($pro->rating < 5 && $pro->rating > 4) echo '<i class="fa fa-star-half fa-stack-1x" ></i>';
                                                  elseif($pro->rating < 5) echo '<i class="fa fa-star-o fa-stack-1x" ></i>';
                                                  else echo '<i class="fa fa-star fa-stack-1x" ></i>';
                                                ?>
                                              </span>
                                            </div>
                                          </li>
                                        </ul>
                                      </div>

                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="modal-footer backgroundBlue">
                              <div class="button-group-page">
                                <div class="buttons-wrapper">
                                  <div class="wishlist-compare text-center">
                                    <a 
                                      class="btn btn-more-details CustomStyle"
                                      href="{{ url('/product').'/'.$pro->id}}"
                                      target="_top"
                                      data-toggle="tooltip"
                                      data-tooltip-class="more-details-tooltip"
                                      data-placement="top"
                                      title
                                      data-original-title="More Details"
                                      >
                                      <span class="btn-text">{{ __('home.More Details') }}</span>
                                    </a>
                                  </div>
                                </div>
                              </div>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>

                      <!-- Model | Latest | Add to Cart -->
                      <div class="modal fade" id="ProductOptions_{{$pro->id}}" tabindex="-1" role="dialog" aria-labelledby="ModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" style="width:400px;" role="document">
                          <div class="modal-content">
                            <div class="modal-header backgroundBlue">
                              <h5 class="modal-title ModelName" style="text-align:center;" id="ModalCenterTitle">{{$pro->name}}</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true" style="position: absolute; top: -27px; right: 10px;">&times;</span>
                              </button>
                            </div>

                            <div class="modal-body">
                              <div class="product-info out-of-stock has-extra-button " style="margin:auto 10%;">

                                <div id="product" class="product-details">
                                  <form id="form_cart_{{$pro->id}}">
                                    <div id="content_{{$pro->id}}">
                                      <div class="product-options">
                                        <h3 class="options-title title">{{ __('home.Available Options') }}</h3>
                                        <!-- Color -->
                                        @if($pro->color)
                                        <div class="form-group required product-option-select">
                                          <label class="control-label" for="color_{{$pro->id}}">{{__('home.Color')}}</label>
                                          <?php 
                                          $colores = [];
                                          $all_colores = \App\Models\Product::where('code', $pro->code)->get();
                                          foreach ($all_colores as $color) {
                                            $new_color = $color->color;
                                            if(!in_array($new_color, $colores))array_push($colores, $new_color);
                                          }
                                          ?>
                                          <input type="hidden" id="code_{{$pro->id}}" value="{{$pro->code}}">
                                          <select name="color_{{$pro->id}}" id="color_{{$pro->id}}" onchange="selectSize({{$pro->id}}, 'code_', 'color_', 'size_', 'size')" class="form-control">
                                            <option value=""> --- {{ __('home.Please Select') }} ---</option>
                                            @foreach ($colores as $color)
                                              <option value="{{$color}}">{{$color}}</option>
                                            @endforeach
                                          </select>
                                        </div>
                                        @endif

                                        <!-- Size -->
                                        @if($pro->size)
                                        <div class="form-group required product-option-select">
                                          <label class="control-label" for="size_{{$pro->id}}">{{__('home.Size')}}</label>
                                          <select name="size_{{$pro->id}}" id="size_{{$pro->id}}" class="form-control">
                                            <option value=""> --- {{ __('home.Please Select') }} ---</option>
                                            @if(!$pro->color)
                                              <?php $all_size = \App\Models\Product::where('code', $pro->code)->get(); ?>
                                              @foreach ($all_size as $size)
                                                <option value="{{$size->size}}">{{$size->size}}</option>
                                              @endforeach
                                            @endif
                                          </select>
                                        </div>
                                        @endif
                                      </div>

                                      <div class="button-group-page">
                                        <div class="buttons-wrapper">
                                          <div id="QTYError_{{$pro->id}}" ></div>
                                          <div class="stepper-group cart-group">
                                            <!-- Qty -->
                                            <div class="stepper form-group input-group">
                                              <label class="control-label" for="quantity_{{$pro->id}}">{{ __('home.Qty') }}</label>
                                              <input  id="quantity_{{$pro->id}}" type="text" name="quantity_{{$pro->id}}"  value="1"  data-minimum="1" class="form-control" />
                                              <input id="product_id_{{$pro->id}}" type="hidden" name="product_id_{{$pro->id}}" value="{{$pro->id}}"/>
                                              <span>
                                                <i class="fa fa-angle-up"></i>
                                                <i class="fa fa-angle-down"></i>
                                              </span>
                                            </div>
                                            <!-- Add to Cart -->
                                            <button
                                              id="button_cart_{{$pro->id}}"
                                              type="submit"
                                              onclick="addToCart(event, {{$pro->id}}, 'form_cart_', 'button_cart_', '', 'QTYError_', 'content_', 'ProductOptions_', 'quantity_')"
                                              data-loading-text="<span class='btn-text'>{{ __('home.Add to Cart') }}</span>"
                                              class="btn btn-cart"
                                              style="margin: 0 0 6px 6px;">
                                              {{ __('home.Add to Cart') }}
                                            </button>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </form>
                                </div>

                              </div>
                            </div>
                          </div>
                        </div>
                      </div> 

                      <!-- Model | Latest | Buy Now -->
                      <div class="modal fade" id="Buy_Now_{{$pro->id}}" tabindex="-1" role="dialog" aria-labelledby="ModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" style="width:400px;" role="document">
                          <div class="modal-content">
                            <div class="modal-header backgroundBlue">
                              <h5 class="modal-title ModelName" style="text-align:center;" id="ModalCenterTitle">{{$pro->name}}</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true" style="position: absolute; top: -27px; right: 10px;">&times;</span>
                              </button>
                            </div>

                            <div class="modal-body">
                              <div class="product-info out-of-stock has-extra-button " style="margin:auto 10%;">

                                <div id="product" class="product-details">
                                  <form id="buy_form_cart_{{$pro->id}}">
                                    <div id="buy_content_{{$pro->id}}">
                                      <div class="product-options">
                                        <h3 class="options-title title">{{ __('home.Available Options') }}</h3>
                                        <!-- Color -->
                                        @if($pro->color)
                                        <div class="form-group required product-option-select">
                                          <label class="control-label" for="buy_color_{{$pro->id}}">{{__('home.Color')}}</label>
                                          <?php 
                                          $colores = [];
                                          $all_colores = \App\Models\Product::where('code', $pro->code)->get();
                                          foreach ($all_colores as $color) {
                                            $new_color = $color->color;
                                            if(!in_array($new_color, $colores))array_push($colores, $new_color);
                                          }
                                          ?>
                                          <input type="hidden" id="buy_code_{{$pro->id}}" value="{{$pro->code}}">
                                          <select name="color_{{$pro->id}}" id="buy_color_{{$pro->id}}" onchange="selectSize({{$pro->id}}, 'buy_code_', 'buy_color_', 'buy_size_', 'size')" class="form-control">
                                            <option value=""> --- {{ __('home.Please Select') }} ---</option>
                                            @foreach ($colores as $color)
                                              <option value="{{$color}}">{{$color}}</option>
                                            @endforeach
                                          </select>
                                        </div>
                                        @endif

                                        <!-- Size -->
                                        @if($pro->size)
                                        <div class="form-group required product-option-select">
                                          <label class="control-label" for="buy_size_{{$pro->id}}">{{__('home.Size')}}</label>
                                          <select name="size_{{$pro->id}}" id="buy_size_{{$pro->id}}" class="form-control">
                                            <option value=""> --- {{ __('home.Please Select') }} ---</option>
                                            @if(!$pro->color)
                                              <?php $all_size = \App\Models\Product::where('code', $pro->code)->get(); ?>
                                              @foreach ($all_size as $size)
                                                <option value="{{$size->size}}">{{$size->size}}</option>
                                              @endforeach
                                            @endif
                                          </select>
                                        </div>
                                        @endif
                                      </div>

                                      <div class="button-group-page">
                                        <div class="buttons-wrapper">
                                          <div id="buy_QTYError_{{$pro->id}}" ></div>
                                          <div class="stepper-group cart-group">
                                            <!-- Qty -->
                                            <div class="stepper form-group input-group">
                                              <label class="control-label" for="quantity_{{$pro->id}}">{{ __('home.Qty') }}</label>
                                              <input  id="buy_quantity_{{$pro->id}}" type="text" name="quantity_{{$pro->id}}"  value="1"  data-minimum="1" class="form-control" />
                                              <input id="buy_product_id_{{$pro->id}}" type="hidden" name="product_id_{{$pro->id}}" value="{{$pro->id}}"/>
                                              <span>
                                                <i class="fa fa-angle-up"></i>
                                                <i class="fa fa-angle-down"></i>
                                              </span>
                                            </div>
                                            <!-- Buy Now -->
                                            <button
                                              id="buy_now_btn_{{$pro->id}}"
                                              type="submit"
                                              onclick="buyNowAdd(event, {{$pro->id}}, 'buy_form_cart_', 'buy_now_btn_', 'buy_', 'buy_QTYError_', 'Buy_Now_', 'buy_quantity_')"
                                              data-loading-text="<span class='btn-text'>{{__('home.Buy Now')}}</span>"
                                              class="btn btn-cart"
                                              style="margin: 0 0 6px 6px;">
                                              {{ __('home.Buy Now') }}
                                            </button>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </form>
                                </div>

                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                     
                      @endforeach
                    </div>
                  </div>




















                  <!-- Offers -->
                  <div class="module-item module-item-2 tab-pane" id="products-5f17d084eccdb-tab-2">
                    <div class="product-grid">
                      <?php 
                        $products= \App\Models\Product::orderBy('discount', 'desc')->get(); 
                        $codes = array();
                        foreach ($products as $key => $pro) {
                            if( in_array($pro->code, $codes) ) $products->forget($key);
                            else array_push($codes, $pro->code);
                        }
                        $products = $products->take(8);
                      ?>
                      @foreach($products as $pro)
                      <div class="product-layout  has-extra-button">
                        <div class="product-thumb">
                          <div class="image">
                            <!-- Quickview -->
                            <div class="quickview-button">
                              <a class="btn btn-quickview" data-toggle="modal" data-target="#offers_ProductQuickView_{{$pro->id}}"
                                data-tooltip-class="module-products-27 module-products-grid quickview-tooltip"
                                data-placement="top" title="{{ __('home.Quickview') }}">
                                <span class="btn-text">{{ __('home.Quickview') }}</span>
                              </a>
                            </div>
                            <!-- Image -->
                            <a href="{{ url('/product').'/'.$pro->id}}"
                              class="product-img has-second-image">
                              <div>
                                <img
                                  src="{{IMAGE}}images/products/{{$pro->image}}"
                                  data-src="{{IMAGE}}images/products/{{$pro->image}}"
                                  data-srcset="{{IMAGE}}images/products/{{$pro->image}} 1x, {{IMAGE}}images/products/{{$pro->image}} 2x"
                                  width="250" height="250" alt="{{$pro->name}}"
                                  title="{{$pro->name}}" class="img-responsive img-first lazyload" /> 
                                <img
                                  src="{{IMAGE}}images/products/{{$pro->image}}"
                                  data-src="{{IMAGE}}images/products/{{$pro->image}}"
                                  data-srcset="{{IMAGE}}images/products/{{$pro->image}} 1x, {{IMAGE}}images/products/{{$pro->image}} 2x"
                                  width="250" height="250" alt="{{$pro->name}}"
                                  title="{{$pro->name}}" class="img-responsive img-second lazyload" />
                              </div>
                            </a>

                            <!-- Labels -->
                            <div class="product-labels">
                              <?php $news= \App\Models\Product::orderBy('created_at', 'desc')->pluck('id')->take(30)->toArray();?>
                              @if(in_array($pro->id, $news))<span class="product-label product-label-29 product-label-default"><b>{{ __('home.New') }}</b></span>@endif
                              @if($pro->stock == 0)<span class="product-label product-label-146 product-label-diagonal"><b>{{ __('home.Out of Stock') }}</b></span>@endif
                              @if($pro->discount)<span class="product-label product-label-28 product-label-default"><b>-{{$pro->discount}}%</b></span>@endif
                              @if(array_key_exists($pro->id,$top_sales20))<span class="product-label product-label-217 product-label-default"><b>{{ __('home.Top Sales') }}</b></span>@endif
                            </div>
                          </div>

                          <div class="caption">
                            <div class="stats">
                              <span class="stat-1">
                                <span class="stats-label">{{ __('home.Brand') }}:</span>
                                <span>
                                  <?php $brand = \App\Models\Brand::where('id', '=', $pro->brand_id)->first();?>
                                  <a href="{{ url('/brand').'/'.$brand->id}}">{{$brand->name}}</a>
                                </span>
                              </span>
                            </div>
                            <div class="name">
                              <a href="{{ url('/product').'/'.$pro->id}}">{{$pro->name}}</a>
                            </div>
                            <div class="price">
                              <?php 
                                $currency = session()->get('cur_currency');
                                $symbol = session()->get('cur_symbol');
                                $old_price = $pro->price*$currency;
                                $new_price = $old_price - $pro->discount * $old_price /100 ;
                              ?>
                              <div>
                                @if($pro->discount)
                                <span class="price-new">{{ $symbol .' '. $new_price }}</span>
                                <span class="price-old">{{ $old_price }}</span>
                                @else
                                <span class="price-normal">{{ $symbol .' '. $old_price }}</span>
                                @endif
                              </div>
                            </div>
                            <!-- Cart | Wishlist -->
                            <div class="buttons-wrapper">
                              <div class="button-group">
                                <!-- Add to Cart -->
                                <div class="cart-group">
                                  <a class="btn btn-cart" data-toggle="modal" data-target="#offers_ProductOptions_{{$pro->id}}">
                                    <span class="btn-text">{{ __('home.Add to Cart') }}</span>
                                  </a>
                                </div>
                                
                              </div>
                            </div>

                            <!-- Buy Now | Add to Wishlist-->
                            <div class="extra-group">
                              <div>
                                <a class="btn btn-extra btn-extra-46"
                                  data-toggle="modal" data-target="#offers_Buy_Now_{{$pro->id}}" >
                                  <span class="btn-text">{{__('home.Buy Now')}}</span>
                                </a>
                                <a class="btn btn-extra btn-extra-93 add_to_wish_list"
                                  data-product-id="{{$pro->id}}"
                                  data-loading-text="<span class='btn-text'>{{__('home.Add to Wishlist')}}</span>">
                                  <span class="btn-text RedText">{{__('home.Add to Wishlist')}}</span>
                                </a>
                              </div>
                            </div>

                          </div>
                        </div>
                      </div>

                      <!-- Modal | QuickView -->
                      <div class="modal fade" id="offers_ProductQuickView_{{$pro->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                          <div class="modal-content">
                            <div class="modal-header backgroundBlue">
                              <h5 class="modal-title ModelName" style="text-align:center;" id="exampleModalLongTitle">{{$pro->name}}</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true" style="position: absolute; top: -27px; right: 10px;">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body backgroundGray">
                              <div class="row">
                                <div class="product-info has-extra-button ">
                                  <!-- Main Image -->
                                  <div class="product-left">
                                    <div class="product-image direction-horizontal position-bottom">
                                      <div class="swiper main-image swiper-has-pages" data-options='{"speed":0,"autoplay":false,"pauseOnHover":false,"loop":false}'>
                                        <div class="swiper-container swiper-container-horizontal">
                                          <div class="swiper-wrapper" style="transform: translate3d(0px, 0px, 0px); transition-duration: 0ms;">
                                            <div class="swiper-slide swiper-slide-visible swiper-slide-active" style="width: 331px;">
                                              
                                              <img
                                                src="{{IMAGE}}images/products/{{$pro->image}}"
                                                srcset="{{IMAGE}}images/products/{{$pro->image}} 2x"
                                                alt="{{$pro->name}}" title="{{$pro->name}}" width="550" height="550" />
                                            </div>

                                          </div>
                                          <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
                                        </div>

                                        <!-- Labels -->
                                          <div class="product-labels">
                                            <?php $news= \App\Models\Product::orderBy('created_at', 'desc')->pluck('id')->take(30)->toArray();?>
                                            @if(in_array($pro->id, $news))<span class="product-label product-label-29 product-label-default"><b>{{ __('home.New') }}</b></span>@endif
                                            @if(array_key_exists($pro->id,$top_sales20))<span class="product-label product-label-217 product-label-default"><b>{{ __('home.Top Sales') }}</b></span>@endif
                                            @if($pro->stock == 0)<span class="product-label product-label-146 product-label-diagonal"><b>{{ __('home.Out of Stock') }}</b></span>@endif
                                            @if($pro->discount)<span class="product-label product-label-28 product-label-default"><b>-{{$pro->discount}}%</b></span>@endif
                                          </div>
                                      </div>
                                    </div>
                                  </div>

                                  <div class="product-right">
                                    <div id="product" class="product-details">
                                      <div class="title page-title ">{{$pro->name}}</div>
                                      
                                      <!-- Description -->
                                      <div class="description">
                                        <p>{{$pro->description}}</p>
                                      </div>
                                       
                                      <!-- Stock | Brand -->
                                      <div class="product-stats">
                                        <ul class="list-unstyled">
                                          <?php 
                                            $brand = \App\Models\Brand::where('id', $pro->brand_id)->first();
                                            $codes = \App\Models\Product::where('code', $pro->code)->get(); 
                                            $stock = 0;
                                            foreach ($codes as $code) $stock += $code->stock;
                                          ?>
                                          <li class="product-stock in-stock"><b>{{__('home.Stock')}}:</b> <span>{{$stock}}</span></li>
                                          <li class="product-manufacturer"><b>{{__('home.Brand')}}:</b><a href="{{url('/brand')}}/{{$brand->id}}" target="_blank">{{$brand->name}}</a></li>
                                        </ul>
                                      </div>

                                      <!-- Price -->
                                      <div class="product-price-group">
                                        <div class="price-wrapper">
                                          <div class="price-group">
                                            <?php 
                                              $currency = session()->get('cur_currency');
                                              $symbol = session()->get('cur_symbol');
                                              $old_price = $pro->price*$currency;
                                              $new_price = $old_price - $pro->discount * $old_price /100 ;
                                            ?>
                                            @if($pro->discount)
                                              <div class="product-price-new">{{ $symbol .' '. $new_price }}</div>
                                              <div class="product-price-old">{{ $old_price }}</div>
                                            @else
                                              <div class="product-price-new">{{ $symbol .' '. $new_price }}</div>
                                            @endif
                                          </div>
                                          <!-- <div class="product-tax">Ex Tax: $999.00</div> -->
                                        </div>
                                      </div>

                                      <!-- Rating -->
                                      <div class="product-stats">
                                        <ul class="list-unstyled">
                                          <li class="product-stock in-stock"><b>{{__('home.Rating')}}: </b>
                                            <div class="rating-stars">
                                              
                                              <span class="fa fa-stack" style=" color: rgba(255, 214, 0, 1); ">
                                                <?php 
                                                  if($pro->rating < 1 && $pro->rating > 0) echo '<i class="fa fa-star-half fa-stack-1x" ></i>';
                                                  elseif($pro->rating < 1) echo '<i class="fa fa-star-o fa-stack-1x" ></i>';
                                                  else echo '<i class="fa fa-star fa-stack-1x" ></i>';
                                                ?>
                                              </span>
                                              <span class="fa fa-stack" style=" color: rgba(255, 214, 0, 1); ">
                                                <?php 
                                                  if($pro->rating < 2 && $pro->rating > 1) echo '<i class="fa fa-star-half fa-stack-1x" ></i>';
                                                  elseif($pro->rating < 2) echo '<i class="fa fa-star-o fa-stack-1x" ></i>';
                                                  else echo '<i class="fa fa-star fa-stack-1x" ></i>';
                                                ?>
                                              </span>
                                              <span class="fa fa-stack" style=" color: rgba(255, 214, 0, 1); ">
                                                <?php 
                                                  if($pro->rating < 3 && $pro->rating > 2) echo '<i class="fa fa-star-half fa-stack-1x" ></i>';
                                                  elseif($pro->rating < 3) echo '<i class="fa fa-star-o fa-stack-1x" ></i>';
                                                  else echo '<i class="fa fa-star fa-stack-1x" ></i>';
                                                ?>
                                              </span>
                                              <span class="fa fa-stack" style=" color: rgba(255, 214, 0, 1); ">
                                                <?php 
                                                  if($pro->rating < 4 && $pro->rating > 3) echo '<i class="fa fa-star-half fa-stack-1x" ></i>';
                                                  elseif($pro->rating < 4) echo '<i class="fa fa-star-o fa-stack-1x" ></i>';
                                                  else echo '<i class="fa fa-star fa-stack-1x" ></i>';
                                                ?>
                                              </span>
                                              <span class="fa fa-stack" style=" color: rgba(255, 214, 0, 1); ">
                                                <?php 
                                                  if($pro->rating < 5 && $pro->rating > 4) echo '<i class="fa fa-star-half fa-stack-1x" ></i>';
                                                  elseif($pro->rating < 5) echo '<i class="fa fa-star-o fa-stack-1x" ></i>';
                                                  else echo '<i class="fa fa-star fa-stack-1x" ></i>';
                                                ?>
                                              </span>
                                            </div>
                                          </li>
                                        </ul>
                                      </div>

                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="modal-footer backgroundBlue">
                              <div class="button-group-page">
                                <div class="buttons-wrapper">
                                  <div class="wishlist-compare text-center">
                                    <a 
                                      class="btn btn-more-details CustomStyle"
                                      href="{{ url('/product').'/'.$pro->id}}"
                                      target="_top"
                                      data-toggle="tooltip"
                                      data-tooltip-class="more-details-tooltip"
                                      data-placement="top"
                                      title
                                      data-original-title="More Details"
                                      >
                                      <span class="btn-text">{{__('home.More Details')}}</span>
                                    </a>
                                  </div>
                                </div>
                              </div>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>

                      <!-- Model | Offers | Add to Cart -->
                      <div class="modal fade" id="offers_ProductOptions_{{$pro->id}}" tabindex="-1" role="dialog" aria-labelledby="ModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" style="width:400px;" role="document">
                          <div class="modal-content">
                            <div class="modal-header backgroundBlue">
                              <h5 class="modal-title ModelName" style="text-align:center;" id="ModalCenterTitle">{{$pro->name}}</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true" style="position: absolute; top: -27px; right: 10px;">&times;</span>
                              </button>
                            </div>

                            <div class="modal-body">
                              <div class="product-info out-of-stock has-extra-button " style="margin:auto 10%;">

                                <div id="product" class="product-details">
                                  <form id="offers_form_cart_{{$pro->id}}">
                                    <div id="offers_content_{{$pro->id}}">
                                      <div class="product-options">
                                        <h3 class="options-title title">{{__('home.Available Options')}}</h3>
                                        <!-- Color -->
                                        @if($pro->color)
                                        <div class="form-group required product-option-select">
                                          <label class="control-label" for="offers_color_{{$pro->id}}">{{__('home.Color')}}</label>
                                          <?php 
                                          $colores = [];
                                          $all_colores = \App\Models\Product::where('code', $pro->code)->get();
                                          foreach ($all_colores as $color) {
                                            $new_color = $color->color;
                                            if(!in_array($new_color, $colores))array_push($colores, $new_color);
                                          }
                                          ?>
                                          <input type="hidden" id="offers_code_{{$pro->id}}" value="{{$pro->code}}">
                                          <select name="color_{{$pro->id}}" id="offers_color_{{$pro->id}}" onchange="selectSize({{$pro->id}}, 'offers_code_', 'offers_color_', 'offers_size_', 'offers_size_')" class="form-control">
                                            <option value=""> --- {{__('home.Please Select')}} ---</option>
                                            @foreach ($colores as $color)
                                              <option value="{{$color}}">{{$color}}</option>
                                            @endforeach
                                          </select>
                                        </div>
                                        @endif

                                        <!-- Size -->
                                        @if($pro->size)
                                        <div class="form-group required product-option-select">
                                          <label class="control-label" for="offers_size_{{$pro->id}}">{{__('home.Size')}}</label>
                                          <select name="size_{{$pro->id}}" id="offers_size_{{$pro->id}}" class="form-control">
                                            <option value=""> --- {{__('home.Please Select')}} ---</option>
                                            @if(!$pro->color)
                                              <?php $all_size = \App\Models\Product::where('code', $pro->code)->get(); ?>
                                              @foreach ($all_size as $size)
                                                <option value="{{$size->size}}">{{$size->size}}</option>
                                              @endforeach
                                            @endif
                                          </select>
                                        </div>
                                        @endif
                                      </div>

                                      <div class="button-group-page">
                                        <div class="buttons-wrapper">
                                          <div id="offers_QTYError_{{$pro->id}}" ></div>
                                          <div class="stepper-group cart-group">
                                            <!-- Qty -->
                                            <div class="stepper form-group input-group">
                                              <label class="control-label" for="quantity_{{$pro->id}}">Qty</label>
                                              <input  id="offers_quantity_{{$pro->id}}" type="text" name="quantity_{{$pro->id}}"  value="1"  data-minimum="1" class="form-control" />
                                              <input id="offers_product_id_{{$pro->id}}" type="hidden" name="product_id_{{$pro->id}}" value="{{$pro->id}}"/>
                                              <span>
                                                <i class="fa fa-angle-up"></i>
                                                <i class="fa fa-angle-down"></i>
                                              </span>
                                            </div>
                                            <!-- Add to Cart -->
                                            <button
                                              id="offers_button_cart_{{$pro->id}}"
                                              type="submit"
                                              onclick="addToCart(event, {{$pro->id}}, 'offers_form_cart_', 'offers_button_cart_', 'offers_', 'offers_QTYError_', 'offers_content_', 'offers_ProductOptions_', 'offers_quantity_')"
                                              data-loading-text="<span class='btn-text'>{{ __('home.Add to Cart') }}</span>"
                                              class="btn btn-cart"
                                              style="margin: 0 0 6px 6px;">
                                              {{ __('home.Add to Cart') }}
                                            </button>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </form>
                                </div>

                              </div>
                            </div>
                          </div>
                        </div>
                      </div> 

                      <!-- Model | Offers | Buy Now -->
                      <div class="modal fade" id="offers_Buy_Now_{{$pro->id}}" tabindex="-1" role="dialog" aria-labelledby="ModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" style="width:400px;" role="document">
                          <div class="modal-content">
                            <div class="modal-header backgroundBlue">
                              <h5 class="modal-title ModelName" style="text-align:center;" id="ModalCenterTitle">{{$pro->name}}</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true" style="position: absolute; top: -27px; right: 10px;">&times;</span>
                              </button>
                            </div>

                            <div class="modal-body">
                              <div class="product-info out-of-stock has-extra-button " style="margin:auto 10%;">

                                <div id="product" class="product-details">
                                  <form id="offers_buy_form_cart_{{$pro->id}}">
                                    <div id="offers_buy_content_{{$pro->id}}">
                                      <div class="product-options">
                                        <h3 class="options-title title">{{__('home.Available Options')}}</h3>
                                        <!-- Color -->
                                        @if($pro->color)
                                        <div class="form-group required product-option-select">
                                          <label class="control-label" for="offers_buy_color_{{$pro->id}}">{{__('home.Color')}}</label>
                                          <?php 
                                          $colores = [];
                                          $all_colores = \App\Models\Product::where('code', $pro->code)->get();
                                          foreach ($all_colores as $color) {
                                            $new_color = $color->color;
                                            if(!in_array($new_color, $colores))array_push($colores, $new_color);
                                          }
                                          ?>
                                          <input type="hidden" id="offers_buy_code_{{$pro->id}}" value="{{$pro->code}}">
                                          <select name="color_{{$pro->id}}" id="offers_buy_color_{{$pro->id}}" onchange="selectSize({{$pro->id}}, 'offers_buy_code_', 'offers_buy_color_', 'offers_buy_size_', 'offers_size')" class="form-control">
                                            <option value=""> --- {{__('home.Please Select')}} ---</option>
                                            @foreach ($colores as $color)
                                              <option value="{{$color}}">{{$color}}</option>
                                            @endforeach
                                          </select>
                                        </div>
                                        @endif

                                        <!-- Size -->
                                        @if($pro->size)
                                        <div class="form-group required product-option-select">
                                          <label class="control-label" for="offers_buy_size_{{$pro->id}}">{{__('home.Size')}}</label>
                                          <select name="size_{{$pro->id}}" id="offers_buy_size_{{$pro->id}}" class="form-control">
                                            <option value=""> --- {{__('home.Please Select')}} ---</option>
                                            @if(!$pro->color)
                                              <?php $all_size = \App\Models\Product::where('code', $pro->code)->get(); ?>
                                              @foreach ($all_size as $size)
                                                <option value="{{$size->size}}">{{$size->size}}</option>
                                              @endforeach
                                            @endif
                                          </select>
                                        </div>
                                        @endif
                                      </div>

                                      <div class="button-group-page">
                                        <div class="buttons-wrapper">
                                          <div id="offers_buy_QTYError_{{$pro->id}}" ></div>
                                          <div class="stepper-group cart-group">
                                            <!-- Qty -->
                                            <div class="stepper form-group input-group">
                                              <label class="control-label" for="quantity_{{$pro->id}}">Qty</label>
                                              <input  id="offers_buy_quantity_{{$pro->id}}" type="text" name="quantity_{{$pro->id}}"  value="1"  data-minimum="1" class="form-control" />
                                              <input id="offers_buy_product_id_{{$pro->id}}" type="hidden" name="product_id_{{$pro->id}}" value="{{$pro->id}}"/>
                                              <span>
                                                <i class="fa fa-angle-up"></i>
                                                <i class="fa fa-angle-down"></i>
                                              </span>
                                            </div>
                                            <!-- Buy Now -->
                                            <button
                                              id="offers_buy_now_btn_{{$pro->id}}"
                                              type="submit"
                                              onclick="buyNowAdd(event, {{$pro->id}}, 'offers_buy_form_cart_', 'offers_buy_now_btn_', 'offers_buy_', 'offers_buy_QTYError_', 'offers_Buy_Now_', 'offers_buy_quantity_')"
                                              data-loading-text="<span class='btn-text'>{{__('home.Buy Now')}}</span>"
                                              class="btn btn-cart"
                                              style="margin: 0 0 6px 6px;">
                                              {{__('home.Buy Now')}}
                                            </button>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </form>
                                </div>

                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      @endforeach
                    </div>
                  </div>





















                  <!-- Best Rated -->
                  <div class="module-item module-item-3 tab-pane" id="products-5f17d084eccdb-tab-3">
                    <div class="product-grid">
                      <?php 
                        $products= \App\Models\Product::orderBy('rating', 'desc')->get(); 
                        $codes = array();
                        foreach ($products as $key => $pro) {
                            if( in_array($pro->code, $codes) ) $products->forget($key);
                            else array_push($codes, $pro->code);
                        }
                        $products = $products->take(8);
                      ?>
                      @foreach($products as $pro)
                      <div class="product-layout  has-extra-button">
                        <div class="product-thumb">
                          <div class="image">
                            <!-- Quickview -->
                            <div class="quickview-button">
                              <a class="btn btn-quickview" data-toggle="modal" data-target="#rated_ProductQuickView_{{$pro->id}}"
                                data-tooltip-class="module-products-27 module-products-grid quickview-tooltip"
                                data-placement="top" title="{{ __('home.Quickview') }}">
                                <span class="btn-text">{{ __('home.Quickview') }}</span>
                              </a>
                            </div>
                            <!-- Image -->
                            <a href="{{ url('/product').'/'.$pro->id}}"
                              class="product-img has-second-image">
                              <div>
                                <img
                                  src="{{IMAGE}}images/products/{{$pro->image}}"
                                  data-src="{{IMAGE}}images/products/{{$pro->image}}"
                                  data-srcset="{{IMAGE}}images/products/{{$pro->image}} 1x, {{IMAGE}}images/products/{{$pro->image}} 2x"
                                  width="250" height="250" alt="{{$pro->name}}"
                                  title="{{$pro->name}}" class="img-responsive img-first lazyload" /> 
                                <img
                                  src="{{IMAGE}}images/products/{{$pro->image}}"
                                  data-src="{{IMAGE}}images/products/{{$pro->image}}"
                                  data-srcset="{{IMAGE}}images/products/{{$pro->image}} 1x, {{IMAGE}}images/products/{{$pro->image}} 2x"
                                  width="250" height="250" alt="{{$pro->name}}"
                                  title="{{$pro->name}}" class="img-responsive img-second lazyload" />
                              </div>
                            </a>

                            <!-- Labels -->
                            <div class="product-labels">
                              <?php $news= \App\Models\Product::orderBy('created_at', 'desc')->pluck('id')->take(30)->toArray();?>
                              @if(in_array($pro->id, $news))<span class="product-label product-label-29 product-label-default"><b>{{ __('home.New') }}</b></span>@endif
                              @if($pro->stock == 0)<span class="product-label product-label-146 product-label-diagonal"><b>{{ __('home.Out of Stock') }}</b></span>@endif
                              @if($pro->discount)<span class="product-label product-label-28 product-label-default"><b>-{{$pro->discount}}%</b></span>@endif
                              @if(array_key_exists($pro->id,$top_sales20))<span class="product-label product-label-217 product-label-default"><b>{{ __('home.Top Sales') }}</b></span>@endif

                            </div>
                          </div>

                          <div class="caption">
                            <div class="stats">
                              <span class="stat-1">
                                <span class="stats-label">{{ __('home.Brand') }}:</span>
                                <span>
                                  <?php $brand = \App\Models\Brand::where('id', '=', $pro->brand_id)->first();?>
                                  <a href="{{ url('/brand').'/'.$brand->id}}">{{$brand->name}}</a>
                                </span>
                              </span>
                            </div>
                            <div class="name">
                              <a href="{{ url('/product').'/'.$pro->id}}">{{$pro->name}}</a>
                            </div>
                            <div class="price">
                              <?php 
                                $currency = session()->get('cur_currency');
                                $symbol = session()->get('cur_symbol');
                                $old_price = $pro->price*$currency;
                                $new_price = $old_price - $pro->discount * $old_price /100 ;
                              ?>
                              <div>
                                @if($pro->discount)
                                <span class="price-new">{{ $symbol .' '. $new_price }}</span>
                                <span class="price-old">{{ $old_price }}</span>
                                @else
                                <span class="price-normal">{{ $symbol .' '. $old_price }}</span>
                                @endif
                              </div>
                            </div>
                            <!-- Cart | Wishlist -->
                            <div class="buttons-wrapper">
                              <div class="button-group">
                                <!-- Add to Cart -->
                                <div class="cart-group">
                                  <a class="btn btn-cart" data-toggle="modal" data-target="#rated_ProductOptions_{{$pro->id}}">
                                    <span class="btn-text">{{ __('home.Add to Cart') }}</span>
                                  </a>
                                </div>
                              </div>
                            </div>

                            <!-- Buy Now | Add to Wishlist-->
                            <div class="extra-group">
                              <div>
                                <a class="btn btn-extra btn-extra-46"
                                  data-toggle="modal" data-target="#rated_Buy_Now_{{$pro->id}}" >
                                  <span class="btn-text">{{__('home.Buy Now')}}</span>
                                </a>
                                <a class="btn btn-extra btn-extra-93 add_to_wish_list"
                                  data-product-id="{{$pro->id}}"
                                  data-loading-text="<span class='btn-text'>{{__('home.Add to Wishlist')}}</span>">
                                  <span class="btn-text RedText">{{__('home.Add to Wishlist')}}</span>
                                </a>
                              </div>
                            </div>

                          </div>
                        </div>
                      </div>

                      <!-- Modal | QuickView -->
                      <div class="modal fade" id="rated_ProductQuickView_{{$pro->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                          <div class="modal-content">
                            <div class="modal-header backgroundBlue">
                              <h5 class="modal-title ModelName" style="text-align:center;" id="exampleModalLongTitle">{{$pro->name}}</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true" style="position: absolute; top: -27px; right: 10px;">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body backgroundGray">
                              <div class="row">
                                <div class="product-info has-extra-button ">
                                  <!-- Main Image -->
                                  <div class="product-left">
                                    <div class="product-image direction-horizontal position-bottom">
                                      <div class="swiper main-image swiper-has-pages" data-options='{"speed":0,"autoplay":false,"pauseOnHover":false,"loop":false}'>
                                        <div class="swiper-container swiper-container-horizontal">
                                          <div class="swiper-wrapper" style="transform: translate3d(0px, 0px, 0px); transition-duration: 0ms;">
                                            <div class="swiper-slide swiper-slide-visible swiper-slide-active" style="width: 331px;">
                                              
                                              <img
                                                src="{{IMAGE}}images/products/{{$pro->image}}"
                                                srcset="{{IMAGE}}images/products/{{$pro->image}} 2x"
                                                alt="{{$pro->name}}" title="{{$pro->name}}" width="550" height="550" />
                                            </div>

                                          </div>
                                          <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
                                        </div>

                                        <!-- Labels -->
                                          <div class="product-labels">
                                            <?php $news= \App\Models\Product::orderBy('created_at', 'desc')->pluck('id')->take(30)->toArray();?>
                                            @if(in_array($pro->id, $news))<span class="product-label product-label-29 product-label-default"><b>{{ __('home.New') }}</b></span>@endif
                                            @if(array_key_exists($pro->id,$top_sales20))<span class="product-label product-label-217 product-label-default"><b>{{ __('home.Top Sales') }}</b></span>@endif
                                            @if($pro->stock == 0)<span class="product-label product-label-146 product-label-diagonal"><b>{{ __('home.Out of Stock') }}</b></span>@endif
                                            @if($pro->discount)<span class="product-label product-label-28 product-label-default"><b>-{{$pro->discount}}%</b></span>@endif
                                          </div>
                                      </div>
                                    </div>
                                  </div>

                                  <div class="product-right">
                                    <div id="product" class="product-details">
                                      <div class="title page-title ">{{$pro->name}}</div>
                                      
                                      <!-- Description -->
                                      <div class="description">
                                        <p>{{$pro->description}}</p>
                                      </div>
                                       
                                      <!-- Stock | Brand -->
                                      <div class="product-stats">
                                        <ul class="list-unstyled">
                                          <?php 
                                            $brand = \App\Models\Brand::where('id', $pro->brand_id)->first();
                                            $codes = \App\Models\Product::where('code', $pro->code)->get(); 
                                            $stock = 0;
                                            foreach ($codes as $code) $stock += $code->stock;
                                          ?>
                                          <li class="product-stock in-stock"><b>{{__('home.Stock')}}:</b> <span>{{$stock}}</span></li>
                                          <li class="product-manufacturer"><b>{{__('home.Brand')}}:</b><a href="{{url('/brand')}}/{{$brand->id}}" target="_blank">{{$brand->name}}</a></li>
                                        </ul>
                                      </div>

                                      <!-- Price -->
                                      <div class="product-price-group">
                                        <div class="price-wrapper">
                                          <div class="price-group">
                                            <?php 
                                              $currency = session()->get('cur_currency');
                                              $symbol = session()->get('cur_symbol');
                                              $old_price = $pro->price*$currency;
                                              $new_price = $old_price - $pro->discount * $old_price /100 ;
                                            ?>
                                            @if($pro->discount)
                                              <div class="product-price-new">{{ $symbol .' '. $new_price }}</div>
                                              <div class="product-price-old">{{ $old_price }}</div>
                                            @else
                                              <div class="product-price-new">{{ $symbol .' '. $new_price }}</div>
                                            @endif
                                          </div>
                                          <!-- <div class="product-tax">Ex Tax: $999.00</div> -->
                                        </div>
                                      </div>

                                      <!-- Rating -->
                                      <div class="product-stats">
                                        <ul class="list-unstyled">
                                          <li class="product-stock in-stock"><b>{{__('home.Rating')}}: </b>
                                            <div class="rating-stars">
                                              
                                              <span class="fa fa-stack" style=" color: rgba(255, 214, 0, 1); ">
                                                <?php 
                                                  if($pro->rating < 1 && $pro->rating > 0) echo '<i class="fa fa-star-half fa-stack-1x" ></i>';
                                                  elseif($pro->rating < 1) echo '<i class="fa fa-star-o fa-stack-1x" ></i>';
                                                  else echo '<i class="fa fa-star fa-stack-1x" ></i>';
                                                ?>
                                              </span>
                                              <span class="fa fa-stack" style=" color: rgba(255, 214, 0, 1); ">
                                                <?php 
                                                  if($pro->rating < 2 && $pro->rating > 1) echo '<i class="fa fa-star-half fa-stack-1x" ></i>';
                                                  elseif($pro->rating < 2) echo '<i class="fa fa-star-o fa-stack-1x" ></i>';
                                                  else echo '<i class="fa fa-star fa-stack-1x" ></i>';
                                                ?>
                                              </span>
                                              <span class="fa fa-stack" style=" color: rgba(255, 214, 0, 1); ">
                                                <?php 
                                                  if($pro->rating < 3 && $pro->rating > 2) echo '<i class="fa fa-star-half fa-stack-1x" ></i>';
                                                  elseif($pro->rating < 3) echo '<i class="fa fa-star-o fa-stack-1x" ></i>';
                                                  else echo '<i class="fa fa-star fa-stack-1x" ></i>';
                                                ?>
                                              </span>
                                              <span class="fa fa-stack" style=" color: rgba(255, 214, 0, 1); ">
                                                <?php 
                                                  if($pro->rating < 4 && $pro->rating > 3) echo '<i class="fa fa-star-half fa-stack-1x" ></i>';
                                                  elseif($pro->rating < 4) echo '<i class="fa fa-star-o fa-stack-1x" ></i>';
                                                  else echo '<i class="fa fa-star fa-stack-1x" ></i>';
                                                ?>
                                              </span>
                                              <span class="fa fa-stack" style=" color: rgba(255, 214, 0, 1); ">
                                                <?php 
                                                  if($pro->rating < 5 && $pro->rating > 4) echo '<i class="fa fa-star-half fa-stack-1x" ></i>';
                                                  elseif($pro->rating < 5) echo '<i class="fa fa-star-o fa-stack-1x" ></i>';
                                                  else echo '<i class="fa fa-star fa-stack-1x" ></i>';
                                                ?>
                                              </span>
                                            </div>
                                          </li>
                                        </ul>
                                      </div>

                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="modal-footer backgroundBlue">
                              <div class="button-group-page">
                                <div class="buttons-wrapper">
                                  <div class="wishlist-compare text-center">
                                    <a 
                                      class="btn btn-more-details CustomStyle"
                                      href="{{ url('/product').'/'.$pro->id}}"
                                      target="_top"
                                      data-toggle="tooltip"
                                      data-tooltip-class="more-details-tooltip"
                                      data-placement="top"
                                      title
                                      data-original-title="More Details"
                                      >
                                      <span class="btn-text">{{__('home.More Details')}}</span>
                                    </a>
                                  </div>
                                </div>
                              </div>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>

                      <!-- Model | Best Rated | Add to Cart -->
                      <div class="modal fade" id="rated_ProductOptions_{{$pro->id}}" tabindex="-1" role="dialog" aria-labelledby="ModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" style="width:400px;" role="document">
                          <div class="modal-content">
                            <div class="modal-header backgroundBlue">
                              <h5 class="modal-title ModelName" style="text-align:center;" id="ModalCenterTitle">{{$pro->name}}</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true" style="position: absolute; top: -27px; right: 10px;">&times;</span>
                              </button>
                            </div>

                            <div class="modal-body">
                              <div class="product-info out-of-stock has-extra-button " style="margin:auto 10%;">

                                <div id="product" class="product-details">
                                  <form id="rated_form_cart_{{$pro->id}}">
                                    <div id="rated_content_{{$pro->id}}">
                                      <div class="product-options">
                                        <h3 class="options-title title">{{__('home.Available Options')}}</h3>
                                        <!-- Color -->
                                        @if($pro->color)
                                        <div class="form-group required product-option-select">
                                          <label class="control-label" for="rated_color_{{$pro->id}}">{{__('home.Color')}}</label>
                                          <?php 
                                          $colores = [];
                                          $all_colores = \App\Models\Product::where('code', $pro->code)->get();
                                          foreach ($all_colores as $color) {
                                            $new_color = $color->color;
                                            if(!in_array($new_color, $colores))array_push($colores, $new_color);
                                          }
                                          ?>
                                          <input type="hidden" id="rated_code_{{$pro->id}}" value="{{$pro->code}}">
                                          <select name="color_{{$pro->id}}" id="rated_color_{{$pro->id}}" onchange="selectSize({{$pro->id}}, 'rated_code_', 'rated_color_', 'rated_size_', 'rated_size_')" class="form-control">
                                            <option value=""> --- {{__('home.Please Select')}} ---</option>
                                            @foreach ($colores as $color)
                                              <option value="{{$color}}">{{$color}}</option>
                                            @endforeach
                                          </select>
                                        </div>
                                        @endif

                                        <!-- Size -->
                                        @if($pro->size)
                                        <div class="form-group required product-option-select">
                                          <label class="control-label" for="rated_size_{{$pro->id}}">{{__('home.Size')}}</label>
                                          <select name="size_{{$pro->id}}" id="rated_size_{{$pro->id}}" class="form-control">
                                            <option value=""> --- {{__('home.Please Select')}} ---</option>
                                            @if(!$pro->color)
                                              <?php $all_size = \App\Models\Product::where('code', $pro->code)->get(); ?>
                                              @foreach ($all_size as $size)
                                                <option value="{{$size->size}}">{{$size->size}}</option>
                                              @endforeach
                                            @endif
                                          </select>
                                        </div>
                                        @endif
                                      </div>

                                      <div class="button-group-page">
                                        <div class="buttons-wrapper">
                                          <div id="rated_QTYError_{{$pro->id}}" ></div>
                                          <div class="stepper-group cart-group">
                                            <!-- Qty -->
                                            <div class="stepper form-group input-group">
                                              <label class="control-label" for="quantity_{{$pro->id}}">Qty</label>
                                              <input  id="rated_quantity_{{$pro->id}}" type="text" name="quantity_{{$pro->id}}"  value="1"  data-minimum="1" class="form-control" />
                                              <input id="rated_product_id_{{$pro->id}}" type="hidden" name="product_id_{{$pro->id}}" value="{{$pro->id}}"/>
                                              <span>
                                                <i class="fa fa-angle-up"></i>
                                                <i class="fa fa-angle-down"></i>
                                              </span>
                                            </div>
                                            <!-- Add to Cart -->
                                            <button
                                              id="rated_button_cart_{{$pro->id}}"
                                              type="submit"
                                              onclick="addToCart(event, {{$pro->id}}, 'rated_form_cart_', 'rated_button_cart_', 'rated_', 'rated_QTYError_', 'rated_content_', 'rated_ProductOptions_', 'rated_quantity_')"
                                              data-loading-text="<span class='btn-text'>{{ __('home.Add to Cart') }}</span>"
                                              class="btn btn-cart"
                                              style="margin: 0 0 6px 6px;">
                                              {{ __('home.Add to Cart') }}
                                            </button>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </form>
                                </div>

                              </div>
                            </div>
                          </div>
                        </div>
                      </div> 

                      <!-- Model | Best Rated | Buy Now -->
                      <div class="modal fade" id="rated_Buy_Now_{{$pro->id}}" tabindex="-1" role="dialog" aria-labelledby="ModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" style="width:400px;" role="document">
                          <div class="modal-content">
                            <div class="modal-header backgroundBlue">
                              <h5 class="modal-title ModelName" style="text-align:center;" id="ModalCenterTitle">{{$pro->name}}</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true" style="position: absolute; top: -27px; right: 10px;">&times;</span>
                              </button>
                            </div>

                            <div class="modal-body">
                              <div class="product-info out-of-stock has-extra-button " style="margin:auto 10%;">

                                <div id="product" class="product-details">
                                  <form id="rated_buy_form_cart_{{$pro->id}}">
                                    <div id="rated_buy_content_{{$pro->id}}">
                                      <div class="product-options">
                                        <h3 class="options-title title">{{__('home.Available Options')}}</h3>
                                        <!-- Color -->
                                        @if($pro->color)
                                        <div class="form-group required product-option-select">
                                          <label class="control-label" for="rated_buy_color_{{$pro->id}}">{{__('home.Color')}}</label>
                                          <?php 
                                          $colores = [];
                                          $all_colores = \App\Models\Product::where('code', $pro->code)->get();
                                          foreach ($all_colores as $color) {
                                            $new_color = $color->color;
                                            if(!in_array($new_color, $colores))array_push($colores, $new_color);
                                          }
                                          ?>
                                          <input type="hidden" id="rated_buy_code_{{$pro->id}}" value="{{$pro->code}}">
                                          <select name="color_{{$pro->id}}" id="rated_buy_color_{{$pro->id}}" onchange="selectSize({{$pro->id}}, 'rated_buy_code_', 'rated_buy_color_', 'rated_buy_size_', 'rated_size')" class="form-control">
                                            <option value=""> --- {{__('home.Please Select')}} ---</option>
                                            @foreach ($colores as $color)
                                              <option value="{{$color}}">{{$color}}</option>
                                            @endforeach
                                          </select>
                                        </div>
                                        @endif

                                        <!-- Size -->
                                        @if($pro->size)
                                        <div class="form-group required product-option-select">
                                          <label class="control-label" for="rated_buy_size_{{$pro->id}}">{{__('home.Size')}}</label>
                                          <select name="size_{{$pro->id}}" id="rated_buy_size_{{$pro->id}}" class="form-control">
                                            <option value=""> --- {{__('home.Please Select')}} ---</option>
                                            @if(!$pro->color)
                                              <?php $all_size = \App\Models\Product::where('code', $pro->code)->get(); ?>
                                              @foreach ($all_size as $size)
                                                <option value="{{$size->size}}">{{$size->size}}</option>
                                              @endforeach
                                            @endif
                                          </select>
                                        </div>
                                        @endif
                                      </div>

                                      <div class="button-group-page">
                                        <div class="buttons-wrapper">
                                          <div id="rated_buy_QTYError_{{$pro->id}}" ></div>
                                          <div class="stepper-group cart-group">
                                            <!-- Qty -->
                                            <div class="stepper form-group input-group">
                                              <label class="control-label" for="quantity_{{$pro->id}}">Qty</label>
                                              <input  id="rated_buy_quantity_{{$pro->id}}" type="text" name="quantity_{{$pro->id}}"  value="1"  data-minimum="1" class="form-control" />
                                              <input id="rated_buy_product_id_{{$pro->id}}" type="hidden" name="product_id_{{$pro->id}}" value="{{$pro->id}}"/>
                                              <span>
                                                <i class="fa fa-angle-up"></i>
                                                <i class="fa fa-angle-down"></i>
                                              </span>
                                            </div>
                                            <!-- Buy Now -->
                                            <button
                                              id="rated_buy_now_btn_{{$pro->id}}"
                                              type="submit"
                                              onclick="buyNowAdd(event, {{$pro->id}}, 'rated_buy_form_cart_', 'rated_buy_now_btn_', 'rated_buy_', 'rated_buy_QTYError_', 'rated_Buy_Now_', 'rated_buy_quantity_')"
                                              data-loading-text="<span class='btn-text'>{{__('home.Buy Now')}}</span>"
                                              class="btn btn-cart"
                                              style="margin: 0 0 6px 6px;">
                                              {{__('home.Buy Now')}}
                                            </button>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </form>
                                </div>

                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      @endforeach
                    </div>
                  </div>

















                  <!-- Top Sales -->
                  <div class="module-item module-item-4 tab-pane" id="products-5f17d084eccdb-tab-4">
                    <div class="product-grid">
                      <?php 
                        $sorted_sales = array();
                        $Orders_products = \App\Models\Orders_products::all();
                        foreach ($Orders_products as $pro) {
                            if(array_key_exists($pro->product_id,$sorted_sales)) $sorted_sales[$pro->product_id] += $pro->qty;
                            else $sorted_sales[$pro->product_id] = $pro->qty;
                        }
                        arsort($sorted_sales);
                        $home_sorted_sales = array_slice($sorted_sales, 0, 7, true); 
                      ?>
                      @foreach($home_sorted_sales as $key => $value)
                      <?php $pro = \App\Models\Product::whereId($key)->first(); ?>
                      <div class="product-layout  has-extra-button">
                        <div class="product-thumb">
                          <div class="image">
                            <!-- Quickview -->
                            <div class="quickview-button">
                              <a class="btn btn-quickview" data-toggle="modal" data-target="#sales_ProductQuickView_{{$pro->id}}"
                                data-tooltip-class="module-products-27 module-products-grid quickview-tooltip"
                                data-placement="top" title="{{ __('home.Quickview') }}">
                                <span class="btn-text">{{ __('home.Quickview') }}</span>
                              </a>
                            </div>
                            <!-- Image -->
                            <a href="{{ url('/product').'/'.$pro->id}}"
                              class="product-img has-second-image">
                              <div>
                                <img
                                  src="{{IMAGE}}images/products/{{$pro->image}}"
                                  data-src="{{IMAGE}}images/products/{{$pro->image}}"
                                  data-srcset="{{IMAGE}}images/products/{{$pro->image}} 1x, {{IMAGE}}images/products/{{$pro->image}} 2x"
                                  width="250" height="250" alt="{{$pro->name}}"
                                  title="{{$pro->name}}" class="img-responsive img-first lazyload" /> 
                                <img
                                  src="{{IMAGE}}images/products/{{$pro->image}}"
                                  data-src="{{IMAGE}}images/products/{{$pro->image}}"
                                  data-srcset="{{IMAGE}}images/products/{{$pro->image}} 1x, {{IMAGE}}images/products/{{$pro->image}} 2x"
                                  width="250" height="250" alt="{{$pro->name}}"
                                  title="{{$pro->name}}" class="img-responsive img-second lazyload" />
                              </div>
                            </a>

                            <!-- Labels -->
                            <div class="product-labels">
                              <?php $news= \App\Models\Product::orderBy('created_at', 'desc')->pluck('id')->take(30)->toArray();?>
                              @if(in_array($pro->id, $news))<span class="product-label product-label-29 product-label-default"><b>{{ __('home.New') }}</b></span>@endif
                              @if($pro->stock == 0)<span class="product-label product-label-146 product-label-diagonal"><b>{{ __('home.Out of Stock') }}</b></span>@endif
                              @if($pro->discount)<span class="product-label product-label-28 product-label-default"><b>-{{$pro->discount}}%</b></span>@endif
                              @if(array_key_exists($pro->id,$top_sales20))<span class="product-label product-label-217 product-label-default"><b>{{ __('home.Top Sales') }}</b></span>@endif
                            </div>
                          </div>

                          <div class="caption">
                            <div class="stats">
                              <span class="stat-1">
                                <span class="stats-label">{{ __('home.Brand') }}:</span>
                                <span>
                                  <?php $brand = \App\Models\Brand::where('id', '=', $pro->brand_id)->first();?>
                                  <a href="{{ url('/brand').'/'.$brand->id}}">{{$brand->name}}</a>
                                </span>
                              </span>
                            </div>
                            <div class="name">
                              <a href="{{ url('/product').'/'.$pro->id}}">{{$pro->name}}</a>
                            </div>
                            <div class="price">
                              <?php 
                                $currency = session()->get('cur_currency');
                                $symbol = session()->get('cur_symbol');
                                $old_price = $pro->price*$currency;
                                $new_price = $old_price - $pro->discount * $old_price /100 ;
                              ?>
                              <div>
                                @if($pro->discount)
                                <span class="price-new">{{ $symbol .' '. $new_price }}</span>
                                <span class="price-old">{{ $old_price }}</span>
                                @else
                                <span class="price-normal">{{ $symbol .' '. $old_price }}</span>
                                @endif
                              </div>
                            </div>
                            <!-- Cart | Wishlist -->
                            <div class="buttons-wrapper">
                              <div class="button-group">
                                <!-- Add to Cart -->
                                <div class="cart-group">
                                  <a class="btn btn-cart" data-toggle="modal" data-target="#sales_ProductOptions_{{$pro->id}}">
                                    <span class="btn-text">{{ __('home.Add to Cart') }}</span>
                                  </a>
                                </div>
                              </div>
                            </div>

                            <!-- Buy Now | Add to Wishlist-->
                            <div class="extra-group">
                              <div>
                                <a class="btn btn-extra btn-extra-46"
                                  data-toggle="modal" data-target="#sales_Buy_Now_{{$pro->id}}" >
                                  <span class="btn-text">{{__('home.Buy Now')}}</span>
                                </a>
                                <a class="btn btn-extra btn-extra-93 add_to_wish_list"
                                  data-product-id="{{$pro->id}}"
                                  data-loading-text="<span class='btn-text'>{{__('home.Add to Wishlist')}}</span>">
                                  <span class="btn-text RedText">{{__('home.Add to Wishlist')}}</span>
                                </a>
                              </div>
                            </div>

                          </div>
                        </div>
                      </div>

                      <!-- Modal | QuickView -->
                      <div class="modal fade" id="sales_ProductQuickView_{{$pro->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                          <div class="modal-content">
                            <div class="modal-header backgroundBlue">
                              <h5 class="modal-title ModelName" style="text-align:center;" id="exampleModalLongTitle">{{$pro->name}}</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true" style="position: absolute; top: -27px; right: 10px;">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body backgroundGray">
                              <div class="row">
                                <div class="product-info has-extra-button ">
                                  <!-- Main Image -->
                                  <div class="product-left">
                                    <div class="product-image direction-horizontal position-bottom">
                                      <div class="swiper main-image swiper-has-pages" data-options='{"speed":0,"autoplay":false,"pauseOnHover":false,"loop":false}'>
                                        <div class="swiper-container swiper-container-horizontal">
                                          <div class="swiper-wrapper" style="transform: translate3d(0px, 0px, 0px); transition-duration: 0ms;">
                                            <div class="swiper-slide swiper-slide-visible swiper-slide-active" style="width: 331px;">
                                              
                                              <img
                                                src="{{IMAGE}}images/products/{{$pro->image}}"
                                                srcset="{{IMAGE}}images/products/{{$pro->image}} 2x"
                                                alt="{{$pro->name}}" title="{{$pro->name}}" width="550" height="550" />
                                            </div>

                                          </div>
                                          <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
                                        </div>

                                        <!-- Labels -->
                                          <div class="product-labels">
                                            <?php $news= \App\Models\Product::orderBy('created_at', 'desc')->pluck('id')->take(30)->toArray();?>
                                            @if(in_array($pro->id, $news))<span class="product-label product-label-29 product-label-default"><b>{{ __('home.New') }}</b></span>@endif
                                            @if(array_key_exists($pro->id,$top_sales20))<span class="product-label product-label-217 product-label-default"><b>{{ __('home.Top Sales') }}</b></span>@endif
                                            @if($pro->stock == 0)<span class="product-label product-label-146 product-label-diagonal"><b>{{ __('home.Out of Stock') }}</b></span>@endif
                                            @if($pro->discount)<span class="product-label product-label-28 product-label-default"><b>-{{$pro->discount}}%</b></span>@endif
                                          </div>
                                      </div>
                                    </div>
                                  </div>

                                  <div class="product-right">
                                    <div id="product" class="product-details">
                                      <div class="title page-title ">{{$pro->name}}</div>
                                      
                                      <!-- Description -->
                                      <div class="description">
                                        <p>{{$pro->description}}</p>
                                      </div>
                                       
                                      <!-- Stock | Brand -->
                                      <div class="product-stats">
                                        <ul class="list-unstyled">
                                          <?php 
                                            $brand = \App\Models\Brand::where('id', $pro->brand_id)->first();
                                            $codes = \App\Models\Product::where('code', $pro->code)->get(); 
                                            $stock = 0;
                                            foreach ($codes as $code) $stock += $code->stock;
                                          ?>
                                          <li class="product-stock in-stock"><b>{{__('home.Stock')}}:</b> <span>{{$stock}}</span></li>
                                          <li class="product-manufacturer"><b>{{__('home.Brand')}}:</b><a href="{{url('/brand')}}/{{$brand->id}}" target="_blank">{{$brand->name}}</a></li>
                                        </ul>
                                      </div>

                                      <!-- Price -->
                                      <div class="product-price-group">
                                        <div class="price-wrapper">
                                          <div class="price-group">
                                            <?php 
                                              $currency = session()->get('cur_currency');
                                              $symbol = session()->get('cur_symbol');
                                              $old_price = $pro->price*$currency;
                                              $new_price = $old_price - $pro->discount * $old_price /100 ;
                                            ?>
                                            @if($pro->discount)
                                              <div class="product-price-new">{{ $symbol .' '. $new_price }}</div>
                                              <div class="product-price-old">{{ $old_price }}</div>
                                            @else
                                              <div class="product-price-new">{{ $symbol .' '. $new_price }}</div>
                                            @endif
                                          </div>
                                          <!-- <div class="product-tax">Ex Tax: $999.00</div> -->
                                        </div>
                                      </div>

                                      <!-- Rating -->
                                      <div class="product-stats">
                                        <ul class="list-unstyled">
                                          <li class="product-stock in-stock"><b>{{__('home.Rating')}}: </b>
                                            <div class="rating-stars">
                                              
                                              <span class="fa fa-stack" style=" color: rgba(255, 214, 0, 1); ">
                                                <?php 
                                                  if($pro->rating < 1 && $pro->rating > 0) echo '<i class="fa fa-star-half fa-stack-1x" ></i>';
                                                  elseif($pro->rating < 1) echo '<i class="fa fa-star-o fa-stack-1x" ></i>';
                                                  else echo '<i class="fa fa-star fa-stack-1x" ></i>';
                                                ?>
                                              </span>
                                              <span class="fa fa-stack" style=" color: rgba(255, 214, 0, 1); ">
                                                <?php 
                                                  if($pro->rating < 2 && $pro->rating > 1) echo '<i class="fa fa-star-half fa-stack-1x" ></i>';
                                                  elseif($pro->rating < 2) echo '<i class="fa fa-star-o fa-stack-1x" ></i>';
                                                  else echo '<i class="fa fa-star fa-stack-1x" ></i>';
                                                ?>
                                              </span>
                                              <span class="fa fa-stack" style=" color: rgba(255, 214, 0, 1); ">
                                                <?php 
                                                  if($pro->rating < 3 && $pro->rating > 2) echo '<i class="fa fa-star-half fa-stack-1x" ></i>';
                                                  elseif($pro->rating < 3) echo '<i class="fa fa-star-o fa-stack-1x" ></i>';
                                                  else echo '<i class="fa fa-star fa-stack-1x" ></i>';
                                                ?>
                                              </span>
                                              <span class="fa fa-stack" style=" color: rgba(255, 214, 0, 1); ">
                                                <?php 
                                                  if($pro->rating < 4 && $pro->rating > 3) echo '<i class="fa fa-star-half fa-stack-1x" ></i>';
                                                  elseif($pro->rating < 4) echo '<i class="fa fa-star-o fa-stack-1x" ></i>';
                                                  else echo '<i class="fa fa-star fa-stack-1x" ></i>';
                                                ?>
                                              </span>
                                              <span class="fa fa-stack" style=" color: rgba(255, 214, 0, 1); ">
                                                <?php 
                                                  if($pro->rating < 5 && $pro->rating > 4) echo '<i class="fa fa-star-half fa-stack-1x" ></i>';
                                                  elseif($pro->rating < 5) echo '<i class="fa fa-star-o fa-stack-1x" ></i>';
                                                  else echo '<i class="fa fa-star fa-stack-1x" ></i>';
                                                ?>
                                              </span>
                                            </div>
                                          </li>
                                        </ul>
                                      </div>

                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="modal-footer backgroundBlue">
                              <div class="button-group-page">
                                <div class="buttons-wrapper">
                                  <div class="wishlist-compare text-center">
                                    <a 
                                      class="btn btn-more-details CustomStyle"
                                      href="{{ url('/product').'/'.$pro->id}}"
                                      target="_top"
                                      data-toggle="tooltip"
                                      data-tooltip-class="more-details-tooltip"
                                      data-placement="top"
                                      title
                                      data-original-title="More Details"
                                      >
                                      <span class="btn-text">{{__('home.More Details')}}</span>
                                    </a>
                                  </div>
                                </div>
                              </div>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>

                      <!-- Model | Top Sales | Add to Cart -->
                      <div class="modal fade" id="sales_ProductOptions_{{$pro->id}}" tabindex="-1" role="dialog" aria-labelledby="ModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" style="width:400px;" role="document">
                          <div class="modal-content">
                            <div class="modal-header backgroundBlue">
                              <h5 class="modal-title ModelName" style="text-align:center;" id="ModalCenterTitle">{{$pro->name}}</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true" style="position: absolute; top: -27px; right: 10px;">&times;</span>
                              </button>
                            </div>

                            <div class="modal-body">
                              <div class="product-info out-of-stock has-extra-button " style="margin:auto 10%;">

                                <div id="product" class="product-details">
                                  <form id="sales_form_cart_{{$pro->id}}">
                                    <div id="sales_content_{{$pro->id}}">
                                      <div class="product-options">
                                        <h3 class="options-title title">{{__('home.Available Options')}}</h3>
                                        <!-- Color -->
                                        @if($pro->color)
                                        <div class="form-group required product-option-select">
                                          <label class="control-label" for="sales_color_{{$pro->id}}">{{__('home.Color')}}</label>
                                          <?php 
                                          $colores = [];
                                          $all_colores = \App\Models\Product::where('code', $pro->code)->get();
                                          foreach ($all_colores as $color) {
                                            $new_color = $color->color;
                                            if(!in_array($new_color, $colores))array_push($colores, $new_color);
                                          }
                                          ?>
                                          <input type="hidden" id="sales_code_{{$pro->id}}" value="{{$pro->code}}">
                                          <select name="color_{{$pro->id}}" id="sales_color_{{$pro->id}}" onchange="selectSize({{$pro->id}}, 'sales_code_', 'sales_color_', 'sales_size_', 'sales_size')" class="form-control">
                                            <option value=""> --- {{__('home.Please Select')}} ---</option>
                                            @foreach ($colores as $color)
                                              <option value="{{$color}}">{{$color}}</option>
                                            @endforeach
                                          </select>
                                        </div>
                                        @endif

                                        <!-- Size -->
                                        @if($pro->size)
                                        <div class="form-group required product-option-select">
                                          <label class="control-label" for="sales_size_{{$pro->id}}">{{__('home.Size')}}</label>
                                          <select name="size_{{$pro->id}}" id="sales_size_{{$pro->id}}" class="form-control">
                                            <option value=""> --- {{__('home.Please Select')}} ---</option>
                                            @if(!$pro->color)
                                              <?php $all_size = \App\Models\Product::where('code', $pro->code)->get(); ?>
                                              @foreach ($all_size as $size)
                                                <option value="{{$size->size}}">{{$size->size}}</option>
                                              @endforeach
                                            @endif
                                          </select>
                                        </div>
                                        @endif
                                      </div>

                                      <div class="button-group-page">
                                        <div class="buttons-wrapper">
                                          <div id="sales_QTYError_{{$pro->id}}" ></div>
                                          <div class="stepper-group cart-group">
                                            <!-- Qty -->
                                            <div class="stepper form-group input-group">
                                              <label class="control-label" for="quantity_{{$pro->id}}">Qty</label>
                                              <input  id="sales_quantity_{{$pro->id}}" type="text" name="quantity_{{$pro->id}}"  value="1"  data-minimum="1" class="form-control" />
                                              <input id="sales_product_id_{{$pro->id}}" type="hidden" name="product_id_{{$pro->id}}" value="{{$pro->id}}"/>
                                              <span>
                                                <i class="fa fa-angle-up"></i>
                                                <i class="fa fa-angle-down"></i>
                                              </span>
                                            </div>
                                            <!-- Add to Cart -->
                                            <button
                                              id="sales_button_cart_{{$pro->id}}"
                                              type="submit"
                                              onclick="addToCart(event, {{$pro->id}}, 'sales_form_cart_', 'sales_button_cart_', 'sales_', 'sales_QTYError_', 'sales_content_', 'sales_ProductOptions_', 'sales_quantity_')"
                                              data-loading-text="<span class='btn-text'>{{ __('home.Add to Cart') }}</span>"
                                              class="btn btn-cart"
                                              style="margin: 0 0 6px 6px;">
                                              {{ __('home.Add to Cart') }}
                                            </button>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </form>
                                </div>

                              </div>
                            </div>
                          </div>
                        </div>
                      </div> 

                      <!-- Model | Top Sales | Buy Now -->
                      <div class="modal fade" id="sales_Buy_Now_{{$pro->id}}" tabindex="-1" role="dialog" aria-labelledby="ModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" style="width:400px;" role="document">
                          <div class="modal-content">
                            <div class="modal-header backgroundBlue">
                              <h5 class="modal-title ModelName" style="text-align:center;" id="ModalCenterTitle">{{$pro->name}}</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true" style="position: absolute; top: -27px; right: 10px;">&times;</span>
                              </button>
                            </div>

                            <div class="modal-body">
                              <div class="product-info out-of-stock has-extra-button " style="margin:auto 10%;">

                                <div id="product" class="product-details">
                                  <form id="sales_buy_form_cart_{{$pro->id}}">
                                    <div id="sales_buy_content_{{$pro->id}}">
                                      <div class="product-options">
                                        <h3 class="options-title title">{{__('home.Available Options')}}</h3>
                                        <!-- Color -->
                                        @if($pro->color)
                                        <div class="form-group required product-option-select">
                                          <label class="control-label" for="sales_buy_color_{{$pro->id}}">{{__('home.Color')}}</label>
                                          <?php 
                                          $colores = [];
                                          $all_colores = \App\Models\Product::where('code', $pro->code)->get();
                                          foreach ($all_colores as $color) {
                                            $new_color = $color->color;
                                            if(!in_array($new_color, $colores))array_push($colores, $new_color);
                                          }
                                          ?>
                                          <input type="hidden" id="sales_buy_code_{{$pro->id}}" value="{{$pro->code}}">
                                          <select name="color_{{$pro->id}}" id="sales_buy_color_{{$pro->id}}" onchange="selectSize({{$pro->id}}, 'sales_buy_code_', 'sales_buy_color_', 'sales_buy_size_', 'sales_size')" class="form-control">
                                            <option value=""> --- {{__('home.Please Select')}} ---</option>
                                            @foreach ($colores as $color)
                                              <option value="{{$color}}">{{$color}}</option>
                                            @endforeach
                                          </select>
                                        </div>
                                        @endif

                                        <!-- Size -->
                                        @if($pro->size)
                                        <div class="form-group required product-option-select">
                                          <label class="control-label" for="sales_buy_size_{{$pro->id}}">{{__('home.Size')}}</label>
                                          <select name="size_{{$pro->id}}" id="sales_buy_size_{{$pro->id}}" class="form-control">
                                            <option value=""> --- {{__('home.Please Select')}} ---</option>
                                            @if(!$pro->color)
                                              <?php $all_size = \App\Models\Product::where('code', $pro->code)->get(); ?>
                                              @foreach ($all_size as $size)
                                                <option value="{{$size->size}}">{{$size->size}}</option>
                                              @endforeach
                                            @endif
                                          </select>
                                        </div>
                                        @endif
                                      </div>

                                      <div class="button-group-page">
                                        <div class="buttons-wrapper">
                                          <div id="sales_buy_QTYError_{{$pro->id}}" ></div>
                                          <div class="stepper-group cart-group">
                                            <!-- Qty -->
                                            <div class="stepper form-group input-group">
                                              <label class="control-label" for="quantity_{{$pro->id}}">Qty</label>
                                              <input  id="sales_buy_quantity_{{$pro->id}}" type="text" name="quantity_{{$pro->id}}"  value="1"  data-minimum="1" class="form-control" />
                                              <input id="sales_buy_product_id_{{$pro->id}}" type="hidden" name="product_id_{{$pro->id}}" value="{{$pro->id}}"/>
                                              <span>
                                                <i class="fa fa-angle-up"></i>
                                                <i class="fa fa-angle-down"></i>
                                              </span>
                                            </div>
                                            <!-- Buy Now -->
                                            <button
                                              id="sales_buy_now_btn_{{$pro->id}}"
                                              type="submit"
                                              onclick="buyNowAdd(event, {{$pro->id}}, 'sales_buy_form_cart_', 'sales_buy_now_btn_', 'sales_buy_', 'sales_buy_QTYError_', 'sales_Buy_Now_', 'sales_buy_quantity_')"
                                              data-loading-text="<span class='btn-text'>{{__('home.Buy Now')}}</span>"
                                              class="btn btn-cart"
                                              style="margin: 0 0 6px 6px;">
                                              {{__('home.Buy Now')}}
                                            </button>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </form>
                                </div>

                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      @endforeach
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