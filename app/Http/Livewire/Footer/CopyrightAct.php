<?php

namespace App\Http\Livewire\Footer;

use Livewire\Component;

class CopyrightAct extends Component
{
    public $lang;

    public function mount($lang)
    {
        $this->lang = $lang;
    }

    public function render()
    {
        return view('livewire.footer.copyright-act')
            ->layout('layouts.footer-page');
    }
}
