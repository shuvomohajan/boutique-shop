<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Redirect;

class UserOtpVerificationCheck
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

      // if(is_numeric($request->get('email'))){
      //     $user = User::where('phone', $request->get('email'))->first();
      // }elseif (filter_var($request->get('email'), FILTER_VALIDATE_EMAIL)) {
      //     $user = User::where('email', $request->get('email'))->first();
      // }

      if($request->user()->hasRole('Customer') && $request->user()->otp_status == 0) {
         return redirect()->route('otp_verification');
      }

        return $next($request);
    }
}
