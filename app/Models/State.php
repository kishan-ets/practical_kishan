<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Scopes;
use Illuminate\Database\Eloquent\SoftDeletes;

class State extends Model
{
    use HasFactory, Scopes, SoftDeletes;

    protected $fillable = [
        'id', 'name','country_id'
    ];

    public $sortable=[
        'id','name'
    ];

    public $foreign_sortable = [
        'country_id'
    ];

    public $foreign_table = [
        'countries'
    ];

    public $foreign_key = [
        'name'
    ];

    public $foreign_method = [
        'country'
    ];

    public function country() {
        return $this->belongsTo(Country::class);
    }

    public function scopeDeleteAll($query,$request){
        if(!empty($request->id)) {
            State::whereIn('id', $request->id)->delete();

            return response()->json(['success' => config('constants.messages.delete_success')], config('constants.validation_codes.ok'));
        }
        else{
            return response()->json(['error' =>config('constants.messages.delete_multiple_error')], config('constants.validation_codes.unprocessable_entity'));
        }
    }
}
