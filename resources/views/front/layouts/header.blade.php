<body class="" id="bodyContent">
  <!-- ================ -->
  <!-- mobile-main-menu -->
  <!-- ================ -->
  <div class="mobile-container mobile-main-menu-container">
    <div class="mobile-wrapper-header">
      <span>{{ __('home.Menu') }}</span>
      <div class="language-currency top-menu">
        <div class="mobile-currency-wrapper"></div>
        <div class="mobile-language-wrapper"></div>
      </div>
      <a class="x"></a>
    </div>
    <div class="mobile-main-menu-wrapper">
      <div style="padding-left: 14px; padding-top: 10px;" class="accordion-menu">
        <ul class="j-menu">
          <li> <a href="{{ url('/') }}"><span class="links-text LinksMobile">{{ __('home.Home') }}</span></a> </li> 
          <li> <a href="{{ url('/about') }}"><span class="links-text LinksMobile">{{ __('about.About Us') }}</span></a> </li> 
          <li> <a href="{{ url('/contact') }}"><span class="links-text LinksMobile">{{ __('home.Contact') }}</span></a> </li>
          @guest
            <li> <a href="{{ route('login') }}"><span class="links-text LinksMobile">{{ __('home.Login') }}</span></a> </li>
            @if (Route::has('register'))
              <li> <a href="{{ route('register') }}"><span class="links-text LinksMobile">{{ __('home.Register') }}</span></a> </li>
            @endif
            @else
            <li> <a href="{{ url('/profile') }}"> <span class="links-text LinksMobile">{{ Auth::user()->name }}</span></a> </li>
            <li> <a href="{{ url('/wishlist') }}"><span class="links-text LinksMobile">{{ __('home.Wishlist') }}</span></a> </li>
            <li> 
              <a 
              href="{{ route('logout') }}" 
              onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              <span class="links-text LinksMobile">{{ __('home.Logout') }}</span></a> 
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;"> @csrf </form>
            </li>
          @endguest
        </ul>
      </div>
    </div>
  </div>

  <div class="mobile-container mobile-filter-container">
    <div class="mobile-wrapper-header"></div>
    <div class="mobile-filter-wrapper"></div>
  </div>

  <div class="mobile-container mobile-cart-content-container">
    <div class="mobile-wrapper-header">
      <span>{{ __('home.Your Cart') }}</span>
      <a class="x"></a></div>
    <div class="mobile-cart-content-wrapper cart-content"></div>
  </div>

  <div class="site-wrapper">
    <header class="header-compact">
      <div class="header header-compact header-sm">

        <!-- ====================================== -->
        <!-- Navbar [1] - Home - Currency - Account -->
        <!-- ====================================== -->
        <div class="top-bar navbar-nav">
          <!-- Home -->
          <div class="top-menu top-menu-2">
            <ul class="j-menu">
              <li class="menu-item top-menu-item top-menu-item-1">
                <a href="{{ url('/') }}"><span class="links-text">{{ __('home.Home') }}</span></a>
              </li>
              <li class="menu-item top-menu-item top-menu-item-2">
                <a href="{{ url('/about') }}"><span class="links-text">{{ __('about.About Us') }}</span></a>
              </li>
              <li class="menu-item top-menu-item top-menu-item-3">
                <a href="{{ url('/contact') }}"><span class="links-text">{{ __('home.Contact') }}</span></a>
              </li>

              <li class="menu-item top-menu-item top-menu-item-4">
                <div class="languages">
                  <div style="padding: 5px;" class="dropdown drop-menu">
                    <button style="background-color: black; color: rgba(182, 187, 198, 1);" type="button" class="dropdown-toggle" data-toggle="dropdown">
                      <span class="currency-symbol-title">
                        <span style="font-weight: 700" class="symbol">{{ __('home.Languages') }}</span>
                      </span>
                    </button>
                    <div class="dropdown-menu j-dropdown">
                      <ul class="j-menu" id="ul_languages">
                        <li>
                          <a class="currency-select" data-lang="eng" href="{{ url('/setlocale/en') }}">
                            <img src="{{ asset('front/image/catalog/flags/en.jpg') }}" width="30" alt="English-image" height="12">
                            &nbsp; &nbsp;
                            <span>{{ __('home.English') }}</span>
                          </a>
                        </li>
                        <li>
                          <a class="currency-select" data-lang="ar" href="{{ url('/setlocale/ar') }}">
                            <img src="{{ asset('front/image/catalog/flags/ar.png') }}" width="30" alt="English-image" height="12">
                            &nbsp; &nbsp;
                            <span >{{ __('home.Arabic') }}</span>
                          </a>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </li>
            </ul>
          </div>

          <!-- Currency -->
          <div class="language-currency top-menu">
            <div class="desktop-language-wrapper"></div>
            <div class="desktop-currency-wrapper">
              <div id="currency" class="currency">
                <?php 
                  $symbol = session()->get('cur_symbol');
                  $title = session()->get('cur_title');
                  $code = session()->get('cur_code');
                ?>
                <form action="{{ url('/currency') }}" method="get" id="form_currency">
                  <div class="dropdown drop-menu">
                    <button type="button" class="dropdown-toggle" data-toggle="dropdown">
                      <span class="currency-symbol-title">
                        <span class="symbol">{{ $symbol }}</span>
                        <span class="currency-title">{{ $title }}</span>
                        <span class="currency-code">{{ $code }}</span>
                      </span>
                    </button>
                    <div class="dropdown-menu j-dropdown">
                      <ul class="j-menu" id="ul_currency">
                        <li dataCode="EUR">
                          <a class="currency-select">
                            <span class="currency-symbol">€</span>
                            <span class="currency-title-dropdown">{{ __('home.Euro') }}</span>
                            <span class="currency-code-dropdown">EUR</span>
                          </a>
                        </li>
                        <li dataCode="USD">
                          <a class="currency-select">
                            <span class="currency-symbol">$</span>
                            <span class="currency-title-dropdown">{{ __('home.US Dollar') }}</span>
                            <span class="currency-code-dropdown">USD</span>
                          </a>
                        </li>
                        <li dataCode="SAR">
                          <a class="currency-select">
                            <span class="currency-symbol">SAR</span>
                            <span class="currency-title-dropdown">{{ __('home.Saudi Riyal') }}</span>
                            <span class="currency-code-dropdown">SAR</span>
                          </a>
                        </li>
                        <li dataCode="AED">
                          <a class="currency-select">
                            <span class="currency-symbol">AED</span>
                            <span class="currency-title-dropdown">{{ __('home.Emirati Dirham') }}</span>
                            <span class="currency-code-dropdown">AED</span>
                          </a>
                        </li>
                        <li dataCode="SYP">
                          <a class="currency-select">
                            <span class="currency-symbol">SYP</span>
                            <span class="currency-title-dropdown">{{ __('home.Syrian Pound') }}</span>
                            <span class="currency-code-dropdown">SYP</span>
                          </a>
                        </li>
                        <li dataCode="EGP">
                          <a class="currency-select">
                            <span class="currency-symbol">EGP</span>
                            <span class="currency-title-dropdown">{{ __('home.Egyptian Pound') }}</span>
                            <span class="currency-code-dropdown">EGP</span>
                          </a>
                        </li>
                      </ul>
                    </div>
                  </div>
                  <input type="hidden" name="cur_input" id="cur_input" value="" />
                </form>
              </div>
            </div>
          </div>

          <!-- Account -->
          <div class="third-menu">
            <div class="top-menu top-menu-14">
              @guest
                <ul class="j-menu">
                  <li class="menu-item top-menu-item top-menu-item-1">
                    <a href="{{ route('login') }}">{{ __('home.Login') }}</a>
                  </li>
                  @if (Route::has('register'))
                    <li class="menu-item top-menu-item top-menu-item-2">
                        <a href="{{ route('register') }}">{{ __('home.Register') }}</a>
                    </li>
                  @endif
                </ul>
                @else
                <ul class="j-menu">
                  <li class="menu-item top-menu-item top-menu-item-1">
                    <a href="{{ url('/profile') }}">
                      <?php
                        if(Auth::user()->image) $user_img = IMAGE.'images/users/'.Auth::user()->image;
                        else $user_img = URL::to('front').'/image/catalog/default_user.png';
                      ?>
                      <img src="{{$user_img}}" data-src="{{$user_img}}" width="30" height="30" alt="{{Auth::user()->name}}" title="{{Auth::user()->name}}" style="border-radius: 50%;" />
                      &nbsp;<span class="links-text">{{ Auth::user()->name }}</span>
                    </a>
                  </li> 

                  <li class="menu-item top-menu-item top-menu-item-5">
                    <a href="{{ url('/wishlist') }}"><span class="links-text">{{ __('home.Wishlist') }}</span></a>
                  </li>
                  
                  <li class="menu-item top-menu-item top-menu-item-2">
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                      <span class="links-text">{{ __('home.Logout') }}</span>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;"> @csrf </form>
                  </li>
                </ul>
              @endguest
            </div>
          </div>
        </div>
                                
        <!-- ================================================ -->
        <!-- Navbar [2] - Logo - Departements - Search & Cart -->
        <!-- ================================================ -->
        <div class="mid-bar navbar-nav">
          <!-- Logo -->
          <div class="desktop-logo-wrapper">
            <div id="logo">
              <a href="{{ url('/') }}">
                <img src="{{ asset('front') }}/image/catalog/logo/logo.png"
                  srcset="{{ asset('front') }}/image/catalog/logo/logo.png 1x, {{ asset('front') }}/image/catalog/logo/logo.png 2x"
                  width="161" height="35" alt="Logo" title="Logo" />
              </a>
            </div>
          </div>

          <!-- Departements -->
          <?php $cats = \App\Models\Category::where('parent_id', '=', 0)->take(8)->get();
          $brands = \App\Models\Brand::take(6)->get(); ?>
          <div class="desktop-main-menu-wrapper navbar-nav">
            <div class="menu-trigger menu-item main-menu-item">
              <ul class="j-menu">
                <li><a>Menu</a></li>
              </ul>
            </div>

            <div id="main-menu" class="main-menu main-menu-3">
              <ul class="j-menu">
                <!-- All Categories -->
                <li class="menu-item main-menu-item main-menu-item-1 dropdown mega-menu menu-fullwidth mega-fullwidth ">
                  <a href="#All_Categories" class="dropdown-toggle"
                    data-toggle="dropdown">
                    <span class="links-text">{{ __('home.All Departments') }}</span>
                    <span class="open-menu collapsed" data-toggle="collapse" data-target="#collapse-5f19493791b26">
                      <i class="fa fa-plus"></i>
                    </span>
                  </a>

                  <div class="dropdown-menu j-dropdown " id="collapse-5f19493791b26">
                    <div class="mega-menu-content">
                      <div class="grid-rows">
                        <div class="grid-row grid-row-1">
                          <div class="grid-cols">

                            <div class="grid-col grid-col-1">
                              <div class="grid-items">
                                <div class="grid-item grid-item-1">
                                  <div class="module module-catalog module-catalog-69 image-on-hover">
                                    <div class="module-body">

                                      @foreach($cats as $cat)
                                      <div class="module-item module-item-1">
                                        <div class="item-content">
                                          <a href="{{ url('/category').'/'.$cat->id }}"
                                            class="catalog-title">{{ $cat->name }}
                                          </a>
                                          <div class="item-assets image-left">
                                            <a href="{{ url('/category').'/'.$cat->id }}"
                                              class="catalog-image">
                                              <img
                                                src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGQAAABkAQMAAABKLAcXAAAABlBMVEUAAAAEAgSXNbeIAAAAAXRSTlMAQObYZgAAAAlwSFlzAAAOxAAADsQBlSsOGwAAABRJREFUOMtjYBgFo2AUjIJRQE8AAAV4AAEpcbn8AAAAAElFTkSuQmCC"
                                                data-src="{{IMAGE}}images/cats/{{ $cat->image }}"
                                                data-image="{{IMAGE}}images/cats/{{ $cat->image }}"
                                                data-srcset="{{IMAGE}}images/cats/{{ $cat->image }} 1x, {{IMAGE}}images/cats/{{ $cat->image }} 2x"
                                                alt="{{ $cat->name }}" width="100" height="100" class="lazyload" />
                                            </a>
                                            <div class="subitems">
                                              <?php 
                                                $subCats = \App\Models\Category::where('parent_id', '=', $cat->id)->take(4)->get();
                                              ?>
                                              @foreach($subCats as $subCat)
                                              <div class="subitem"
                                                data-image="{{IMAGE}}images/cats/{{ $subCat->image }}"
                                                data-image2x="{{IMAGE}}images/cats/{{ $subCat->image }} 1x, {{IMAGE}}images/cats/{{ $subCat->image }} 2x">
                                                <a
                                                  href="{{ url('/category').'/'.$subCat->id }}"><span>{{ $subCat->name }}</span></a>
                                              </div>
                                              @endforeach


                                              <div class="subitem view-more">
                                                <a href="{{ url('/category').'/'.$cat->id }}"><span>{{ __('home.View More') }}</span></a></div>
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

                            <div class="grid-col grid-col-2">
                              <div class="grid-items">
                                <div class="grid-item grid-item-1">
                                  <div id="banners-5f17d069d25af" class="module module-banners module-banners-98">
                                    <div class="module-body">
                                      <div class="module-item module-item-1">
                                        <a href="{{ url('/products')}}">
                                          <img
                                            src="{{ asset('front')}}/image/catalog/imgs/17-tall-220x320h.jpg"
                                            srcset="{{ asset('front')}}/image/catalog/imgs/17-tall-220x320h.jpg 1x, {{ asset('front') }}/image/catalog/imgs/17-tall-220x320h.jpg 2x"
                                            alt="" width="220" height="320" />
                                        </a></div>
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
                </li>
                <!-- All Brands -->
                <li class="menu-item main-menu-item main-menu-item-4 dropdown mega-menu menu-fullwidth mega-fullwidth ">
                  <a href="#All_Brands" class="dropdown-toggle"
                    data-toggle="dropdown">
                    <span class="links-text">{{ __('home.Top Brands') }}</span>
                    <span class="open-menu collapsed" data-toggle="collapse" data-target="#collapse-5f194937928ad">
                      <i class="fa fa-plus"></i>
                    </span>
                    {{-- <span class="menu-label">New</span> --}}
                  </a>
                  <div class="dropdown-menu j-dropdown " id="collapse-5f194937928ad">
                    <div class="mega-menu-content">
                      <div class="grid-rows">
                        <div class="grid-row grid-row-1">
                          <div class="grid-cols">
                            <div class="grid-col grid-col-1">
                              <div class="grid-items">
                                <div class="grid-item grid-item-1">
                                  <div class="module module-catalog module-catalog-161 image-on-hover">
                                    <div class="module-body">
                                      @foreach($brands as $brand)
                                      <div class="module-item module-item-1">
                                        <div class="item-content">
                                          <a href="{{ url('/brand').'/'.$brand->id}}"
                                            class="catalog-title">{{ $brand->name }}</a>
                                          <div class="item-assets image-left">
                                            <a href="{{ url('/brand').'/'.$brand->id}}"
                                              class="catalog-image">
                                              <img
                                                src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGQAAABkAQMAAABKLAcXAAAABlBMVEUAAAAEAgSXNbeIAAAAAXRSTlMAQObYZgAAAAlwSFlzAAAOxAAADsQBlSsOGwAAABRJREFUOMtjYBgFo2AUjIJRQE8AAAV4AAEpcbn8AAAAAElFTkSuQmCC"
                                                data-src="{{IMAGE}}images/brands/{{ $brand->image }}"
                                                data-image="{{IMAGE}}images/brands/{{ $brand->image }}"
                                                data-srcset="{{IMAGE}}images/brands/{{ $brand->image }} 1x, {{IMAGE}}images/brands/{{ $brand->image }} 2x"
                                                alt="{{ $brand->name }}" width="100" height="100" class="lazyload" />
                                            </a>
                                            <div class="subitems">
                                              <?php 
                                                $pros_brand= \App\Models\Product::where('brand_id', '=', $brand->id)->get(); 
                                                $codes = array();
                                                foreach ($pros_brand as $key => $pro) {
                                                    if( in_array($pro->code, $codes) ) $pros_brand->forget($key);
                                                    else array_push($codes, $pro->code);
                                                }
                                                $pros_brand = $pros_brand->take(4);
                                              ?>
                                              @foreach($pros_brand as $pro)
                                                <div class="subitem"
                                                  data-image="{{IMAGE}}images/products/{{$pro->image}}"
                                                  data-image2x="{{IMAGE}}images/products/{{$pro->image}} 1x, {{IMAGE}}images/products/{{$pro->image}} 2x">
                                                  <a href="{{ url('product').'/'.$pro->id }}">
                                                    <span>{{ $pro->name }}</span>
                                                  </a>
                                                </div>
                                              @endforeach
                                              <div class="subitem view-more">
                                                <a href="{{ url('/brand').'/'.$brand->id}}">
                                                  <span>{{ __('home.View More') }}</span>
                                                </a>
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
                            <div class="grid-col grid-col-2">
                              <div class="grid-items">
                                <div class="grid-item grid-item-1">
                                  <div class="module module-products module-products-186 module-products-grid carousel-mode">
                                    <div class="module-body">
                                      <div class="tab-container">
                                        <ul class="nav nav-tabs">
                                          <li class="tab-1 active">
                                            <a href="#products-5f17d069f0e2c-tab-1" data-toggle="tab">{{ __('home.Top Sales') }}</a>
                                          </li>
                                          <li class="tab-2">
                                            <a href="#products-5f17d069f0e2c-tab-2" data-toggle="tab">{{ __('home.Special Deals') }}</a>
                                          </li>
                                        </ul>
                                        <div class="tab-content">
                                          <!-- Top Sales -->
                                          <div class="module-item module-item-1 tab-pane active"
                                            id="products-5f17d069f0e2c-tab-1">
                                            <div class="swiper"
                                              data-items-per-row='{"c0":{"0":{"items":2,"spacing":20},"760":{"items":2,"spacing":10}},"c1":{"0":{"items":2,"spacing":20}},"c2":{"0":{"items":1,"spacing":20}},"sc":{"0":{"items":1,"spacing":20}}}'
                                              data-options='{"speed":500,"autoplay":false,"pauseOnHover":true,"loop":false}'>
                                              <div class="swiper-container">
                                                <div class="swiper-wrapper product-grid">
                                                  <?php 
                                                    $topSales = top_sales4(); 
                                                    $top_sales20 = top_sales20(); 
                                                  ?>
                                                  @foreach($topSales as $key => $value)
                                                    <?php $pro = \App\Models\Product::whereId($key)->first(); ?>
                                                    <div class="product-layout swiper-slide">
                                                      <div class="product-thumb">
                                                        <div class="image">
                                                          <a href="{{ url('/product').'/'.$pro->id}}" class="product-img has-second-image">
                                                            <div>
                                                              <img
                                                                src="{{IMAGE}}/images/products/{{$pro->image}}"
                                                                data-src="{{IMAGE}}/images/products/{{$pro->image}}"
                                                                width="190" height="190" 
                                                                alt="{{$pro->name}}" title="{{$pro->name}}"
                                                                class="img-responsive img-first lazyload" />
                                                              <img
                                                                src="{{IMAGE}}/images/products/{{$pro->image}}"
                                                                data-src="{{IMAGE}}/images/products/{{$pro->image}}"
                                                                width="190" height="190"
                                                                alt="{{$pro->name}}" title="{{$pro->name}}"
                                                                class="img-responsive img-second lazyload" />
                                                            </div>
                                                          </a>
                                                          <div class="product-labels">
                                                            <?php $news= \App\Models\Product::orderBy('created_at', 'desc')->pluck('id')->take(30)->toArray();?>
                                                            @if(in_array($pro->id, $news))<span class="product-label product-label-29 product-label-default"><b>{{ __('home.New') }}</b></span>@endif
                                                            @if($pro->stock == 0)<span class="product-label product-label-146 product-label-diagonal"><b>{{ __('home.Out of Stock') }}</b></span>@endif
                                                            @if($pro->discount)<span class="product-label product-label-28 product-label-default"><b>-{{$pro->discount}}%</b></span>@endif
                                                            @if(array_key_exists($pro->id,$top_sales20))<span class="product-label product-label-217 product-label-default"><b>{{ __('home.Top Sales') }}</b></span>@endif
                                                          </div>
                                                        </div>
                                                        <div class="caption">
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
                                                              <span class="price-normal">{{ $symbol .' '. $new_price }}</span>
                                                              @endif
                                                            </div>
                                                            <span class="price-tax">Ex Tax:$999.00</span>
                                                          </div>
                                                          <div class="rating rating-hover">
                                                            <div class="rating-stars">
                                                              <span class="fa fa-stack">
                                                                @if($pro->rating < 1 && $pro->rating > 0) <i class="starsYellow fa fa-star-half-o fa-stack-1x" ></i>
                                                                @elseif($pro->rating < 1) <i class="starsYellow fa fa-star-o fa-stack-1x" ></i>
                                                                @else <i class="starsYellow fa fa-star fa-stack-1x" ></i>
                                                                @endif
                                                              </span>
                                                              <span class="fa fa-stack">
                                                                @if($pro->rating < 2 && $pro->rating > 1) <i class="starsYellow fa fa-star-half-o fa-stack-1x" ></i>
                                                                @elseif($pro->rating < 2) <i class="starsYellow fa fa-star-o fa-stack-1x" ></i>
                                                                @else <i class="starsYellow fa fa-star fa-stack-1x" ></i>
                                                                @endif
                                                              </span>
                                                              <span class="fa fa-stack">
                                                                @if($pro->rating < 3 && $pro->rating > 2) <i class="starsYellow fa fa-star-half-o fa-stack-1x" ></i>
                                                                @elseif($pro->rating < 3) <i class="starsYellow fa fa-star-o fa-stack-1x" ></i>
                                                                @else <i class="starsYellow fa fa-star fa-stack-1x" ></i>
                                                                @endif
                                                              </span>
                                                              <span class="fa fa-stack">
                                                                @if($pro->rating < 4 && $pro->rating > 3) <i class="starsYellow fa fa-star-half-o fa-stack-1x" ></i>
                                                                @elseif($pro->rating < 4) <i class="starsYellow fa fa-star-o fa-stack-1x" ></i>
                                                                @else <i class="starsYellow fa fa-star fa-stack-1x" ></i>
                                                                @endif
                                                              </span>
                                                              <span class="fa fa-stack">
                                                                @if($pro->rating < 5 && $pro->rating > 4) <i class="starsYellow fa fa-star-half-o fa-stack-1x" ></i>
                                                                @elseif($pro->rating < 5) <i class="starsYellow fa fa-star-o fa-stack-1x" ></i>
                                                                @else <i class="starsYellow fa fa-star fa-stack-1x" ></i>
                                                                @endif
                                                              </span>
                                                            </div>
                                                          </div>
                                                          <div class="buttons-wrapper">
                                                            <div class="button-group">
                                                              <div class="cart-group">
                                                                <a href="{{ url('/product').'/'.$pro->id}}" class="btn btn-cart">
                                                                  <span class="btn-text">{{ __('home.More Details') }}</span>
                                                                </a>
                                                              </div>
                                                            </div>
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
                                          <!-- Special Deals -->
                                          <div class="module-item module-item-2 tab-pane"
                                            id="products-5f17d069f0e2c-tab-2">
                                            <div class="swiper"
                                              data-items-per-row='{"c0":{"0":{"items":2,"spacing":20},"760":{"items":2,"spacing":10}},"c1":{"0":{"items":2,"spacing":20}},"c2":{"0":{"items":1,"spacing":20}},"sc":{"0":{"items":1,"spacing":20}}}'
                                              data-options='{"speed":500,"autoplay":false,"pauseOnHover":true,"loop":false}'>
                                              <div class="swiper-container">
                                                <div class="swiper-wrapper product-grid">
                                                  <?php 
                                                    $specialDeals= \App\Models\Product::orderBy('discount', 'desc')->get(); 
                                                    $codes = array();
                                                    foreach ($specialDeals as $key => $pro) {
                                                        if( in_array($pro->code, $codes) ) $specialDeals->forget($key);
                                                        else array_push($codes, $pro->code);
                                                    }
                                                    $specialDeals = $specialDeals->take(4);
                                                  ?>
                                                  @foreach($specialDeals as $pro)
                                                  <div class="product-layout swiper-slide">
                                                    <div class="product-thumb">
                                                      <div class="image">
                                                        <a href="{{ url('/product').'/'.$pro->id}}" class="product-img has-second-image">
                                                          <div>
                                                            <img
                                                              src="{{IMAGE}}/images/products/{{$pro->image}}"
                                                              data-src="{{IMAGE}}/images/products/{{$pro->image}}"
                                                              width="190" height="190" 
                                                              alt="{{$pro->name}}" title="{{$pro->name}}"
                                                              class="img-responsive img-first lazyload" />
                                                            <img
                                                              src="{{IMAGE}}/images/products/{{$pro->image}}"
                                                              data-src="{{IMAGE}}/images/products/{{$pro->image}}"
                                                              width="190" height="190"
                                                              alt="{{$pro->name}}" title="{{$pro->name}}"
                                                              class="img-responsive img-second lazyload" />
                                                          </div>
                                                        </a>
                                                        <div class="product-labels">
                                                          <?php $news= \App\Models\Product::orderBy('created_at', 'desc')->pluck('id')->take(30)->toArray();?>
                                                          @if(in_array($pro->id, $news))<span class="product-label product-label-29 product-label-default"><b>{{ __('home.New') }}</b></span>@endif
                                                          @if($pro->stock == 0)<span class="product-label product-label-146 product-label-diagonal"><b>{{ __('home.Out of Stock') }}</b></span>@endif
                                                          @if($pro->discount)<span class="product-label product-label-28 product-label-default"><b>-{{$pro->discount}}%</b></span>@endif
                                                          @if(array_key_exists($pro->id,$top_sales20))<span class="product-label product-label-217 product-label-default"><b>{{ __('home.Top Sales') }}</b></span>@endif
                                                        </div>
                                                      </div>
                                                      <div class="caption">
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
                                                            <span class="price-normal">{{ $symbol .' '. $new_price }}</span>
                                                            @endif
                                                          </div>
                                                          <span class="price-tax">Ex Tax:$999.00</span>
                                                        </div>
                                                        <div class="rating rating-hover">
                                                          <div class="rating-stars">
                                                            <span class="fa fa-stack">
                                                              @if($pro->rating < 1 && $pro->rating > 0) <i class="starsYellow fa fa-star-half-o fa-stack-1x" ></i>
                                                              @elseif($pro->rating < 1) <i class="starsYellow fa fa-star-o fa-stack-1x" ></i>
                                                              @else <i class="starsYellow fa fa-star fa-stack-1x" ></i>
                                                              @endif
                                                            </span>
                                                            <span class="fa fa-stack">
                                                              @if($pro->rating < 2 && $pro->rating > 1) <i class="starsYellow fa fa-star-half-o fa-stack-1x" ></i>
                                                              @elseif($pro->rating < 2) <i class="starsYellow fa fa-star-o fa-stack-1x" ></i>
                                                              @else <i class="starsYellow fa fa-star fa-stack-1x" ></i>
                                                              @endif
                                                            </span>
                                                            <span class="fa fa-stack">
                                                              @if($pro->rating < 3 && $pro->rating > 2) <i class="starsYellow fa fa-star-half-o fa-stack-1x" ></i>
                                                              @elseif($pro->rating < 3) <i class="starsYellow fa fa-star-o fa-stack-1x" ></i>
                                                              @else <i class="starsYellow fa fa-star fa-stack-1x" ></i>
                                                              @endif
                                                            </span>
                                                            <span class="fa fa-stack">
                                                              @if($pro->rating < 4 && $pro->rating > 3) <i class="starsYellow fa fa-star-half-o fa-stack-1x" ></i>
                                                              @elseif($pro->rating < 4) <i class="starsYellow fa fa-star-o fa-stack-1x" ></i>
                                                              @else <i class="starsYellow fa fa-star fa-stack-1x" ></i>
                                                              @endif
                                                            </span>
                                                            <span class="fa fa-stack">
                                                              @if($pro->rating < 5 && $pro->rating > 4) <i class="starsYellow fa fa-star-half-o fa-stack-1x" ></i>
                                                              @elseif($pro->rating < 5) <i class="starsYellow fa fa-star-o fa-stack-1x" ></i>
                                                              @else <i class="starsYellow fa fa-star fa-stack-1x" ></i>
                                                              @endif
                                                            </span>
                                                          </div>
                                                        </div>
                                                        <div class="buttons-wrapper">
                                                          <div class="button-group">
                                                            <div class="cart-group">
                                                              <a href="{{ url('/product').'/'.$pro->id}}" class="btn btn-cart">
                                                                <span class="btn-text">{{ __('home.More Details') }}</span>
                                                              </a>
                                                            </div>
                                                          </div>
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
                        </div>
                      </div>
                    </div>
                  </div>
                </li>
              </ul>
            </div>
          </div>

          <!-- Search & Cart -->
          <div class="header-cart-group">
            <div class="top-menu secondary-menu"></div>
            <!-- Search -->
            <div class="desktop-search-wrapper mini-search">
              <div id="search" class="dropdown">
                <button class="dropdown-toggle search-trigger" data-toggle="dropdown"></button>
                <div class="dropdown-menu j-dropdown">
                  <div class="header-search">
                    <!-- meneu categories -->
                    <div class="search-categories dropdown drop-menu">
                      <div class="search-categories-button" >{{ __('home.All') }}</div>
                      
                    </div>

                    <input onkeyup="startSearch()" type="text" name="searchInput" id="myInputSearch" placeholder="{{ __('home.Search for products') }}..." class="search-input" />
                    <button onclick="goSearch()" id="buttonSearch" type="button" class="search-button"></button>
                    
                    <!-- seatch Results -->
                    <div class="tt-menu .tt-empty" style="position: absolute; top: 100%; left: 0px; z-index: 100; ">
                      <div id="myResults" class="tt-dataset tt-dataset-0">
                        <?php $products = \App\Models\Product::all(); $currency = session()->get('cur_currency'); $symbol = session()->get('cur_symbol'); ?>
                        @foreach($products as $pro)
                          <?php $old_price = $pro->price*$currency; $new_price = $old_price - $pro->discount * $old_price /100 ; ?>
                          <div style="display:none;" class="search-result tt-suggestion tt-selectable">
                            <a href="{{ url('/product').'/'.$pro->id }}">
                              <img src="{{IMAGE}}/images/products/{{$pro->image}}" width="60" height="60">
                              <span class="">
                                <span class="product-name">{{$pro->name}}</span>
                                <span class="GreenText">
                                  @if($pro->discount)
                                    <span >{{ $symbol . $new_price }}</span>&nbsp;
                                    <del>{{ $symbol . $old_price }}</del>
                                    @else
                                    <span>{{ $symbol . $new_price }}</span>
                                  @endif
                                </span>
                              </span>
                            </a>
                          </div>
                        @endforeach
                      </div>
                    </div>

                  </div>
                </div>
              </div>
            </div>

            <!-- cart -->
            <div class="desktop-cart-wrapper">
              <div id="cart" class="dropdown">
                <?php 
                  $total_price = 0;
                  if(Auth::user()) {
                    $cart_content = \App\Models\Cart::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->get();
                      
                    $items_count = 0;
                    foreach ($cart_content as $pro) {
                      $pro_stock = \App\Models\Product::whereId($pro->product_id)->first()->stock;
                      $cart_stock = $pro->quantity;
                      $cur_stock = min($pro_stock, $cart_stock);
                      $items_count += $cur_stock;
                    }
                  }
                  else $items_count = "-1" 
                ?>
                <a data-toggle="dropdown" data-loading-text="Loading..." class="dropdown-toggle cart-heading"
                  href="{{ url('/cart') }}">
                  <span id="cart-total">
                    <?php if($items_count == "-1")echo '0'; else echo $items_count; ?> item(s) - $0.00
                  </span>
                  <i class="fa fa-shopping-cart"></i>
                  @if($items_count <= 0)
                    <span id="cart-items" class="count-badge count-zero">0</span>
                  @else
                    <span id="cart-items" class="count-badge">{{$items_count}}</span>
                  @endif
                </a>
                <div id="cart-content" class="dropdown-menu cart-content j-dropdown">
                  <ul> <?php
                    if(Auth::user()){
                      if($items_count <=0){ ?>
                        <li>
                          <p class="text-center cart-empty">{{ __('home.Your shopping cart is empty!') }}</p>
                        </li> <?php 
                      } 
                      else { ?>
                        <!-- Items in cart -->
                        <li class="cart-products">
                          <table class="table">
                            @foreach($cart_content as $cart_item )
                              <?php 
                              $pro = App\Models\Product::where('id', $cart_item->product_id)->first(); 
                              if($cart_item->quantity > $pro->stock ) $cur_qty = $pro->stock; 
                              else $cur_qty = $cart_item->quantity;
                              ?>
                              <tr id="pro_cart_{{$cart_item->id}}"> 
                                <td class="text-center td-image" style="width:30%;">              
                                  <a href="{{ url('/product').'/'.$pro->id}}">
                                    <img 
                                      src="{{IMAGE}}/images/products/{{$pro->image}}"
                                      alt="{{$pro->name}}"
                                      title="{{$pro->name}}"
                                    />
                                  </a>
                                </td>
                                <td class="text-center td-name">
                                  <a href="{{ url('/product').'/'.$pro->id}}">{{$pro->name}}</a>
                                  <br />
                                  @if($pro->color)                      
                                    <span>{{ __('home.Color') }}</span>
                                    <small>{{$pro->color}}</small>
                                    <br />
                                  @endif 

                                  @if($pro->size)                      
                                    <span>{{ __('home.Size') }}</span>
                                    <small>{{$pro->size}}</small>
                                    <br />
                                  @endif
                                </td>
                                <td class="text-center td-qty">x {{$cur_qty}}</td>
                                <?php 
                                  $currency = session()->get('cur_currency');
                                  $symbol = session()->get('cur_symbol');
                                  $old_price = $pro->price*$currency;
                                  $price = ($old_price - $pro->discount * $old_price /100) * $cur_qty;
                                  $total_price += $price;
                                ?>
                                <td class="text-center td-total">{{ $symbol .' '. $price}}</td>
                                <td class="text-center td-remove">
                                  <button type="button" onclick="removeItem({{$cart_item->id}});" title="{{ __('home.Remove') }}" class="cart-remove">
                                    <i class="fa fa-times-circle"></i>
                                  </button>
                                </td>
                              </tr>
                            @endforeach

                          </table>
                        </li>

                        <!-- Buttons in cart -->
                        <li class="cart-totals">
                          <div>
                            <table class="table table-bordered">
                              <tr>
                                <td class="text-right td-total-title">{{ __('home.Total Price') }}: </td>
                                <td class="text-right td-total-text" id="total_price">{{$total_price.' '.$symbol}}</td>
                              </tr>
                            </table>
                            <div class="cart-buttons">
                              <a class="btn-cart btn" href="{{ url('/cart') }}">
                                <i class="fa"></i><span>{{ __('home.View Cart') }}</span>
                              </a>
                              <a class="btn-checkout btn" href="{{ url('/checkout') }}">
                                <i class="fa"></i>
                                <span>{{ __('home.Checkout') }}</span>
                              </a>
                            </div>
                          </div>
                        </li>

                        <?php 
                      } 
                    }
                    else { ?> 
                      <li>
                        <p class="text-center cart-empty">{{ __('home.Your shopping cart is empty!') }}</p>
                      </li> <?php 
                    } ?>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="mobile-header mobile-default mobile-1">
        <div class="mobile-top-bar">
          <div class="mobile-top-menu-wrapper">
            <div class="top-menu top-menu-13">
              <ul class="j-menu">
                <li class="menu-item top-menu-item top-menu-item-1">
                  <a href="{{ route('login') }}"><span class="links-text">{{ __('home.Login') }}</span></a></li>
                <li class="menu-item top-menu-item top-menu-item-2">
                  <a href="{{ route('register') }}"><span class="links-text">{{ __('home.Register') }}</span></a></li>
              </ul>
            </div>
          </div>
        </div>
        <div class="mobile-bar sticky-bar">
          <div class="mobile-logo-wrapper"></div>
          <div class="mobile-bar-group">
            <div class="menu-trigger"></div>
            <div class="mobile-search-wrapper mini-search"></div>
            <div class="mobile-cart-wrapper mini-cart"></div>
          </div>
        </div>
      </div>
    </header>

    <input type="hidden" value="{{url('/')}}" id="url" name="url">
    <input type="hidden" value="{{FILE}}json/countries.json" id="jsonFiel" name="jsonFiel">