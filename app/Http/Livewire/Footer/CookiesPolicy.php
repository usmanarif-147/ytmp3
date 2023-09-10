<?php

namespace App\Http\Livewire\Footer;

use Livewire\Component;

class CookiesPolicy extends Component
{
    public $lang;

    public function mount($lang)
    {
        $this->lang = $lang;
    }

    public function render()
    {
        return view('livewire.footer.cookies-policy')
            ->layout('layouts.footer-page');
    }
}
