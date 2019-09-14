<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

/**
 * Class UserController
 * @package App\Http\Controllers\Api
 */
class UserController extends Controller
{
    /**
     * @param User $user
     * @param Role $role
     * @return \Illuminate\Http\JsonResponse
     */
    public function assignRole(User $user, Role $role)
    {
        $user->assignRole($role);
        return response()->json(['message' => 'Assigned successfully!'])->setStatusCode(200);
    }

    /**
     * @param User $user
     * @param Permission $permission
     * @return \Illuminate\Http\JsonResponse
     */
    public function assignPermission(User $user, Permission $permission)
    {
        $user->givePermissionTo($permission);
        return response()->json(['message' => 'Assigned successfully!'])->setStatusCode(200);
    }

    /**
     * @param User $user
     * @param array $roles
     * @return \Illuminate\Http\JsonResponse
     */
    public function syncRoles(User $user, array $roles)
    {
        $user->roles()->sync($roles);
        return response()->json(['message' => 'Synced successfully!'])->setStatusCode(200);
    }

    /**
     * @param User $user
     * @param array $permissions
     * @return \Illuminate\Http\JsonResponse
     */
    public function syncPermissions(User $user, array $permissions)
    {
        $user->permissions()->sync($permissions);
        return response()->json(['message' => 'Synced successfully!'])->setStatusCode(200);
    }
}
