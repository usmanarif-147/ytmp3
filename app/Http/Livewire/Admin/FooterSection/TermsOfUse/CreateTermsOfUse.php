<?php

namespace App\Http\Livewire\Admin\FooterSection\TermsOfUse;

use App\Http\Livewire\Footer\TermOfUse;
use App\Models\Language;
use App\Models\TermsOfUse;
use Livewire\Component;

class CreateTermsOfUse extends Component
{

    public $formSubmited = 0;

    public $heading, $languages = [];

    public
        $lang_id,
        $title,
        $description;

    public function mount()
    {

        $usedLanguages = TermsOfUse::select('terms_of_uses.lang_id')->get()->toArray();

        $this->languages = Language::whereNotIn('id', $usedLanguages)
            ->pluck('name', 'id')
            ->toArray();

        // dd($this->languages);
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

    public function store()
    {
        $data = $this->validate();

        TermsOfUse::create($data);

        $this->formSubmited = 1;

        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',
            'message' => 'Term of Use Page created successfully!',
        ]);
    }


    public function render()
    {
        $this->heading = 'Create Term Of Use Page';
        return view('livewire.admin.footer-section.terms-of-use.create-terms-of-use')
            ->layout('layouts.app');
    }
}
