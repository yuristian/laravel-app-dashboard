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
                            <h6 class="card-title">Add Property Type</h6>
                            <form method="POST" action="{{ route('store.type') }}" class="forms-sample">
                                @csrf
                                <div class="mb-3">
                                    <label for="type" class="form-label">Type Name</label>
                                    <input type="text" name="type" class="form-control @error('type') is-invalid @enderror" id="type">
                                    @error('type')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="icon" class="form-label">Type Icon</label>
                                    <input type="icon" name="icon" class="form-control @error('icon') is-invalid @enderror" id="icon">
                                    @error('icon')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
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
@endsection
