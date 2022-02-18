<?php

namespace App\Http\Controllers\API;
use App\Models\User;
use App\Models\Role;
use App\Http\Requests\RolesRequest;
use App\Http\Resources\RolesCollection;
use App\Http\Resources\RolesResource;
use Illuminate\Http\Request;

class RolesAPIController extends Controller
{
    //
    public function index(Request $request){
        $query = User::commonFunctionMethod(Role::class,$request);
        return new RolesCollection(RolesResource::collection($query),RolesResource::class);
    }

    public function store(RolesRequest $request)
    {
        return new RolesResource(Role::create($request->all()));
    }

    public function update(RolesRequest $request, Role $role)
    {
        $role->update($request->all());

        return new RolesResource($role);
    }

    public function show(Role $role)
    {
        return new RolesResource($role->load([]));
    }

    public function destroy(Request $request, Role $role)
    {
        $role->delete();

        return new RolesResource($role);
    }

    public function deleteAll(Request $request)
    {
        return Role::deleteAll($request);
    }
}
