<p> {{ __('dashboard.Product Info') }}: </p>
<div style="margin-top:10px;"  class="box">
    <div class="box-body">
        <table class="table table-bordered table-hover textCenter" id="records_table">
            <thead >
                <tr>
                    <th class="textCenter">{{ __('dashboard.ID') }}</th>
                    <th class="textCenter">{{ __('dashboard.Image') }}</th>
                    <th class="textCenter">{{ __('dashboard.Name') }}</th>
                    <th class="textCenter">{{ __('dashboard.Unit Price') }}</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $old_price = $pro->price;
                    $new_price = $pro->price;
                    if($pro->discount){
                        $new_price = $old_price - ($old_price*$pro->discount/100);
                    }
                ?>
                <tr>
                    <td class="textCenter">{{ $pro->id }}</td>
                    <td class="textCenter"> <img src="{{ URL::to('/storage') }}/images/products/{{$pro->image}}" width='70' class='img-thumbnail' /></td>
                    <td class="textCenter">{{ $pro->name }}</td>
                    <td class="textCenter">
                        @if($pro->discount)
                            <span style="color: #00a65a;">{{ $new_price }}$</span>&nbsp;
                            <del style="color: #dd4b39;">{{ $old_price }}$</del>
                        @else
                            <span style="color: #00a65a;">{{ $old_price }}$</span>
                        @endif
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>