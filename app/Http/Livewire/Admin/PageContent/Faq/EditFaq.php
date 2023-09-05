<?php

namespace App\Http\Livewire\Admin\PageContent\Faq;

use App\Models\Page;
use App\Models\PageFaq;
use Livewire\Component;

class EditFaq extends Component
{

    public $pageId, $langId, $heading;

    public
        $questions = [],
        $answers = [];


    public function mount($pageId)
    {
        $this->pageId = $pageId;
        $this->langId = Page::where('id', $pageId)->first()->lang_id;

        $pageFaq = PageFaq::select('id', 'page_id', 'question', 'answer')->where('page_id', $pageId)->get()->toArray();
        foreach ($pageFaq as $faq) {
            array_push($this->questions, $faq['question']);
            array_push($this->answers, $faq['answer']);
        }
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

    public function update()
    {
        $data = $this->validate();

        $pageFaq = PageFaq::select('id', 'page_id', 'question', 'answer')->where('page_id', $this->pageId)->delete();

        // dd($pageFaq = PageFaq::select('id', 'page_id', 'question', 'answer')->where('page_id', $this->pageId)->get()->toArray());
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
            'message' => 'Page Faq Updated successfully!',
        ]);
    }


    public function render()
    {
        $this->heading = 'Edit Faq';
        return view('livewire.admin.page-content.faq.edit-faq')
            ->layout('layouts.app');
    }
}
