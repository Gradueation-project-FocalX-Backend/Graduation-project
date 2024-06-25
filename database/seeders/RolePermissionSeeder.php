<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    private $permissions = ['show', 'create', 'update', 'delete', 'trash',];
    private $model_path;
    private $model_names;
    private $model_files;
    public function run(): void
    {
        //
        $this->model_path = app_path('Models');
        $this->model_files = File::allFiles($this->model_path);
        $this->model_names = collect($this->model_files)->map(function ($file) {
            $model_name = pathinfo($file, PATHINFO_FILENAME);
            return "$model_name";
        })->push('Role', 'Permission');


        $role_admin = Role::create(['name' => 'admin']);
        $role_user = Role::create(['name' => 'customer']);
        $role_employee = Role::create(['name' => 'employee']);
        $role_admin->save();
        $role_user->save();
        $role_employee->save();

        foreach ($this->model_names as $model_name) {
            foreach ($this->permissions as $permission) {
                $permission = Permission::create([
                    'name' => $model_name . ' ' . $permission,
                    'guard_name' => 'web',
                ]);
                if ($permission->save()) {
                    $role_admin->givePermissionTo($permission);
                }
            }
        }

        $additional_permissions =['Permission revoke', 'Permission assign'];

        foreach($additional_permissions as $per)
        {
            $permission = Permission::create([
                'name' => $per,
                'guard_name' => 'web',
            ]);
            $role_admin->givePermissionTo($per);
        }
    }
}
