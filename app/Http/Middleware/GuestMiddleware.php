<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\firstpayment;
class GuestMiddleware
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
        if(Auth::check()){
            if(Auth::user()->role_as =='2')
            {
                return $next($request);
            }
            
            else{
                return redirect('/home')->with('status','مبروك تم تفعيل الحساب بنجاح وتم إضافة المبلغ لحسابك مع إهداء 10 من النقاط الخاصة بالموقع');
            }
        }
    }
}
