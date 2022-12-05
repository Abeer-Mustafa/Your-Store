<!-- ****************************  -->
<!-- ***** Modal | QuickView ***** -->
<!-- ****************************  -->

<?php 
  // Special Deals
  $products= \App\Models\Product::where('discount', '>', 0)->orderBy('discount', 'desc')->get(); 
  $specialDeals= getUniqueProBrand($products)->take(10); 

  // Best Sales
  $topSales = top_sales10();
  $top_sales20 = top_sales20();

  // Best Rated
  $products= \App\Models\Product::orderBy('rating', 'desc')->get(); 
  $topBrands= getUniqueProBrand($products)->take(8); 

  // You might also like
  if(Session::has('footer_might_like')) $might_like = session()->get('footer_might_like');
  else $might_like = $specialDeals;

  // Recommendations for you
  if(Session::has('footer_recommndations')) $recommndations = session()->get('footer_recommndations');
  else $recommndations = $specialDeals;
?>

<!-- Special Deals -->
@foreach($specialDeals as $pro)
  @include('front.includes.footer_model')
@endforeach

<!-- Top Sales -->
@foreach($topSales as $key => $value)
  <?php $pro = \App\Models\Product::whereId($key)->first(); ?>
  @include('front.includes.footer_model')
@endforeach

<!-- Top Brands -->
@foreach($topBrands as $pro)
  @include('front.includes.footer_model')
@endforeach

<!-- You might also like -->
@foreach($might_like as $pro)
  @include('front.includes.footer_model')
@endforeach

<!-- Recommndations for you -->
@foreach($recommndations as $pro)
  @include('front.includes.footer_model')
@endforeach

<footer>
  <div class="grid-rows">
    
    <!-- Tabs -->
    <div class="grid-row grid-row-1">
      <div class="grid-cols">
        <div class="grid-col grid-col-1">
          <div class="grid-items">
            <div class="grid-item grid-item-1">
              <div class="module module-side_products module-side_products-39 carousel-mode">
                <div class="module-body side-products-tabs">

                  <ul class="nav nav-tabs">
                    <li class="tab-1 active"> <a href="#side_products-5f17d06a0f727-tab-1" data-toggle="tab">{{ __('home.Special Deals') }}</a> </li>
                    <li class="tab-2"> <a href="#side_products-5f17d06a0f727-tab-2" data-toggle="tab">{{ __('home.Best Sales') }}</a> </li> 
                    <li class="tab-3"> <a href="#side_products-5f17d06a0f727-tab-3" data-toggle="tab">{{ __('home.Best Rated') }}</a> </li>
                    @guest
                      @if(Session::has('footer_might_like'))
                        <li class="tab-4"> <a href="#side_products-5f17d06a0f727-tab-4" data-toggle="tab">{{ __('home.You might also like') }}</a> </li> 
                      @endif
                    @else
                      @if(Session::has('footer_recommndations'))
                        <li class="tab-5"> <a href="#side_products-5f17d06a0f727-tab-5" data-toggle="tab">{{ __('home.Recommendations for you') }}</a> </li>
                      @endif
                    @endguest
                  </ul>

                  <div class="tab-content">

                    <!-- Special Deals -->
                    <div class="module-item module-item-1 tab-pane active" id="side_products-5f17d06a0f727-tab-1">
                      <div class="swiper"
                        data-items-per-row='{"c0":{"0":{"items":5,"spacing":10},"1024":{"items":3,"spacing":10},"760":{"items":3,"spacing":10},"470":{"items":2,"spacing":10}},"c1":{"0":{"items":4,"spacing":10},"1024":{"items":3,"spacing":10},"760":{"items":2,"spacing":10}},"c2":{"0":{"items":3,"spacing":10},"1024":{"items":2,"spacing":10}},"sc":{"0":{"items":1,"spacing":10}}}'
                        data-options='{"speed":500,"autoplay":false,"pauseOnHover":true,"loop":false}'>
                        <div class="swiper-container">
                          <div class="swiper-wrapper side-products">
                            @foreach($specialDeals as $pro)
                              @include('front.includes.footer_pro_item')
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
                    
                    <!-- Top Sales -->
                    <div class="module-item module-item-2 tab-pane" id="side_products-5f17d06a0f727-tab-2">
                      <div class="swiper"
                        data-items-per-row='{"c0":{"0":{"items":5,"spacing":10},"1024":{"items":3,"spacing":10},"760":{"items":3,"spacing":10},"470":{"items":2,"spacing":10}},"c1":{"0":{"items":4,"spacing":10},"1024":{"items":3,"spacing":10},"760":{"items":2,"spacing":10}},"c2":{"0":{"items":3,"spacing":10},"1024":{"items":2,"spacing":10}},"sc":{"0":{"items":1,"spacing":10}}}'
                        data-options='{"speed":500,"autoplay":false,"pauseOnHover":true,"loop":false}'>
                        <div class="swiper-container">
                          <div class="swiper-wrapper side-products">
                            @foreach($topSales as $key => $value)
                              <?php $pro = \App\Models\Product::whereId($key)->first(); ?>
                              @include('front.includes.footer_pro_item')
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

                    <!-- Top Brands -->
                    <div class="module-item module-item-3 tab-pane" id="side_products-5f17d06a0f727-tab-3">
                      <div class="swiper"
                        data-items-per-row='{"c0":{"0":{"items":5,"spacing":10},"1024":{"items":3,"spacing":10},"760":{"items":3,"spacing":10},"470":{"items":2,"spacing":10}},"c1":{"0":{"items":4,"spacing":10},"1024":{"items":3,"spacing":10},"760":{"items":2,"spacing":10}},"c2":{"0":{"items":3,"spacing":10},"1024":{"items":2,"spacing":10}},"sc":{"0":{"items":1,"spacing":10}}}'
                        data-options='{"speed":500,"autoplay":false,"pauseOnHover":true,"loop":false}'>
                        <div class="swiper-container">
                          <div class="swiper-wrapper side-products">
                            @foreach($topBrands as $pro)
                              @include('front.includes.footer_pro_item')
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

                    <!-- You might also like -->
                    <div class="module-item module-item-4 tab-pane" id="side_products-5f17d06a0f727-tab-4">
                      <div class="swiper"
                        data-items-per-row='{"c0":{"0":{"items":5,"spacing":10},"1024":{"items":3,"spacing":10},"760":{"items":3,"spacing":10},"470":{"items":2,"spacing":10}},"c1":{"0":{"items":4,"spacing":10},"1024":{"items":3,"spacing":10},"760":{"items":2,"spacing":10}},"c2":{"0":{"items":3,"spacing":10},"1024":{"items":2,"spacing":10}},"sc":{"0":{"items":1,"spacing":10}}}'
                        data-options='{"speed":500,"autoplay":false,"pauseOnHover":true,"loop":false}'>
                        <div class="swiper-container">
                          <div class="swiper-wrapper side-products">
                            @foreach($might_like as $pro)
                              @include('front.includes.footer_pro_item')
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

                    <!-- Recommndations for you -->
                    <div class="module-item module-item-5 tab-pane" id="side_products-5f17d06a0f727-tab-5">
                      <div class="swiper"
                        data-items-per-row='{"c0":{"0":{"items":5,"spacing":10},"1024":{"items":3,"spacing":10},"760":{"items":3,"spacing":10},"470":{"items":2,"spacing":10}},"c1":{"0":{"items":4,"spacing":10},"1024":{"items":3,"spacing":10},"760":{"items":2,"spacing":10}},"c2":{"0":{"items":3,"spacing":10},"1024":{"items":2,"spacing":10}},"sc":{"0":{"items":1,"spacing":10}}}'
                        data-options='{"speed":500,"autoplay":false,"pauseOnHover":true,"loop":false}'>
                        <div class="swiper-container">
                          <div class="swiper-wrapper side-products">
                            @foreach($recommndations as $pro)
                              @include('front.includes.footer_pro_item')
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

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Logo | Links -->
    <div class="grid-row grid-row-2">
      <div class="grid-cols">
        <!-- Logo | social media -->
        <div class="grid-col grid-col-1">
          <div class="grid-items">
            <div class="grid-item grid-item-1">
              <div class="module module-blocks module-blocks-257 blocks-grid">
                <div class="module-body">
                  <div class="module-item module-item-1 no-expand">
                    <div class="block-body expand-block">
                      <div class="block-header">
                        <img
                          src="{{ asset('front') }}/image/catalog/logo/logo.png"
                          srcset="{{ asset('front') }}/image/catalog/logo/logo.png 1x, {{ asset('front') }}/image/catalog/logo/logo.png 2x"
                          alt="Your Store" width="200" height="" class="block-image" />
                      </div>
                      <div class="block-wrapper">
                        <div class="block-content  block-html">
                          <p><b>{{ __('home.Address') }}</b></p>
                          <p></p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="grid-item grid-item-2">
              <div class="icons-menu icons-menu-61">
                <ul>
                  <li class="menu-item icons-menu-item icons-menu-item-1 icon-menu-icon">
                    <a data-toggle="tooltip" data-tooltip-class="icons-menu-tooltip-61" data-placement="top"
                      title="{{ __('home.Facebook') }}" href="{{ url('/') }}">
                      <span class="links-text">{{ __('home.Facebook') }}</span>
                    </a>
                  </li>
                  <li class="menu-item icons-menu-item icons-menu-item-2 icon-menu-icon">
                    <a data-toggle="tooltip" data-tooltip-class="icons-menu-tooltip-61" data-placement="top"
                      title="{{ __('home.Twitter') }}" href="{{ url('/') }}">
                      <span class="links-text">{{ __('home.Twitter') }}</span>
                    </a>
                  </li>
                  <li class="menu-item icons-menu-item icons-menu-item-3 icon-menu-icon">
                    <a data-toggle="tooltip" data-tooltip-class="icons-menu-tooltip-61" data-placement="top"
                      title="{{ __('home.Instagram') }}" href="{{ url('/') }}">
                      <span class="links-text">{{ __('home.Instagram') }}</span>
                    </a>
                  </li>
                  <li class="menu-item icons-menu-item icons-menu-item-4 icon-menu-icon">
                    <a data-toggle="tooltip" data-tooltip-class="icons-menu-tooltip-61" data-placement="top"
                      title="{{ __('home.Google') }}" href="{{ url('/') }}">
                      <span class="links-text">{{ __('home.Google') }}</span>
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>

        <!-- Customer Service -->
        <div class="grid-col grid-col-2">
          <div class="grid-items">
            <div class="grid-item grid-item-1">
              <div class="links-menu links-menu-75">
                <h3 class="title module-title">{{ __('home.Customer Service') }}</h3>
                <ul class="module-body">
                  <li class="menu-item links-menu-item links-menu-item-1">
                    <a href="{{ url('/contact') }}">
                      <span class="links-text">{{ __('home.Contact') }}</span>
                    </a></li>
                  <li class="menu-item links-menu-item links-menu-item-2">
                    <a href="{{ url('/about') }}">
                      <span class="links-text">{{ __('home.About') }}</span>
                    </a></li>
                  <li class="menu-item links-menu-item links-menu-item-3">
                    <a href="{{ url('/profile') }}">
                      <span class="links-text">{{ __('home.My Account') }}</span>
                    </a></li>
                  <li class="menu-item links-menu-item links-menu-item-4">
                    <a href="{{ url('/wishlist') }}">
                      <span class="links-text">{{ __('home.My Wish list') }}</span>
                    </a></li>
                  <li class="menu-item links-menu-item links-menu-item-5">
                    <a href="{{ url('/cart') }}">
                      <span class="links-text">{{ __('home.My Shopping Cart') }}</span>
                    </a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>

        <!-- Brands -->
        <div class="grid-col grid-col-3">
          <div class="grid-items">
            <div class="grid-item grid-item-1">
              <div class="links-menu links-menu-76">
                <h3 class="title module-title"><a href="{{ url('/brands') }}" style="color:#fff;">{{ __('home.All Brands') }}</a></h3>
                <ul class="module-body">
                  <?php $brandsfooter = \App\Models\Brand::take(5)->get(); ?>
                  @foreach($brandsfooter as $brand)
                  <li class="menu-item links-menu-item links-menu-item-1">
                    <a href="{{ url('/brand').'/'.$brand->id }}">
                      <span class="links-text">{{ $brand->name }}</span>
                    </a>
                  </li>
                  @endforeach
                </ul>
              </div>
            </div>
          </div>
        </div>

        <!-- Categories -->
        <div class="grid-col grid-col-4">
          <div class="grid-items">
            <div class="grid-item grid-item-1">
              <div class="links-menu links-menu-76">
                <h3 class="title module-title"><a href="{{ url('/categories') }}" style="color:#fff;">{{ __('home.All Categories') }}</a></h3>
                <ul class="module-body">
                  <?php $catsFooter = \App\Models\Brand::take(5)->get(); ?>
                  @foreach($catsFooter as $cat)
                  <li class="menu-item links-menu-item links-menu-item-1">
                    <a href="{{ url('/cat').'/'.$cat->id }}">
                      <span class="links-text">{{ $cat->name }}</span>
                    </a>
                  </li>
                  @endforeach
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Copyright | Payments Methods-->
    <div class="grid-row grid-row-3">
      <div class="grid-cols">

        <!-- Copyright -->
        <div class="grid-col grid-col-1">
          <div class="grid-items">
            <div class="grid-item grid-item-1">
              <div class="links-menu links-menu-77">
                <ul class="module-body">
                  <li class="menu-item links-menu-item links-menu-item-1">
                    <a>
                      <span class="links-text">{{ __('home.Copyright') }}</span>
                    </a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>

        <!-- Payments Methods -->
        <div class="grid-col grid-col-2">
          <div class="grid-items">
            <div class="grid-item grid-item-1">
              <div class="icons-menu icons-menu-228">
                <ul>
                  <li class="menu-item icons-menu-item icons-menu-item-1 icon-menu-icon">
                    <a data-toggle="tooltip" data-tooltip-class="icons-menu-tooltip-228" data-placement="top"
                      title="{{ __('home.Visa') }}" href="#">
                      <span class="links-text">{{ __('home.Visa') }}</span>
                    </a></li>
                  <li class="menu-item icons-menu-item icons-menu-item-2 icon-menu-icon">
                    <a data-toggle="tooltip" data-tooltip-class="icons-menu-tooltip-228" data-placement="top"
                      title="{{ __('home.Mastercard') }}" href="#">
                      <span class="links-text">{{ __('home.Mastercard') }}</span>
                    </a></li>
                  <li class="menu-item icons-menu-item icons-menu-item-4 icon-menu-icon">
                    <a data-toggle="tooltip" data-tooltip-class="icons-menu-tooltip-228" data-placement="top"
                      title="{{ __('home.Discover') }}" href="#">
                      <span class="links-text">{{ __('home.Discover') }}</span>
                    </a></li>
                  <li class="menu-item icons-menu-item icons-menu-item-5 icon-menu-icon">
                    <a data-toggle="tooltip" data-tooltip-class="icons-menu-tooltip-228" data-placement="top"
                      title="{{ __('home.Paypal') }}" href="#">
                      <span class="links-text">{{ __('home.Paypal') }}</span>
                    </a></li>
                  <li class="menu-item icons-menu-item icons-menu-item-6 icon-menu-icon">
                    <a data-toggle="tooltip" data-tooltip-class="icons-menu-tooltip-228" data-placement="top"
                      title="{{ __('home.Stripe') }}" href="#">
                      <span class="links-text">{{ __('home.Stripe') }}</span>
                    </a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</footer>

</div>

<!-- scroll to top -->
<div class="scroll-top">
  <i class="fa fa-angle-up"></i>
</div>