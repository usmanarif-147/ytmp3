<?php

namespace App\Http\Livewire\Admin\FooterSection\LegalDisclaimer;

use App\Models\Language;
use App\Models\LeagalDisclaimer;
use Livewire\Component;

class EditLegalDisclaimer extends Component
{

    public $formSubmited = 0;

    public $leagleDisclaimerId, $heading, $languages = [];

    public $lang_id, $title, $description;

    public function mount($id)
    {
        $this->languages = Language::where('status', 1)
            ->pluck('name', 'id')
            ->toArray();

        $this->leagleDisclaimerId = $id;

        $leagleDisclaimer = LeagalDisclaimer::where('id', $id)->first();

        $this->lang_id = $leagleDisclaimer->lang_id;
        $this->title = $leagleDisclaimer->title;
        $this->description = $leagleDisclaimer->description;
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

        LeagalDisclaimer::where('id', $this->leagleDisclaimerId)->update($data);

        $this->formSubmited = 1;

        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',
            'message' => 'Leagle Disclaimer Page updated successfully!',
        ]);
    }


    public function render()
    {
        $this->heading = 'Edit Leagle Disclaimer Page';
        return view('livewire.admin.footer-section.legal-disclaimer.edit-legal-disclaimer')
            ->layout('layouts.app');
    }
}
