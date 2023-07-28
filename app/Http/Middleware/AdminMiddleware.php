<?php
namespace App\Http\middleware;

use Closure;
use \Illuminate\Support\Facades\Auth;

class AdminMiddleware 
{
        public function handle ($request,Closure $next)
        {
            if (Auth::check())
            {
                if( Auth::user()->is_role ==1 ){
                    return $next($request);
                }
                else{
                    Auth::logout();
                    return redirect(url('/'));
                }
            }
            else {
                Auth::logout();
                {
                    return redirect (url('/'));
                }
            }
        }

}

?>