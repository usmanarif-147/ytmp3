<?php

namespace App\Http\Livewire\Admin\PageContent\Help;

use App\Models\PageHelp;
use Livewire\Component;

class EditHelp extends Component
{

    public $pageId, $heading;

    public
        $how_to_download_content,
        $why_use_content;


    public function mount($pageId)
    {
        $this->pageId = $pageId;

        $pageHelp = PageHelp::where('page_id', $pageId)->first();
        $this->how_to_download_content = $pageHelp->how_to_download_content;
        $this->why_use_content = $pageHelp->why_use_content;
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

    public function update()
    {
        $data = $this->validate();

        PageHelp::where('page_id', $this->pageId)->update($data);

        // Page::create($data);

        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',
            'message' => 'Help content updated successfully!',
        ]);
    }

    public function render()
    {
        $this->heading = 'Edit Meta';
        return view('livewire.admin.page-content.help.edit-help')
            ->layout('layouts.app');
    }
}
