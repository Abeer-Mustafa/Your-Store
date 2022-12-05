@extends('admin.index')

@section('subTitle')
{{ __('dashboard.Brands') }}
@endsection

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <button type="button" name="create_record" id="create_record" class="btn btn-success btn-sm">{{ __('dashboard.Create Record') }}</button>
                    </div>
                    <div class="box-body">
                        <table class="table table-bordered table-hover textCenter" id="records_table">
                            <thead>
                                <tr>
                                    <th width="10%">{{ __('dashboard.Image') }}</th>
                                    <th width="5%">{{ __('dashboard.ID') }}</th>
                                    <th width="10%">{{ __('dashboard.Name') }}</th>
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
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" align="center">{{ __('dashboard.Add New Record') }}</h4>
            </div>
            <style>
              .required:after {
                content:" *";
                color: red;
              }
            </style>
            <div class="modal-body">
                <span id="form_result"></span>
                <form method="post" id="sample_form" class="form-horizontal" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="required control-label col-md-4">{{ __('dashboard.Name') }} : </label>
                        <div class="col-md-8">
                            <input type="text" name="name" id="name" class="form-control" />
                            <input type="hidden" name="old_name" id="old_name" />
                        </div>
                    </div>                    

                    <div class="form-group">
                        <label class="required control-label col-md-4">{{ __('dashboard.Select Brand Image') }} : </label>
                        <div class="col-md-8">
                            <input type="file" name="image" id="image" />
                            <span id="store_image"></span>
                        </div>
                    </div>
                    <br />
                    <div class="form-group" align="center">
                        <input type="hidden" name="action" id="action" />
                        <input type="hidden" name="hidden_id" id="hidden_id" />
                        <input type="submit" name="action_button" id="action_button" class="btn btn-warning"
                            value="{{ __('dashboard.Add') }}" />
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
        var Edit_Brand = "{{ __('dashboard.Edit Brand') }}";
        var Delete_Brand = "{{ __('dashboard.Delete Brand') }}";
        var OK = "{{ __('dashboard.Ok') }}";

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Show tabel
        $('#records_table').DataTable({
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
                url: "{{ route('brands.index') }}",
            },
            columns: [
                {
                    data: 'image',
                    name: 'image',
                    render: function (data, type, full, meta) {
                        return "<img src={{ URL::to('/storage') }}/images/brands/" + data +
                            " width='70' class='img-thumbnail' />";
                    },
                    orderable: false
                },
                { data: 'id',          name: 'id' },
                { data: 'name',        name: 'name' },
                { data: 'action',      name: 'action', orderable: false, searchable: false }
            ]
        });

        // Add Button
        $('#create_record').click(function () {
            $('.modal-title').text(AddNewRecord);
            $('#action').val("Add");
            $('#action_button').val(Add);
            $('#form_result').html('');
            $('#store_image').html('');
            $('#sample_form')[0].reset();
            $('#formModal').modal('show');
        });

        // Submit Form
        $('#sample_form').on('submit', function (event) {
            event.preventDefault();

            // Add Action
            if ($('#action').val() == 'Add') {
                $.ajax({
                    url: "{{ route('brands.store') }}",
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
                            $('#records_table').DataTable().ajax.reload();
                        }
                        $('#form_result').html(html);
                        $('#action_button').val(Add);
                         $('#image_loading').hide();
                    }
                })
            }

            // Edit Action
            if ($('#action').val() == "Edit") {
                var id = $('#hidden_id').val();
                $.ajax({
                    url: "{{ route('brands.store') }}",
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
                            $('#records_table').DataTable().ajax.reload();
                        }
                        $('#form_result').html(html);
                        $('#action_button').val(Edit);
                        $('#image_loading').hide();

                    }
                });
            }
        });

        // Edit Button
        $(document).on('click', '.edit', function () {
            var id = $(this).attr('id');
            $('#form_result').html('');
            $.ajax({
                url: "{{ route('brands.index') }}" + '/' + id + '/edit',
                dataType: "json",
                success: function (html) {
                    $('#name').val(html.data.name);
                    $('#old_name').val(html.data.name);

                    $('#store_image').html("<img src={{ URL::to('/storage') }}/images/brands/" + html.data.image + " width='70' class='img-thumbnail' />");
                    $('#store_image').append(
                        "<input type='hidden' name='hidden_image' value='" + html.data
                        .image + "' />");

                    $('#hidden_id').val(html.data.id);
                    $('.modal-title').text(Edit_Brand);
                    $('#action').val("Edit");
                    $('#action_button').val(Edit);
                    $('#formModal').modal('show');
                }
            })
        });

        var record_id;

        // Button Delete
        $(document).on('click', '.delete', function () {
            record_id = $(this).attr('id');
            $('.modal-title').text(Delete_Brand);
            $('#confirmModal').modal('show');
        });

        // Delete Confirmation 
        $('#ok_button').click(function () {
            $.ajax({
                url: "{{ route('brands.index') }}" + '/' + record_id,
                beforeSend: function () {
                    $('#ok_button').text(DeleteWait);
                },
                method : "DELETE",
                success: function (data) {
                    setTimeout(function () {
                        $('#confirmModal').modal('hide');
                        $('#records_table').DataTable().ajax.reload();
                    }, 2000);
                    $('#ok_button').text(OK);
                }
            })
        });

    });
</script>
@endpush