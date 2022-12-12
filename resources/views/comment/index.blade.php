@extends('layouts.main')

@section('title', 'Comment')

@section('page_title', 'Comment')

@section('breadcrumb')

    <li class="breadcrumb-item"><a href="/">Home</a></li>
    <li class="breadcrumb-item active"><a>Comment</a></li>

@endsection

@section('content')

    <div class="row">
        <div class="col-md-10"></div>
        <div class="col-md-2">

            {{-- Button trigger modal --}}
            <button type="button" class="btn btn-block btn-success" data-toggle="modal" data-target="#modalCreate">
                Create
            </button>
        </div>
    </div>
    <div class="col-md-12 mt-3">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">List Data</h3>
            </div>
            <div class="card-body table-responsive">
                <table id="dataTable" class="table table-bordered text-nowrap">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>News</th>
                            <th>Comment</th>
                            <th>Like</th>
                            <th>Time_comment</th>
                            <th>Date_comment</th>
                            <th>Is Active</th>
                            <th>Create At</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalCreate" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form action="#" class="form-create" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Create Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Enter name..."
                                required></input>
                        </div>
                        <div class="form-group">
                            <label>Title</label>
                            <select name="id_category" class="custom-select">
                                @foreach ($news as $d)
                                    <option value="{{ $d->id }}">{{ $d->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Comment</label>
                            <input type="text" name="comment" class="form-control" placeholder="Enter Comment..."
                                required></input>
                        </div>
                        <div class="form-group">
                            <label>Is Active</label>
                            <select class="form-control" name="is_active">
                                <option value="enable">Enable</option>
                                <option value="disable">Disable</option>
                            </select>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Edit -->
    <div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form class="form-edit">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Update Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Enter name...">
                            <input type="hidden" name="id">

                        </div>
                        <div class="form-group">
                            <label>Title</label>
                            <select name="id_category" class="custom-select">
                                @foreach ($news as $d)
                                    <option value="{{ $d->id }}">{{ $d->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Comment</label>
                            <input type="text" name="comment" class="form-control" placeholder="Enter Comment..."
                                required></input>
                        </div>
                        <div class="form-group">
                            <label>Is Active</label>
                            <select class="form-control" name="is_active">
                                <option value="enable">Enable</option>
                                <option value="disable">Disable</option>
                            </select>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection

@push('custom-script')
    <script>
        $(function() {
            loadData();
        });

        function loadData() {
            $.ajax({
                url: "/comment/getData",
                type: "GET",
                data: {}

                //sukses dan dapat API
            }).done(function(result) {
                $('#dataTable').DataTable({
                    "paging": true,
                    "searching": true,
                    "ordering": true,
                    "responsive": true,
                    "destroy": true,
                    "data": result.data,
                    "columns": [{
                            "data": "no"
                        },
                        {
                            "data": "name"
                        },
                        {
                            "data": "news.title"
                        },
                        {
                            "data": "comment"
                        },
                        {
                            "data": "like"
                        },
                        {
                            "data": "time_comment"
                        },
                        {
                            "data": "date_comment"
                        },
                        {
                            "data": "is_active"
                        },
                        {
                            "data": "created_at"
                        },

                        {
                            "data": "id"
                        },

                    ],
                    "columnDefs": [{
                            "targets": 9,
                            "data": "id",
                            "render": function(data, type, row) {
                                return '<div class="btn-group">' +
                                    '<button type="button" class="btn btn-default">Action</button>' +
                                    '<button type="button" class="btn btn-default btn-flat dropdown-toggle dropdown-icon" data-toggle="dropdown">' +
                                    '<span class="sr-only">Toggle Dropdown</span>' +
                                    '</button>' +
                                    '<div class="dropdown-menu" role="menu">' +
                                    '<a class="dropdown-item btn-edit" data-id="' + row.id +
                                    '" href="#">Edit</a>' +
                                    '<input type="submit" class="dropdown-item btn-delete" data-id="' +
                                    row.id + '" value="Delete" href="#">' +
                                    '</div>' +
                                    '</div>';
                            },
                        },
                        {
                            "targets": 4,
                            "data": "like",
                            "render": function(data, type, row) {
                                return row.like == 1 ? "Like" : 'Dislike';
                            }
                        }
                    ]
                })

            }).fail(function(xhr, error) {
                console.log('xhr', xhr.status)
                console.log('error', error)
            })
        }

        $(document).on('submit', '.form-create', function(e) {
            e.preventDefault()

            var form = $(this)
            var inputToken = form.find("input[name=_token]")

            $.ajax({
                url: "/comment/createData",
                type: "POST",
                data: {
                    _token: inputToken.val(),
                    name: form.find("input[name=name]").val(),
                    title: form.find("select[name=title]").val(),
                    comment: form.find("input[name=comment]").val(),
                    is_active: form.find("select[name=is_active]").val(),

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
            //supaya tidak error
            e.preventDefault()

            $.ajax({
                url: "/comment/getData",
                type: "GET",
                data: {
                    id: $(this).data('id')
                }
            }).done(function(result) {

                if (result.data) {
                    var form = $('.form-edit')
                    var data = result.data
                    form.find("input[name=name]").val(),
                        form.find("input[name=phone_number]").val(),
                        form.find("input[name=comment]").val(),
                        form.find("select[name=is_active]").val(),
                        form.find('input[name=id]').val(data.id)

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
                url: "/comment/updateData/" + form.find("input[name=id]").val(),
                type: "POST",
                data: {
                    _token: inputToken.val(),
                    name: form.find("input[name=name]").val(),
                    phone_number: form.find("input[name=phone_number]").val(),
                    comment: form.find("input[name=comment]").val(),
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
            e.preventDefault();

            if (confirm('Are you sure to delete data?')) {
                var inputToken = $("input[name=_token]")

                $.ajax({
                    url: "/comment/deleteData/" + $(this).data('id'),
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
