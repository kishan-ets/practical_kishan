<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RolePermission extends Model
{
    use HasFactory;

    protected $table = 'permission_role';

    protected $fillable = [
        'permission_id',
        'role_id'
    ];

    public function permission(){
        return $this->belongsTo(Permission::class);
    }

    public function scopeAddRolePermission($query,$request){
        $data = $request->all();
        
        // $check_role_permission = RolePermission::where('role_id',$request->role_id)->where('permission_id',$request->permission_id)->first();

        // if(!$check_role_permission){

            // RolePermission::insert([
            //     'permission_id' => $request->get('permission_id'),
            //     'role_id' => $request->get('role_id'),
            // ]);
            $delete_role_permission = RolePermission::where('role_id',$data['role_id'])->delete();

            $insert_arr = [];
            foreach($data['permission_id'] as $key => $value){
                $insert_arr[$key]['role_id'] = $data['role_id'];
                $insert_arr[$key]['permission_id'] = $value;
            }

            RolePermission::insert($insert_arr);

            return response()->json(['success' => config('constants.messages.role_permisssion_success')], config('constants.validation_codes.ok'));
        // }else{
        //     return response()->json(['error' =>config('constants.messages.role_permisssion_alreday')], config('constants.validation_codes.unassigned'));
        // }
    }
    
}
