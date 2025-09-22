@extends('backend.admin.master')

@section('section')
    <div class="page-content">
        <div class="card">
            <div class="card-body p-4">
                <h5 class="mb-4">Edit Role</h5>

                <form action="{{ route('admin.roles.update', $role->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- Role Title --}}
                    <div class="row mb-3">
                        <label for="role_name" class="col-sm-3 col-form-label">
                            Role Title
                        </label>
                        <div class="col-sm-9">
                            <div class="position-relative input-icon">
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="role_name" name="name" value="{{ old('name', $role->name) }}" required>
                                <span class="position-absolute top-50 translate-middle-y">
                                    <i class='bx bx-id-card' style="color:#4ECDC4;"></i>
                                </span>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- Permissions Multi-select (exact code you gave) --}}
                    <div class="row mb-3">
                        <label for="multiple-select-clear-field" class="col-sm-3 col-form-label">Assign Permissions</label>
                        <div class="col-sm-9">
                            <select class="form-select" id="multiple-select-clear-field" name="permissions[]"
                                data-placeholder="Choose anything" multiple>
                                @foreach ($permissions as $permission)
                                    <option value="{{ $permission->id }}"
                                        {{ in_array($permission->id, $role->permissions->pluck('id')->toArray()) ? 'selected' : '' }}>
                                        {{ $permission->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('permissions')
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- Submit --}}
                    <div class="row">
                        <label class="col-sm-3 col-form-label"></label>
                        <div class="col-sm-9">
                            <div class="d-md-flex d-grid align-items-center gap-3">
                                <button type="submit" class="btn btn-primary px-4">Update</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
