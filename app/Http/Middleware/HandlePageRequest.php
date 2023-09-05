<?php

namespace App\Http\Middleware;

use App\Models\Page;
use Closure;
use Illuminate\Http\Request;

class HandlePageRequest
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
        $slug = Page::where('make_default', 1)->first()->slug;
        if (!request()->segment(1)) {
            return redirect('/' . $slug);
        }
        if (request()->segment(1) == 'terms-of-use') {
            return redirect('terms-of-use');
        }
        $page = Page::where('slug', request()->segment(1))
            ->where('status', 1)
            ->first();
        if (!$page) {
            return redirect('/' . $slug);
        }

        return $next($request);
    }
}
