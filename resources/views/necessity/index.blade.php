@extends('layouts.main')

@section('title', 'Necessity')

@section('page_title', 'Necessity')

@section('breadcrumb')

    <li class="breadcrumb-item"><a href="/">Home</a></li>
    <li class="breadcrumb-item active">Setting Necessity</li>

@endsection

@section('content')

    <div class="row">

        <div class="col-md-10"></div>
        <div class="col-md-2">
            <button class="btn btn-block btn-success" data-toggle="modal" data-target="#modalCreate">Create</button>
        </div>

        <div class="col-12 mt-3">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">List Data</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="dataTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Necessity</th>
                                <th>Description</th>
                                <th>Is Active</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalCreate" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form action="" class="form-created">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Create Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label>Necessity</label>
                            <input type="text" class="form-control" name="necessity" required>
                        </div>

                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" class="form-control" id="" rows="3"></textarea>
                        </div>

                        <div class="form-group">
                            <label>Is Active</label>
                            <select name="is_active" class="form-control">
                                <option value="1">Enable</option>
                                <option value="0">Disable</option>
                            </select>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Save Data</button>
                    </div>
                </form>

            </div>
        </div>

    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form action="" class="form-edit">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Edit Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label>Necessity</label>
                            <input type="text" class="form-control" name="necessity" required>
                            <input type="hidden" class="form-control" name="id" required>
                        </div>

                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" class="form-control" id="" rows="3"></textarea>
                        </div>

                        <div class="form-group">
                            <label>Is Active</label>
                            <select name="is_active" class="form-control">
                                <option value="1">Enable</option>
                                <option value="0">Disable</option>
                            </select>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Save Data</button>
                    </div>
                </form>

            </div>
        </div>

    </div>

@endsection

@push('custom-script')


    <script>
        $(function() {

            loadData()

        });

        function loadData() {

            $.ajax({
                url: '/necessity/getData',
                type: '',
                data: {}
            }).done(function(result) {

                if (result.status) {

                    $('#dataTable').DataTable({
                        "paging": true,
                        "lengthChange": false,
                        "searching": true,
                        "ordering": true,
                        "info": true,
                        "autoWidth": false,
                        "responsive": true,
                        "data": result.data,
                        "column": [{
                                "data": "no"
                            },
                            {
                                "data": "necessity"
                            },
                            {
                                "data": "description"
                            }
                            {
                                "data": "is_active"
                            }
                            {
                                "data": "created_at"
                            },
                            {
                                "data": "id"
                            }
                        ],
                        "columnDefs"    : [{
                            "targets": 3,
                            "data": "is_active",
                            "render": function(data, type, row) {
                                return row.is_active == 1 ? 'Enable' : 'Disable';
                            }
                        },
                        {
                            "targets": 5,
                            "data": "id",
                            "render": function(data, type, row) {
                                return '<div class="btn-group">' +
                                    '<button type="button" class="btn btn-default">Action</button>' +
                                    '<button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown">' +
                                    '<span class="sr-only">Toggle Dropdown</span>' +
                                    '</button>' +
                                    '<div class="dropdown-menu" role="menu">' +
                                    '<a class="dropdown-item btn-edit" data-id="' + row.no +
                                    '" href="#">Edit</a>' +
                                    '<input type="submit" class="dropdown-item btn-delete" data-id="' +
                                    row.no + '"  value="Delete" href="#">' +
                                    '</div>' +
                                    '</div>';
                            }
                        }
                    ]
                    });


                } else {
                    alert(result.message)
                }

            }).fail(function(xhr, error) {

                console.log('xhr', xhr.status)
                console.log('error', error)

            })


        }

        $(document).on('submit', '.form-create', function(e) {
            e.preventDefault()

            var form = $(this)
            var inputToken = $("input[name=_token]")

            $.ajax({
                url: "/necessity/createData",
                type: "POST",
                data: {
                    _token: inputToken.val(),
                    necessity: form.find("input[name=necessity]").val(),
                    description: form.find("textarea[name=description]").val()
                }
            }).done(function(result) {

                inputToken.val(result.newToken)

                if (result.status) {
                    $('#modalCreate').modal('hide')
                    alert(result.message)
                    loadData()
                } else {
                    alert(result.message)
                }

            }).fail(function(xhr, error) {

            })

        })

        $(document).on('click', '.btn-edit', function(e) {
            e.preventDefault();

            $.ajax({
                url: "/necessity/getData",
                type: "GET",
                data: {
                    id: $(this).data('id')
                }
            }).done(function(result) {

                if (result.data) {

                    var form = $('.form-edit')
                    var data = result.data

                    form.find('input[name=id]').val(data.id)
                    form.find('input[name=necessity]').val(data.necessity)
                    form.find('textarea[name=description]').val(data.description)
                    form.find('select[name=is_active]').val(data.is_active)

                    $('#modalEdit').modal('show')

                } else {
                    alert('Data not found')
                }
                
            }).fail(function(xhr, error) {
                console.log('xhr', xhr.status)
                console.log('error', error)
            })
        })

        $(document).on('submit', '.form-edit', function(e) {
            e.preventDefault()

            var form = $(this)
            var inputToken = form.find("input[name=_token]")

            $.ajax({
                url: "/necessity/updateData/"+form.find("input[name=id]").val(),
                type: "POST",
                data: {
                    _token: inputToken.val(),
                    necessity: form.find("input[name=necessity]").val(),
                    description: form.find("textarea[name=description]").val(),
                    is_active: form.find("select[name=is_active]").val(),

                }
            }).done(function(result) {
                inputToken.val(result.newToken)

                if (result.status) {
                    $('#modalEdit').modal('hide')
                    loadData()
                } else {
                    alert(result.message)
                }
            }).fail(function(xhr, error) {
                console.log('xhr', xhr.status)
                console.log('error', error)
            })
        })

        $(document).on('click', '.btn-delete', function(e) {
            e.preventDefault()

            if(confirm('Are you sure to delete data ?')) {
                var inputToken = $("input[name=_token]")

                $.ajax({
                    url: "/necessity/deleteData/"+$(this).data('id'),
                    type: "POST",
                    data: {
                        _token: inputToken.val()
                    }
                }).done(function(result) {

                    inputToken.val(result.newToken)
                    if (result.status) {
                        loadData()
                    } else {
                        alert(result.message)
                    }

                }).fail(function(xhr, error) {
                    console.log('xhr', xhr.status)
                    console.log('error', error)
                })
            }
            
            
        })

    </script>

@endpush
