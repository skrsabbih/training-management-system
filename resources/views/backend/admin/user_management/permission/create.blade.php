@extends('backend.admin.master')

@section('section')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="card">
            <div class="card-body p-4">
                <h5 class="mb-4">Create Permission</h5>

                <form action="{{ route('admin.permissions.store') }}" method="POST">
                    @csrf
                    <div class="row mb-3">
                        <label for="permission_name" class="col-sm-3 col-form-label">Permission Title <span style="color:red">*</span></label>
                        <div class="col-sm-9">
                            <div class="position-relative input-icon">
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="permission_name" name="name" placeholder="Enter Permission Title"
                                    value="{{ old('name') }}" required>
                                <span class="position-absolute top-50 translate-middle-y"><i
                                        class='bx bx-shield-quarter'style="color:#FF6B6B;"></i></span>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <label class="col-sm-3 col-form-label"></label>
                        <div class="col-sm-9">
                            <div class="d-md-flex d-grid align-items-center gap-3">
                                <button type="submit" class="btn btn-primary px-4">Save</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection
