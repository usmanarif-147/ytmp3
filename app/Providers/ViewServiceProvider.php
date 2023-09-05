<?php

namespace App\Providers;

use App\Models\Page;
use App\Models\PageStaticMeta;
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
        $pageStaticMeta = PageStaticMeta::first();
        $page = Page::select(
            'page_dynamic_metas.meta_description',
            'page_dynamic_metas.item_prop_description',
            'page_dynamic_metas.og_description',
            'languages.lang',
            'pages.page_title'
        )
            ->join('page_dynamic_metas', 'page_dynamic_metas.page_id', 'pages.id')
            ->join('languages', 'languages.id', 'pages.lang_id')
            ->where('pages.slug', $slug)
            ->first();

        $metaArr = [
            'lang' => $page->lang,
            'page_title' => $page->page_title,
            'title' => $pageStaticMeta->title,
            'robots' => $pageStaticMeta->robots,
            'canonical' => $pageStaticMeta->canonical,
            'item_prop_name' => $pageStaticMeta->item_prop_name,
            'item_prop_image' => $pageStaticMeta->item_prop_image,
            'og_type' => $pageStaticMeta->og_type,
            'og_title' => $pageStaticMeta->og_title,
            'og_image' => $pageStaticMeta->og_image,
            'meta_description' => $page->meta_description,
            'item_prop_description' => $page->item_prop_description,
            'og_description' => $page->og_description,
        ];

        return $metaArr;
    }
}
