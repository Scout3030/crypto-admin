<?php

namespace App\Http\Middleware;

use App\Helpers\Services\SegmentService;
use Auth;
use Closure;
use Illuminate\Http\Request;

class Segment
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        app(SegmentService::class)->init(Auth::user());
        return $next($request);
    }
}
