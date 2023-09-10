<?php

namespace App\Http\Livewire\Admin\FooterSection\LegalDisclaimer;

use App\Models\Language;
use App\Models\LeagalDisclaimer;
use Livewire\Component;

class CreateLegalDisclaimer extends Component
{

    public $formSubmited = 0;

    public $heading, $languages = [];

    public
        $lang_id,
        $title,
        $description;

    public function mount()
    {

        $usedLanguages = LeagalDisclaimer::select('leagal_disclaimers.lang_id')->get()->toArray();

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

        LeagalDisclaimer::create($data);

        $this->formSubmited = 1;

        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',
            'message' => 'Leagle Disclaimer Page created successfully!',
        ]);
    }

    public function render()
    {
        $this->heading = 'Create Leagle Disclaimer Page';
        return view('livewire.admin.footer-section.legal-disclaimer.create-legal-disclaimer')
            ->layout('layouts.app');
    }
}
