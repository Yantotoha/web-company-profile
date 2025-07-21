@extends('layouts.admin')
@section('title')
    Categories
@endsection

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Category</h1>

            <form action="" id="form_cari" method="post">
                @csrf
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Cari nama" name="cari" id="cari">
                    <div class="input-group-append">
                        <button type="button" id="add_new"
                            class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Add</button>
                        <button class="d-none d-sm-inline-block btn btn-sm btn-info shadow-sm" type="button"
                            id="btn-cari">Cari</button>
                    </div>
                </div>
            </form>
        </div>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Category</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="Tcate" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <form id="addForm" method="post" enctype="multipart/form-data">
        @csrf
        <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add new Category</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-grop row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Name</label>
                                    <input type="text" id="name_category" name="name" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Image</label>
                            <div id="imagec" class="my-2"></div>
                            <input type="file" id="filec" name="file" class="form-control"
                                onchange="ViewImage(this);">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button type="button" id="proses_add" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <form id="updateForm" method="post" enctype="multipart/form-data">
        @csrf
        <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static"
            data-keyboard="false">
            <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Update Category</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-grop row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Name</label>
                                    <input type="hidden" id="id_update" name="id" class="form-control">
                                    <input type="text" id="name_update" name="name" class="form-control">
                                </div>
                            </div>

                        </div>
                        <div class="form-group">
                            <label for="">Image</label>
                            <div id="imagec_update" class="my-2"></div>
                            <input type="file" id="file_update" name="file" class="form-control"
                                onchange="ViewImageUp(this);">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button type="button" id="proses_update" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
@section('script')
    <script>
        function ViewImage(input) {
            let imagec = $('#imagec');
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    imagec.empty().append('<img id="imgv" class="img-fluid" src="#">');
                    $('#imgv').attr('src', e.target.result).height(200);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        function ViewImageUp(input) {
            let imagec = $('#imagec_update');
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    imagec.empty().append('<img id="imgv" class="img-fluid" src="#">');
                    $('#imgv').attr('src', e.target.result).height(200);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        $('document').ready(function(e) {
            var Tcate = $('#Tcate').DataTable({
                "responsive": true,
                'searching': false,
                "processing": true,
                "serverSide": true,
                "pagingType": "full_numbers",
                "paging": true,
                "ajax": {
                    "url": "{{ route('admin.category.data') }}",
                    "data": function(parm) {
                        parm.search = function() {
                            return $('#cari').val()
                        }
                    },

                },
                "columns": [{
                        "data": "name",
                        "orderable": false
                    },
                    {
                        "data": "image",
                        "orderable": false,
                        render: function(data, type, row) {
                            let img_path = row.image;
                            let img_view = '<img src="{{ asset('storage') }}/' + img_path +
                                '" class="rounded float-left" width="100">';
                            return img_view;
                        }
                    },
                    {
                        "data": "id",
                        "orderable": false,
                        render: function(data, type, row) {
                            var idData = row.id;
                            let isVerified = row.verified;
                            let btn =
                                '<div class="btn-group" role="group" aria-label="Basic example">';
                            if (isVerified == 0) {
                                btn +=
                                    '<button type="button" class="btn btn-success btnVerified">Verified</button>';
                            }
                            btn +=
                                '<button type="button" class="btn btn-warning btnUpdate">Update</button>';

                            btn += '</div>';
                            return btn;
                        }
                    },
                ]
            });

            function redraw() {
                Tcate.draw();
            }

            // function tombol add new
            $("#add_new").click(function() {
                $("#addModal").modal("show");
            });

            // proses add
            $("#proses_add").click(function() {
                var postData = new FormData($("#addForm")[0]);
                $.ajax({
                    url: "{{ URL::route('admin.category.store') }}",
                    data: postData,
                    type: "POST",
                    dataType: "JSON",
                    cache: false,
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        $('.loading-clock').css('display', 'flex');
                    },
                    success: function(data) {
                        if (data.success == 1) {
                            // Reset form
                            $('#addForm')[0].reset();
                            // Remove image preview
                            $("#addModal").modal("hide");
                            toastr_success(data.messages);
                            redraw();
                        } else {
                            toastr_error(data.messages);
                        }
                    },
                    complete: function() {
                        $('.loading-clock').css('display', 'none');
                    },
                });
            });

            // proses cari data
            $("#btn-cari").click(function() {
                let search = $("#cari").val();
                Tcate.draw();
            });

            // tombol update data
            $("#Tcate tbody").on('click', '.btnUpdate', function() {
                let data = Tcate.row($(this).parents('tr')).data();
                let idData = data.id;
                $.ajax({
                    url: "{{ URL::route('admin.category.detail') }}",
                    type: "GET",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        'id': idData
                    },
                    dataType: "JSON",
                    cache: false,
                    beforeSend: function() {
                        $('.loading-clock').css('display', 'flex');
                    },
                    success: function(data) {
                        if (data.success == 1) {
                            let id = data.data.id;
                            let name = data.data.name;
                            let image = data.data.image;
                            $("#updateForm #imagec_update").empty().append(
                                '<img id="img" class="img-fluid" src="#">');
                            $('#img').attr('src', "{{ asset('storage') }}/" + image).height(
                                200);
                            $("#id_update").val(id);
                            $("#name_update").val(title);
                            $('#file_update').val(null);

                        } else {
                            toastr_error(data.messages);
                        }
                    },
                    complete: function() {
                        $('.loading-clock').css('display', 'none');
                    },
                })
                $("#updateModal").modal("show");
            });

            // proses update data
            $("#proses_update").click(function() {
                var postData = new FormData($("#updateForm")[0]);
                $.ajax({
                    url: "{{ URL::route('admin.category.update') }}",
                    data: postData,
                    type: "POST",
                    dataType: "JSON",
                    cache: false,
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        $('.loading-clock').css('display', 'flex');
                    },
                    success: function(data) {
                        if (data.success == 1) {
                            $("#updateModal").modal("hide");
                            toastr_success(data.messages);
                            redraw();
                        } else {
                            toastr_error(data.messages);
                        }
                    },
                    complete: function() {
                        $('.loading-clock').css('display', 'none');
                    },
                });
            });



            function toastr_success(msg) {
                const Toast = Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.onmouseenter = Swal.stopTimer;
                        toast.onmouseleave = Swal.resumeTimer;
                    }
                });
                Toast.fire({
                    icon: "success",
                    title: msg
                });
            }

            function toastr_error(msg) {
                const Toast = Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.onmouseenter = Swal.stopTimer;
                        toast.onmouseleave = Swal.resumeTimer;
                    }
                });
                Toast.fire({
                    icon: "error",
                    title: msg
                });
            }
        });
    </script>
@endsection
