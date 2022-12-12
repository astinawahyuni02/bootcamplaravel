@extends('layouts.main')

@section('title', 'Profile')

@section('page_title', 'Profile')

@section('breadcrumb')

    <li class="breadcrumb-item"><a href="/">Home</a></li>
    <li class="breadcrumb-item active"><a>Profile</a></li>

@endsection

@section('content')

    <div class="card card-secondary">

        <form action="#" class="form-profile" method="POST">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label>Name</label>
                    <input type="name" class="form-control" id="name" name="name" required>
                    <input type="hidden" name="id" id="changeId">

                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input class="form-control" id="email" name="email"></input>
                </div>
            </div>
        </form>
    </div>

    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalUpdate">
        Update Password
    </button>

    <!-- Modal Update Password-->
    <div class="modal fade" id="modalUpdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form class="form-updatepassword">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Changes Password</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="Old Password">Old Password</label>
                            <input type="password" name="old_password" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="New Password">New Password</label>
                            <input type="password" name="new_password" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="Confirm Password">Confirm Password</label>
                            <input type="password" name="confirm_password" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-warning btn-update">Update Password</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    {{-- Modal Update Profile --}}
    <button type="button" class="btn btn-warning btn-updateprofile" data-toggle="modal" data-target="#modalUpdateProfile">
        Update Profile
    </button>

    <div class="modal fade" id="modalUpdateProfile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form class="form-updateprofile">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Update Profile</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="Nama">Name</label>
                            <input type="text" name="name" class="form-control">
                            <input type="hidden" name="id" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="Email">Email</label>
                            <input type="email" name="email" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-warning ">Update Profile</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection

@push('custom-script')
    <script>
        $(function() {
            showProfile()
        })

        function showProfile() {

            $.ajax({
                url: "/profile/getData",
                type: "GET",
                data: {}
            }).done(function(result) {

                var form = $('.form-profile')

                form.find('input[name=id]').val(result.id)
                form.find('input[name=name]').val(result.name)
                form.find('input[name=email]').val(result.email)
                // form.find('input[name=password]').val(result.password)

            }).fail(function(xhr, error) {
                console.log('xhr', xhr.status)
                console.log('error', error)

            })
        }

        $(document).on('submit', '.form-updatepassword', function(e) {
            e.preventDefault()

            var myId = $('#changeId').val();
            // var form = $(this)
            var inputToken = form.find("input[name=_token]")


            $.ajax({
                url: "/profile/updatePassword/" + myId,
                type: "POST",
                data: {
                    _token: inputToken.val(),

                    old_password: form.find("input[name=old_password]").val(),
                    new_password: form.find("input[name=new_password]").val(),
                    confirm_password: form.find("input[name=confirm_password]").val(),
                }

            }).done(function(result) {
                inputToken.val(result.newToken)

                if (result.status) {
                    $('#modalUpdate').modal('hide')
                    alert(result.message)
                    window.location.href = '/logout'

                } else {
                    alert(result.message)

                }

            }).fail(function(xhr, error) {

            })
        })

        $(document).on('click', '.btn-updateprofile', function(e) {
            //supaya tidak error
            e.preventDefault()

            $.ajax({
                url: "/profile/getData",
                type: "GET",
                data: {
                    id: $(this).data('id')
                }
            }).done(function(result) {

                var form = $('.form-updateprofile')

                form.find('input[name=id]').val(result.id)
                form.find('input[name=name]').val(result.name)
                form.find('input[name=email]').val(result.email)
                // form.find('input[name=password]').val(result.password)

            }).fail(function(xhr, error) {
                console.log('xhr', xhr.status)
                console.log('error', error)

            })
        })

        $(document).on('submit', '.form-updateprofile', function(e) {
            e.preventDefault()

            var form = $(this)
            var inputToken = form.find("input[name=_token]")

            $.ajax({
                url: "/profile/updateProfile/" + form.find("input[name=id]").val(),
                type: "POST",
                data: {
                    _token: inputToken.val(),
                    id: form.find("input[name=id]").val(),
                    name: form.find("input[name=name]").val(),
                    email: form.find("input[name=email]").val(),
                }
            }).done(function(result) {
                inputToken.val(result.newToken)


                if (result.status) {
                    $('#modalUpdateProfile').modal('hide')
                    alert(result.message)
                    loadData()
                } else {

                }
            }).fail(function(xhr, error) {
                console.log('xhr', xhr.status)
                console.log('error', error)
            })
        })
    </script>
@endpush
