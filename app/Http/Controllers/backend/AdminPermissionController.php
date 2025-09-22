<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class AdminPermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permissions = Permission::all();
        return view('backend.admin.user_management.permission.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // permission create with module like User Management etc.
        $modules = Permission::whereNull('parent_id')->get();
        return view('backend.admin.user_management.permission.create', compact('modules'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:permissions,name',
            'parent_id' => 'nullable|exists:permissions,id',
        ]);

        Permission::create([
            'name' => $request->name,
            'guard_name' => 'web',
            'parent_id' => $request->parent_id,
        ]);

        return redirect()->route('admin.permissions.index')->with('success', 'Permission created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $permission = Permission::findOrFail($id);
        return view('backend.admin.user_management.permission.show', compact('permission'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $permission = Permission::findOrFail($id);
        $modules = Permission::whereNull('parent_id')->where('id', '!=', $permission->id)->get();
        return view('backend.admin.user_management.permission.edit', compact('permission', 'modules'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $permission = Permission::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255|unique:permissions,name,' . $permission->id,
            'parent_id' => 'nullable|exists:permissions,id',
        ]);

        $permission->update([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
        ]);

        return redirect()->route('admin.permissions.index')->with('success', 'Permission updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $permission = Permission::findOrFail($id);
        $permission->delete();

        return redirect()->route('admin.permissions.index')->with('success', 'Permission deleted successfully!');
    }
}
