@extends('front.layouts.main')

<!-- *************************** -->
<!-- ***** Head | Sections ***** -->
<!-- *************************** -->
@section('htmlClass')
desktop win  mozilla oc30 is-guest route-common-cart-info ul li route-product-product product-360 store-0 skin-1 desktop-header-active compact-sticky mobile-sticky layout-2
@endsection

@section('Title')
{{$product->name}}
@endsection

@section('TitleURL')
{{ url('/product').'/'. $product->id}}
@endsection

@section('TitleImage')
{{ URL::to('/storage') }}/images/products/{{$product->image}}
@endsection

@section('TitleDesc')
{{$product->description}}
@endsection

@section('cssAssets')
284b41ac07ff884955d0cacb6d4d77e2fdc9.css?v=7f711446
@endsection

@section('cssfile')
style_pro
@endsection

@section('jsAssets')
d331f857d88bb95ba7c9e71c4f63a97bfdc9.js?v=7f711446
@endsection

@section('jsLibraries')
  <style type="text/css">
    .img-zoom-result {
      border: 1px solid #d4d4d4;
      width: 300px;
      height: 300px;
      position: absolute !important;
      display: none;
      z-index: 10;
      left: 50%;
      background-repeat: no-repeat;
    }
    .img-zoom-lens {
      position: absolute;
      border: 1px solid #d4d4d4;
      width: 70px;
      height: 70px;
    }
  </style>
@endsection

<!-- ******************** -->
<!-- ***** Contents ***** -->
<!-- ******************** -->
@section('content')
<ul class="breadcrumb">
  <li><a href="{{ url('/') }}"><i class="fa fa-home"></i>{{ __('home.Home') }}</a></li>
  <?php 
    $parentCats = [];
    $parent = \App\Models\Category::where('id', $product->cat_id)->first();
    array_push($parentCats, $parent);
    while ($parent->parent_id > 0){
        $parent = \App\Models\Category::where('id', $parent->parent_id)->first();
        array_push($parentCats, $parent);
    }
    $parentCats=array_reverse($parentCats);
    
    $top_sales20 = top_sales20();
  ?>
  
  @foreach($parentCats as $parent)
    <li><a href="{{ url('/category').'/'.$parent->id }}">{{$parent->name}}</a></li>
  @endforeach
  <li><a href="{{ url('/product').'/'.$product->id }}">{{$product->name}}</a></li>
</ul>
<h1 class="title page-title"><span>{{$product->name}}</span></h1>

<input type="hidden" value="{{$product->code}}" id="pro_code" name="pro_code">
<div id="product-product" class="container">
  <div class="row">
    <div id="content">
      <div class="product-info has-extra-button DirectionLeft">

        <div class="product-left">
          <!-- Images | main-addational -->
          <div class="product-image direction-vertical position-left">
            <!-- Main Image -->
            <div 
            data-options='{"speed":0,"autoplay":false,"pauseOnHover":false,"loop":false}'
              class="swiper main-image"
              style="width: calc(100% - 80px)">
              <div class="swiper-container DivImage">
                <div class="swiper-wrapper">
                  <div 
                    class="swiper-slide"
                    data-gallery=".lightgallery-product-images"
                    data-index="0">
                    <img
                      id="mainImag"
                      class="MAINIMAGE"
                      src="{{IMAGE}}images/products/{{$product->image}}"
                      srcset="{{IMAGE}}images/products/{{$product->image}}"
                      alt="{{$product->name}}" 
                      title="{{$product->name}}" 
                      width="550" height="550" />
                  </div>
                  <?php $product_codes = \App\Models\Product::where([['code', '=', $product->code],['id', '!=', $product->id]])->get(); ?>
                  @for($i=0; $i<$product_codes->count(); $i++)
                  <div
                    class="swiper-slide"
                    data-gallery=".lightgallery-product-images"
                    data-index="{{$i+1}}">
                    <img
                      class="MAINIMAGE"
                      src="{{IMAGE}}images/products/{{$product_codes[$i]->image}}"
                      alt="{{$product_codes[$i]->name}}"
                      title="{{$product_codes[$i]->name}}"
                      width="550" height="550" />
                  </div>
                  @endfor
                </div>
              </div>

              <div class="swiper-controls">
                <div class="swiper-buttons">
                  <div class="swiper-button-prev"></div>
                  <div class="swiper-button-next"></div>
                </div>
                <div class="swiper-pagination"></div>
              </div>

              <!-- Labels -->
                <div class="product-labels">
                  <?php $news= \App\Models\Product::orderBy('created_at', 'desc')->pluck('id')->take(30)->toArray();?>
                  @if(in_array($product->id, $news))<span class="product-label product-label-29 product-label-default"><b>{{ __('home.New') }}</b></span>@endif
                  @if($product->stock == 0)<span class="product-label product-label-146 product-label-diagonal"><b>{{ __('home.Out of Stock') }}</b></span>@endif
                  @if($product->discount)<span class="product-label product-label-28 product-label-default"><b>-{{$product->discount}}%</b></span>@endif
                  @if(array_key_exists($product->id,$top_sales20))<span class="product-label product-label-217 product-label-default"><b>{{ __('home.Top Sales') }}</b></span>@endif
                </div>
            </div>

            <!-- Addational Images -->
            <div 
              class="swiper additional-images"
              data-options='{"slidesPerView":"auto","spaceBetween":0,"direction":"vertical"}'
              style="width: 80px">
              <div class="swiper-container">
                <div class="swiper-wrapper">

                  <div class="swiper-slide additional-image" data-index="0">
                    <img 
                      class="clickedImage"
                      src="{{IMAGE}}images/products/{{$product->image}}"
                      alt="{{$product->name}}"
                      title="{{$product->name}}" />
                  </div>

                  @for($i=0; $i<$product_codes->count(); $i++)
                  <div class="swiper-slide additional-image" data-index="{{$i+1}}">
                    <img 
                      class="clickedImage"
                      src="{{IMAGE}}images/products/{{$product_codes[$i]->image}}"
                      alt="{{$product_codes[$i]->name}}"
                      title="{{$product_codes[$i]->name}}" />
                  </div>
                  @endfor
                </div>
              </div>
                    
              <div class="swiper-buttons">
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
              </div>
              <div class="swiper-pagination"></div>
            </div>
          </div>

          <!-- Images Page Zooming -->
          <div 
            class="lightgallery lightgallery-product-images"
            data-images='[
              {
              "src":"{{URL::to("storage")}}/images/products/{{$product->image}}",
              "thumb":"{{URL::to("storage")}}/images/products/{{$product->image}}",
              "subHtml":"{{$product->name}}"
              }

              <?php if($product_codes->count()>0) { echo ",";
                for($i=0; $i<$product_codes->count()-1; $i++) { ?>
              {
              "src":"{{URL::to("storage")}}/images/products/{{$product_codes[$i]->image}}",
              "thumb":"{{URL::to("storage")}}/images/products/{{$product_codes[$i]->image}}",
              "subHtml":"{{$product_codes[$i]->name}}"
              },
              <?php } ?>                  

              <?php $lastItem = $product_codes->count()-1 ?>
              {
              "src":"{{URL::to("storage")}}/images/products/{{$product_codes[$lastItem]->image}}",
              "thumb":"{{URL::to("storage")}}/images/products/{{$product_codes[$lastItem]->image}}",
              "subHtml":"{{$product_codes[$lastItem]->name}}"
              }
              <?php } ?>
            ]'
            data-options='{"thumbWidth":80,"thumbConHeight":80,"addClass":"lg-product-images","mode":"lg-slide","download":true,"fullScreen":false}'>
          </div>

          <!-- Reviews -->
          <div class="product-blocks blocks-image">
            <div class="product-blocks-image product-blocks-244 grid-rows">
              <div class="grid-row grid-row-244-1">
                <div class="grid-cols">
                  <div class="grid-col grid-col-244-1-1">
                    <div class="grid-items">
                      <div class="grid-item grid-item-244-1-1-1">
                        <div class="module module-side_products module-side_products-222 carousel-mode">
                          <div class="module-body side-products-tabs">
                            <ul class="nav nav-tabs">
                              <li class="tab-1 active">
                                <a href="#side_products-5f17d67a291a9-tab-1" data-toggle="tab">{{ __('home.Reviews') }}</a>
                              </li>
                              <li class="tab-2">
                                <a href="#side_products-5f17d67a291a9-tab-2" data-toggle="tab">{{ __('home.Write a review') }}</a>
                              </li>
                            </ul>
                            <div class="tab-content">

                              <!-- Reviews -->
                              <div class="module-item module-item-1 tab-pane active "
                                id="side_products-5f17d67a291a9-tab-1">
                                <div
                                  class="swiper"
                                  data-items-per-row='{"c0":{"0":{"items":3,"spacing":10},"470":{"items":2,"spacing":10}},"c1":{"0":{"items":2,"spacing":10}},"c2":{"0":{"items":2,"spacing":10}},"sc":{"0":{"items":1,"spacing":10}}}'
                                  data-options='{"speed":400,"autoplay":false,"pauseOnHover":true,"loop":false}'>
                                  <div class="swiper-container">
                                    <div class="swiper-wrapper side-products">
                                      <?php $reviews = \App\Models\Review::where([['product_id', $product->id],['status', 'Accepted'] ] )->get(); 
                                      if($reviews->count() == 0) { ?>
                                        <div>
                                          <span>{{ __('home.No Reviews Yet') }}</span>
                                        </div>
                                      <?php } else {  
                                        foreach($reviews as $review){
                                        $user = \App\Models\User::where('id', $review->user_id)->first(); ?>
                                        <div class="product-layout swiper-slide ">
                                          <div class="side-product">
                                            <div class="image">
                                              <div  class="product-img">
                                                <?php
                                                  if($user->image) $user_img = URL::to('storage').'/images/users/'.$user->image;
                                                  else $user_img = URL::to('front').'/image/catalog/default_user.png';
                                                ?>
                                                <img 
                                                  src="{{$user_img}}"
                                                  data-src="{{$user_img}}" data-srcset="{{$user_img}} 1x, {{$user_img}} 2x"
                                                  alt="{{$user->name}}" title="{{$user->name}}"
                                                  class="img-first lazyload" width="60" height="60" style="border-radius: 50%;" />
                                              </div>
                                            </div>
                                            
                                            <div class="caption">
                                              <div class="price">
                                                <span class="price-new">{{$user->name}}</span>
                                              </div>

                                              <div class="rating-stars">
                                                @for($i = 1; $i <= 5; $i++)
                                                  <span class="fa fa-stack" style=" color: rgba(255, 214, 0, 1); ">
                                                    <?php 
                                                      if($review->stars < $i && $review->stars > $i-1) echo '<i class="fa fa-star-half fa-stack-1x" ></i>';
                                                      elseif($review->stars < $i) echo '<i class="fa fa-star-o fa-stack-1x" ></i>';
                                                      else echo '<i class="fa fa-star fa-stack-1x" ></i>';
                                                    ?>
                                                  </span>
                                                @endfor
                                              </div>
                                              
                                              <div class="name">
                                                <span>{{$review->feedback}}</span>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      <?php } }?>
                                    </div>
                                  </div>

                                  <div class="swiper-buttons">
                                    <div class="swiper-button-prev"></div>
                                    <div class="swiper-button-next"></div>
                                  </div>
                                  <div class="swiper-pagination"></div>
                                </div>
                              </div>

                              <!-- Write a review -->
                              <div class="module-item module-item-2 tab-pane DirectionRight"
                                id="side_products-5f17d67a291a9-tab-2">
                                <div class="block-body expand-block">
                                  <div class="block-wrapper">
                                    <div class="block-content ">
                                      <form class="form-horizontal" id="form-review">
                                        <div id="review"></div>
                                        <h4>{{ __('home.Write a review') }}</h4>
                                        <div class="form-group required">
                                          <label class="col-sm-2 control-label" for="input-review">{{ __('home.Your Opinion') }}</label>
                                          <div class="col-sm-10">
                                            <textarea name="feedback"  id="input-review" class="form-control">
                                            </textarea>
                                          </div>
                                        </div>
                                        <div class="form-group required">
                                          <label class="col-sm-2 control-label">{{ __('home.Ratingg') }}</label>
                                          <div class="col-sm-10 rate">
                                            <span>{{ __('home.Bad') }}</span>
                                            <input type="radio" name="rating" value="1" />
                                            <input type="radio" name="rating" value="2" />
                                            <input type="radio" name="rating" value="3" />
                                            <input type="radio" name="rating" value="4" />
                                            <input type="radio" name="rating" value="5" />
                                            <span>{{ __('home.Good') }}</span>
                                          </div>
                                        </div>

                                        <div class="clearfix">
                                          <div class="pull-right">
                                            <a
                                              type="button" id="button-review"
                                              class="btn btn-primary"
                                              onclick="review('{{$product->id}}')"
                                              data-loading-text="<span class='btn-text'>{{ __('home.Continue') }}</span>">
                                              <span class="btn-text">{{ __('home.Continue') }}</span>
                                            </a>
                                          </div>
                                        </div>
                                      </form>
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
        </div>

        <!-- Zoooom Div -->
        <div  id="myresult" class="img-zoom-result"></div>

        <div class="product-right DirectionRight">
          <div id="product" class="product-details">
            <div class="title page-title">{{$product->name}}</div>
            <!-- Free Shipping | Tabs -->
            <div class="product-blocks blocks-top">
              <!-- Free Shipping -->
              @if($product->price>=200)
              <div class="product-blocks-top product-blocks-230 grid-rows">
                <div class="grid-row grid-row-230-1">
                  <div class="grid-cols">
                    <div class="grid-col grid-col-230-1-1">
                      <div class="grid-items">
                        <div class="grid-item grid-item-230-1-1-1">
                          <div class="module module-info_blocks module-info_blocks-232">
                            <div class="module-body">
                              <div class="module-item module-item-1 info-blocks info-blocks-icon">
                                <div class="info-block">
                                  <div class="info-block-content">
                                    <div class="info-block-title">
                                      {{ __('home.This product qualifies for free shipping') }}
                                    </div>
                                    <div class="info-block-text">{{ __('home.This block for free shipping') }}
                                      
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
              @endif

              <!-- Tabs -->
              <div class="tabs-container product_extra product_tabs product_tabs-top">
                <ul class="nav nav-tabs">
                  <li class="active">
                    <a href="#product_tabs-5f194b26a6d0f" data-toggle="tab">{{ __('home.Description') }}</a>
                  </li>
                  <li class="">
                    <a href="#product_tabs-5f194b26a45c6" data-toggle="tab">{{ __('home.Detailed information') }}</a>
                  </li>
                </ul>

                <div class="tab-content">
                  <div class="product_extra-266 tab-pane active" id="product_tabs-5f194b26a6d0f">
                    <div class="block-body expand-block">
                      <div class="block-wrapper">
                        <div class="block-content expand-content">
                          <p>{{$product->description}}</p>
                          <div class="block-expand-overlay">
                            <a class="block-expand btn"></a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="product_extra-264 tab-pane" id="product_tabs-5f194b26a45c6">
                    <div class="block-body expand-block">
                      <div class="block-wrapper">
                        <div class="block-content ">
                          <div id="tab-specification">
                            @if($product->more_info) {{$product->more_info}}
                            @else {{ __('home.There is No Detailed Information.') }}
                            @endif
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Stock | Brand -->
            <div class="product-stats">
              <!-- Stock -->
              <ul class="list-unstyled">
                <?php $codes = \App\Models\Product::where('code', $product->code)->get(); 
                $stock = 0;
                foreach ($codes as $code) $stock += $code->stock;
                ?>
                <li class="product-stock in-stock"><b>{{ __('home.Stock') }}:</b> <span>{{$stock}}</span></li>
              </ul>
              <!-- Brand -->
              <div class="brand-image product-manufacturer">
                <?php $brand = \App\Models\Brand::where('id', $product->brand_id)->first();  ?>
                <a href="{{url('/brand')}}/{{$brand->id}}">
                  <img 
                    src="{{IMAGE}}images/brands/{{$brand->image}}"
                    srcset="{{IMAGE}}images/brands/{{$brand->image}} 1x,{{IMAGE}}images/brands/{{$brand->image}} 2x"
                    alt="Ericksson" />
                  <span>{{$brand->name}}</span>
                </a>
              </div>
            </div>

            <!-- Based on 0 reviews. -->
            <div class="rating rating-page">
              <div class="rating-stars">
                @for($i = 1; $i <= 5; $i++)
                  <span class="fa fa-stack" style=" color: rgba(255, 214, 0, 1); ">
                    <?php 
                      if($product->rating < $i && $product->rating > $i-1) echo '<i class="fa fa-star-half-o fa-stack-1x" ></i>';
                      elseif($product->rating < $i) echo '<i class="fa fa-star-o fa-stack-1x" ></i>';
                      else echo '<i class="fa fa-star fa-stack-1x" ></i>';
                    ?>
                  </span>
                @endfor
              </div>
              <div class="review-links">
                <a>{{ __('home.Based on x reviews', ['attribute' => count($reviews)]) }}</a>
              </div>
            </div>

            <!-- Price -->
            <div class="product-price-group">
              <div class="price-wrapper">
                <div class="price-group">
                   <?php 
                    $currency = session()->get('cur_currency');
                    $symbol = session()->get('cur_symbol');
                    $old_price = $product->price*$currency;
                    $new_price = $old_price - $product->discount * $old_price /100 ;
                  ?>
                  @if($product->discount)
                  <div class="product-price-new">{{ $symbol .' '. $new_price }}</div>
                  <div class="product-price-old">{{ $old_price }}</div>
                  @else
                  <div class="product-price-new">{{ $symbol .' '. $old_price }}</div>
                  @endif
                </div>
                <!-- <div class="product-tax">Ex Tax: $999.00</div> -->
              </div>
            </div>

            <!-- Options | Buttons -->
            <div class="product-options">
              <h3 class="options-title title">{{ __('home.Available Options') }}</h3>
              <form id="form-cart">
              <!-- Color -->
              @if($product->color)
              <div class="form-group required product-option-select">
                <label class="control-label" for="color">{{ __('home.Color') }}</label>
                <?php 
                $colores = [];
                $all_colores = \App\Models\Product::where('code', $product->code)->get();
                foreach ($all_colores as $color) {
                  $new_color = $color->color;
                  if(!in_array($new_color, $colores))array_push($colores, $new_color);
                }
                ?>
                <select name="color" id="color" class="form-control">
                  <option value=""> --- {{ __('home.Please Select') }} ---</option>
                  @foreach ($colores as $color)
                    <option value="{{$color}}">{{$color}}</option>
                  @endforeach
                </select>
              </div>
              @endif

              <!-- Size -->
              @if($product->size)
              <div class="form-group required product-option-select">
                <label class="control-label" for="size">{{ __('home.Size') }}</label>
                <select name="size" id="size" class="form-control">
                  <option value=""> --- {{ __('home.Please Select') }} ---</option>
                  @if(!$product->color)
                    <?php $all_size = \App\Models\Product::where('code', $product->code)->get(); ?>
                    @foreach ($all_size as $size)
                      <option value="{{$size->size}}">{{$size->size}}</option>
                    @endforeach
                  @endif
                </select>
              </div>
              @endif

              <!-- Buttons -->
              <div class="button-group-page">
                <div class="buttons-wrapper">
                  <!-- Qty | Cart | Buy | Ask -->
                  <div id="QTYError" ></div>
                  <div class="stepper-group cart-group">
                    <!-- Qty -->
                    <div class="stepper form-group input-group">
                      <label class="control-label" for="quantity">{{ __('home.Qty') }}</label>
                      <input 
                        id="quantity"
                        type="text"
                        name="quantity"
                        value="1"
                        data-minimum="1"
                        class="form-control" />
                      <input id="product-id" type="hidden" name="product_id" value="{{$product->id}}" />
                      <span>
                        <i class="fa fa-angle-up"></i>
                        <i class="fa fa-angle-down"></i>
                      </span>
                    </div>
                      
                    <!-- Add to Cart -->
                    <a id="button-cart" onclick="addToCart(event, {{$product->id}})" data-loading-text="<span class='btn-text'>{{ __('home.Add to Cart') }}</span>" class="btn btn-cart">
                      <span class="btn-text">{{ __('home.Add to Cart') }}</span>
                    </a>
                      
                    <!-- Buy Now | Ask Question -->
                    <div class="extra-group">
                      <a 
                      class="btn btn-extra btn-extra-46 btn-1-extra"
                      id="buy_now_btn" onclick="buyNowAdd('{{$product->id}}')"
                      data-loading-text="<span class='btn-text'>{{ __('home.Buy Now') }}</span>">
                        <span class="btn-text">{{ __('home.Buy Now') }}</span>
                      </a>
                      <a 
                        class="btn btn-extra btn-extra-93 btn-2-extra"
                        id="add_to_wish_list" onclick="wishlist('{{$product->id}}')"
                        data-loading-text="<span class='btn-text'>{{ __('home.Wishlist') }}</span>">
                        <span class="btn-text">{{ __('home.Wishlist') }}</span>
                      </a>
                    </div>
                  </div>

                  <!-- Wish List -->
                  <!-- <div class="wishlist-compare" id="add_to_wish_list" onclick="wishlist('{{$product->id}}')">
                    <a class="btn btn-wishlist">
                      <span class="btn-text">Add to Wish List</span>
                    </a>
                  </div> -->

                  <!-- Model | Ask Question -->
                  <div class="modal fade" id="ask_question_{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="ModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" style="width:40%;" role="document">
                      <div class="modal-content">
                        <div class="modal-header backgroundBlue">
                          <h5 class="modal-title ModelName" style="text-align:center;" id="ModalCenterTitle">{{ __('home.About This Product') }}</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" style="position: absolute; top: -27px; right: 10px;">&times;</span>
                          </button>
                        </div>

                        <div class="modal-body">
                          <div class="product-details">
                            <div class="site-wrapper">
                              <div class="grid-rows">
                                <div class="grid-cols">
                                  <div class="grid-col grid-col-1">
                                    <div class="grid-items">
                                      <div class="grid-item grid-item-1">
                                        <div class="module module-form module-form-198">
                                          <div class="module-body">
                                          <div class="content_ask_ques">
                                            <form id="form_ask_ques" class="form-horizontal">
                                              @csrf
                                              <fieldset>
                                                <div class="form-group custom-field required">
                                                  <label class="col-sm-2 control-label" for="name">{{ __('home.Your Name') }}</label>
                                                  <div class="col-sm-10">
                                                    <input type="text" id="name" name="name" placeholder="Your Name" class="form-control">
                                                  </div>
                                                </div> 
                                                <div class="form-group custom-field required">
                                                  <label class="col-sm-2 control-label" for="email">{{ __('home.Your Email') }}</label>
                                                  <div class="col-sm-10">
                                                    <input type="email" id="email" name="email" placeholder="Your Email" class="form-control">
                                                  </div>
                                                </div>
                                                <div class="form-group custom-field ">
                                                  <label class="col-sm-2 control-label" for="message">{{ __('home.Message') }}</label>
                                                  <div class="col-sm-10">
                                                    <textarea id="message" name="message" rows="5" placeholder="Message" class="form-control"></textarea>
                                                  </div>
                                                </div>
                                              </fieldset>
                                              <div id="button_ask_ques">
                                                <input type="hidden" id="product_id" value="{{$product->id}}">
                                                <button type="button" class="btn btn-primary" data-loading-text="<span>Submit</span>">
                                                  <span>{{ __('home.Submit') }}</span>
                                                </button>
                                              </div>
                                            </form>
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

                </form>
                </div>
              </div>
            </div>
          </div>
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
<script  src="{{ asset('front') }}/theme/assets/3e7596d4bb59fda7041af1e1fd9de833fdc9.js?v=7f711446"></script>
<script  src="{{ asset('front') }}/js/product.js"></script>
@include('front.includes.trans_select') 

</body>
</html>
@endsection



