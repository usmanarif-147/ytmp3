<?php

namespace App\Http\Livewire\Admin\PageContent\Meta;

use App\Models\Page;
use App\Models\PageMeta;
use Livewire\Component;

class AddMeta extends Component
{

    public $pageId, $langId, $heading;

    public
        $meta_title,
        $meta_description;


    public function mount($pageId)
    {
        $this->pageId = $pageId;
        $this->langId = Page::where('id', $pageId)->first()->lang_id;
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

    public function store()
    {
        $data = $this->validate();

        $data['page_id'] = $this->pageId;
        $data['lang_id'] = $this->langId;

        PageMeta::create($data);

        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',
            'message' => 'Page meta added successfully!',
        ]);
    }


    public function render()
    {
        $this->heading = 'Add Meta';
        return view('livewire.admin.page-content.meta.add-meta')
            ->layout('layouts.app');
    }
}
