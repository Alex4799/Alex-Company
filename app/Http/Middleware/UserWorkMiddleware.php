<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Work;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserWorkMiddleware
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
        $notDoneWorks=Work::where('user_id',Auth::user()->id)->where('status',0)->get();
        $notDoneWorks_count=count($notDoneWorks);
        $request->merge(compact('notDoneWorks_count'));
        return $next($request);

    }
}
