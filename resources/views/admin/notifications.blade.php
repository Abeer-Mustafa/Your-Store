@extends('admin.index')

@section('subTitle')
{{ __('dashboard.Notifications') }}
@endsection

@section('content')
  	<section class="content">
        <div class="row">
        	<!-- all Orders -->
            <div class="col-xs-12">
                <div style="margin-top:10px;" id="nots_content" class="box">
					@include('admin.layouts.notifications')
                </div>
            </div> 
        </div>
    </section>

<!-- Scripts -->
<script type="text/javascript">
    $(document).ready(function () {
		// Update Note
		$(document).on('click', '.update_item', function () {
            var pro_id = $(this).attr('data-id');
            var note_id = $(this).attr('note-id');
			var new_stock = $('#quantity_' + pro_id).val();
        
			var APP_URL = $('#dashboard').val();
			$.ajax({
                url: "{{ route('update_note') }}",
                method: "GET",
                data: {pro_id:pro_id, new_stock:new_stock, note_id:note_id},
                dataType: "json",
                beforeSend: function () {
                    $('#update_item_'+note_id).html('<i class="fas fa-sync fa-spin"></i>');
                },
                success: function (json) {
        			$('#nots_content').load(APP_URL + '/all_nots');
                    console.log(json['success']);
                }
            });
		});

		// Delete Note
		$(document).on('click', '.delete_item', function () {
			var record_id = $(this).attr('data-id');
			var APP_URL = $('#dashboard').val();
			$.ajax({
                url: "{{ route('delete_note') }}",
                method: "GET",
                data: {record_id:record_id },
                dataType: "json",
                beforeSend: function () {
                    $('#remove_item_'+record_id).html('<i class="fas fa-spinner fa-spin"></i>');
                },
                success: function (json) {
        			$('#nots_content').load(APP_URL + '/all_nots');
                }
            });
		});
   	});
</script>
@endsection