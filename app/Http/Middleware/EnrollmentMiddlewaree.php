<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnrollmentMiddlewaree
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
        $admin_enrollment_status=User::where('id',1)->first()->enrollments_status;
        $user_enrollment_status=User::where('id',Auth::user()->id)->first()->enrollments_status;
        $request->merge(compact('admin_enrollment_status','user_enrollment_status'));
        return $next($request);

    }
}
