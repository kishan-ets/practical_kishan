<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Permission;

class Permission extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function scopeAddPermission($query,$request){
        $data = $request->all();
        $user = Permission::create($data);

        return response()->json(['success' => config('constants.messages.permisssion_success')], config('constants.validation_codes.ok'));
    }
}
