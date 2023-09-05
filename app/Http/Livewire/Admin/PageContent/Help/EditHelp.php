<?php

namespace App\Http\Livewire\Admin\PageContent\Help;

use App\Models\PageHelp;
use Livewire\Component;

class EditHelp extends Component
{

    public $pageId, $heading;

    public
        $left_title,
        $right_title,
        $description_left,
        $description_right;


    public function mount($pageId)
    {
        $this->pageId = $pageId;

        $pageHelp = PageHelp::where('page_id', $pageId)->first();
        $this->left_title = $pageHelp->left_title;
        $this->right_title = $pageHelp->right_title;
        $this->description_left = $pageHelp->description_left;
        $this->description_right = $pageHelp->description_right;
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
