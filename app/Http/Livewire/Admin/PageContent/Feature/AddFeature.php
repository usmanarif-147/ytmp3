<?php

namespace App\Http\Livewire\Admin\PageContent\Feature;

use App\Models\Page;
use App\Models\PageFeature;
use Livewire\Component;
use Livewire\WithFileUploads;

class AddFeature extends Component
{
    use WithFileUploads;
    public $pageId, $langId, $heading;

    public
        $feature_title,
        $feature_image,
        $feature_description;


    public function mount($pageId)
    {
        $this->pageId = $pageId;
        $this->langId = Page::where('id', $pageId)->first()->lang_id;
    }

    protected function rules()
    {
        return [
            'feature_title'             =>        ['required'],
            'feature_image'             =>        ['required', 'mimes:jpeg,jpg,png', 'max:2048'],
            'feature_description'       =>        ['required'],
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function store()
    {
        $data = $this->validate();

        if ($this->feature_image) {
            $image = $this->feature_image;
            $imageName = time() . '.' . $image->extension();
            $image->storeAs('public/uploads', $imageName);
            $data['feature_image'] = 'uploads/' . $imageName;
        }

        $data['page_id'] = $this->pageId;
        $data['lang_id'] = $this->langId;

        PageFeature::create($data);

        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',
            'message' => 'Page Featured added successfully!',
        ]);
    }


    public function render()
    {
        $this->heading = 'Add Feature Content';
        return view('livewire.admin.page-content.feature.add-feature')
            ->layout('layouts.app');
    }
}
