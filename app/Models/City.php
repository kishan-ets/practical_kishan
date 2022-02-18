<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Scopes;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model
{
    use HasFactory, Scopes, SoftDeletes;

    protected $fillable = [
        'id', 'name','state_id'
    ];

    public $sortable=[
        'id','name'
    ];

    public $foreign_sortable = [
        'state_id'
    ];

    public $foreign_table = [
        'states'
    ];

    public $foreign_key = [
        'name'
    ];

    public $foreign_method = [
        'state'
    ];

    public function state() {
        return $this->belongsTo(State::class);
    }

    public function scopeDeleteAll($query,$request){
        if(!empty($request->id)) {
            City::whereIn('id', $request->id)->delete();

            return response()->json(['success' => config('constants.messages.delete_success')], config('constants.validation_codes.ok'));
        }
        else{
            return response()->json(['error' =>config('constants.messages.delete_multiple_error')], config('constants.validation_codes.unprocessable_entity'));
        }
    }
}
