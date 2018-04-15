<?php

namespace App\Http\Middleware;

use Closure;
use App\Member;

class AuthToken
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
      if(null !== $request->header('Authorization')){
        if(Member::where('token',$request->header('Authorization'))->exists()) {
            $request->userId = Member::where('token',$request->header('Authorization'))->first()->id;
            return $next($request);
        } else {
          return response()->json($request->header('Authorization'), 403);
        }
      }
      else {
        return response()->json('No token',403);
      }
    }
}
