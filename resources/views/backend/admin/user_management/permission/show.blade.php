@extends('backend.admin.master')

@section('section')
    <div class="page-content">
        <div class="card">
            <div class="card-body p-4">
                <h5 class="mb-4">View Permission</h5>

                <div class="row mb-3">
                    <label for="permission_name" class="col-sm-3 col-form-label">Permission Title</label>
                    <div class="col-sm-9">
                        <div class="position-relative input-icon">
                            <input type="text" class="form-control" id="permission_name"
                                   value="{{ $permission->name }}" readonly>
                            <span class="position-absolute top-50 translate-middle-y">
                                <i class='bx bx-shield-quarter' style="color:#FF6B6B;"></i>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-sm-12 text-end">
                        <a href="{{ route('admin.permissions.index') }}" class="btn btn-secondary">
                            Back to Permission List
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
