<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Scopes;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permission extends Model
{
    use HasFactory, Scopes, SoftDeletes;

    protected $fillable = [
        'name',
    ];

    public function scopeAddPermission($query,$request){
        $data = $request->all();
        $user = Permission::create($data);

        return response()->json(['success' => config('constants.messages.permisssion_success')], config('constants.validation_codes.ok'));
    }

    public function scopeDeleteAll($query,$request){
        if(!empty($request->id)) {
            Permission::whereIn('id', $request->id)->delete();

            return response()->json(['success' => config('constants.messages.delete_success')], config('constants.validation_codes.ok'));
        }
        else{
            return response()->json(['error' =>config('constants.messages.delete_multiple_error')], config('constants.validation_codes.unprocessable_entity'));
        }
    }
}
