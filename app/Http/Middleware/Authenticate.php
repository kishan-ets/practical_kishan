<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Closure;
use Exception;

class Authenticate extends Middleware
{
    protected $guards = [];

    public function handle($request, Closure $next, ...$guards)
    {
        $this->guards = $guards;

        try {

            $this->authenticate($request, $guards);            
            return parent::handle($request, $next, ...$guards);
        }

        catch (Exception $e) {            
            return \Illuminate\Support\Facades\Response::make("Authorization Token not found", config('constants.validation_codes.unauthorized'));
        }
    }
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('login');
        }
    }
}
