<?php

namespace App\Http\Livewire\Admin\PageContent\DynamicMeta;

use App\Models\Page;
use App\Models\PageDynamicMeta;
use Livewire\Component;

class AddDynamicMeta extends Component
{
    public $pageId, $langId, $heading;

    public
        $lang_id,
        $page_id,
        $meta_title,
        $meta_description,
        $item_prop_name,
        $item_prop_image,
        $item_prop_description,
        $og_type,
        $og_title,
        $og_image,
        $og_description,
        $og_locale,
        $og_url,
        $canonical,
        $robots;


    public function mount($pageId)
    {
        $this->pageId = $pageId;
        $this->langId = Page::where('id', $pageId)->first()->lang_id;
    }

    protected function rules()
    {
        return [
            'meta_title'                   =>      ['required'],
            'meta_description'             =>      ['required'],
            'item_prop_name'               =>      ['required'],
            'item_prop_image'              =>      ['required'],
            'item_prop_description'        =>      ['required'],
            'og_type'                      =>      ['required'],
            'og_title'                     =>      ['required'],
            'og_image'                     =>      ['required'],
            'og_description'               =>      ['required'],
            'og_locale'                    =>      ['required'],
            'og_url'                       =>      ['required'],
            'canonical'                    =>      ['required'],
            'robots'                       =>      ['required'],
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function store()
    {
        $data = $this->validate();

        $data['page_id'] = $this->pageId;
        $data['lang_id'] = $this->langId;

        PageDynamicMeta::create($data);

        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',
            'message' => 'Page Dynamic Meta Added Successfully!',
        ]);
    }


    public function render()
    {
        $this->heading = 'Add Dynamic Meta';
        return view('livewire.admin.page-content.dynamic-meta.add-dynamic-meta')
            ->layout('layouts.app');
    }
}
