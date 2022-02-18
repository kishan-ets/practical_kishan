<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use App\Traits\Scopes;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\UserGallery;

class User extends Authenticatable
{
    use HasApiTokens, Scopes, HasFactory, SoftDeletes, Notifiable;


    public function scopeCommonFunctionMethod($query, $model, $request, $preQuery = null, $tablename = null, $groupBy = null, $export_select = false, $no_paginate = false)
    {
        return $this->getCommonFunctionMethod($model, $request, $preQuery, $tablename , $groupBy , $export_select , $no_paginate);
    }

    public static function getCommonFunctionMethod($model, $request, $preQuery = null, $tablename = null, $groupBy = null, $export_select = false, $no_paginate = false)
    {
        if (is_null($preQuery)) {
            $mainQuery = $model::withSearch($request->get('search'), $export_select);
        } else {
            $mainQuery = $model->withSearch($request->get('search'), $export_select);
        }
        if($request->filled('filter') != '')
            $mainQuery = $mainQuery->withFilter($request->get('filter'));
        if(!is_null($groupBy))
            $mainQuery = $mainQuery->groupBy($groupBy);
        if ( $no_paginate ){
            return $mainQuery->withOrderBy($request->get('sort'), $request->get('order_by'), $tablename, $export_select);
        }else{
            return $mainQuery->withOrderBy($request->get('sort'), $request->get('order_by'), $tablename, $export_select)
                ->withPerPage($request->get('per_page'));
        }
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'mobile_no',
        'gender',
        'dob',
        'address',
        'country_id',
        'state_id',
        'city_id',
        'role_id',

    ];

    public $sortable=[
         'name', 'email', 'gender', 'mobile_no', 'dob', 'address',
    ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class)->with('permission');
    }

    

    public function documents()
    {
        return $this->hasMany(UserGallery::class);
    }

    public function scopeRegister($query,$request){
        $data = $request->all();
        $data['password'] = bcrypt($data['password']);
        $user = User::create($data);

        if($request->hasfile('documents')) {
            foreach ($request->documents as $image) {
                $path = User::uploadOne($image, '/public/user/documents/' . $user->id);
                UserGallery::create(['user_id' => $user->id, 'filename' => $path]);
            }
        }

        return response()->json(['success' => config('constants.messages.registration_success')], config('constants.validation_codes.ok'));
    }

    public function scopeDeleteAll($query,$request){
        if(!empty($request->id)) {
            User::whereIn('id', $request->id)->delete();

            return response()->json(['success' => config('constants.messages.delete_success')], config('constants.validation_codes.ok'));
        }
        else{
            return response()->json(['error' =>config('constants.messages.delete_multiple_error')], config('constants.validation_codes.unprocessable_entity'));
        }
    }
}
