<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    //
    public function index()
    {
        $roles = Role::all();
        return view('admin.roles.index', compact('roles'));
    }

    public function create()
    {
        $allowedRoles = Role::getAllowedRoleNames();
        return view('admin.roles.create', compact('allowedRoles'));
    }

    public function store(Request $request)
    {
        $allowedRoles = Role::getAllowedRoleNames();

        $request->validate([
            'role_name' => 'required|string|in:' . implode(',', $allowedRoles) . '|unique:roles',
            'permissions' => 'nullable|array',
            'permissions.*' => 'string',
        ]);

        Role::create([
            'role_name' => $request->role_name,
            'permissions' => $request->permissions ?? [],
        ]);

        return redirect()->route('roles.index')
            ->with('success', 'Role created successfully.');
    }

    public function show(Role $role)
    {
        return view('admin.roles.show', compact('role'));
    }

    public function edit(Role $role)
    {
        $allowedRoles = Role::getAllowedRoleNames();
        return view('admin.roles.edit', compact('role', 'allowedRoles'));
    }

    public function update(Request $request, Role $role)
    {
        $allowedRoles = Role::getAllowedRoleNames();

        // Allow keeping current role_name or changing to another allowed one
        $request->validate([
            'role_name' => 'required|string|in:' . implode(',', $allowedRoles) . '|unique:roles,role_name,' . $role->id,
            'permissions' => 'nullable|array',
            'permissions.*' => 'string',
        ]);

        $role->update([
            'role_name' => $request->role_name,
            'permissions' => $request->permissions ?? [],
        ]);

        return redirect()->route('roles.index')
            ->with('success', 'Role updated successfully.');
    }

    public function destroy(Role $role)
    {
        // Optional: prevent deletion of critical roles
        if (in_array($role->role_name, ['admin'])) {
            return redirect()->route('roles.index')
                ->with('error', 'System role cannot be deleted.');
        }

        $role->delete();
        return redirect()->route('roles.index')
            ->with('success', 'Role deleted successfully.');
    }
}
