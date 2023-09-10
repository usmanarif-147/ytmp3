<?php

namespace App\Http\Livewire\Admin\FooterSection\CookiePolicy;

use App\Models\CookiesPolicy;
use App\Models\Language;
use Livewire\Component;

class EditCookiePolicy extends Component
{

    public $formSubmited = 0;

    public $cookiePolicyId, $heading, $languages = [];

    public $lang_id, $title, $description;

    public function mount($id)
    {
        $this->languages = Language::where('status', 1)
            ->pluck('name', 'id')
            ->toArray();

        $this->cookiePolicyId = $id;

        $cookiePolicy = CookiesPolicy::where('id', $id)->first();

        $this->lang_id = $cookiePolicy->lang_id;
        $this->title = $cookiePolicy->title;
        $this->description = $cookiePolicy->description;
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

        CookiesPolicy::where('id', $this->cookiePolicyId)->update($data);

        $this->formSubmited = 1;

        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',
            'message' => 'Cookie Policy Page updated successfully!',
        ]);
    }


    public function render()
    {
        $this->heading = 'Edit Cookie Policy Page';
        return view('livewire.admin.footer-section.cookie-policy.edit-cookie-policy')
            ->layout('layouts.app');
    }
}
