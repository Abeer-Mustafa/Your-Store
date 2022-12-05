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