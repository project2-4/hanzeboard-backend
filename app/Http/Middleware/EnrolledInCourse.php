<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnrolledInCourse
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $course = $request->route('course');

        // No course specified, nothing to check
        if (is_null($course)) {
            return $next($request);
        }

        if (Auth::user()->courses()->where('id', $course->id)->count() !== 1) {
            abort(403, 'No access to this course');
        }

        return $next($request);
    }
}
