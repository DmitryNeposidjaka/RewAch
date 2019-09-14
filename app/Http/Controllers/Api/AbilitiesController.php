<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

/**
 * Class AbilitiesController
 * @package App\Http\Controllers\Api
 */
class AbilitiesController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function createRole(Request $request)
    {
        $this->validate($request, [
            'name' => 'request|string|max:255',
            'guard_name' => 'request|string|max:255'
        ]);
        $role = Role::create($request->only(['name', 'guard_name']));
        return response()->json(['message' => 'Role has been created', 'entity' => $role])->setStatusCode(201);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function createPermission(Request $request)
    {
        $this->validate($request, [
            'name' => 'request|string|max:255',
            'guard_name' => 'request|string|max:255'
        ]);
        $permission = Permission::create($request->only(['name', 'guard_name']));
        return response()->json(['message' => 'Permission has been created', 'entity' => $permission])->setStatusCode(201);
    }

    /**
     * @param Role $role
     * @param Permission $permission
     * @return \Illuminate\Http\JsonResponse
     */
    public function assignPermissionToRole(Role $role, Permission $permission)
    {
        $role->givePermissionTo($permission);
        return response()->json(['message' => 'Permission assigned successfully'])->setStatusCode(200);
    }

    /**
     * @param Role $role
     * @param array $permissions
     * @return \Illuminate\Http\JsonResponse
     */
    public function syncRolesPermissions(Role $role, array $permissions)
    {
        $role->permissions()->sync($permissions);
        return response()->json(['message' => 'Permissions synced successfully'])->setStatusCode(201);
    }

}
