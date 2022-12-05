
<?php 
$total_price = 0;
$cart_content = \App\Models\Cart::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->get(); ?>
<li class="cart-products">
 <table class="table">
    @foreach($cart_content as $cart_item )
      <?php $pro = App\Models\Product::where('id', $cart_item->product_id)->first();
      if($cart_item->quantity > $pro->stock ) $cur_qty = $pro->stock; 
      else $cur_qty = $cart_item->quantity;
      ?>
      <tr id="pro_cart_{{$cart_item->id}}">
        <td class="text-center td-image" style="width:30%;"> 
          <a href="{{url('/product')}}/{{$pro->id}}">
            <img 
            src='{{IMAGE}}images/products/{{$pro->image}}'
            alt="{{$pro->name}}"
            title="{{$pro->name}}"/>
          </a>
        </td>

        <td class="text-left td-name">
          <a href="{{url('/product')}}/{{$pro->id}}">{{$pro->name}}</a>
          <br /> 
          @if ($pro->color)
            <span>{{__('home.Color')}}</span>
            <small>{{$pro->color}}</small>
            <br />
          @endif
          @if ($pro->size)
            <span>{{__('home.Size')}}</span>
            <small>{{$pro->size}}</small>
            <br />
          @endif

        </td>

        <td class="text-right td-qty">x {{$cur_qty}}</td>

        <?php $currency = session()->get('cur_currency');
        $symbol = session()->get('cur_symbol');
        $old_price = $pro->price*$currency;
        $price = ($old_price - $pro->discount * $old_price /100) * $cur_qty;
        $total_price += $price;
        ?>

        <td class="text-right td-total">{{$symbol}} {{$price}}</td>
        <td class="text-center td-remove">
          <button type="button" onclick="removeItem('{{$cart_item->id}}');" title="{{ __('home.Remove') }}" class="cart-remove">
            <i class="fa fa-times-circle"></i>
          </button>
        </td>
      </tr>       
    @endforeach
 </table>
</li> 

<li class="cart-totals"> 
  <div> 
    <table class="table table-bordered"> 
      <tr> 
        <td class="text-right td-total-title">{{ __('home.Total Price') }}:</td> 
        <td class="text-right td-total-text" id="total_price">{{$total_price}} {{$symbol}}</td> 
      </tr> 
    </table> 

    <div class="cart-buttons"> 
      <a class="btn-cart btn" href="{{url('/cart')}}"> 
        <i class="fa"></i><span>{{ __('home.View Cart') }}</span> 
      </a> 
      <a class="btn-checkout btn" href="{{url('/checkout')}}"> 
        <i class="fa"></i><span>{{ __('home.Checkout') }}</span> 
      </a> 
    </div> 
  </div> 
</li> 
