<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Role;
use App\Models\Permission;
use App\Traits\Scopes;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use HasFactory, Scopes, SoftDeletes;

    protected $fillable = [
        'name',
    ];

    
    public function scopeAddRole($query,$request){
        $data = $request->all();
        $user = Role::create($data);

        return response()->json(['success' => config('constants.messages.role_success')], config('constants.validation_codes.ok'));
    }


    public function permission()
    {
        return $this->belongsToMany(Permission::class);
    }

    public function scopeDeleteAll($query,$request){
        if(!empty($request->id)) {
            Role::whereIn('id', $request->id)->delete();

            return response()->json(['success' => config('constants.messages.delete_success')], config('constants.validation_codes.ok'));
        }
        else{
            return response()->json(['error' =>config('constants.messages.delete_multiple_error')], config('constants.validation_codes.unprocessable_entity'));
        }
    }

    public function permission_data() {
        // return $this->belongsToMany(Role::class,"permission_role","role_id","permission_id");
        return $this->belongsToMany(Permission::class,"permission_role","role_id","permission_id");
    }

    public function addRolePermission($permission_arr,$id,$role){
        
        $data = $permission_arr;
        
        $role = Role::find($id);
        
        
        // $check_role_permission = RolePermission::where('role_id',$request->role_id)->where('permission_id',$request->permission_id)->first();

        // if(!$check_role_permission){

            // RolePermission::insert([
            //     'permission_id' => $request->get('permission_id'),
            //     'role_id' => $request->get('role_id'),
            // ]);
            // $delete_role_permission = RolePermission::where('role_id',$id)->delete();
            $role->permission_data()->detach();
            
            $role->permission_data()->attach($data['role_permission']);
            // $this->permission_data()->detach(); //this executes the delete-query

            // $insert_arr = [];
            // foreach($permission_arr as $key => $value){
            //     $insert_arr[$key]['role_id'] = $id;
            //     $insert_arr[$key]['permission_id'] = $value;
            // }

           //////// RolePermission::insert($insert_arr);

            return response()->json(['success' => config('constants.messages.role_permisssion_success')], config('constants.validation_codes.ok'));
        // }else{
        //     return response()->json(['error' =>config('constants.messages.role_permisssion_alreday')], config('constants.validation_codes.unassigned'));
        // }
    }

}
