<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Requests\UsersRequest;
use App\Http\Requests\RolesRequest;
use App\Http\Requests\PermissionsRequest;
use App\Http\Requests\RolePermissionsRequest;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource; 
use App\Imports\UsersImport;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use App\Models\UserGallery;
use App\Models\RolePermission;

class UserController extends Controller
{
    //
    public function index(Request $request)
    {
        $query = User::commonFunctionMethod(User::class,$request);
        return new UserCollection(UserResource::collection($query),UserResource::class);
    }

    public function addRole(RolesRequest $request){
        return Role::AddRole($request);
    }

    public function addPermission(PermissionsRequest $request){
        return Permission::AddPermission($request);
    }

    public function addRolePermission(Request $request,$id,Role $role){


        // $permission_arr = $request->permission_id;
        $permission_arr = $request->all();
        // dd($request->all());
        return Role::addRolePermission($permission_arr,$id,$role);
    }

    public function register(UsersRequest $request)
    {
        return new UserResource(User::Register($request));
    }

    public function show(User $user)
    {
        return new UserResource($user->load([]));
    }

    public function update(UsersRequest $request, User $user)
    {
        $request['password'] = bcrypt($request['password']);
        $user->update($request->all());
        return new UserResource($user);
    }

    public function destroy(Request $request, User $user)
    {
        $user->delete();
        return new UserResource($user);
    }

    public function deleteAll(Request $request)
    {
        return User::deleteAll($request);
    }

    public function import(Request $request)
    {
        return User::importBulk($request,new UsersImport(),config('constants.models.user_model'),config('constants.import_dir_path.user_dir_path'));
    }

    public function export(Request $request)
    {
        return Excel::download(new UsersExport($request), 'user.csv');
    }
}
