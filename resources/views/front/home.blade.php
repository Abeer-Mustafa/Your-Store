@extends('front.layouts.main')

<!-- *************************** -->
<!-- ***** Head | Sections ***** -->
<!-- *************************** -->
@section('htmlClass')
  desktop win mozilla oc30 is-guest route-common-home store-0 skin-1 desktop-header-active compact-sticky mobile-sticky layout-1
@endsection

@section('Title')
  {{ __('home.Your Store') }}
@endsection

@section('TitleURL')
  {{ url('/')}}
@endsection

@section('TitleImage')
{{ URL::to('/front') }}/image/catalog/logo/logo.png
@endsection

@section('TitleDesc')
  E-Commerce
@endsection

@section('cssAssets')
7e57e9b00b1eabc084a21e4dd7387162fdc9.css?v=7f711446
@endsection

@section('cssfile')
home
@endsection

@section('jsAssets')
d331f857d88bb95ba7c9e71c4f63a97bfdc9.js?v=7f711446
@endsection

@section('jsLibraries')
@endsection

<!-- ****************** -->
<!-- ***** Slider ***** -->
<!-- ****************** -->
@section('slider')
<div id="top" class="top top-row">
  <div class="grid-rows">
    <!-- Slider -->
    <div class="grid-row grid-row-top-1">
      <div class="grid-cols">
        <div class="grid-col grid-col-top-1-1">
          <div class="grid-items">
            <div class="grid-item grid-item-top-1-1-1">
              <div class="module module-master_slider module-master_slider-242" id="slider_id"
                style="background-image:{{ asset('front') }}('/image/catalog/slider/slider1.jpg');">
                <div class="journal-loading"><i class="fa fa-spinner fa-spin"></i></div>
                <img
                  src="{{ asset('front') }}/image/catalog/slider/slider1.jpg"
                  srcset="{{ asset('front') }}/image/catalog/slider/slider1.jpg 1x, {{ asset('front') }}/image/catalog/slider/slider1.jpg 2x"
                  alt="" width="1320" height="600" />
                <div class="master-slider ms-skin-minimal"
                  data-options='{"width":1320,"height":600,"layout":"fillwidth","smoothHeight":false,"centerControls":false,"parallaxMode":"swipe","instantStartLayers":true,"loop":true,"dir":"h","autoHeight":true,"rtl":false,"startOnAppear":false,"autoplay":true,"overPause":true,"shuffle":false,"view":"mask","speed":"15","swipe":true,"mouse":true,"controls":{"arrows":{"autohide":false},"bullets":{"autohide":false},"timebar":{"autohide":false,"inset":true,"align":"top"}}}'
                  data-parallax="35">
                  <div class="module-item module-item-1 ms-slide" data-delay="2.5">
                    <img
                      src="{{ asset('front') }}/image/catalog/slider/slider1.jpg"
                      srcset="{{ asset('front') }}/image/catalog/slider/slider1.jpg 1x, {{ asset('front') }}/image/catalog/slider/slider1.jpg 2x"
                      alt="" width="1320" height="600" />
                    <div class="module-subitem module-subitem-1 ms-layer ms-layer-text ms-caption" data-resize="true" data-origin="ml" data-parallax="0" data-type="text" data-position="normal" data-offset-y="-70" data-effect="right(300)" data-delay="100" data-duration="800" data-ease="easeOutQuart" data-hide-effect="fade" data-hide-delay="0" data-hide-duration="0">
                      {{ __('home.Women\'s Clothing') }} <br />{{ __('home.and Fashion') }}
                    </div>
                    <a href="{{ url('/products') }}" class="module-subitem module-subitem-3 ms-layer ms-layer-button btn" data-resize="true" data-origin="ml" data-parallax="0" data-type="button" data-position="normal" data-offset-y="80" data-effect="right(300)" data-delay="300" data-duration="800" data-ease="easeOutQuart" data-hide-effect="fade" data-hide-delay="0" data-hide-duration="0">
                      <span>{{ __('home.Shop Now') }}</span>
                    </a>
                  </div>

                  <div class="module-item module-item-2 ms-slide" data-delay="2.5">
                    <img
                      src="{{ asset('front') }}/image/catalog/slider/3.png"
                      srcset="{{ asset('front') }}/image/catalog/slider/3.png 1x, {{ asset('front') }}/image/catalog/slider/3.png 2x"
                      alt="" width="1320" height="600" />
                    <div class="module-subitem module-subitem-1 ms-layer ms-layer-text ms-caption" data-resize="true" data-origin="ml" data-parallax="0" data-type="text" data-position="normal" data-offset-y="-70" data-effect="right(300)" data-delay="100" data-duration="800" data-ease="easeOutQuart" data-hide-effect="fade" data-hide-delay="0" data-hide-duration="0">
                      {{ __('home.Discover our') }} <br /> {{ __('home.Beauty Selection') }}
                    </div>
                    <a href="{{ url('/products') }}" class="module-subitem module-subitem-3 ms-layer ms-layer-button btn" data-resize="true" data-origin="ml" data-parallax="0" data-type="button" data-position="normal" data-offset-y="80" data-effect="right(300)" data-delay="300" data-duration="800" data-ease="easeOutQuart" data-hide-effect="fade" data-hide-delay="0" data-hide-duration="0">
                      <span>{{ __('home.Shop Now') }}</span></a>
                  </div>

                  <div class="module-item module-item-3 ms-slide" data-delay="2.5">
                    <img
                      src="{{ asset('front') }}/image/catalog/slider/slider3.jpg"
                      srcset="{{ asset('front') }}/image/catalog/slider/slider3.jpg 1x, {{ asset('front') }}/image/catalog/slider/slider3.jpg 2x"
                      alt="" width="1320" height="600" />
                    <div class="module-subitem module-subitem-1 ms-layer ms-layer-text ms-caption" data-resize="true" data-origin="ml" data-parallax="0" data-type="text" data-position="normal" data-offset-y="-70" data-effect="right(300)" data-delay="100" data-duration="800" data-ease="easeOutQuart" data-hide-effect="fade" data-hide-delay="0" data-hide-duration="0">
                      {{ __('home.Shop in your') }} <br />{{ __('home.Local Currency') }}
                    </div>
                    <a href="{{ url('/products') }}" class="module-subitem module-subitem-3 ms-layer ms-layer-button btn" data-resize="true" data-origin="ml" data-parallax="0" data-type="button" data-position="normal" data-offset-y="80" data-effect="right(300)" data-delay="300" data-duration="800" data-ease="easeOutQuart" data-hide-effect="fade" data-hide-delay="0" data-hide-duration="0">
                      <span>{{ __('home.Shop Now') }}</span>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection

<!-- ******************** -->
<!-- ***** Contents ***** -->
<!-- ******************** -->
@section('content')
  <!-- Categories -->
  <div class="grid-row grid-row-top-2" >
    <svg viewBox="0 0 100 20" class="wave wave-top" preserveAspectRatio="none">
      <path fill="white" d="M 0 30 V 10 Q 25 7 55 10 T 100 10 V 30 Z"></path>
    </svg>
    <div class="grid-row grid-row-bottom-2">
      <div class="grid-cols">
        <div class="grid-col grid-col-bottom-2-1">
          <div class="grid-items">
            <div class="grid-item grid-item-bottom-2-1-1">
              <div class="module title-module module-title-143">
                <div class="title-wrapper">
                  <h3>{{ __('home.Our Categories') }}</h3>
                  <div class="title-divider"></div>
                  <div class="subtitle"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="grid-col grid-col-bottom-2-2">
          <div class="grid-items">
            <div class="grid-item grid-item-bottom-2-2-1">
              <div class="module module-manufacturers module-manufacturers-38 module-manufacturers- carousel-mode">
                <div class="module-body">
                  <div class="module-item module-item-1 swiper-slide">
                    <div class="swiper"
                      data-items-per-row='{"c0":{"0":{"items":10,"spacing":0},"1500":{"items":8,"spacing":0},"1024":{"items":7,"spacing":0},"760":{"items":4,"spacing":0}},"c1":{"0":{"items":7,"spacing":0}},"c2":{"0":{"items":3,"spacing":0}},"sc":{"0":{"items":2,"spacing":0}}}'
                      data-options='{"speed":500,"autoplay":false,"pauseOnHover":true,"loop":false}'>
                      <div class="swiper-container">
                        <div class="swiper-wrapper manufacturer-grid">
                          <?php $cats = \App\Models\Category::all(); ?>
                          @foreach($cats as $cat)
                            <div class="manufacturer-layout swiper-slide">
                              <div class="manufacturer-thumb">
                                <div class="image">
                                  <a href="{{ url('/category').'/'.$cat->id }}">
                                    <img
                                      src="{{IMAGE}}images/cats/{{$cat->image}}"
                                      data-src="{{IMAGE}}images/cats/{{$cat->image}}"
                                      data-srcset="{{IMAGE}}images/cats/{{$cat->image}} 1x, {{IMAGE}}images/cats/{{$cat->image}} 2x"
                                      width="150" height="150" alt="{{$cat->name}}" title="{{$cat->name}}"
                                      class="lazyload" />
                                  </a>
                                </div>
                                <div class="caption">
                                  <div class="name">
                                    <a href="{{ url('/category').'/'.$cat->id }}">{{$cat->name}}</a>
                                  </div>
                                </div>
                              </div>
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
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Free Shipping -->
  <div class="grid-row grid-row-top-3">
    <div class="grid-cols">
      <div class="grid-col grid-col-top-3-1">
        <div class="grid-items">
          <div class="grid-item grid-item-top-3-1-1">
            <div class="module module-info_blocks module-info_blocks-263">
              <div class="module-body">
                <div class="module-item module-item-1 info-blocks info-blocks-icon">
                  <div class="info-block">
                    <div class="info-block-content">
                      <div class="info-block-title">
                        <?php 
                          $currency = session()->get('cur_currency');
                          $symbol = session()->get('cur_symbol');
                        ?>
                        {{ __('home.Free shipping on any order above') }} {{ $symbol.$currency*200 }}.
                      </div>
                      <div class="info-block-text"></div>
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

  <!-- Products -->
  @include('front.includes.products_home') 

  <!-- Modal | Add to Wishlist successfuly -->
  <div class="modal" tabindex="-1" role="dialog" id="modalWishlist">
    <div class="modal-dialog" role="document" style="width:31%;">
      <div class="modal-content" style="background-color:#d2eac8;">
        
        <div class="modal-body">
           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <p id="contentModalWishlist">response ajax wishlist</p>
        </div>
      </div>
    </div>
  </div>

  <!-- End of Season Sale -->
  <div class="grid-row grid-row-top-5">
    <div class="grid-cols">
      <div class="grid-col grid-col-top-5-1">
        <div class="grid-items">
          <div class="grid-item grid-item-top-5-1-1">
            <div class="module module-blocks module-blocks-261 blocks-grid">
              <div class="module-body">
                <div class="module-item module-item-1">
                  <div class="block-body expand-block">
                    <h3 class="title module-title block-title textCenter">{{ __('home.End of Season Sale') }}</h3>
                    <div class="block-wrapper">
                      <div class="block-content  block-html">
                        <p>{{ __('home.Lorem Ipsum') }}&nbsp;<br>
                        </p>
                      </div>
                      <div class="block-footer"><a class="btn" href="{{ url('/products') }}">{{ __('home.Shop Now') }}</a></div>
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

<!-- Brands | What you say -->
<div id="bottom" class="bottom top-row">
  <div class="grid-rows">

    <!-- Brands -->
    <div class="grid-row grid-row-bottom-2">
      <div class="grid-cols">
        <div class="grid-col grid-col-bottom-2-1">
          <div class="grid-items">
            <div class="grid-item grid-item-bottom-2-1-1">
              <div class="module title-module module-title-143">
                <div class="title-wrapper">
                  <h3>{{ __('home.Our Brands') }}</h3>
                  <div class="title-divider"></div>
                  <div class="subtitle"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="grid-col grid-col-bottom-2-2">
          <div class="grid-items">
            <div class="grid-item grid-item-bottom-2-2-1">
              <div class="module module-manufacturers module-manufacturers-38 module-manufacturers- carousel-mode">
                <div class="module-body">
                  <div class="module-item module-item-1 swiper-slide">
                    <div class="swiper"
                      data-items-per-row='{"c0":{"0":{"items":10,"spacing":0},"1500":{"items":8,"spacing":0},"1024":{"items":7,"spacing":0},"760":{"items":4,"spacing":0}},"c1":{"0":{"items":7,"spacing":0}},"c2":{"0":{"items":3,"spacing":0}},"sc":{"0":{"items":2,"spacing":0}}}'
                      data-options='{"speed":500,"autoplay":false,"pauseOnHover":true,"loop":false}'>
                      <div class="swiper-container">
                        <div class="swiper-wrapper manufacturer-grid">
                          <?php $brands = \App\Models\Brand::all(); ?>
                          @foreach($brands as $brand)
                          <div class="manufacturer-layout swiper-slide">
                            <div class="manufacturer-thumb">
                              <div class="image">
                                <a href="{{ url('/brand').'/'.$brand->id }}">
                                  <img
                                    src="{{IMAGE}}images/brands/{{$brand->image}}"
                                    data-src="{{IMAGE}}images/brands/{{$brand->image}}"
                                    data-srcset="{{IMAGE}}images/brands/{{$brand->image}} 1x, {{IMAGE}}images/brands/{{$brand->image}} 2x"
                                    width="150" height="150" alt="{{$brand->name}}" title="{{$brand->name}}"
                                    class="lazyload" />
                                </a>
                              </div>
                              <div class="caption">
                                <div class="name">
                                  <a href="{{ url('/brand').'/'.$brand->id }}">{{$brand->name}}</a>
                                </div>
                              </div>
                            </div>
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

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- What you say -->
    <div class="grid-row grid-row-bottom-4">
      <div class="grid-col grid-col-bottom-4-2" style="margin: auto;">
        <div class="grid-items">
          <div class="grid-item grid-item-bottom-4-2-1">
            <div class="module module-testimonials module-testimonials-180 blocks-grid carousel-mode">
              <h3 class="title module-title" style="text-align: center;">{{ __('home.What you say about our products') }}</h3>
              <div class="module-body">
                <div class="swiper"
                  data-items-per-row='{"c0":{"0":{"items":1,"spacing":0}},"c1":{"0":{"items":1,"spacing":0}},"c2":{"0":{"items":1,"spacing":0}},"sc":{"0":{"items":1,"spacing":0}}}'
                  data-options='{"speed":500,"autoplay":{"delay":3000},"pauseOnHover":true,"loop":false}'>
                  <div class="swiper-container">
                    <div class="swiper-wrapper">
                    <?php $reviews = \App\Models\Review::where('status', 'Accepted')->orderBy('stars', 'desc')->take(6)->get(); ?>
                    @foreach($reviews as $review)
                      <div class="module-item module-item-1 swiper-slide">
                        <div class="block-body">
                          <div class="block-header"><i class="icon icon-block"></i></div>
                          <div class="block-content block-text">{{ $review->feedback }}</div>
                          <?php $user = \App\Models\User::where('id', $review->user_id)->first(); ?>
                          <div class="block-footer">{{$user->name}}</div>
                        </div>
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
<script  src="{{ asset('front') }}/theme/assets/608bdd2a8e5cf8cd74b96d306c67d941fdc9.js?v=7f711446" defer></script>
<script  src="{{ asset('front') }}/js/home.js"></script>
<script  src="{{ asset('front') }}/js/cart.js"></script>
@include('front.includes.trans_select') 

</body>
</html>
@endsection
