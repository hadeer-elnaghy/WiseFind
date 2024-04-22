<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class CheckAuthUser
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
        if (!empty($request->login_user_id)){
            // check user id have or not
            $loginUserIdFromGet = $request->login_user_id;
            $hasUser = User::find($loginUserIdFromGet);

            if (empty($hasUser) && $loginUserIdFromGet != 'nologinuser') {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Can not find User with your login user id'
                ], 404);

            }

        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'need user id'
            ],404);
        }
        return $next($request);
    }
}
