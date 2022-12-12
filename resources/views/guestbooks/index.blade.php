@extends('layouts.main')

@section('title', 'Guest Books')

@section('page_title', 'Guest Books')

@section('breadcrumb')

    <li class="breadcrumb-item"><a href="/">Home</a></li>
    <li class="breadcrumb-item active"><a href="#">Guest Books</a></li>

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
                                <th>Fullname</th>
                                <th>Address</th>
                                <th>Phone Number</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Necessity</th>
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
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Create Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label>Fullname</label>
                            <input type="text" class="form-control" name="full_name" required>
                        </div>

                        <div class="form-group">
                            <label>Necessity</label>
                            <select name="necessity_id" class="form-control">
                                @foreach ($data as $d)
                                    <option value="{{ $d->id }}">{{ $d->necessity }}</option>
                                @endforeach

                            </select>
                        </div>

                        <div class="form-group">
                            <label>Address</label>
                            <textarea name="address" class="form-control" id="" rows="3"></textarea>
                        </div>

                        <div class="form-group">
                            <label>Phone Number</label>
                            <input type="number" name="no_hp" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Visiting Time</label>
                            <input type="time" name="visiting_time" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Visiting Date</label>
                            <input type="date" name="visiting_date" class="form-control">
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

    <div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form action="" class="form-edit">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Edit Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label>Fullname</label>
                            <input type="text" class="form-control" name="full_name" required>
                            <input type="hidden" class="form-control" name="id">
                        </div>

                        <div class="form-group">
                            <label>Necessity</label>
                            <select name="necessity_id" class="form-control">
                                @foreach ($data as $d)
                                    <option value="{{ $d->id }}">{{ $d->necessity }}</option>
                                @endforeach

                            </select>
                        </div>

                        <div class="form-group">
                            <label>Address</label>
                            <textarea name="address" class="form-control" id="" rows="3"></textarea>
                        </div>

                        <div class="form-group">
                            <label>Phone Number</label>
                            <input type="number" name="no_hp" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Visiting Time</label>
                            <input type="time" name="visiting_time" step="2" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Visiting Date</label>
                            <input type="date" name="visiting_date" class="form-control">
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

        });

        function loadData() {

            $.ajax({
                url: '/guestbooks/getData',
                type: 'GET',
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
                                "data": "full_name"
                            },
                            {
                                "data": "address"
                            },
                            {
                                "data": "no_hp"
                            },
                            {
                                "data": "visiting_date"
                            },
                            {
                                "data": "visiting_time"
                            },
                            {
                                "data": "necessity.necessity"
                            },
                            {
                                "data": "id"
                            }
                        ],
                        "columnDefs": [{
                            "targets": 7,
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
                                    row.id + '"  value="Delete" href="#">' +
                                    '</div>' +
                                    '</div>';
                            }
                        }]
                    });


                } else {
                    alert(result.message)
                }

            }).fail(function(xhr, error) {

                console.log('xhr', xhr.status)
                console.log('error', error)

            })


        }

        $(document).on('click', '.form-create', function(e) {
            e.preventDefault()

            var form = $(this)
            var inputToken = $("input[name=_token]")

            $.ajax({
                url: "/guestbooks/createData",
                type: "POST",
                data: {
                    _token: inputToken.val(),
                    full_name: form.find("input[name=full_name]").val(),
                    address: form.find("textarea[name=address]").val(),
                    no_hp: form.find("input[name=no_hp]").val(),
                    visiting_date: form.find("input[name=visiting_date]").val(),
                    visiting_time: form.find("input[name=visiting_time]").val(),
                    necessity_id: form.find("input[name=necessity_id]").val(),
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

            $.ajax({
                url: "/guestbooks/getData",
                type: "GET",
                data: {
                    id: $(this).data('id')
                }
            }).done(function(result) {

                if (result.data) {

                    var form = $('.form-edit')
                    var data = result.data

                    form.find('input[name=id]').val(data.id)
                    form.find('input[name=full_name]').val(full_name)
                    form.find('textarea[name=address]').val(address)
                    form.find('input[name=no_hp]').val(no_hp)
                    form.find('input[name=vissiting_times]').val(vissiting_time)
                    form.find('input[name=vissiting_date]').val(vissiting_date)

                    $('#modelEdit').modal('show')

                } else {
                    alert('Data not found')
                }

            }).fail(function(xhr, error) {
                console.log('xhr', xhr.status)
                console.log('error', error)
            })
        })

        $(document).on('click', '.form-edit', function(e) {

            var form = $(this)
            var inputToken = form.find("input[name=_token]")

            $.ajax({
                url: "/guestbooks/updateData/" + form.find("input[name=id]").val(),
                type: "POST",
                data: {
                    _token: inputToken.val(),
                    full_name: form.find("input[name=full_name]").val(),
                    address: form.find("textarea[name=address]").val(),
                    no_hp: form.find("input[name=no_hp]").val(),
                    visiting_date: form.find("input[name=visiting_date]").val(),
                    visiting_time: form.find("input[name=visiting_time]").val(),
                    necessity_id: form.find("input[name=necessity_id]").val(),

                }
            }).done(function(result) {
                inputToken.val(result.newToken)

                if (result.status) {
                    $('#modalEdit').modal('hide')
                } else {
                    alert(result.message)
                }
            }).fail(function(xhr, error) {
                console.log('xhr', xhr.status)
                console.log('error', error)
            })
        })

        $(document).on('click', '.btn-delete', function(e) {

            if (confirm('Are you sure to delete data ?')) {
                var inputToken = $("input[name=_token]")

                $.ajax({
                    url: "/guestbooks/deleteData/" + $(this).data('id'),
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
