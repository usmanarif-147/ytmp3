<?php

namespace App\Http\Livewire\Admin\FooterSection\CookiePolicy;

use App\Models\CookiesPolicy;
use App\Models\Language;
use Livewire\Component;

class CreateCookiePolicy extends Component
{

    public $formSubmited = 0;

    public $heading, $languages = [];

    public
        $lang_id,
        $title,
        $description;

    public function mount()
    {

        $usedLanguages = CookiesPolicy::select('cookies_policies.lang_id')->get()->toArray();

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

        CookiesPolicy::create($data);

        $this->formSubmited = 1;

        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',
            'message' => 'Cookie Policy Page created successfully!',
        ]);
    }


    public function render()
    {
        $this->heading = 'Create Cookie Policy Page';
        return view('livewire.admin.footer-section.cookie-policy.create-cookie-policy')
            ->layout('layouts.app');
    }
}
