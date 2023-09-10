<?php

namespace App\Providers;

use App\Models\Language;
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

            $page = Page::where('default', 1)->first();
            $slug = $page->slug;

            if (!request()->segment(1)) {
                $data = $this->getMeta($slug);
            }
            $page = Page::where('slug', request()->segment(1))->where('status', 1)->first();
            if (!$page) {
                $data = $this->getMeta($slug);
            }
            if ($page) {
                $data = $this->getMeta($page->slug);
            }

            $view->with([
                'data' => $data,
            ]);
        });

        view()->composer('layouts.footer-page', function ($view) {

            $lang_name = Language::where('lang', session('lang'))->first()->name;

            $page_content = ['lang_name' => $lang_name];
            $langs = $this->getLangs();

            $view->with([
                'page_content' => $page_content,
                'langs' => $langs
            ]);
        });
    }

    private function getMeta($slug)
    {
        $page = Page::select(
            'page_dynamic_metas.meta_title',
            'page_dynamic_metas.meta_description',
            'page_dynamic_metas.item_prop_name',
            'page_dynamic_metas.item_prop_image',
            'page_dynamic_metas.item_prop_description',
            'page_dynamic_metas.og_type',
            'page_dynamic_metas.og_title',
            'page_dynamic_metas.og_image',
            'page_dynamic_metas.og_description',
            'page_dynamic_metas.og_locale',
            'page_dynamic_metas.og_url',
            'page_dynamic_metas.canonical',
            'page_dynamic_metas.robots',
            'languages.lang',
            'pages.page_title'
        )
            ->join('page_dynamic_metas', 'page_dynamic_metas.page_id', 'pages.id')
            ->join('languages', 'languages.id', 'pages.lang_id')
            ->where('pages.slug', $slug)
            ->first();

        session()->put('lang', $page->lang);
        $metaArr = [
            'lang' => $page->lang,
            'page_title' => $page->page_title,

            'meta_title' => $page->meta_title,
            'meta_description' => $page->meta_description,

            'item_prop_name' => $page->item_prop_name,
            'item_prop_description' => $page->item_prop_description,
            'item_prop_image' => $page->item_prop_image,

            'og_type' => $page->og_type,
            'og_title' => $page->og_title,
            'og_image' => $page->og_image,
            'og_description' => $page->og_description,
            'og_locale' => $page->og_description,
            'og_url' => $page->og_description,

            'robots' => $page->robots,
            'canonical' => $page->canonical,
        ];

        return $metaArr;
    }

    private function getLangs()
    {
        return Language::select(
            'languages.id',
            'languages.flag',
            'languages.name',
            'languages.lang',
            'pages.slug as page_slug'
        )
            ->join('pages', 'pages.lang_id', 'languages.id')
            ->where('languages.status', 1)
            ->where('languages.is_content_uploaded', 1)
            ->get();
    }
}
