<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Scopes;
use Illuminate\Database\Eloquent\SoftDeletes;

class Country extends Model
{
    use HasFactory, Scopes, SoftDeletes;

    protected $fillable = [
        'id', 'name', 'created_by','updated_by'
    ];

    public $sortable=[
        'id','name',
    ];

    public function scopeDeleteAll($query,$request){
        if(!empty($request->id)) {
            Country::whereIn('id', $request->id)->delete();

            return response()->json(['success' => config('constants.messages.delete_success')], config('constants.validation_codes.ok'));
        }
        else{
            return response()->json(['error' =>config('constants.messages.delete_multiple_error')], config('constants.validation_codes.unprocessable_entity'));
        }
    }
}
