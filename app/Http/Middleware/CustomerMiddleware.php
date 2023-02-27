<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerMiddleware
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
        if(!empty(Auth::user())){
            if(url()->current()==route('auth#loginPage') || url()->current()==route('auth#registerPage')){
                return back();
            }

            if(Auth::user()->role !== 'customer'){
                return back()->with(['AuthMessage'=>"You don't have permission for these page"]);
                }
            $cart=Cart::where('user_id',Auth::user()->id)->get();
            $cart_count=count($cart);
            $request->merge(compact('cart_count'));
            return $next($request);
        }else{
            return $next($request);
        }
    }
}
