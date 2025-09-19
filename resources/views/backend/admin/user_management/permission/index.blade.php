@extends('backend.admin.master')

@section('section')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-1 justify-content-end">
            <a href="{{ route('admin.permissions.create') }}" class="btn btn-primary">
                Create Permission
            </a>
        </div>

        <h6 class="mb-1 text-uppercase text-center fw-bold" style="color:#FF6B6B;">
            Permission List
        </h6>
        <hr />
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="permissionsTable" class="table table-striped table-bordered text-center align-middle">
                        <thead class="text-center">
                            <tr>
                                <th>ID</th>
                                <th>Permission Title</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($permissions as $permission)
                                <tr>
                                    <td>{{ $permission->id }}</td>
                                    <td>{{ $permission->name }}</td>
                                    <td>
                                        <div class="d-flex justify-content-center gap-1">
                                            <a href="{{ route('admin.permissions.show', $permission->id) }}"
                                                class="btn btn-info btn-sm d-flex align-items-center gap-1 px-2"
                                                title="View">
                                                <i class='bx bx-show fs-6'></i> <span>View</span>
                                            </a>
                                            <a href="{{ route('admin.permissions.edit', $permission->id) }}"
                                                class="btn btn-warning btn-sm d-flex align-items-center gap-1 px-2"
                                                title="Edit">
                                                <i class='bx bx-edit fs-6'></i> <span>Edit</span>
                                            </a>
                                            <form action="{{ route('admin.permissions.destroy', $permission->id) }}"
                                                method="POST" class="d-inline-flex"
                                                onsubmit="return confirm('Are you sure you want to delete this permission?');">
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

@section('scripts')
    <!-- Include jQuery and Datatables JS -->
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>
@endsection
