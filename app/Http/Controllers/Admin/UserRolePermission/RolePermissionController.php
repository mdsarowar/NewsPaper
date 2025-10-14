<?php

namespace App\Http\Controllers\Admin\UserRolePermission;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laratrust\Models\Permission;
use Laratrust\Models\Role;

class RolePermissionController extends Controller
{
    public function roletopermission(){
        $permissions = Permission::all()->groupBy(function ($perm) {
            return explode('-', $perm->name)[1] ?? 'general';
        });
//        return $permissions;
        return view('admin.role.role_permission',[
            'role'=>Role::first(),
            'permissions'=>$permissions
        ]);
    }

    public function updateroletopermission(Request $request ,string $id){
//        return $request;
       $role=Role::find($id);
        $role->permissions()->sync($request->permissions);
       return redirect()->back();
    }
}
