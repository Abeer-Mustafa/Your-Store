
<div class="modal fade" id="footer_deals_quickView_{{$pro->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                    <li class="product-stock in-stock"><b>{{ __('home.Stock') }}: </b> <span>{{$stock}}</span></li>
                    <li class="product-manufacturer"><b>{{ __('home.Brand') }}: </b><a href="{{url('/brand')}}/{{$brand->id}}" target="_blank">{{$brand->name}}</a></li>
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