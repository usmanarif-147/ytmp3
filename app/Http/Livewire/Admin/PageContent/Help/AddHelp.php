<?php

namespace App\Http\Livewire\Admin\PageContent\Help;

use App\Models\Page;
use App\Models\PageHelp;
use Livewire\Component;

class AddHelp extends Component
{

    public $pageId, $langId, $heading;

    public
        $left_title,
        $right_title,
        $description_left,
        $description_right;


    public function mount($pageId)
    {
        $this->pageId = $pageId;
        $this->langId = Page::where('id', $pageId)->first()->lang_id;
    }

    protected function rules()
    {
        return [
            'left_title'                     =>        ['required'],
            'right_title'                    =>        ['required'],
            'description_left'               =>        ['required'],
            'description_right'              =>        ['required'],
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
