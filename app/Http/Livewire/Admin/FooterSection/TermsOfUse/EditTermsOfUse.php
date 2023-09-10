<?php

namespace App\Http\Livewire\Admin\FooterSection\TermsOfUse;

use App\Models\Language;
use App\Models\TermsOfUse;
use Livewire\Component;

class EditTermsOfUse extends Component
{

    public $formSubmited = 0;

    public $termOfUseId, $heading, $languages = [];

    public $lang_id, $title, $description;

    public function mount($id)
    {
        $this->languages = Language::where('status', 1)
            ->pluck('name', 'id')
            ->toArray();

        $this->termOfUseId = $id;

        $termOfUse = TermsOfUse::where('id', $id)->first();

        $this->lang_id = $termOfUse->lang_id;
        $this->title = $termOfUse->title;
        $this->description = $termOfUse->description;
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

        TermsOfUse::where('id', $this->termOfUseId)->update($data);

        $this->formSubmited = 1;

        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',
            'message' => 'Term of Use Page updated successfully!',
        ]);
    }


    public function render()
    {
        $this->heading = 'Edit Term Of Use Page';
        return view('livewire.admin.footer-section.terms-of-use.edit-terms-of-use')
            ->layout('layouts.app');
    }
}
