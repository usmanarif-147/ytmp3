<?php

namespace App\Http\Livewire\Admin\Page;

use App\Models\Language;
use App\Models\Page;
use Livewire\Component;

class EditPage extends Component
{
    public $heading, $page_id, $prev_lang_id, $languages = [];

    public
        $lang_id,
        $page_title,
        $slug,
        $status;

    public function mount($id)
    {

        $this->languages = Language::all()->pluck('name', 'id')->toArray();

        $this->page_id = $id;
        $page = Page::where('id', $id)->first();

        $this->lang_id = $page->lang_id;
        $this->prev_lang_id = $page->lang_id;
        $this->page_title = $page->page_title;
        $this->slug = $page->slug;
        $this->status = $page->status ? $page->status : 2;
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

    public function update()
    {
        $data = $this->validate();

        if ($data['status'] == 2) {
            $data['status'] = 0;
        }

        if ($this->lang_id != $this->prev_lang_id) {
            Language::where('id', $this->prev_lang_id)->update([
                'is_content_uploaded' => 0
            ]);
            Language::where('id', $this->lang_id)->update([
                'is_content_uploaded' => 1
            ]);
        }

        Page::where('id', $this->page_id)->update($data);

        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',
            'message' => 'Page updated successfully!',
        ]);
    }

    public function render()
    {
        $this->heading = "Edit";
        return view('livewire.admin.page.edit-page')
            ->layout('layouts.app');
    }
}
