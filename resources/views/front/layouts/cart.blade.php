<?php 
$totalPrice=0;
if(count($cart) == 0) echo '<div><p style="text-align: center; font-size:20px;">'.__('home.cart is empty').'</p></div>'; 
else { ?>
<!-- Table contents -->
<div class="table-responsive">
  <table class="table table-bordered table-hover">
    <thead>
      <tr>
        <td class="text-center td-image">{{__('home.Image')}}</td>
        <td class="text-center td-name">{{__('home.Name')}}</td>
        <td class="text-center td-model">{{__('home.Info')}}</td>
        <td class="text-center td-qty">{{__('home.Quantity')}}</td>
        <td class="text-center td-price">{{__('home.Unit Price')}}</td>
        <td class="text-center td-total">{{__('home.Total')}}</td>
      </tr>
    </thead>
    <tbody>
      @foreach($cart as $item)
        <?php 
          $product = \App\Models\Product::find($item->product_id); 
          $brand = \App\Models\Brand::find($product->brand_id);
          if($item->quantity > $product->stock ) $cur_qty = $product->stock; 
          else $cur_qty = $item->quantity;
        ?>
        <tr>
          <td width="10%" class="text-center td-image"><a href="{{url('/product')}}/{{$product->id}}"><img src="{{IMAGE}}images/products/{{$product->image}}" alt="{{$product->name}}" title="{{$product->name}}" /></a></td>
          <td width="15%"class="text-center td-name"><a href="{{url('/product')}}/{{$product->id}}">{{$product->name}}</a></td>
          <td width="20%" class="td-model">
            <ul style="list-style: none; padding-left:0px;">
            <li><span>{{__('home.Brand')}}: </span><a href="{{url('/brand')}}/{{$brand->id}}">{{$brand->name}}</a></li>
            @if($product->color)<li><span>{{__('home.Color')}}: {{$product->color}}</span></li>@endif
            @if($product->size)<li><span>{{__('home.Size')}}: {{$product->size}}</span></li>@endif
            </ul>
          </td>
          
          <td width="15%" class="text-center td-qty">
            <div class="input-group btn-block">
              <div class="stepper">
                <input type="text" name="quantity" id="quantity_{{$item->id}}" value="{{$cur_qty}}" size="1" class="form-control" />
                <span>
                  <i class="fa fa-angle-up"></i>
                  <i class="fa fa-angle-down"></i>
                </span>
              </div>
              <span class="input-group-btn">
                <a id="update_item_{{$item->id}}" 
                  onclick='updateItemCart({{$item->id}})'
                  title="{{__('home.Update')}}"
                  class="update_item btn btn-warning"
                  data-loading-text="<span class='btn-text'>{{__('home.Update')}}</span>" >
                  <i class="fa fa-refresh"></i>
                </a> 

                <a id="remove_item_{{$item->id}}" 
                  onclick='removItemCart({{$item->id}})'
                  title="{{__('home.Remove')}}"
                  class="btn btn-danger"
                  data-loading-text="<span class='btn-text'>{{__('home.Remove')}}</span>" >
                  <i class="fa fa-times"></i>
                </a>
              </span>
            </div>
          </td>
          <td width="15%" class="text-center td-price">
            <div class="price">
              <?php 
                $currency = session()->get('cur_currency');
                $symbol = session()->get('cur_symbol');
                $old_price = $product->price*$currency;
                $new_price = $old_price - $product->discount * $old_price /100 ;
                $act_price = $new_price*$cur_qty;
                $totalPrice += $act_price;
                ?>
                @if($product->discount)
                  <b style="color:rgba(46, 175, 35, 1);">{{ $symbol .' '. $new_price }}</b>
                  &nbsp<s><del style="color: #e7284d;">{{ $old_price }}</del></s>
                @else
                <b style="color:rgba(46, 175, 35, 1);">{{ $symbol .' '. $old_price }}</b>
                @endif
            </div>
          </td>
          <td width="15%" class="text-center td-total"><b style="color:rgba(46, 175, 35, 1);">{{ $symbol .' '. $act_price }}</b></td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>

<!-- Total Price -->
<div class="panels-total">
  <div class="cart-total">
    <table class="table table-bordered">
      <tr>
        <td class="text-left"><strong>{{__('home.Total Price')}}:</strong></td>
        <td class="text-center"><b style="color:rgba(46, 175, 35, 1);">{{ $symbol .' '. $totalPrice }}</b></td>
      </tr>
    </table>
  </div>
</div>

<!-- Buttons -->
<div class="buttons clearfix">
  <div class="pull-left"><a href="{{ url('/') }}" class="btn btn-default"><span>{{__('home.Continue Shopping')}}</span></a></div>
  <div class="pull-right"><a href="{{ url('/checkout') }}" class="btn btn-success"><span>{{__('home.Checkout')}}</span></a></div>
</div>
<?php } ?>
