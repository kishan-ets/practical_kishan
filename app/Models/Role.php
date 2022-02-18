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
}
