<?php

namespace App\Http\Livewire\Admin\FooterSection\CopyrightAct;

use App\Models\CopyrightAct;
use App\Models\Language;
use Livewire\Component;

class CreateCopyrighAct extends Component
{

    public $formSubmited = 0;

    public $heading, $languages = [];

    public
        $lang_id,
        $title,
        $description;

    public function mount()
    {
        $usedLanguages = CopyrightAct::select('copyright_acts.lang_id')->get()->toArray();

        $this->languages = Language::whereNotIn('id', $usedLanguages)
            ->pluck('name', 'id')
            ->toArray();
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

        CopyrightAct::create($data);

        $this->formSubmited = 1;

        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',
            'message' => 'Copyright Act Page created successfully!',
        ]);
    }


    public function render()
    {
        $this->heading = 'Create Copyright Act Page';
        return view('livewire.admin.footer-section.copyright-act.create-copyrigh-act')
            ->layout('layouts.app');
    }
}
