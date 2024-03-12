@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">

    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <a href="{{ route('add.role')}} " class="btn btn-inverse-info">Add Roles Permission</a>&nbsp;
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">All Roles Permission</h6>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Serial Number</th>
                                    <th>Roles Name</th>
                                    <th>Permission Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $key => $item)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>
                                            @foreach ( $item->permissions as $perm)
                                                <span class="badge bg-danger">{{ $perm->name }}</span>
                                                @if($loop->iteration % 5 === 0)
                                                    <br/>
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>
                                            <a href="{{ route('edit.role', $item->id) }}" class="btn btn-inverse-warning">Edit</a>
                                            <a href="{{ route('delete.role', $item->id) }}" id="delete" class="btn btn-inverse-danger">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection