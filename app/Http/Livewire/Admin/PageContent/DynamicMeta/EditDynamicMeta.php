<?php

namespace App\Http\Livewire\Admin\PageContent\DynamicMeta;

use App\Models\PageDynamicMeta;
use Livewire\Component;

class EditDynamicMeta extends Component
{
    public $pageId, $heading;

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
        $pageMeta = PageDynamicMeta::where('page_id', $pageId)->first();

        $this->meta_title = $pageMeta->meta_title;
        $this->meta_description = $pageMeta->meta_description;
        $this->item_prop_name = $pageMeta->item_prop_name;
        $this->item_prop_image = $pageMeta->item_prop_image;
        $this->item_prop_description = $pageMeta->item_prop_description;
        $this->og_type = $pageMeta->og_type;
        $this->og_title = $pageMeta->og_title;
        $this->og_image = $pageMeta->og_image;
        $this->og_description = $pageMeta->og_description;
        $this->og_locale = $pageMeta->og_locale;
        $this->og_url = $pageMeta->og_url;
        $this->canonical = $pageMeta->canonical;
        $this->robots  = $pageMeta->robots;
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

    public function update()
    {
        $data = $this->validate();

        PageDynamicMeta::where('page_id', $this->pageId)->update($data);

        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',
            'message' => 'Page Dynamic Meta Updated successfully!',
        ]);
    }

    public function render()
    {
        $this->heading = 'Edit Meta';
        return view('livewire.admin.page-content.dynamic-meta.edit-dynamic-meta')
            ->layout('layouts.app');
    }
}
