@extends('admin.index')

@section('subTitle')
{{ __('dashboard.Orders') }}
@endsection

@section('content')
  	<section class="content">
        <div class="row">
        	<!-- all Orders -->
            <div class="col-xs-12">
        		<a id="all_orders" class="btn btn-info">{{ __('dashboard.All Orders') }}</a>
        		<a id="pending_orders" class="btn btn-danger">{{ __('dashboard.Pending Orders') }}</a>
        		<a id="delivered_orders" class="btn btn-success">{{ __('dashboard.Delivered Orders') }}</a>
                <div style="margin-top:10px;" id="orers_content" class="box">
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
                </div>
            </div> 

            <!-- Customen Information -->
            <div class="col-xs-12" id="orers_info_user" >
            </div>

            <!-- Order Information -->
            <div class="col-xs-12" id="orers_info_order">
            </div>
        </div>
    </section>

<!-- Scripts -->
<script type="text/javascript">
    $(document).ready(function () {
    	// View User
		$(document).on('click', '.view_user', function () {
			var record_id = $(this).attr('data-id');
			var APP_URL = $('#dashboard').val();
        	$('#orers_info_user').load(APP_URL + '/view_user/' + record_id );
		});	

		// View Order
		$(document).on('click', '.view_order', function () {
			var record_id = $(this).attr('data-id');
			var APP_URL = $('#dashboard').val();
			$('#orers_info_order').load(APP_URL + '/view_order/' + record_id );
		});

		// Delivered Order | Cahnge status
		$(document).on('click', '.delivered_order', function () {
			var record_id = $(this).attr('data-id');
			var APP_URL = $('#dashboard').val();
			$.ajax({
                url: "{{ route('delivered') }}",
                method: "GET",
                data: {record_id:record_id },
                dataType: "json",
                success: function (json) {
        			$('#orers_content').load(APP_URL + '/all_orders');
                }
            });
		});

		// Delete Order
		$(document).on('click', '.delete_order', function () {
			var record_id = $(this).attr('data-id');
			var APP_URL = $('#dashboard').val();
			$.ajax({
                url: "{{ route('delete_order') }}",
                method: "GET",
                data: {record_id:record_id },
                dataType: "json",
                success: function (json) {
        			$('#orers_content').load(APP_URL + '/all_orders');
                }
            });
		});

		// all orders
		$(document).on('click', '#all_orders', function () {
			var APP_URL = $('#dashboard').val();
        	$('#orers_content').load(APP_URL + '/all_orders');
		});

		// pending orders
		$(document).on('click', '#pending_orders', function () {
			var APP_URL = $('#dashboard').val();
        	$('#orers_content').load(APP_URL + '/pending_orders');
		});

		// delivered orders
		$(document).on('click', '#delivered_orders', function () {
			var APP_URL = $('#dashboard').val();
        	$('#orers_content').load(APP_URL + '/delivered_orders');
		});
   	});
</script>
@endsection