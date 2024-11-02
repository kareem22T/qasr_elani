<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Api\ApiHelpersController;
use Closure;
use \Illuminate\Support\Facades\Auth;
class CheckUserVerified extends ApiHelpersController
{
    public function handle($request, Closure $next)
    {
        $user = Auth::guard('users')->user();
        if ($user->verified == 2) {
            $data = array_merge($this->returnUserData($user), ['token' => $user->createToken('userLogin')->plainTextToken]);
            return response()->api(true, 'userWaitingActivation', [], $data);
        }
        return $next($request);
    }
}
