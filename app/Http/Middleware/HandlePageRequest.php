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

        // dd($request->all());
        if (!request()->segment(1)) {
            // $this->getMeta('sp11');
            return redirect('/sp11');
        }
        $page = Page::where('slug', request()->segment(1))->where('status', 1)->first();
        if (!$page) {
            // $this->getMeta('sp11');
            return redirect('/sp11');
        }
        // if ($page) {
        //     $this->getMeta($page->slug);
        // }

        return $next($request);
    }

    // private function getMeta($slug)
    // {
    //     $page = Page::select(
    //         'page_metas.meta_title',
    //         'page_metas.meta_description',
    //     )
    //         ->join('page_metas', 'page_metas.page_id', 'pages.id')
    //         ->where('pages.slug', $slug)
    //         ->first();

    //     if ($page) {
    //         if (!session()->has('meta_title')) {
    //             session()->put('meta_title', $page->meta_title);
    //         }
    //         if (!session()->has('meta_description')) {
    //             session()->put('meta_description', $page->meta_description);
    //         }
    //     }
    // }


    private function getMeta($slug)
    {
        $page = Page::select(
            'page_metas.meta_title',
            'page_metas.meta_description',
        )
            ->join('page_metas', 'page_metas.page_id', 'pages.id')
            ->where('pages.slug', $slug)
            ->first();

        if (session()->has('meta_title')) {
            session()->put('meta_title', $page->meta_title);
            session()->put('meta_description', $page->meta_description);
            // dd(session()->all());
        } else {
            session()->put('meta_title', $page->meta_title);
            session()->put('meta_description', $page->meta_description);
        }
    }
}
