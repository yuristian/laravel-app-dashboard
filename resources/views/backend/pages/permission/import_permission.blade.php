@extends('admin.admin_dashboard')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <div class="page-content">
        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <a href="{{ route('export')}} " class="btn btn-inverse-warning">Download Xlsx File</a>
            </ol>
        </nav>
        <div class="row profile-body">
            <div class="col-md-8 col-xl-8 middle-wrapper">
                <div class="row">
                    <div class="col-md-12 grid-margin">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="card-title">Import Permissions</h6>
                                <form method="POST" action="{{ route('store.permission') }}" class="forms-sample" id="myForm">
                                    @csrf
                                    <div class="form-group mb-3">
                                        <label for="import_file" class="form-label">Xls File Import</label>
                                        <input type="file" name="import_file" class="form-control">
                                    </div>
                                    <button type="submit" class="btn btn-inverse-warning">Upload</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
