<?php

namespace App\Http\Livewire\Footer;

use Livewire\Component;

class LeagalDisclaimer extends Component
{

    public $lang;

    public function mount($lang)
    {
        $this->lang = $lang;
    }

    public function render()
    {
        return view('livewire.footer.leagal-disclaimer')
            ->layout('layouts.footer-page');
    }
}
