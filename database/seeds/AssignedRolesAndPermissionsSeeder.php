<?php

use \App\Models\User;
use Illuminate\Database\Seeder;
use \Spatie\Permission\Models\Role;
use \Spatie\Permission\Models\Permission;

class AssignedRolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //  get Models

        $users = User::whereIn('name', ['Superadmin', 'testadmin', 'testuser'])->get();
        $roles = Role::all();
        $permissions = Permission::all();

        //  prepare permissions lists

        $adminRolePermissions = [
            'to login',
            'create achievement',
            'get achievements',
            'edit achievement',
            'delete achievement',
            'get waiting achievements',
            'achievement attach category',
            'achievement detach category',
            'achievement attach tag',
            'achievement detach tag',
            'get rewards',
            'get waiting rewards',
            'reward achievement',
            'remove reward achievement',
            'approve achievement allow',
            'approve reward allow',
            'approve achievement deny',
            'approve reward deny',
            'create category',
            'get categories',
            'update category',
            'delete category',
            'create tag',
            'get tags',
            'update tag',
            'delete tag',
        ];
        $userRolePermissions = [
            'to login',
            'create achievement',
            'get achievements',
            'get rewards',
            'get waiting rewards',
            'create category',
            'get categories',
            'create tag',
            'get tags',
        ];

        //  find users Models

        $superAdminUser = $users->where('name', 'Superadmin')->first();
        $adminUser = $users->where('name', 'testadmin')->first();
        $testUser = $users->where('name', 'testuser')->first();

        //  find roles Models

        $superAdminRole = $roles->where('name', 'superadmin')->first();
        $adminRole = $roles->where('name', 'admin')->first();
        $userRole = $roles->where('name', 'user')->first();

        //  set permissions to roles

        $superAdminRole->syncPermissions([$permissions->where('name', '*')->first()]);
        $adminRole->syncPermissions($permissions->whereIn('name', $adminRolePermissions));
        $userRole->syncPermissions($permissions->whereIn('name', $userRolePermissions));

        //  assign roles to users

        $superAdminUser->assignRole($superAdminRole);
        $adminUser->assignRole($adminRole);
        $testUser->assignRole($userRole);
    }
}
