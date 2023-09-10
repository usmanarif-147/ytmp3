<?php

namespace App\Http\Livewire\Admin\FooterSection\PrivacyPolicy;

use App\Models\Language;
use App\Models\PrivacyPolicy;
use Livewire\Component;

class EditPrivacyPolicy extends Component
{

    public $formSubmited = 0;

    public $privacyPolicyId, $heading, $languages = [];

    public $lang_id, $title, $description;

    public function mount($id)
    {
        $this->languages = Language::where('status', 1)
            ->pluck('name', 'id')
            ->toArray();

        $this->privacyPolicyId = $id;

        $privacyPolicy = PrivacyPolicy::where('id', $id)->first();

        $this->lang_id = $privacyPolicy->lang_id;
        $this->title = $privacyPolicy->title;
        $this->description = $privacyPolicy->description;
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

        PrivacyPolicy::where('id', $this->privacyPolicyId)->update($data);

        $this->formSubmited = 1;

        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',
            'message' => 'Privacy Policy Page updated successfully!',
        ]);
    }


    public function render()
    {
        $this->heading = 'Edit Privacy Policy Page';
        return view('livewire.admin.footer-section.privacy-policy.edit-privacy-policy')
            ->layout('layouts.app');
    }
}
