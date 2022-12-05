@extends('admin.index')

@section('subTitle')
{{ __('dashboard.Products') }}
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
                            <thead >
                                <tr>
                                    <th class="textCenter">{{ __('dashboard.Image') }}</th>
                                    <th class="textCenter">{{ __('dashboard.ID') }}</th>
                                    <th class="textCenter">{{ __('dashboard.Name') }}</th>
                                    <th class="textCenter">{{ __('dashboard.Code') }}</th>
                                    <th class="textCenter">{{ __('dashboard.Description') }}</th>
                                    <th class="textCenter">{{ __('dashboard.Main Category') }}</th>
                                    <th class="textCenter">{{ __('dashboard.Brand') }}</th>
                                    <th class="textCenter">{{ __('dashboard.Quantity') }}</th>
                                    <th class="textCenter">{{ __('dashboard.Price') }}</th>
                                    <th class="textCenter">{{ __('dashboard.Discount') }}</th>
                                    <th class="textCenter">{{ __('dashboard.Color') }}</th>
                                    <th class="textCenter">{{ __('dashboard.Size') }}</th>
                                    <th class="textCenter">{{ __('dashboard.MoreInfo') }}</th>
                                    <th class="textCenter">{{ __('dashboard.Action') }}</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>

<div id="formModal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width: 70%;">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #f4f4f4;">
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
                    
                    <!-- Row1 | Name - Code -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="required control-label col-md-3">{{ __('dashboard.Name') }}:</label>
                                <div class="col-md-9">
                                    <input type="text" name="name" id="name" class="form-control" />
                                </div>
                            </div>                    
                        </div>                    

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="required control-label col-md-3">{{ __('dashboard.Code') }}:</label>
                                <div class="col-md-9">
                                    <input type="text" name="code" id="code" class="form-control" autocomplete/>
                                    <small style="color:#b5adad;"><cite>{{ __('dashboard.CodeDesc') }}. </cite></small>
                                </div>
                            </div>
                        </div>
                    </div>   

                    <!-- Row3 | Category - Brand -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="required control-label col-md-3">{{ __('dashboard.Category') }}:</label>
                                <div class="col-md-9">
                                    <select name="cat_id" id="cat_id" class="form-control">
                                        <option value="">{{ __('dashboard.Select Main Category') }}</option>
                                    </select>
                                </div>
                            </div>                    
                        </div>                    

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="required control-label col-md-3">{{ __('dashboard.Brand') }}:</label>
                                <div class="col-md-9">
                                    <select name="brand_id" id="brand_id" class="form-control">
                                        <option value="">{{ __('dashboard.Select Brand') }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>                    

                    <!-- Row3 | Quantity - Price -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="required control-label col-md-3">{{ __('dashboard.Quantity') }}:</label>
                                <div class="col-md-9">
                                    <input type="number" name="stock" id="stock" class="form-control" />
                                </div>
                            </div>                    
                        </div>                    

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="required control-label col-md-3">{{ __('dashboard.Price') }}($):</label>
                                <div class="col-md-9">
                                    <input type="number" name="price" id="price" class="form-control" />
                                </div>
                            </div>
                        </div>
                    </div>                    

                    <!-- Row4 | Discount -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">{{ __('dashboard.Discount') }}(%):</label>
                                <div class="col-md-9">
                                    <input type="number" name="discount" id="discount" class="form-control" max="100" min="0"/>
                                </div>
                            </div>                    
                        </div>                    
                    </div>

                    <!-- Row5 | Color - Size -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">{{ __('dashboard.Color') }}:</label>
                                <div class="col-md-9">
                                    <select name="color" id="color" class="form-control">
                                        <option value="">{{ __('dashboard.Select Color') }}</option>
                                        <option value="Red">{{ __('dashboard.Red') }}</option>
                                        <option value="Blue">{{ __('dashboard.Blue') }}</option>
                                        <option value="Black">{{ __('dashboard.Black') }}</option>
                                        <option value="Brown">{{ __('dashboard.Brown') }}</option>
                                        <option value="Yellow">{{ __('dashboard.Yellow') }}</option>
                                        <option value="Green">{{ __('dashboard.Green') }}</option>
                                        <option value="Orange">{{ __('dashboard.Orange') }}</option>
                                        <option value="Purple">{{ __('dashboard.Purple') }}</option>
                                        <option value="Pink">{{ __('dashboard.Pink') }}</option>
                                        <option value="Gray">{{ __('dashboard.Gray') }}</option>
                                        <option value="White">{{ __('dashboard.White') }}</option>
                                    </select>
                                </div>
                            </div>                    
                        </div>                    

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">{{ __('dashboard.Size') }}:</label>
                                <div class="col-md-9">
                                    <select name="size" id="size" class="form-control">
                                        <option value="">{{ __('dashboard.Select Size') }}</option>
                                        <option value="XXS">XXS</option>
                                        <option value="XS">XS</option>
                                        <option value="S">S</option>
                                        <option value="M">M</option>
                                        <option value="L">L</option>
                                        <option value="XL">XL</option>
                                        <option value="XXL">XXL</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div> 

                    <!-- Row5 | Description - More Information -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="required control-label col-md-3">{{ __('dashboard.Description') }}:</label>
                                <div class="col-md-9">
                                    <textarea name="description" id="description" class="form-control"> </textarea>
                                </div>
                            </div>                    
                        </div>                    

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">{{ __('dashboard.MoreInfo') }}:</label>
                                <div class="col-md-9">
                                    <textarea class="form-control" id="more_info" name="more_info"> </textarea>
                                    <small style="color:#b5adad;"><cite>{{ __('dashboard.MoreInfoDesc') }}</cite></small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Row6 | Image -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="required control-label col-md-4">{{ __('dashboard.Product Image') }} : </label>
                                <div class="col-md-8">
                                    <input type="file" name="image" id="image" />
                                    <span id="store_image"></span>
                                </div>
                            </div>                    
                        </div>                    

                    </div>

                    <div class="form-group" align="center">
                        <input type="hidden" name="action" id="action" />
                        <input type="hidden" name="hidden_id" id="hidden_id" />
                        <input type="submit" name="action_button" id="action_button" class="btn btn-warning"
                            value="{{ __('dashboard.Add') }}" style="padding:8px 40px;"/>
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
                <h2 class="modal-title " align="center">{{ __('dashboard.Confirmation') }}Confirmation</h2>
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
<style>
    .ex {
    background-color: #00a65a !important;
    color: #ffffff !important;
}
</style>
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
        var Edit_Product = "{{ __('dashboard.Edit Product') }}";
        var Delete_Product = "{{ __('dashboard.Delete Product') }}";
        var OK = "{{ __('dashboard.Ok') }}";
        var Select_Main_Category = "{{ __('dashboard.Select Main Category') }}";
        var Select_Brand = "{{ __('dashboard.Select Brand') }}";

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Show tabel
        $('#records_table').DataTable({
            dom: 'Bfrtip',
            buttons: [
                {
            extend: 'excelHtml5',
            className: 'ex',
            text: '<span class="fa fa-file-excel-o"></span> Excel Export',
            exportOptions: {
        orthogonal: 'excelHtml5',
        columns: [1,2,3,4,5,6,7,8,9,10,11,12] ,
        rows: { order:'current', search: 'none' },
       
        },
        },
    
        ],
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
            serverSide: false,
            "order": [[ 1, "desc" ]],
            ajax: {
                url: "{{ route('products.index') }}",
            },
            columns: [
                {
                    data: 'image',
                    name: 'image',
                    render: function (data, type, full, meta) {
                        return "<img src={{ URL::to('/storage') }}/images/products/" + data +
                            " width='70' class='img-thumbnail' />";
                    },
                    orderable: false
                },
                { data: 'id',          name: 'id' },
                { data: 'name',        name: 'name' },
                { data: 'code',        name: 'code' },
                { data: 'description', name: 'description' },
                { data: 'cat_id',      name: 'cat_id' },
                { data: 'brand_id',    name: 'brand_id' },
                { data: 'stock',       name: 'stock' },
                { data: 'price',       name: 'price' },
                { data: 'discount',    name: 'discount' },
                { data: 'color',       name: 'color' },
                { data: 'size',        name: 'size' },
                { data: 'more_info',   name: 'more_info' },
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
                    url: "{{ route('products.store') }}",
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
                    url: "{{ route('products.store') }}",
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
                url: "{{ route('products.index') }}" + '/' + id + '/edit',
                dataType: "json",
                success: function (html) {
                    $('#name').val(html.data.name);
                    $('#code').val(html.data.code);
                    $('#cat_id').val(html.data.cat_id);
                    $('#brand_id').val(html.data.brand_id);
                    $('#stock').val(html.data.stock);
                    $('#price').val(html.data.price);
                    $('#discount').val(html.data.discount);
                    $('#more_info').val(html.data.more_info);
                    $('#description').val(html.data.description);
                    $('#color').val(html.data.color);
                    $('#size').val(html.data.size);

                    $('#store_image').html("<img src={{ URL::to('/storage') }}/images/products/" + html.data.image + " width='70' class='img-thumbnail' />");
                    $('#store_image').append(
                        "<input type='hidden' name='hidden_image' value='" + html.data
                        .image + "' />");

                    $('#hidden_id').val(html.data.id);
                    $('.modal-title').text(Edit_Product);
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
            $('.modal-title').text(Delete_Product);
            $('#confirmModal').modal('show');
        });

        // Delete Confirmation 
        $('#ok_button').click(function () {
            $.ajax({
                url: "{{ route('products.index') }}" + '/' + record_id,
                beforeSend: function () {
                    $('#ok_button').text(DeleteWait);
                },
                method : "DELETE",
                success: function (data) {
                    setTimeout(function () {
                        $('#ok_button').text(OK);
                        $('#confirmModal').modal('hide');
                        $('#records_table').DataTable().ajax.reload();
                    }, 2000);
                }
            })
        });

        // Select Category
        $.ajax({
            url: "{{ route('getCats') }}",
            method: 'GET',
            dataType: 'json',
            success: function(data){
                var catsOptions = '<option value="">' + Select_Main_Category + '</option>';
                $.each(data.cats, function(key, cat){
                    catsOptions += '<option value="'+cat.id+'">'+cat.name+'</option>';
                });
                $('#cat_id').html(catsOptions)
            }
        });  

        // Select Brand
        $.ajax({
            url: "{{ route('getBrands') }}",
            method: 'GET',
            dataType: 'json',
            success: function(data){
                var brandsOptions = '<option value="">' + Select_Brand + '</option>';
                $.each(data.brands, function(key, brand){
                    brandsOptions += '<option value="'+brand.id+'">'+brand.name+'</option>';
                });
                $('#brand_id').html(brandsOptions)
            }
        });          
    });
</script>
@endpush

