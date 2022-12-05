<?php 
  if(count($products) == 0) echo '<span style="color: #888; font-size:20px; padding-left:2%;">'. __("home.There is no products") .'</span>';
  $top_sales20 = top_sales20();
  ?>
<?php foreach($products as $i=>$pro) { ?>
<div class="product-layout has-countdown has-extra-button" data-price="{{$products[$i]['price']}}" >
  <div class="product-thumb">
    <div class="image imageDiv" >
      <div class="quickview-button">
        <a class="btn btn-quickview" data-toggle="modal" data-target="#ProductQuickView_{{$products[$i]['id']}}"
          data-tooltip-class="product-grid quickview-tooltip" data-placement="top"
          title="{{ __('home.Quickview') }}">
          <span class="btn-text">{{ __('home.Quickview') }}</span>
        </a>
      </div>
      
      <a href="{{ url('/product').'/'.$products[$i]['id']}}" class="product-img has-second-image">
        <div>
          <img
            src="{{IMAGE}}images/products/{{$products[$i]['image']}}"
            data-src="{{IMAGE}}images/products/{{$products[$i]['image']}}"
            data-srcset="{{IMAGE}}images/products/{{$products[$i]['image']}} 1x, {{IMAGE}}images/products/{{$products[$i]['image']}} 2x"
            width="250" height="250" alt="{{$products[$i]['name']}}"
            title="{{$products[$i]['name']}}" class="img-responsive img-first lazyload" /> 
          <img
            src="{{IMAGE}}images/products/{{$products[$i]['image']}}"
            data-src="{{IMAGE}}images/products/{{$products[$i]['image']}}"
            data-srcset="{{IMAGE}}images/products/{{$products[$i]['image']}} 1x, {{IMAGE}}images/products/{{$products[$i]['image']}} 2x"
            width="250" height="250" alt="{{$products[$i]['name']}}"
            title="{{$products[$i]['name']}}" class="img-responsive img-second lazyload" />
        </div>
      </a>
      <div class="product-labels">
        <?php $news= \App\Models\Product::orderBy('created_at', 'desc')->pluck('id')->take(30)->toArray();?>
        @if(in_array($products[$i]['id'], $news))<span class="product-label product-label-29 product-label-default"><b>{{ __('home.New') }}</b></span>@endif
        @if($products[$i]['stock'] == 0)<span class="product-label product-label-146 product-label-diagonal"><b>{{ __('home.Out of Stock') }}</b></span>@endif
        @if($products[$i]['discount'])<span class="product-label product-label-28 product-label-default"><b>-{{$products[$i]['discount']}}%</b></span>@endif
        @if(array_key_exists($products[$i]['id'],$top_sales20))<span class="product-label product-label-217 product-label-default"><b>{{ __('home.Top Sales') }}</b></span>@endif
      </div>
      <!-- @if($products[$i]['discount'])<div class="countdown" data-date="Sun Jan 31 2021 00:00:00 +0000"></div>@endif -->
    </div>
    <div class="caption">
      <div class="stats">
        <span class="stat-1">
          <span class="stats-label">{{ __('home.Brand') }}:</span>
          <span>
            <?php $brand = \App\Models\Brand::where('id', '=', $products[$i]['brand_id'])->first();?>
            <a href="{{ url('/brand').'/'.$brand->id}}">{{$brand->name}}</a>
          </span>
        </span>
      </div>

      <div class="name">
        <a href="{{ url('/product').'/'.$products[$i]['id']}}">{{$products[$i]['name']}}</a>
      </div>

      <div class="description">{{$products[$i]['description']}}</div>

      <div class="price">
        <?php 
          $currency = session()->get('cur_currency');
          $symbol = session()->get('cur_symbol');
          $old_price = $products[$i]['price']*$currency;
          $new_price = $old_price - $products[$i]['discount'] * $old_price /100 ;
        ?>
        <div>
          @if($products[$i]['discount'])
          <span class="price-new">{{ $symbol .' '. $new_price }}</span>
          <span class="price-old">{{ $old_price }}</span>
          @else
          <span class="price-normal">{{ $symbol .' '. $new_price }}</span>
          @endif
        </div>
      </div>

      <!-- Cart | Wishlist -->
      <div class="buttons-wrapper">
        <div class="button-group">
          <!-- Add to Cart -->
          <div class="cart-group">
            <a class="btn btn-cart" data-toggle="modal" data-target="#ProductOptions_{{$products[$i]['id']}}">
              <span class="btn-text">{{ __('home.Add to Cart') }}</span>
            </a>
          </div>
        </div>
      </div>

      <!-- Buy Now | Add to Wishlist-->
      <div class="extra-group">
        <div>
          <a class="btn btn-extra btn-extra-46"
            data-toggle="modal" data-target="#Buy_Now_{{$products[$i]['id']}}">
            <span class="btn-text">{{ __('home.Buy Now') }}</span>
          </a>
          <a class="btn btn-extra btn-extra-93" onclick="wishlist('{{$products[$i]['id']}}')" >
            <span class="btn-text">{{ __('home.Add to Wishlist') }}</span>
          </a>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal | QuickView -->
<div class="modal fade" id="ProductQuickView_{{$products[$i]['id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header backgroundBlue">
        <h5 class="modal-title ModelName" style="text-align:center;" id="exampleModalLongTitle">{{$products[$i]['name']}}</h5>
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
                          src="{{IMAGE}}images/products/{{$products[$i]['image']}}"
                          srcset="{{IMAGE}}images/products/{{$products[$i]['image']}} 2x"
                          data-largeimg="{{IMAGE}}images/products/{{$products[$i]['image']}}"
                          alt="{{$products[$i]['name']}}" title="{{$products[$i]['name']}}" width="550" height="550" />
                      </div>
                    </div>
                    <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
                  </div>

                  <!-- Labels -->
                    <div class="product-labels">
                      <?php $news= \App\Models\Product::orderBy('created_at', 'desc')->pluck('id')->take(30)->toArray();?>
                      @if(in_array($products[$i]['id'], $news))<span class="product-label product-label-29 product-label-default"><b>{{ __('home.New') }}</b></span>@endif
                      @if(array_key_exists($products[$i]['id'],$top_sales20))<span class="product-label product-label-217 product-label-default"><b>{{ __('home.Top Sales') }}</b></span>@endif
                      @if($products[$i]['stock'] == 0)<span class="product-label product-label-146 product-label-diagonal"><b>{{ __('home.Out of Stock') }}</b></span>@endif
                      @if($products[$i]['discount'])<span class="product-label product-label-28 product-label-default"><b>-{{$products[$i]['discount']}}%</b></span>@endif
                    </div>
                </div>
              </div>
            </div>

            <div class="product-right">
              <div id="product" class="product-details">
                <div class="title page-title ">{{$products[$i]['name']}}</div>
                
                <!-- Description -->
                <div class="description">
                  <p>{{$products[$i]['description']}}</p>
                </div>
                 
                <!-- Stock | Brand -->
                <div class="product-stats">
                  <ul class="list-unstyled">
                    <?php 
                      $brand = \App\Models\Brand::where('id', $products[$i]['brand_id'])->first();
                      $codes = \App\Models\Product::where('code', $products[$i]['code'])->get(); 
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
                        $old_price = $products[$i]['price']*$currency;
                        $new_price = $old_price - $products[$i]['discount'] * $old_price /100 ;
                      ?>
                      @if($products[$i]['discount'])
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
                            if($products[$i]['rating'] < 1 && $products[$i]['rating'] > 0) echo '<i class="fa fa-star-half fa-stack-1x" ></i>';
                            elseif($products[$i]['rating'] < 1) echo '<i class="fa fa-star-o fa-stack-1x" ></i>';
                            else echo '<i class="fa fa-star fa-stack-1x" ></i>';
                          ?>
                        </span>
                        <span class="fa fa-stack" style=" color: rgba(255, 214, 0, 1); ">
                          <?php 
                            if($products[$i]['rating'] < 2 && $products[$i]['rating'] > 1) echo '<i class="fa fa-star-half fa-stack-1x" ></i>';
                            elseif($products[$i]['rating'] < 2) echo '<i class="fa fa-star-o fa-stack-1x" ></i>';
                            else echo '<i class="fa fa-star fa-stack-1x" ></i>';
                          ?>
                        </span>
                        <span class="fa fa-stack" style=" color: rgba(255, 214, 0, 1); ">
                          <?php 
                            if($products[$i]['rating'] < 3 && $products[$i]['rating'] > 2) echo '<i class="fa fa-star-half fa-stack-1x" ></i>';
                            elseif($products[$i]['rating'] < 3) echo '<i class="fa fa-star-o fa-stack-1x" ></i>';
                            else echo '<i class="fa fa-star fa-stack-1x" ></i>';
                          ?>
                        </span>
                        <span class="fa fa-stack" style=" color: rgba(255, 214, 0, 1); ">
                          <?php 
                            if($products[$i]['rating'] < 4 && $products[$i]['rating'] > 3) echo '<i class="fa fa-star-half fa-stack-1x" ></i>';
                            elseif($products[$i]['rating'] < 4) echo '<i class="fa fa-star-o fa-stack-1x" ></i>';
                            else echo '<i class="fa fa-star fa-stack-1x" ></i>';
                          ?>
                        </span>
                        <span class="fa fa-stack" style=" color: rgba(255, 214, 0, 1); ">
                          <?php 
                            if($products[$i]['rating'] < 5 && $products[$i]['rating'] > 4) echo '<i class="fa fa-star-half fa-stack-1x" ></i>';
                            elseif($products[$i]['rating'] < 5) echo '<i class="fa fa-star-o fa-stack-1x" ></i>';
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
                href="{{ url('/product').'/'.$products[$i]['id']}}"
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

<!-- Model | Available Options -->
<div class="modal fade" id="ProductOptions_{{$products[$i]['id']}}" tabindex="-1" role="dialog" aria-labelledby="ModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" style="width:400px;" role="document">
    <div class="modal-content">
      <div class="modal-header backgroundBlue">
        <h5 class="modal-title ModelName" style="text-align:center;" id="ModalCenterTitle">{{$products[$i]['name']}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" style="position: absolute; top: -27px; right: 10px;">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <div class="product-info out-of-stock has-extra-button " style="margin:auto 10%;">

          <div id="product" class="product-details">
            <form id="form_cart_{{$products[$i]['id']}}">
              <div id="content_{{$products[$i]['id']}}">
                <div class="product-options">
                  <h3 class="options-title title">{{ __('home.Available Options') }}</h3>
                  <!-- Color -->
                  @if($products[$i]['color'])
                  <div class="form-group required product-option-select">
                    <label class="control-label" for="color_{{$products[$i]['id']}}">{{ __('home.Color') }}</label>
                    <?php 
                    $colores = [];
                    $all_colores = \App\Models\Product::where('code', $products[$i]['code'])->get();
                    foreach ($all_colores as $color) {
                      $new_color = $color->color;
                      if(!in_array($new_color, $colores))array_push($colores, $new_color);
                    }
                    ?>
                    <input type="hidden" id="code_{{$products[$i]['id']}}" value="{{$products[$i]['code']}}">
                    <select name="color_{{$products[$i]['id']}}" id="color_{{$products[$i]['id']}}" onchange="selectSize({{$products[$i]['id']}}, 'code_', 'color_', 'size_', 'size')" class="form-control">
                      <option value=""> --- {{ __('home.Please Select') }} ---</option>
                      @foreach ($colores as $color)
                        <option value="{{$color}}">{{$color}}</option>
                      @endforeach
                    </select>
                  </div>
                  @endif

                  <!-- Size -->
                  @if($products[$i]['size'])
                  <div class="form-group required product-option-select">
                    <label class="control-label" for="size_{{$products[$i]['id']}}">{{ __('home.Size') }}</label>
                    <select name="size_{{$products[$i]['id']}}" id="size_{{$products[$i]['id']}}" class="form-control">
                      <option value=""> --- {{ __('home.Please Select') }} ---</option>
                      @if(!$products[$i]['color'])
                        <?php $all_size = \App\Models\Product::where('code', $products[$i]['code'])->get(); ?>
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
                    <div id="QTYError_{{$products[$i]['id']}}" ></div>
                    <div class="stepper-group cart-group">
                      <!-- Qty -->
                      <div class="stepper form-group input-group">
                        <label class="control-label" for="quantity_{{$products[$i]['id']}}">{{ __('home.Qty') }}</label>
                        <input  id="quantity_{{$products[$i]['id']}}" type="text" name="quantity_{{$products[$i]['id']}}"  value="1"  data-minimum="1" class="form-control" />
                        <input id="product_id_{{$products[$i]['id']}}" type="hidden" name="product_id_{{$products[$i]['id']}}" value="{{$products[$i]['id']}}"/>
                        <span>
                          <i class="fa fa-angle-up"></i>
                          <i class="fa fa-angle-down"></i>
                        </span>
                      </div>
                      <!-- Add to Cart -->
                      <button
                        id="button_cart_{{$products[$i]['id']}}"
                        type="submit"
                        onclick="addToCart(event, {{$products[$i]['id']}}, 'form_cart_', 'button_cart_', '', 'QTYError_', 'content_', 'ProductOptions_', 'quantity_')"
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

<!-- Model | Available Options | Buy Now -->
<div class="modal fade" id="Buy_Now_{{$products[$i]['id']}}" tabindex="-1" role="dialog" aria-labelledby="ModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" style="width:400px;" role="document">
    <div class="modal-content">
      <div class="modal-header backgroundBlue">
        <h5 class="modal-title ModelName" style="text-align:center;" id="ModalCenterTitle">{{$products[$i]['name']}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" style="position: absolute; top: -27px; right: 10px;">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <div class="product-info out-of-stock has-extra-button " style="margin:auto 10%;">

          <div id="product" class="product-details">
            <form id="buy_form_cart_{{$products[$i]['id']}}">
              <div id="buy_content_{{$products[$i]['id']}}">
                <div class="product-options">
                  <h3 class="options-title title">{{ __('home.Available Options') }}</h3>
                  <!-- Color -->
                  @if($products[$i]['color'])
                  <div class="form-group required product-option-select">
                    <label class="control-label" for="buy_color_{{$products[$i]['id']}}">{{ __('home.Color') }}</label>
                    <?php 
                    $colores = [];
                    $all_colores = \App\Models\Product::where('code', $products[$i]['code'])->get();
                    foreach ($all_colores as $color) {
                      $new_color = $color->color;
                      if(!in_array($new_color, $colores))array_push($colores, $new_color);
                    }
                    ?>
                    <input type="hidden" id="buy_code_{{$products[$i]['id']}}" value="{{$products[$i]['code']}}">
                    <select name="color_{{$products[$i]['id']}}" id="buy_color_{{$products[$i]['id']}}" onchange="selectSize({{$products[$i]['id']}}, 'buy_code_', 'buy_color_', 'buy_size_', 'size')" class="form-control">
                      <option value=""> --- {{ __('home.Please Select') }} ---</option>
                      @foreach ($colores as $color)
                        <option value="{{$color}}">{{$color}}</option>
                      @endforeach
                    </select>
                  </div>
                  @endif

                  <!-- Size -->
                  @if($products[$i]['size'])
                  <div class="form-group required product-option-select">
                    <label class="control-label" for="buy_size_{{$products[$i]['id']}}">{{ __('home.Size') }}</label>
                    <select name="size_{{$products[$i]['id']}}" id="buy_size_{{$products[$i]['id']}}" class="form-control">
                      <option value=""> --- {{ __('home.Please Select') }} ---</option>
                      @if(!$products[$i]['color'])
                        <?php $all_size = \App\Models\Product::where('code', $products[$i]['code'])->get(); ?>
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
                    <div id="buy_QTYError_{{$products[$i]['id']}}" ></div>
                    <div class="stepper-group cart-group">
                      <!-- Qty -->
                      <div class="stepper form-group input-group">
                        <label class="control-label" for="quantity_{{$products[$i]['id']}}">{{ __('home.Qty') }}</label>
                        <input  id="buy_quantity_{{$products[$i]['id']}}" type="text" name="quantity_{{$products[$i]['id']}}"  value="1"  data-minimum="1" class="form-control" />
                        <input id="product_id_{{$products[$i]['id']}}" type="hidden" name="product_id_{{$products[$i]['id']}}" value="{{$products[$i]['id']}}"/>
                        <span>
                          <i class="fa fa-angle-up"></i>
                          <i class="fa fa-angle-down"></i>
                        </span>
                      </div>
                      <!-- Add to Cart -->
                      <button
                        id="buy_now_btn_{{$products[$i]['id']}}"
                        type="submit"
                        onclick="buyNowAdd(event, {{$products[$i]['id']}}, 'buy_form_cart_', 'buy_now_btn_', 'buy_', 'buy_QTYError_', 'Buy_Now_', 'buy_quantity_')"
                        data-loading-text="<span class='btn-text'>Buy Now</span>"
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
<?php } ?>
{{ $products->links() }}