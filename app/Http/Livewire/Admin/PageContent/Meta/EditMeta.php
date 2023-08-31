<?php

namespace App\Http\Livewire\Admin\PageContent\Meta;

use App\Models\PageMeta;
use Livewire\Component;

class EditMeta extends Component
{

    public $pageId, $heading;

    public
        $meta_title,
        $meta_description;


    public function mount($pageId)
    {
        $this->pageId = $pageId;
        $pageMeta = PageMeta::where('page_id', $pageId)->first();

        $this->meta_title = $pageMeta->meta_title;
        $this->meta_description = $pageMeta->meta_description;
    }

    protected function rules()
    {
        return [
            'meta_title'        =>        ['required'],
            'meta_description'  =>        ['required'],
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function update()
    {
        $data = $this->validate();

        PageMeta::where('page_id', $this->pageId)->update($data);

        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',
            'message' => 'Page meta updated successfully!',
        ]);
    }

    public function render()
    {
        $this->heading = 'Edit Meta';
        return view('livewire.admin.page-content.meta.edit-meta')
            ->layout('layouts.app');
    }
}
