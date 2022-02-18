<?php

namespace App\Http\Controllers\API;
use App\Models\User;
use App\Models\Permission;
use App\Http\Requests\PermissionsRequest;
use App\Http\Resources\PermissionsCollection;
use App\Http\Resources\PermissionsResource;
use Illuminate\Http\Request;

class PermissionsAPIController extends Controller
{
    //
    public function index(Request $request){
        $query = User::commonFunctionMethod(Permission::class,$request);
        return new PermissionsCollection(PermissionsResource::collection($query),PermissionsResource::class);
    }

    public function store(PermissionsRequest $request)
    {
        return new PermissionsResource(Permission::create($request->all()));
    }

    public function update(PermissionsRequest $request, Permission $permission)
    {
        $permission->update($request->all());

        return new PermissionsResource($permission);
    }

    public function show(Permission $permission)
    {
        return new PermissionsResource($permission->load([]));
    }

    public function destroy(Request $request, Permission $permission)
    {
        $permission->delete();

        return new PermissionsResource($permission);
    }

    public function deleteAll(Request $request)
    {
        return Permission::deleteAll($request);
    }

}
