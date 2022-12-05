@extends('admin.index')

@section('subTitle')
{{ __('dashboard.Home') }}
@endsection

@section('content')

    <section class="content">

      <!-- Blocks -->
      <div class="row">
        <!-- New Orders -->
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-green">
            <div class="inner">
              <h3>{{ count($orders)}}</h3>
              <p style="margin-bottom: 0;">{{ __('dashboard.New Orders') }}</p>
              <p style="font-size: 12px;margin-bottom: 0;">{{ __('dashboard.New Orders text') }}</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="{{ route('orders') }}" class="small-box-footer">{{ __('dashboard.More info') }} <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <!-- New Reviews -->
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>{{ count($reviews) }}</h3>
              <p style="margin-bottom: 0;">{{ __('dashboard.New reviews') }}</p>
              <p style="font-size: 12px;margin-bottom: 0;">{{ __('dashboard.New reviews text') }}</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="{{ route('reviews') }}" class="small-box-footer">{{ __('dashboard.More info') }} <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <!-- User Registrations -->
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3> {{ count($users) }}</h3>
              <p style="margin-bottom: 0;">{{ __('dashboard.User Registrations') }}</p>
              <p style="font-size: 12px;margin-bottom: 0;">{{ __('dashboard.User Registrations text') }}</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="{{ route('users.index') }}" class="small-box-footer">{{ __('dashboard.More info') }} <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <!-- Notifications -->
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-red">
            <div class="inner">
              <h3>{{ count($nots) }}</h3>
              <p style="margin-bottom: 0;">{{ __('dashboard.Notifications') }}</p>
              <p style="font-size: 12px;margin-bottom: 0;">{{ __('dashboard.Notifications text') }}</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="{{ route('notifications') }}" class="small-box-footer">{{ __('dashboard.More info') }} <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
      </div>

      <!-- TO DO List -->
      <div class="row" id="to_do_lidt">
        @include('admin.layouts.getTasks')
      </div>

      <!-- Modal | Add Item -->
      <div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="modalAdd" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title text-center">{{ __('dashboard.Add New Task') }}</h5>
            </div>
            <form method="post" id="taskForm">
              <div class="modal-body">
                {{csrf_field() }}
                <div id="result"></div>
                <div class="form-group">
                  <label for="task_title"> {{ __('dashboard.Task Title') }} </label>
                  <input type="text" class="form-control" name="task_title" id="task_title" placeholder="{{ __('dashboard.Task Title') }}">
                </div>
                <div class="form-group">
                  <label for="description"> {{ __('dashboard.Description') }} </label>
                  <input type="text" class="form-control" name="description" id="description" placeholder="{{ __('dashboard.Description') }}">
                </div>
                <div class="form-group">
                  <label for="duration"> {{ __('dashboard.Duration') }} </label>
                  <input type="text" class="form-control" name="duration" id="duration" placeholder="{{ __('dashboard.duration text') }}">
                </div>
              </div>
              <div class="modal-footer">
                <button type="submit" id="saveBtn" class="btn btn-primary">{{ __('dashboard.Save Task') }}</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('dashboard.Close') }}</button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <!-- Modal | Edit Item -->
      <div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="modalEdit" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title text-center">{{ __('dashboard.Edit Task') }}</h5>
            </div>
            <form method="post" id="taskFormEdit">
              <div class="modal-body">
                {{csrf_field() }}
                <div id="resultEdit"></div>
                <input type="hidden" name="taskId" value="" id="taskID">
                <div class="form-group">
                  <label for="task_title"> {{ __('dashboard.Task Title') }} </label>
                  <input type="text" class="form-control" name="task_title" id="edit_task_title" placeholder="{{ __('dashboard.Task Title') }}">
                </div>
                <div class="form-group">
                  <label for="description"> {{ __('dashboard.Description') }} </label>
                  <input type="text" class="form-control" name="description" id="edit_description" placeholder="{{ __('dashboard.Description') }}">
                </div>
                <div class="form-group">
                  <label for="duration"> {{ __('dashboard.Duration') }} </label>
                  <input type="text" class="form-control" name="duration" id="edit_duration" placeholder="{{ __('dashboard.duration text') }}">
                </div>
              </div>
              <div class="modal-footer">
                <button type="submit" id="EditBtn" class="btn btn-primary">{{ __('dashboard.Edit Task') }}</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('dashboard.Close') }}</button>
              </div>
            </form>
          </div>
        </div>
      </div>

    </section>
@endsection

@push('AJAX')
  <script type="text/javascript">
    $(document).ready(function () {
      $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
      // Add Button
      $(document).on('click', '.Open_Modal', function () {
        $('#result').html('');
        $('#taskForm')[0].reset();
      }); 
      // Edit Button
      $(document).on('click', '.edit', function () {
        var taskID =  $(this).attr('data-id');
        $('#resultEdit').html('');
        $.ajax({
          url: "{{ route('getInfoTask') }}",
          data: {taskID:taskID},
          success: function (json) {
            $('#edit_task_title').val(json['task_title']);
            $('#edit_description').val(json['description']);
            $('#edit_duration').val(json['duration']);
            $('#taskID').val(taskID);
          }
        });
        $('#modalEdit').modal('show');
      });    
      // Delete Button
      $(document).on('click', '.delete', function () {
        var taskID =  $(this).attr('data-id');
        $.ajax({
          url: "{{ route('delTask') }}",
          data: {taskID:taskID},
          success: function (json) {
            if (json['success']) {
              $('#to_do_lidt').load("{{ route('getTasks') }}");
            }
          }
        });
      });

      // Add Task
      $('#taskForm').on('submit', function (event) {
        event.preventDefault();
        var btnSave = "{{__('dashboard.Save Task')}}";
        var btnSaveWait = "{{__('dashboard.Saving...')}}";
        $.ajax({
          url: "{{ route('addTask') }}",
          beforeSend: function () {
            $('#saveBtn').text(btnSaveWait);
          },
          complete: function () {
            $('#saveBtn').text(btnSave);
          },
          method: "POST",
          data: $("#taskForm").serialize(),
          dataType: "json",
          success: function (json) {
            var html = '';
            if (json['errors']) {
              html = '<div class="alert alert-danger">';
              $.each(json['errors'], function(key, value){
                html += '<p>' + value + '</p>';
              });
              html += '</div>';
            }
            if (json['success']) {
              html = '<div class="alert alert-success">' + json['success']+ '</div>';
              $('#to_do_lidt').load("{{ route('getTasks') }}");
            }
            $('#result').html(html);
          }
        })
      });  

      // Edit Task
      $('#taskFormEdit').on('submit', function (event) {
        event.preventDefault();
        var btnEdit = "{{__('dashboard.Edit Task')}}";
        var btnEditWait = "{{__('dashboard.Editting...')}}";
        $.ajax({
          url: "{{ route('editTask') }}",
          beforeSend: function () {
            $('#EditBtn').text(btnEditWait);
          },
          complete: function () {
            $('#EditBtn').text(btnEdit);
          },
          method: "POST",
          data: $("#taskFormEdit").serialize(),
          dataType: "json",
          success: function (json) {
            var html = '';
            if (json['errors']) {
              html = '<div class="alert alert-danger">';
              $.each(json['errors'], function(key, value){
                html += '<p>' + value + '</p>';
              });
              html += '</div>';
            }
            if (json['success']) {
              html = '<div class="alert alert-success">' + json['success']+ '</div>';
              
            }
            $('#resultEdit').html(html);
            setTimeout(function () {
              $('#modalEdit').modal('hide');
              $('#to_do_lidt').load("{{ route('getTasks') }}");
            }, 2000);

          }
        })
      });
    });
  </script>
@endpush
