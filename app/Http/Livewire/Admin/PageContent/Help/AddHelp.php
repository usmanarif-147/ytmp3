<?php

namespace App\Http\Livewire\Admin\PageContent\Help;

use App\Models\Page;
use App\Models\PageHelp;
use Livewire\Component;

class AddHelp extends Component
{

    public $pageId, $langId, $heading;

    public
        $how_to_download_content,
        $why_use_content;


    public function mount($pageId)
    {
        $this->pageId = $pageId;
        $this->langId = Page::where('id', $pageId)->first()->lang_id;
    }

    protected function rules()
    {
        return [
            'how_to_download_content'        =>        ['required'],
            'why_use_content'                =>        ['required'],
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

        PageHelp::create($data);

        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',
            'message' => 'Help content added to the page successfully!',
        ]);
    }


    public function render()
    {
        $this->heading = 'Add Help Content';
        return view('livewire.admin.page-content.help.add-help')
            ->layout('layouts.app');
    }
}
