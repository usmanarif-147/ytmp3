<?php

namespace App\Http\Middleware;

use App\Models\Language;
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
        $page = Page::where('default', 1)->first();
        $slug = $page->slug;
        session()->put('lang', Language::where('id', $page->lang_id)->first()->lang);
        if (!request()->segment(1)) {
            return redirect('/' . $slug, 301);
        }


        $page = Page::where('slug', request()->segment(1))
            ->where('status', 1)
            ->first();
        session()->put('lang', Language::where('id', $page->lang_id)->first()->lang);
        if (!$page) {
            return redirect('/' . $slug, 301);
        }

        return $next($request);
    }
}
