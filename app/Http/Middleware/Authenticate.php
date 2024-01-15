<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        // dd($guards); 
        
        if (!$request->expectsJson()) {
            if (in_array('auth:admin', $request->route()->middleware())) {
                return route('admin.login')->with('error', 'aaa needed');;
            }
            
            // if (in_array('auth:web', $request->route()->middleware())) {
            //     return route('user.login')->with('error', 'login needed');;
            // }
        } else {
            abort(
                response()->json(
                    [
                        'status' => false,
                        'data' => 'Unauthenticated',
                    ],
                    200
                )
            );
        }
    }
}
