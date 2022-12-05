
@extends('admin.index')

@section('subTitle')
    {{ __('dashboard.Users') }}
@endsection

@section('content')
    <section class="content">
        <input type="hidden" id="App_URL" value="{{ url('/') }}">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <button type="button" name="create_record" id="create_record" class="btn btn-success btn-sm">{{ __('dashboard.Create Record') }}</button>
                    </div>
                    <div class="box-body">
                        <table class="table table-bordered table-hover textCenter" id="user_table">
                            <thead>
                                <tr>
                                    <th width="10%">{{ __('dashboard.Image') }}</th>
                                    <th width="5%">{{ __('dashboard.ID') }}</th>
                                    <th width="10%">{{ __('dashboard.Full Name') }}</th>
                                    <th width="20%">{{ __('dashboard.Email') }}</th>
                                    <th width="10%">{{ __('dashboard.Phone') }}</th>
                                    <th width="10%">{{ __('dashboard.Country') }}</th>
                                    <th width="10%">{{ __('dashboard.State') }}</th>
                                    <th width="10%">{{ __('dashboard.City') }}</th>
                                    <th width="15%">{{ __('dashboard.Action') }}</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div id="formModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #f4f4f4;">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title" align="center">{{ __('dashboard.Add New Record') }}</h4>
                    </div>
                    <div class="modal-body">
                        <span id="form_result"></span>
                        <form method="post" id="sample_form" class="form-horizontal" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label class="control-label col-md-4">{{ __('dashboard.Full Name') }} : </label>
                                <div class="col-md-8">
                                    <input type="text" name="name" id="name" class="form-control" />
                                </div>
                            </div>                    

                            <div class="form-group">
                                <label class="control-label col-md-4">{{ __('dashboard.Email') }} : </label>
                                <div class="col-md-8">
                                    <input type="email" name="email" id="email" class="form-control" />
                                    <input type="hidden" name="old_email" id="old_email" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-4">{{ __('dashboard.Phone') }} : </label>
                                <div class="col-md-8">
                                    <input type="text" name="phone" id="phone" class="form-control" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-4" id="pas_role">{{ __('dashboard.Password') }} : </label>
                                <div class="col-md-8"  id="pas_role_input">
                                    <input type="password" name="password" id="password" class="form-control" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-4">{{ __('dashboard.Country') }} : </label>
                                <div class="col-md-8">
                                    <select name="country" id="country" class="form-control">
                                        <option value="">{{ __('dashboard.Select Country') }}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-4">{{ __('dashboard.State') }} : </label>
                                <div class="col-md-8">
                                    <select name="state" id="state" class="form-control">
                                        <option value="">{{ __('dashboard.Select State') }}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-4">{{ __('dashboard.City') }} : </label>
                                <div class="col-md-8">
                                    <select name="city" id="city" class="form-control">
                                        <option value="">{{ __('dashboard.Select City') }}</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="control-label col-md-4">{{ __('dashboard.Select Profile Image') }} : </label>
                                <div class="col-md-8">
                                    <input type="file" name="image" id="image" />
                                    <span id="store_image"></span>
                                </div>
                            </div>
                            <br />
                            <div class="form-group" align="center">
                                <input type="hidden" name="action" id="action" />
                                <input type="hidden" name="hidden_id" id="hidden_id" />
                                <input type="submit" name="action_button" id="action_button" class="btn btn-warning" value="{{ __('dashboard.Add') }}" style="padding:8px 40px;"/>
                                <img src="{{ asset('admin') }}/img/wait6.gif" style="width:4%; display:none;" id="image_loading" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div id="confirmModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h2 class="modal-title " align="center">{{ __('dashboard.Confirmation') }}</h2>
                    </div>
                    <div class="modal-body">
                        <h4 align="center" style="margin:0;">{{ __('dashboard.confirmMsg') }}</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" name="ok_button" id="ok_button" class="btn btn-danger">{{ __('dashboard.Ok') }}</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('dashboard.Cancel') }}</button>
                    </div>
                </div>
            </div>
        </div>

    </section>

@endsection

@push('AJAX')
<script type="text/javascript">
    $(document).ready(function () {

        var AddNewRecord = "{{ __('dashboard.Add New Record') }}";
        var Add = "{{ __('dashboard.Add') }}";
        var AddWait = "{{ __('dashboard.Adding...') }}";
        var EditWait = "{{ __('dashboard.Editing...') }}";
        var DeleteWait = "{{ __('dashboard.Deleting...') }}";
        var Edit = "{{ __('dashboard.Edit') }}";
        var Edit_User = "{{ __('dashboard.Edit User') }}";
        var Delete_User = "{{ __('dashboard.Delete User') }}";
        var OK = "{{ __('dashboard.Ok') }}";
        var Password = "{{ __('dashboard.Password') }}";
        var Role = "{{ __('dashboard.Role') }}";
        var User = "{{ __('dashboard.User') }}";
        var Admin = "{{ __('dashboard.Admin') }}";

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#user_table').DataTable({
            language: {
                "emptyTable": "{{ __('table.emptyTable') }}",
                "loadingRecords": "{{ __('table.loadingRecords') }}",
                "processing": "{{ __('table.processing') }}",
                "lengthMenu": "{{ __('table.lengthMenu') }}",
                "zeroRecords": "{{ __('table.zeroRecords') }}",
                "info": "{{ __('table.info') }}",
                "infoEmpty": "{{ __('table.infoEmpty') }}",
                "infoFiltered": "{{ __('table.infoFiltered') }}",
                "search": "{{ __('table.search') }}",
                "paginate": {
                    "first": "{{ __('table.first') }}",
                    "previous": "{{ __('table.previous') }}",
                    "next": "{{ __('table.next') }}",
                    "last": "{{ __('table.last') }}"
                },  
                "aria": {
                    "sortAscending": "{{ __('table.sortAscending') }}",
                    "sortDescending": "{{ __('table.sortDescending') }}"
                }
            },
            processing: true,
            serverSide: true,
            "order": [[ 1, "desc" ]],
            ajax: {
                url: "{{ route('users.index') }}",
            },
            columns: [
                {
                    data: 'image',
                    name: 'image',
                    render: function (data, type, full, meta) {
                        if(data)
                        return "<img src={{ URL::to('/storage') }}/images/users/" + data +
                            " width='70' class='img-thumbnail' />"; 
                        else
                        return "<img src={{ URL::to('/front') }}/image/catalog/default_user.png" +
                            " width='70' class='img-thumbnail' />";
                    },
                    orderable: false
                },
                {
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'phone',
                    name: 'phone'
                },
                {
                    data: 'country',
                    name: 'country'
                },
                {
                    data: 'state',
                    name: 'state'
                },
                {
                    data: 'city',
                    name: 'city'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }
            ]
        });

        $('#create_record').click(function () {
            $('.modal-title').text(AddNewRecord);
            $('#action_button').val(Add);
            $('#action').val("Add");
            $('#pas_role').html(Password);
            var roleInput = '<input type="password" name="password" id="password" class="form-control" />';
            $('#pas_role_input').html(roleInput);
            $('#sample_form')[0].reset();
            $('#formModal').modal('show');
            $('#form_result').html('<div class=""></div>');
        });

        $('#sample_form').on('submit', function (event) {
            event.preventDefault();
            if ($('#action').val() == 'Add') {
                $.ajax({
                    url: "{{ route('users.store') }}",
                    beforeSend: function () {
                        $('#action_button').val(AddWait);
                        $('#image_loading').show();
                    },
                    method: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    dataType: "json",
                    success: function (data) {
                        var html = '';
                        if (data.errors) {
                            html = '<div class="alert alert-danger">';
                            for (var count = 0; count < data.errors.length; count++) {
                                html += '<p>' + data.errors[count] + '</p>';
                            }
                            html += '</div>';
                        }
                        if (data.success) {
                            html = '<div class="alert alert-success">' + data.success +
                                '</div>';
                            $('#sample_form')[0].reset();
                            $('#user_table').DataTable().ajax.reload();
                        }
                        $('#form_result').html(html);
                        $('#action_button').val(Add);
                        $('#image_loading').hide();
                    }
                })
            }

            if ($('#action').val() == "Edit") {
                var id = $('#hidden_id').val();
                $.ajax({
                    url: "{{ route('users.update') }}",
                    beforeSend: function () {
                        $('#action_button').val(EditWait);
                        $('#image_loading').show();
                    },
                    method: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    dataType: "json",
                    success: function (data) {
                        var html = '';
                        if (data.errors) {
                            html = '<div class="alert alert-danger">';
                            for (var count = 0; count < data.errors.length; count++) {
                                html += '<p>' + data.errors[count] + '</p>';
                            }
                            html += '</div>';
                        }
                        if (data.success) {
                            html = '<div class="alert alert-success">' + data.success +
                                '</div>';
                            $('#sample_form')[0].reset();
                            $('#store_image').html('');
                            $('#user_table').DataTable().ajax.reload();
                        }
                        $('#form_result').html(html);
                        $('#action_button').val(Edit);
                        $('#image_loading').hide();
                    }
                });
            }
        });

        $(document).on('click', '.edit', function () {
            var id = $(this).attr('id');
            $('#form_result').html('');
            $.ajax({
                url: "{{ route('users.index') }}" + '/' + id + '/edit',
                dataType: "json",
                success: function (html) {
                    $('#name').val(html.data.name);
                    $('#email').val(html.data.email);
                    $('#phone').val(html.data.phone);

                    $('#pas_role').html(Role);
                    var roleInput = '';
                    if(html.data.admin == 1) roleInput = '<label><input type="radio" name="admin" value="1" checked>'+Admin+' </label> &nbsp; &nbsp; <label> <input type="radio" name="admin" value="0"> '+User+'</label>'
                    else roleInput = '<label><input type="radio" name="admin" value="1" >'+Admin+' </label> &nbsp; &nbsp; <label> <input type="radio" name="admin" value="0" checked> '+User+'</label>'
                    $('#pas_role_input').html(roleInput);
                
                    $('#country option[value="'+ html.data.country +'"]').attr("selected", true);
                    $('#state').html('<option value="'+html.data.state+'" selected>'+html.data.state+'</option>');
                    $('#city').html('<option value="'+html.data.city+'" selected>'+html.data.city+'</option>');
                    
                    if(html.data.image){
                        $('#store_image').html("<img src={{ URL::to('/storage') }}/images/users/" + html.data.image + " width='70' class='img-thumbnail' />");
                        $('#store_image').append("<input type='hidden' name='hidden_image' value='" + html.data.image + "' />");
                    }
                    else{
                        $('#store_image').html("<img src={{ URL::to('/front') }}/image/catalog/default_user.png  width='70' class='img-thumbnail' />");
                        $('#store_image').append("<input type='hidden' name='hidden_image' value='" + html.data.image + "' />");
                    }

                    $('#old_email').val(html.data.email);

                    $('#hidden_id').val(html.data.id);
                    $('.modal-title').text(Edit_User);
                    $('#action_button').val(Edit);
                    $('#action').val("Edit");
                    $('#formModal').modal('show');
                }
            })
        });

        var user_id;

        $(document).on('click', '.delete', function () {
            user_id = $(this).attr('id');
            $('.modal-title').text(Delete_User);
            $('#confirmModal').modal('show');
        });

        $('#ok_button').click(function () {
            $.ajax({
                url: "{{ route('users.index') }}" + '/' + user_id,
                beforeSend: function () {
                    $('#ok_button').text(DeleteWait);
                },
                method : "DELETE",
                success: function (data) {
                    setTimeout(function () {
                        $('#confirmModal').modal('hide');
                        $('#user_table').DataTable().ajax.reload();
                    }, 2000);
                    $('#ok_button').text(OK);
                }
            })
        });

    });

</script>
@endpush

@push('SelectCountries')

<script type="text/javascript">
    $(document).ready(function(){
        var Select_Country = "{{ __('dashboard.Select Country') }}";
        var Select_State = "{{ __('dashboard.Select State') }}";
        var Select_City = "{{ __('dashboard.Select City') }}";

      var countryOptions = '';
      var stateOptions = '';
      var cityOptions = '';
      var statesSelected = '';
      var citiesSelected = '';
      var country_id = '';
      var pathFile = $('#App_URL').val() + '/storage/json/countries.json';
      console.log(pathFile);

      $.getJSON(pathFile, function(data){
        countryOptions += '<option value="">' + Select_Country + '</option>';
        $.each(data, function(key, country){
          countryOptions += '<option country="'+country.id+'" value="'+country.name+'">'+country.name+'</option>';
        });
        $('#country').html(countryOptions);
      });

      $('#country').on('change', function(){
        country_id =  $('option:selected', this).attr('country');
        if(country_id != ''){
          $.getJSON(pathFile, function(data){
            stateOptions = '<option value="">' + Select_State + '</option>';
            $.each(data, function(key, country){
              if(country_id == country.id) statesSelected = country.states;
            });
              $.each(statesSelected, function(key, state){
                stateOptions += '<option state="'+state.id+'" value="'+state.name+'">'+state.name+'</option>';
              });
            $('#state').html(stateOptions);
          });
        }
        else {
          $('#state').html('<option value="">' + Select_State + '</option>');
          $('#city').html('<option value="">' + Select_City + '</option>');
        }
      });
      
      $('#state').on('change', function(){
        var state_id = $('option:selected', this).attr('state');
        if(state_id != ''){
          $.getJSON(pathFile, function(data){
            cityOptions = '<option value="">' + Select_City + '</option>';
            $.each(data, function(key, country){
              if(country_id == country.id){
                var statesCurrent = country.states;
                $.each(statesCurrent, function(key, state){
                  if(state_id == state.id)citiesSelected = state.cities;
                });
              }
            });
            $.each(citiesSelected, function(key, city){
              cityOptions += '<option value="'+city.name+'">'+city.name+'</option>';
            });
            $('#city').html(cityOptions);
          });
        }
        else
          $('#city').html('<option value="">' + Select_City + '</option>');
      });
    });
</script>

@endpush

