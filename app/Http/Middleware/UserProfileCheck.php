<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\Profile;

class UserProfileCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $profile = Profile::where('user_id', '=', Auth::id())->first();

        if (!$profile) {
            return redirect()->route('frontend.profile.get');
        }

        return $next($request);
    }
}
