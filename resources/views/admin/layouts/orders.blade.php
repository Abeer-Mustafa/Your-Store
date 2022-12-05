<div class="box-body">
    <table class="table table-bordered table-hover textCenter" id="records_table">
        <thead >
            <tr>
                <th class="textCenter">{{ __('dashboard.ID') }}</th>
                <th class="textCenter">{{ __('dashboard.Status') }}</th>
                <th class="textCenter">{{ __('dashboard.Total Price') }}</th>
                <th class="textCenter">{{ __('dashboard.Date of Order') }}</th>
                <th class="textCenter">{{ __('dashboard.Action') }}</th>
            </tr>
        </thead>
        <tbody>
        	@foreach($orders as $order)
            <tr>
                <td class="textCenter">{{ $order->id }}</td>
                <td class="textCenter">
                <?php 
                    if($order->status == 'Pending') echo __('dashboard.Pending');
                    else echo __('dashboard.Delivered');
                ?>
                </td>
                <td class="textCenter">{{ $order->payment_amount }}$</td>
                <td class="textCenter">{{ $order->updated_at }}</td>
                <td class="textCenter"> 
                    <a data-id="{{ $order->user_id }}" class="view_user  btn btn-primary btn-sm">{{ __('dashboard.View Customer') }}</a>
                    <a data-id="{{ $order->id }}" class="view_order  btn bg-maroon btn-sm">{{ __('dashboard.View Order') }}</a>
                    <a data-id="{{ $order->id }}" class="delete_order  btn btn-danger btn-sm">{{ __('dashboard.Delete') }}</a>
                    @if($order->status!="Delivered") 
                        <a data-id="{{ $order->id }}" class="delivered_order  btn btn-success btn-sm">{{ __('dashboard.DoneDelivered') }}</a>
                    @else
                     <span style="color: #00a65a;" ><i class="fa fa-check-circle"></i></span>
                    @endif
                </td>
            </tr>
        	@endforeach
        </tbody>
    </table>
</div>