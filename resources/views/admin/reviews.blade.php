@extends('admin.index')

@section('subTitle')
{{ __('dashboard.Reviews') }}
@endsection

@section('content')
  	<section class="content">
        <div class="row">
        	<!-- all Reviews -->
            <div class="col-xs-12">
        		<a id="all_reviews" class="btn btn-info">{{ __('dashboard.All Reviews') }}</a>
        		<a id="pending_reviews" class="btn btn-danger">{{ __('dashboard.Pending Reviews') }}</a>
        		<a id="accepted_reviews" class="btn btn-success">{{ __('dashboard.Accepted Reviews') }}</a>
                <div style="margin-top:10px;" id="reviews_content" class="box">
					<div class="box-body">
                        <table class="table table-bordered table-hover textCenter" id="records_table">
                            <thead >
                                <tr>
                                    <th class="textCenter">{{ __('dashboard.ID') }}</th>
                                    <th class="textCenter">{{ __('dashboard.User ID') }}</th>
                                    <th class="textCenter">{{ __('dashboard.Product ID') }}</th>
                                    <th class="textCenter">{{ __('dashboard.Message') }}</th>
                                    <th class="textCenter">{{ __('dashboard.Stars') }}</th>
                                    <th class="textCenter">{{ __('dashboard.Status') }}</th>
                                    <th class="textCenter">{{ __('dashboard.Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                            	@foreach($reviews as $review)
                                <tr>
                                    <td class="textCenter">{{ $review->id }}</td>
                                    <td class="textCenter">{{ $review->user_id }}</td>
                                    <td class="textCenter">{{ $review->product_id }}</td>
                                    <td class="textCenter">{{ $review->feedback }}</td>
                                    <td class="textCenter">{{ $review->stars }}</td>
                                    <td class="textCenter">
                                        <?php 
                                            if($review->status == 'Pending') echo __('dashboard.RevPending');
                                            else echo __('dashboard.Accepted');
                                        ?>
                                    </td>
                                    <td class="textCenter"> 
                                        <a data-id="{{ $review->user_id }}" class="view_user  btn btn-primary btn-sm">{{ __('dashboard.View User') }}</a>
                                        <a data-id="{{ $review->product_id }}" class="view_product  btn bg-maroon btn-sm">{{ __('dashboard.View Product') }}</a>
        								<a data-id="{{ $review->id }}" class="delete_review  btn btn-danger btn-sm">{{ __('dashboard.Delete') }}</a>
        								@if($review->status!="Accepted") 
				                            <a data-id="{{ $review->id }}" class="accept_review  btn btn-success btn-sm">{{ __('dashboard.DoneAccept') }}</a>
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

            <!-- User Information -->
            <div class="col-xs-12" id="reviews_info_user" >
            </div>

            <!-- Product Information -->
            <div class="col-xs-12" id="reviews_info_pro">
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
            $('#reviews_info_user').load(APP_URL + '/view_rater/' + record_id );
        }); 

        // View Product
        $(document).on('click', '.view_product', function () {
            var record_id = $(this).attr('data-id');
            var APP_URL = $('#dashboard').val();
            $('#reviews_info_pro').load(APP_URL + '/view_pro/' + record_id );
        });
		// Accept Review | Cahnge status
		$(document).on('click', '.accept_review', function () {
			var record_id = $(this).attr('data-id');
			var APP_URL = $('#dashboard').val();
			$.ajax({
                url: "{{ route('accepted') }}",
                method: "GET",
                data: {record_id:record_id },
                dataType: "json",
                success: function (json) {
        			$('#reviews_content').load(APP_URL + '/all_reviews');
                }
            });
		});

		// Delete Review
		$(document).on('click', '.delete_review', function () {
			var record_id = $(this).attr('data-id');
			var APP_URL = $('#dashboard').val();
			$.ajax({
                url: "{{ route('delete_review') }}",
                method: "GET",
                data: {record_id:record_id },
                dataType: "json",
                success: function (json) {
        			$('#reviews_content').load(APP_URL + '/all_reviews');
                }
            });
		});

		// all Reviews
		$(document).on('click', '#all_reviews', function () {
			var APP_URL = $('#dashboard').val();
        	$('#reviews_content').load(APP_URL + '/all_reviews');
		});

		// pending Reviews
		$(document).on('click', '#pending_reviews', function () {
			var APP_URL = $('#dashboard').val();
        	$('#reviews_content').load(APP_URL + '/pending_reviews');
		});

		// accepted Reviews
		$(document).on('click', '#accepted_reviews', function () {
			var APP_URL = $('#dashboard').val();
        	$('#reviews_content').load(APP_URL + '/accepted_reviews');
		});
   	});
</script>
@endsection