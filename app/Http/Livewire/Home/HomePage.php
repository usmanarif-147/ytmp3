<?php

namespace App\Http\Livewire\Home;

use App\Models\Language;
use App\Models\Page;
use App\Models\PageFaq;
use App\Models\PageFeature;
use Livewire\Component;

class HomePage extends Component
{

    public $slug;

    public $page_content, $langs = [], $page_faqs = [];

    public function mount($slug)
    {

        $this->slug = $slug;

        $this->langs = Language::select(
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


    /**
     * Get Languages
     */
    public function getPageData()
    {
        // $page_id = Page::where('slug', $this->slug)->first()->id;
        // dd($page_id);

        // $feature = PageFeature::where('page_id', $page_id)->get()->toArray();
        // dd($feature);

        $pageData = Page::select(
            'pages.id',
            'pages.page_title',
            'pages.slug as page_slug',
            'page_features.feature_title',
            'page_features.feature_image',
            'page_features.feature_description',
            'page_helps.left_title',
            'page_helps.right_title',
            'page_helps.description_left',
            'page_helps.description_right',
            'page_dynamic_metas.meta_description',
            'languages.id as lang_id',
            'languages.name as lang_name',
            'languages.lang as lang',
            'languages.flag as lang_flag',
        )
            ->leftJoin('languages', 'pages.lang_id', 'languages.id')
            ->leftJoin('page_features', 'page_features.page_id', 'pages.id')
            ->leftJoin('page_helps', 'page_helps.page_id', 'pages.id')
            ->leftJoin('page_dynamic_metas', 'page_dynamic_metas.page_id', 'pages.id')
            ->where('pages.slug', $this->slug);


        return $pageData;
    }

    public function render()
    {

        $this->page_content = $this->getPageData()->first()->toArray();

        // dd($this->page_content['description_right']);

        $faqs = PageFaq::select('question', 'answer')->where('page_id', $this->page_content['id'])->get()->toArray();

        $this->page_faqs = ['page_faqs' => $faqs];

        return view('livewire.home.home')
            ->layout('layouts.home');
    }
}
