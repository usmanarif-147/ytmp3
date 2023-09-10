<?php

namespace App\Http\Livewire\Admin\FooterSection\PrivacyPolicy;

use App\Models\Language;
use App\Models\PrivacyPolicy;
use Livewire\Component;

class CreatePrivacyPolicy extends Component
{

    public $formSubmited = 0;

    public $heading, $languages = [];

    public
        $lang_id,
        $title,
        $description;

    public function mount()
    {

        $usedLanguages = PrivacyPolicy::select('privacy_policies.lang_id')->get()->toArray();

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

        PrivacyPolicy::create($data);

        $this->formSubmited = 1;

        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',
            'message' => 'Privacy Policy Page created successfully!',
        ]);
    }

    public function render()
    {
        $this->heading = 'Create Privacy Policy Page';
        return view('livewire.admin.footer-section.privacy-policy.create-privacy-policy')
            ->layout('layouts.app');
    }
}
