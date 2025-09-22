@extends('backend.admin.master')

@section('section')
    <div class="page-content">
        <div class="card">
            <div class="card-body p-4">
                <h5 class="mb-4">View Role</h5>

                {{-- Role Title --}}
                <div class="row mb-3">
                    <label for="role_name" class="col-sm-3 col-form-label">Role Title</label>
                    <div class="col-sm-9">
                        <div class="position-relative input-icon">
                            <input type="text" class="form-control"
                                   id="role_name" value="{{ $role->name }}" readonly>
                            <span class="position-absolute top-50 translate-middle-y">
                                <i class='bx bx-id-card' style="color:#4ECDC4;"></i>
                            </span>
                        </div>
                    </div>
                </div>

                {{-- Assigned Permissions --}}
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Assigned Permissions</label>
                    <div class="col-sm-9">
                        @if($role->permissions->count() > 0)
                            <div class="border rounded p-3" style="max-height: 250px; overflow-y: auto;">
                                <div class="row">
                                    @foreach($role->permissions as $permission)
                                        <div class="col-md-3 mb-2">
                                            <span class="badge bg-primary">
                                                {{ $permission->name }}
                                            </span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @else
                            <p class="text-muted mb-0">No permissions assigned to this role.</p>
                        @endif
                    </div>
                </div>

                {{-- Back Button --}}
                <div class="row mt-3">
                    <div class="col-sm-12 text-end">
                        <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary">
                            Back to Role List
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
