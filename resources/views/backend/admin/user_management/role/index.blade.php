@extends('backend.admin.master')

@section('section')
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-1 justify-content-end">
        <a href="{{ route('admin.roles.create') }}" class="btn btn-primary">
            Create Role
        </a>
    </div>

    <h6 class="mb-1 text-uppercase">
        Role List
    </h6>
    <hr />
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="permissionsTable" class="table table-striped table-bordered text-center align-middle">
                    <thead class="text-center">
                        <tr>
                            <th>ID</th>
                            <th>Role Title</th>
                            <th>Permissions</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $role)
                            <tr>
                                <td>{{ $role->id }}</td>
                                <td>{{ $role->name }}</td>
                                <td>
                                    @if($role->permissions->count() > 0)
                                        <div class="permissions-scroll border rounded p-2">
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
                                        <p class="text-muted mb-0">No permissions assigned</p>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center gap-1">
                                        <a href="{{ route('admin.roles.show', $role->id) }}"
                                            class="btn btn-info btn-sm d-flex align-items-center gap-1 px-2"
                                            title="View">
                                            <i class='bx bx-show fs-6'></i> <span>View</span>
                                        </a>
                                        <a href="{{ route('admin.roles.edit', $role->id) }}"
                                            class="btn btn-warning btn-sm d-flex align-items-center gap-1 px-2"
                                            title="Edit">
                                            <i class='bx bx-edit fs-6'></i> <span>Edit</span>
                                        </a>
                                        <form action="{{ route('admin.roles.destroy', $role->id) }}"
                                            method="POST" class="d-inline-flex"
                                            onsubmit="return confirm('Are you sure you want to delete this role?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="btn btn-danger btn-sm d-flex align-items-center gap-1 px-2"
                                                title="Delete">
                                                <i class='bx bx-trash fs-6'></i> <span>Delete</span>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    /* Scrollable permissions container in table cell */
    .permissions-scroll {
        max-height: 180px; /* Adjust height as needed */
        overflow-y: auto;
    }
    /* Row inside scrollable container */
    .permissions-scroll .row {
        margin: 0;
    }
    .permissions-scroll .col-md-3 {
        padding-left: 2px;
        padding-right: 2px;
    }
    .permissions-scroll .badge {
        display: block;
        width: 100%;
        text-align: center;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
</style>
@endsection

@section('scripts')
<!-- Include jQuery and Datatables JS -->
<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function() {
        $('#permissionsTable').DataTable({
            "columnDefs": [
                { "orderable": false, "targets": [2,3] } // Disable sorting for Permissions and Actions
            ]
        });
    });
</script>
@endsection
