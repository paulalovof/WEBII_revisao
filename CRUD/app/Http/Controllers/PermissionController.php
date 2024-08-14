<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Models\Permission;

class PermissionController extends Controller
{
    public static function loadPermissions($role) {

        $sess = array();
        $perm = Permission::with(['resource'])->where('role_id', $role)->get();
        foreach($perm as $item){
            $sess[$item->resource->nome] = (boolean) $item->permission;
        }
        session(['user_permissions' => $sess]);
    }

    public static function isAuthorized($resources){
        $permissions = session('user_permissions');
        return $permissions[$resources];
    }
}
