<?php

namespace App\Http\Controllers;

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
}
