<?php 
if(count($wishlist) == 0) echo '<div><p style="text-align: center; font-size:20px;">'.__("home.wishlist is empty").'</p></div>'; 
else { ?>
<!-- Table contents -->
<div class="table-responsive">
  <table class="table table-bordered table-hover">
    <thead>
      <tr>
        <td class="text-center td-image">{{__('home.Image')}}</td>
        <td class="text-center td-name">{{__('home.Name')}}</td>
        <td class="text-center td-model">{{__('home.Brand')}}</td>
        <td class="text-center td-price">{{__('home.Price')}}</td>
        <td class="text-center td-action">{{__('home.Action')}}</td>
      </tr>
    </thead>
    <tbody>
      @foreach($wishlist as $item)
      <?php $product = \App\Models\Product::find($item->product_id);?>
        <tr class="">
          <td width="10%" class="text-center td-image"><a href="{{url('/product')}}/{{$product->id}}"><img src="{{IMAGE}}images/products/{{$product->image}}" alt="{{$product->name}}" title="{{$product->name}}" /></a></td>
          <td class="text-center td-name"><a href="{{url('/product')}}/{{$product->id}}">{{$product->name}}</a></td>
          <?php $brand = \App\Models\Brand::find($product->brand_id); ?>
          <td class="text-center td-model"><a href="{{url('/brand')}}/{{$brand->id}}">{{$brand->name}}</a></td>
          <td class="text-center td-price" >
            <div class="price">
              <?php 
                $currency = session()->get('cur_currency');
                $symbol = session()->get('cur_symbol');
                $old_price = $product->price*$currency;
                $new_price = $old_price - $product->discount * $old_price /100 ;
              ?>
              @if($product->discount)
                <b style="color:rgba(46, 175, 35, 1);">{{ $symbol .' '. $new_price }}</b>
                &nbsp<s><del style="color: #e7284d;">{{ $old_price }}</del></s>
              @else
              <b style="color:rgba(46, 175, 35, 1);">{{ $symbol .' '. $old_price }}</b>
              @endif
            </div>
          </td>
          
          <td class="text-center td-action">
            <button type="button" data-toggle="modal" data-target="#ProductOptions_{{$product->id}}" data-toggle="tooltip" title="{{__('home.Add to Cart')}}" class="btn btn-success" data-loading-text="<i class='fa fa-shopping-cart'></i>">
              <i class="fa fa-shopping-cart"></i>
            </button>
            <a id="remove_item_{{$item->id}}" 
              onclick='removItemfromWish({{$item->id}})'
              title="{{__('home.Remove')}}"
              class="remove_item btn btn-danger btn-remove"
              data-loading-text="<i class='fa fa-times'></i>" >
              <i class="fa fa-times"></i>
            </a>
          </td>
        </tr>

        <!-- Model | Available Options -->
        <div class="modal fade" id="ProductOptions_{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="ModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" style="width:400px;" role="document">
            <div class="modal-content">
              <div class="modal-header backgroundBlue">
                <h5 class="modal-title ModelName" style="text-align:center;" id="ModalCenterTitle">{{$product->name}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true" style="position: absolute; top: -27px; right: 10px;">&times;</span>
                </button>
              </div>

              <div class="modal-body">
                <div class="product-info out-of-stock has-extra-button " style="margin:auto 10%;">

                  <div id="product" class="product-details">
                    <form id="form_cart_{{$product->id}}">
                      <div id="content_{{$product->id}}">
                        <div class="product-options">
                          <h3 class="options-title title">{{__('home.Available Options')}}</h3>
                          <!-- Color -->
                          @if($product->color)
                          <div class="form-group required product-option-select">
                            <label class="control-label" for="color_{{$product->id}}">{{__('home.Color')}}</label>
                            <?php 
                            $colores = [];
                            $all_colores = \App\Models\Product::where('code', $product->code)->get();
                            foreach ($all_colores as $color) {
                              $new_color = $color->color;
                              if(!in_array($new_color, $colores))array_push($colores, $new_color);
                            }
                            ?>
                            <input type="hidden" id="code_{{$product->id}}" value="{{$product->code}}">
                            <select name="color_{{$product->id}}" id="color_{{$product->id}}" onchange="selectSize({{$product->id}}, 'code_', 'color_', 'size_', 'size')" class="form-control">
                              <option value=""> --- {{__('home.Please Select')}} ---</option>
                              @foreach ($colores as $color)
                                <option value="{{$color}}">{{$color}}</option>
                              @endforeach
                            </select>
                          </div>
                          @endif

                          <!-- Size -->
                          @if($product->size)
                          <div class="form-group required product-option-select">
                            <label class="control-label" for="size_{{$product->id}}">{{__('home.Size')}}</label>
                            <select name="size_{{$product->id}}" id="size_{{$product->id}}" class="form-control">
                              <option value=""> --- {{__('home.Please Select')}} ---</option>
                              @if(!$product->color)
                                <?php $all_size = \App\Models\Product::where('code', $product->code)->get(); ?>
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
                            <div id="QTYError_{{$product->id}}" ></div>
                            <div class="stepper-group cart-group">
                              <!-- Qty -->
                              <div class="stepper form-group input-group">
                                <label class="control-label" for="quantity_{{$product->id}}">{{__('home.Qty')}}</label>
                                <input  id="quantity_{{$product->id}}" type="text" name="quantity_{{$product->id}}"  value="1"  data-minimum="1" class="form-control" />
                                <input id="product_id_{{$product->id}}" type="hidden" name="product_id_{{$product->id}}" value="{{$product->id}}"/>
                                <span>
                                  <i class="fa fa-angle-up"></i>
                                  <i class="fa fa-angle-down"></i>
                                </span>
                              </div>
                              <!-- Add to Cart -->
                              <button
                                id="button_cart_{{$product->id}}"
                                type="submit"
                                onclick="addToCart(event, {{$product->id}}, 'form_cart_', 'button_cart_', '', 'QTYError_', 'content_', 'ProductOptions_', 'quantity_')"
                                data-loading-text="<span class='btn-text'>{{__('home.Add to Cart')}}</span>"
                                class="btn btn-cart"
                                style="margin: 0 0 6px 6px;">
                                {{__('home.Add to Cart')}}
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
    </tbody>  
  </table>
</div>

<!-- Buttons -->
<div class="buttons clearfix">
  <div class="pull-left"><a href="{{ url('/') }}" class="btn btn-default"><span>{{__('home.Continue Shopping')}}</span></a></div>
  <div class="pull-right"><a href="{{ url('/cart') }}" class="btn btn-warning"><span>{{__('home.View Cart')}}</span></a></div>
</div>
<?php } ?>