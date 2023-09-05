<?php

namespace App\Http\Livewire\Admin\PageContent\Feature;

use App\Models\PageFeature;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditFeature extends Component
{

    use WithFileUploads;
    public $pageId, $heading, $feature_image_preview;

    public
        $feature_title,
        $feature_image,
        $feature_description;


    public function mount($pageId)
    {
        $this->pageId = $pageId;

        $pageFeature = PageFeature::where('page_id', $pageId)->first();
        $this->feature_title = $pageFeature->feature_title;
        $this->feature_image_preview = $pageFeature->feature_image;
        $this->feature_description = $pageFeature->feature_description;

        // dd($pageFeature->toArray());
    }

    protected function rules()
    {
        return [
            'feature_title'             =>        ['required'],
            'feature_image'             =>        ['nullable', 'mimes:jpeg,jpg,png', 'max:2048'],
            'feature_description'       =>        ['required'],
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function update()
    {
        $data = $this->validate();


        if (!$data['feature_image']) {
            $data['feature_image'] = $this->feature_image_preview;
        } else {
            $image = $data['feature_image'];
            $imageName = time() . '.' . $image->extension();
            $image->storeAs('public/uploads', $imageName);
            $data['feature_image'] = 'uploads/' . $imageName;
            if ($this->feature_image_preview) {
                if (Storage::exists('public/' . $this->feature_image_preview)) {
                    Storage::delete('public/' . $this->feature_image_preview);
                }
            }
        }

        PageFeature::where('page_id', $this->pageId)->update($data);

        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',
            'message' => 'Page feature updated successfully!',
        ]);
    }


    public function render()
    {
        $this->heading = 'Edit Feature Content';
        return view('livewire.admin.page-content.feature.edit-feature')
            ->layout('layouts.app');
    }
}
