@extends('admin.admin_dashboard')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <style type="text/css">
        .form-check-label{
            text-transform: capitalize
        }
    </style>
    <div class="page-content">
        <div class="row profile-body">
            <div class="col-md-12 col-xl-12 middle-wrapper">
                <div class="row">
                    <div class="col-md-12 grid-margin">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="card-title">Add Roles in Permission</h6>
                                <form method="POST" action="{{ route('store.role.permission') }}" class="forms-sample"
                                    id="myForm">
                                    @csrf
                                    <div class="form-group mb-3">
                                        <label for="name" class="form-label">Role Name</label>
                                        <select name="role_id" class="form-select">
                                            <option selected="" disabled="">Select Role</option>
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-check mb-2">
                                        <input type="checkbox" class="form-check-input" id="checkDefaultmain">
                                        <label class="form-check-label" for="checkDefaultmain">All Permission</label>
                                    </div>
                                    <hr>
                                    @foreach ($permission_groups as $group)
                                        <div class="row">
                                            <div class="col-3">
                                                <div class="form-check mb-2">
                                                    <input type="checkbox" class="form-check-input">
                                                    <label class="form-check-label"
                                                        for="checkDefault">{{ $group->group_name }}</label>
                                                </div>
                                            </div>
                                            <div class="col-9">
                                                @php
                                                    $permissions = App\Models\User::getPermissionByGroupName(
                                                        $group->group_name,
                                                    );
                                                @endphp

                                                @foreach ($permissions as $permission)
                                                    <div class="form-check mb-2">
                                                        <input type="checkbox" class="form-check-input" name="permission[]"
                                                            id="checkDefault{{ $permission->id }}"
                                                            value="{{ $permission->id }}">
                                                        <label class="form-check-label"
                                                            for="checkDefault{{ $permission->id }}">{{ $permission->name }}</label>
                                                    </div>
                                                @endforeach
                                                <br />
                                            </div>
                                        </div> <!-- End Row -->
                                    @endforeach
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
        $('#checkDefaultmain').click(function(){
            if($(this).is(':checked')) {
                $('input[type=checkbox]').prop('checked',true);
            } else {
                $('input[type=checkbox]').prop('checked',false);
            }
        });
    </script>
@endsection
