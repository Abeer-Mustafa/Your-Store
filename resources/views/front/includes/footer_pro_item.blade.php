<div class="product-layout swiper-slide">
  <div class="side-product">

    <div class="image">
      <a href="{{ url('/product').'/'.$pro->id }}" class="product-img">
        <img
          src="{{IMAGE}}images/products/{{$pro->image}}"
          data-src="{{IMAGE}}images/products/{{$pro->image}}"
          width="70" height="70" alt="{{ $pro->name }}"
          title="{{ $pro->name }}"
          class="img-first lazyload" />
      </a>
      <div class="quickview-button">
        <a class="btn btn-quickview" data-toggle="modal" data-target="#footer_deals_quickView_{{$pro->id}}"
          data-tooltip-class="module-side_products-39 quickview-tooltip"
          data-placement="top" title="{{ __('home.Quickview') }}" >
          <span class="btn-text">{{ __('home.Quickview') }}</span>
        </a>
      </div>
    </div>

    <div class="caption">
      <div class="name"> <a href="{{ url('/product').'/'.$pro->id }}">{{ $pro->name }}</a> </div>
      <div class="price">
        <?php 
          $currency = session()->get('cur_currency');
          $symbol = session()->get('cur_symbol');
          $old_price = $pro->price*$currency;
          $new_price = $old_price - $pro->discount * $old_price /100 ;
        ?>
        @if($pro->discount)
        <span class="price-new">{{ $symbol .' '. $new_price }}</span>
        <span class="price-old">{{ $old_price }}</span>
        @else
        <span class="price-normal">{{ $symbol .' '. $new_price }}</span>
        @endif
      </div>
    </div>
  </div>
</div>