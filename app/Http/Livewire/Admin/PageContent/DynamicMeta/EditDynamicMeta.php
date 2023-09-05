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
        $meta_description,
        $item_prop_description,
        $og_description;


    public function mount($pageId)
    {
        $this->pageId = $pageId;
        $pageMeta = PageDynamicMeta::where('page_id', $pageId)->first();

        $this->meta_description = $pageMeta->meta_description;
        $this->item_prop_description = $pageMeta->item_prop_description;
        $this->og_description = $pageMeta->og_description;
    }

    protected function rules()
    {
        return [
            'meta_description'             =>      ['required'],
            'item_prop_description'        =>      ['required'],
            'og_description'               =>      ['required'],
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
