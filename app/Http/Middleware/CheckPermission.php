<?php

namespace App\Http\Middleware;

use Closure;
use Str;
use Illuminate\Http\Request;
use App\Models\RolePermission;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $role_id  = \Auth::user()->role_id;
        $actionName = class_basename($request->route()->getActionname());
        $actionName = explode("@",$actionName);
        
        if(Str::contains($actionName[0],'APIController'))
            $module = Str::lower(str_replace("APIController","",$actionName[0]));
        else
            $module = Str::lower(str_replace("sAPIController","",$actionName[0]));

        $action = $actionName[1];
        $permission = $action.'-'.$module;
        $excluded_permissions = [
        ];


        $get_role = RolePermission::with('permission')->where('role_id',$role_id)->get()->toArray();

        $permission_data = array_column($get_role, 'permission');

        $permission_arr = array_column($permission_data, 'name');


        if($request->path() == 'api/v1/batch_request' || $request->path() == 'api/v1/auth_batch_request')
            return $next($request);

        if(in_array($permission,$excluded_permissions))
            return $next($request);
        if(in_array($permission,$permission_arr))
            return $next($request);
        else if($request->user()->tokenCan($permission))
            return $next($request);
        else
            return \Illuminate\Support\Facades\Response::make(config('constants.permission.user_has_not_permission'), config('constants.validation_codes.forbidden'));
    }
}
