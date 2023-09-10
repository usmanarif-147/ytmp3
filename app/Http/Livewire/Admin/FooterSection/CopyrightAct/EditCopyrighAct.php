<?php

namespace App\Http\Livewire\Admin\FooterSection\CopyrightAct;

use App\Models\CopyrightAct;
use App\Models\Language;
use Livewire\Component;

class EditCopyrighAct extends Component
{

    public $formSubmited = 0;

    public $copyrightActId, $heading, $languages = [];

    public $lang_id, $title, $description;

    public function mount($id)
    {
        $this->languages = Language::where('status', 1)
            ->pluck('name', 'id')
            ->toArray();

        $this->copyrightActId = $id;

        $copyrightAct = CopyrightAct::where('id', $id)->first();

        $this->lang_id = $copyrightAct->lang_id;
        $this->title = $copyrightAct->title;
        $this->description = $copyrightAct->description;
    }

    protected function rules()
    {
        return [
            'lang_id'        =>        ['required', 'not_in:0'],
            'title'          =>        ['required'],
            'description'    =>        ['required'],
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }


    public function update()
    {
        $data = $this->validate();

        CopyrightAct::where('id', $this->copyrightActId)->update($data);

        $this->formSubmited = 1;

        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',
            'message' => 'Copyright Act Page updated successfully!',
        ]);
    }


    public function render()
    {
        $this->heading = 'Edit Copyright Act Page';
        return view('livewire.admin.footer-section.copyright-act.edit-copyrigh-act')
            ->layout('layouts.app');
    }
}
