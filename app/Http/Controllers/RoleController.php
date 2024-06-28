<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{


    /**
     * return list of roles
     * return collection
     */
    public function index()
    {
        $roles = Role::all(); // paginate() is better 

        return view('dashboard.roles.index', compact('roles'));
    }

    /**
     * return view 
     * add new role 
     */
    public function create()
    {
        return view('dashboard.roles.add');
    }


    /**
     * Add new role
     * 
     */

    public function store(RoleRequest $request)
    {
        $data = $request->validated();
        Role::create([
            'name' => $data['name'],
        ]);

        return redirect()->route('roles.index')->with('success', 'New role has been added');
    }
    public function edit(Role $role)
    {
        $unassigned_permissions = DB::table('permissions')
            ->whereNotIn('permissions.id', function ($query) use ($role) {
                $query->select('permission_id')
                    ->from('role_has_permissions')
                    ->where('role_id', $role->id);
            })->get();


        $permissions = DB::table('permissions')
            ->whereIn('permissions.id', function ($query) use ($role) {
                $query->select('permission_id')
                    ->from('role_has_permissions')
                    ->where('role_id', $role->id);
            })->orderBy('id')->get();


        return view('dashboard.roles.edit', compact('role', 'unassigned_permissions', 'permissions'));
    }


    //  ===================  Assign permissions to role =====================
    public function assignPermission(Role $role, string $id)
    {
        // return $id;
        // return $role;
        $permission = Permission::where('id', $id)->first();
        $role->givePermissionTo($permission);
        return redirect()->back()->with('info', "$permission->name is assign to $role->name");
    }


    //  ===================  Revoke permissions from role =====================
    public function revokePermission(Role $role, string $id)
    {
        // return $id;
        // return $role;
        $permission = Permission::where('id', $id)->first();
        $role->revokePermissionTo($permission);
        return redirect()->back()->with('info', "$permission->name is revoked from $role->name");
    }

    /**
     * Delete role 
     * Note : can't delete Roles (admin, employee , customer) cause is part of the system
     */
    public function destroy(string $id)
    {
        $role = Role::findOrFail($id);
        if ($role->name == 'admin' || $role->name == 'employee' || $role->name == 'customer') {
            return redirect()->route('roles.index')->with('danger', 'This a main role in the system can not delete it');
        }
        $role->delete();
        return redirect()->route('roles.index')->with('success', 'The role has been deleted');
    }
}
