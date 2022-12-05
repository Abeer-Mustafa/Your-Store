<div class="box-body">
    <table class="table table-bordered table-hover textCenter" id="records_table">
        <thead >
            <tr>
                <th class="text-center td-id">{{ __('dashboard.ID') }}</th>
                <th class="text-center td-image">{{ __('dashboard.Image') }}</th>
                <th class="text-center td-name">{{ __('dashboard.Name') }}</th>
                <th class="text-center td-model">{{ __('dashboard.Info') }}</th>
                <th class="text-center td-qty">{{ __('dashboard.Current Quantity') }}</th>
                <th class="text-center td-price">{{ __('dashboard.Price') }}</th>
                <th class="text-center td-total">{{ __('dashboard.Action') }}</th>
            </tr>
        </thead>
        <tbody>
        	@foreach($nots as $note)
                <?php $product = \App\Models\Product::find($note->product_id); ?>
                <tr>
                    <td width="10%" class="text-center td-id">{{$product->id}}</td>
                    <td width="10%" class="text-center td-image"><img width='70' class='img-thumbnail' src="{{ URL::to('/storage') }}/images/products/{{$product->image}}" alt="{{$product->name}}" title="{{$product->name}}" /></td>
                    <td width="15%"class="text-center td-name">{{$product->name}}</td>
                    <?php $brand = \App\Models\Brand::find($product->brand_id); ?>
                    <td width="20%" class="td-model">
                        <ul style="list-style: none; padding-left:0px;">
                            <li><span>{{ __('dashboard.Brand') }}: </span><a href="{{url('/brand')}}/{{$brand->id}}">{{$brand->name}}</a></li>
                            @if($product->color)<li><span>{{ __('dashboard.Color') }}: {{$product->color}}</span></li>@endif
                            @if($product->size)<li><span>{{ __('dashboard.Size') }}: {{$product->size}}</span></li>@endif
                        </ul>
                    </td>
                    <td width="15%" class="text-center td-qty">
                        <div class="input-group btn-block">
                          <div class="stepper">
                            <input type="number" min=1 name="quantity" id="quantity_{{$product->id}}" value="{{$product->stock}}" size="1" class="form-control" />
                          </div>
                          <span class="input-group-btn">
                            <a id="update_item_{{$note->id}}" 
                              data-id="{{$product->id}}"
                              note-id="{{$note->id}}"
                              title="{{ __('dashboard.Update') }}"
                              class="update_item btn btn-primary" >
                              <i class="fa fa-refresh"></i>
                            </a> 
                          </span>
                        </div>
                    </td>
                    <td width="15%" class="text-center td-price">
                        <div class="price">
                          <?php 
                            $old_price = $product->price;
                            $new_price = $old_price - $product->discount * $old_price /100 ;
                            ?>
                            @if($product->discount)
                              <b style="color:rgba(46, 175, 35, 1);">${{ $new_price }}</b>
                              &nbsp<s><del style="color: #e7284d;">${{ $old_price }}</del></s>
                            @else
                            <b style="color:rgba(46, 175, 35, 1);">${{ $old_price }}</b>
                            @endif
                        </div>
                    </td>
                  <td width="15%" class="text-center td-total">
                    <a id="remove_item_{{$note->id}}" 
                      data-id="{{$note->id}}"
                      title="{{ __('dashboard.Remove') }}"
                      class="delete_item btn btn-danger">
                      <i class="fa fa-times"></i>
                    </a>
                  </td>
                </tr>
        	@endforeach
        </tbody>
    </table>
</div>