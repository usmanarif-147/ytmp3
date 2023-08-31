<?php

namespace App\Providers;

use App\Models\Page;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('layouts.home', function ($view) {


            // dd($request->all());
            if (!request()->segment(1)) {
                $data = $this->getMeta('sp11');
            }
            $page = Page::where('slug', request()->segment(1))->where('status', 1)->first();
            if (!$page) {
                $data = $this->getMeta('sp11');
            }
            if ($page) {
                $data = $this->getMeta($page->slug);
            }

            $view->with([
                'data' => $data,
            ]);
        });
    }

    private function getMeta($slug)
    {
        $page = Page::select(
            'page_metas.meta_title',
            'page_metas.meta_description',
        )
            ->join('page_metas', 'page_metas.page_id', 'pages.id')
            ->where('pages.slug', $slug)
            ->first();

        $metaArr = [
            'meta_title' => $page->meta_title,
            'meta_description' => $page->meta_description,
        ];

        return $metaArr;
    }
}
