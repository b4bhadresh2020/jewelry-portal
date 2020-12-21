<?php

namespace App\Repositories\Permission;

use App\Repositories\Permission\PermissionRepositoryInterface;
use App\User;
use Illuminate\Support\Facades\Auth;
use Junges\ACL\Http\Models\Group;
use Junges\ACL\Http\Models\Permission;

class PermissionRepository implements PermissionRepositoryInterface
{
    /**
     * @param $request
     * @return Group
     */
    public function store($request)
    {
        $group = new Group();
        $group->name = $request->name;
        $group->slug = (str_replace(' ', '-', strtolower($request->name)));
        $group->save();
        $group->assignPermissions($request->permission);
        return $group;
    }

    /**
     * @param int $id
     * @param $request
     * @return boolean
     */
    public function update($id, $request)
    {
        $group = Group::find($id);
        $group->name = $request->name;
        $group->slug = (str_replace(' ', '-', strtolower($request->name)));
        $group->revokeAllPermissions();
        $group->assignPermissions($request->permission);
        $group->save();
        return $group;
    }

    /**
     * @param int $id
     * @param boolean $forceDelete
     * @return boolean
     */
    public function delete($id, $forceDelete = false)
    {
        $group = Group::find($id);
        $group->revokeAllPermissions();
        $group->detachAllUsers();
        return $group->delete();
    }

    public function findAllGroup()
    {
        return Group::all();
    }

    public function findAllPermission()
    {
        return Permission::all();
    }

    public function count($type)
    {
        $count = 0;
        switch ($type) {
            case 1:
                $count = Group::count();
                break;
            case 2:
                $count = Permission::count();
                break;
        }
        return $count;
    }

    public function findAssignGroupId($id)
    {
        $group = User::find($id)->groups()->pluck('id');
        return (count($group)) ? $group[0] : "";
    }

    public function formatAll()
    {
        $skipPermissionInList = [];
        $crudPermission = $otherPermission = [];

        $permissions = Permission::whereNotIn('slug', $skipPermissionInList)->get();
        $actions = array_column(
            Permission::distinct('action')
                ->select('action')
                ->where('is_crud', true)
                ->whereNotIn('slug', $skipPermissionInList)
                ->get()->toArray(),
            'action'
        );
        foreach ($permissions as $permission) {
            if ($permission->is_crud) {
                $crudPermission[$permission->module][$permission->action] = $permission;
            } else {
                $otherPermission[$permission->module][] = $permission;
            }
        }

        return [
            'crudPermission' => $crudPermission,
            'otherPermission' => $otherPermission,
            'skipPermissionInList' => $skipPermissionInList,
            'actions' => $actions,
        ];
    }
}
