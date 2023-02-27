<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageMiddleware
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
        $unread_message=Message::where('user_id',Auth::user()->id)->where('status',0)->get();
        $unread_message_count=count($unread_message);
        $request->merge(compact('unread_message_count'));
        return $next($request);
    }
}
