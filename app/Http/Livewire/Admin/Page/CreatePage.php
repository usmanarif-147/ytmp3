<?php

namespace App\Http\Livewire\Admin\Page;

use App\Models\Language;
use App\Models\Page;
use Livewire\Component;

class CreatePage extends Component
{

    public $heading, $languages = [];

    public
        $lang_id,
        $page_title,
        $slug,
        $status;


    public function mount()
    {
        $this->languages = Language::where('is_content_uploaded', 0)->pluck('name', 'id')->toArray();
    }

    protected function rules()
    {
        return [
            'lang_id'        =>        ['required', 'not_in:0'],
            'page_title'     =>        ['required'],
            'slug'           =>        ['required'],
            'status'         =>        ['required', 'not_in:0'],
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function store()
    {
        $data = $this->validate();

        if ($data['status'] == 2) {
            $data['status'] = 0;
        }

        Language::where('id', $this->lang_id)->update([
            'is_content_uploaded' => 1
        ]);

        Page::create($data);

        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',
            'message' => 'Page created successfully!',
        ]);
    }

    public function render()
    {
        $this->heading = 'Create';
        return view('livewire.admin.page.create-page')
            ->layout('layouts.app');
    }
}
