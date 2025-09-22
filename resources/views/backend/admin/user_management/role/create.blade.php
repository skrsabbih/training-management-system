@extends('backend.admin.master')

@section('section')
    <div class="page-content">
        <div class="card">
            <div class="card-body p-4">
                <h5 class="mb-4">Create Role</h5>

                <form action="{{ route('admin.roles.store') }}" method="POST">
                    @csrf

                    {{-- Role Title --}}
                    <div class="row mb-3">
                        <label for="role_name" class="col-sm-3 col-form-label">
                            Role Title <span style="color:red">*</span>
                        </label>
                        <div class="col-sm-9">
                            <div class="position-relative input-icon">
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="role_name" name="name" placeholder="Enter Role Title"
                                    value="{{ old('name') }}" required>
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

                    {{-- Module Permissions --}}
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">
                            Assign Permissions
                        </label>
                        <div class="col-sm-9">
                            <div class="border rounded p-3" style="max-height: 350px; overflow-y: auto;">

                                {{-- Loop Modules --}}
                                @foreach($modules as $module)
                                    <div class="mb-3">
                                        {{-- Module Checkbox --}}
                                        <div class="form-check mb-2">
                                            <input class="form-check-input module-checkbox"
                                                type="checkbox"
                                                id="module_{{ $module->id }}"
                                                data-module="{{ $module->id }}">
                                            <label class="form-check-label fw-bold text-primary" for="module_{{ $module->id }}">
                                                {{ $module->name }}
                                            </label>
                                        </div>

                                        {{-- Child Permissions --}}
                                        <div class="ms-4">
                                            @foreach($permissions->where('parent_id', $module->id) as $permission)
                                                <div class="form-check mb-1">
                                                    <input class="form-check-input permission-checkbox"
                                                        type="checkbox"
                                                        name="permissions[]"
                                                        value="{{ $permission->id }}"
                                                        data-module="{{ $module->id }}"
                                                        id="permission_{{ $permission->id }}">
                                                    <label class="form-check-label" for="permission_{{ $permission->id }}">
                                                        {{ $permission->name }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            </div>
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
                                <button type="submit" class="btn btn-primary px-4">Save</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const moduleCheckboxes = document.querySelectorAll('.module-checkbox');
        const permissionCheckboxes = document.querySelectorAll('.permission-checkbox');

        // Module wise check/uncheck
        moduleCheckboxes.forEach(moduleCb => {
            moduleCb.addEventListener('change', function () {
                let moduleId = this.dataset.module;
                let childs = document.querySelectorAll(`.permission-checkbox[data-module="${moduleId}"]`);
                childs.forEach(cb => cb.checked = this.checked);
            });
        });

        // Permission wise check -> update module checkbox
        permissionCheckboxes.forEach(cb => {
            cb.addEventListener('change', function () {
                let moduleId = this.dataset.module;
                let moduleCb = document.querySelector(`.module-checkbox[data-module="${moduleId}"]`);
                let childs = document.querySelectorAll(`.permission-checkbox[data-module="${moduleId}"]`);
                // যদি অন্তত ১টা select থাকে তবে module checked
                moduleCb.checked = [...childs].some(c => c.checked);
            });
        });

        // Form validation
        document.querySelector("form").addEventListener("submit", function (e) {
            if (![...permissionCheckboxes].some(cb => cb.checked)) {
                e.preventDefault();
                alert("Please select at least one permission.");
            }
        });
    });
</script>
@endsection
