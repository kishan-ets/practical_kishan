<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Role;
use App\Models\Permission;

class Role extends Model
{
    use HasFactory;

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
}
