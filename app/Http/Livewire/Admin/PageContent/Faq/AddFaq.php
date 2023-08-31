<?php

namespace App\Http\Livewire\Admin\PageContent\Faq;

use App\Models\Page;
use App\Models\PageFaq;
use Livewire\Component;

class AddFaq extends Component
{
    public $pageId, $langId, $heading;

    public
        $questions = [''],
        $answers = [''];


    public function mount($pageId)
    {
        $this->pageId = $pageId;
        $this->langId = Page::where('id', $pageId)->first()->lang_id;
    }

    protected function rules()
    {
        return [
            'questions.*'           =>        ['required'],
            'answers.*'             =>        ['required']
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function addNewFaq()
    {
        array_push($this->questions, '');
        array_push($this->answers, '');
    }

    public function removeFaq($index)
    {
        unset($this->questions[$index]);
        unset($this->answers[$index]);
        $this->questions = array_values($this->questions);
        $this->answers = array_values($this->answers);
    }

    public function store()
    {
        $data = $this->validate();

        foreach ($this->questions as $key => $question) {
            PageFaq::create([
                'page_id' => $this->pageId,
                'lang_id' => $this->langId,
                'question' => $question,
                'answer' => $this->answers[$key],
            ]);
        }

        // $this->resetModal();
        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',
            'message' => 'Page Faq added successfully!',
        ]);
    }

    public function render()
    {
        $this->heading = 'Add Faq';
        return view('livewire.admin.page-content.faq.add-faq')
            ->layout('layouts.app');
    }
}
