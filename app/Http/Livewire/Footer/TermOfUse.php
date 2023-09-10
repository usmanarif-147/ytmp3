<?php

namespace App\Http\Livewire\Footer;

use App\Models\Language;
use App\Models\TermsOfUse;
use Illuminate\Support\Facades\Lang;
use Livewire\Component;

class TermOfUse extends Component
{

    public $lang_id, $langs, $termOfUseContent;

    public function mount($lang)
    {
        $this->lang_id = Language::where('lang', $lang)->first()->id;
    }

    public function getPageData()
    {
        return Language::select('languages.name as lang_name')
            ->where('lang', $this->lang);
    }

    public function render()
    {

        $this->termOfUseContent = TermsOfUse::where('lang_id', $this->lang_id)->first();

        return view('livewire.footer.term-of-use')
            ->layout('layouts.footer-page');
    }
}
