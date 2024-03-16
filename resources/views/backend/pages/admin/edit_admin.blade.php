@extends('admin.admin_dashboard')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <div class="page-content">
        <div class="row profile-body">
            <div class="col-md-8 col-xl-8 middle-wrapper">
                <div class="row">
                    <div class="col-md-12 grid-margin">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="card-title">Edit Admin</h6>
                                <form method="POST" action="{{ route('store.admin') }}" class="forms-sample"
                                    id="myForm">
                                    @csrf
                                    <div class="form-group mb-3">
                                        <label for="username" class="form-label">Admin Username</label>
                                        <input type="text" name="username" class="form-control" value="{{ $user->username }}">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="name" class="form-label">Admin Name</label>
                                        <input type="text" name="name" class="form-control" value="{{ $user->name }}">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="email" class="form-label">Admin Email</label>
                                        <input type="text" name="email" class="form-control" value="{{ $user->email }}">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="phone" class="form-label">Admin Phone</label>
                                        <input type="text" name="phone" class="form-control" value="{{ $user->phone }}">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="address" class="form-label">Admin Address</label>
                                        <input type="text" name="address" class="form-control" value="{{ $user->address }}">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="password" class="form-label">Admin Password</label>
                                        <input type="password" name="password" class="form-control">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="name" class="form-label">Role Name</label>
                                        <select name="roles" class="form-select">
                                            <option selected="" disabled="">Select Role</option>
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary me-2">Save Changes</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#myForm').validate({
                rules: {
                    username: {
                        required: true,
                    },
                    name: {
                        required: true,
                    },
                    emailname: {
                        required: true,
                    },
                    phone: {
                        required: true,
                    },
                    address: {
                        required: true,
                    },
                },
                messages: {
                    name: {
                        required: 'Please Enter Permission Name',
                    },
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                },
            });
        });
    </script>
@endsection
