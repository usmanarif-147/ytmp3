<?php

namespace App\Http\Livewire\Admin\PageContent\StaticMeta;

use App\Models\Page;
use App\Models\PageStaticMeta;
use Livewire\Component;
use Livewire\WithFileUploads;

class AddStaticMeta extends Component
{

    use WithFileUploads;

    public $pageId, $langId, $heading;

    public
        $item_prop_image,
        $og_image,
        $title,
        $robots,
        $item_prop_name,
        $canonical,
        $og_type,
        $og_title;

    protected function rules()
    {
        return [
            'item_prop_image'                       =>      ['required', 'mimes:jpeg,jpg,png,gif', 'max:2048'],
            'og_image'                              =>      ['required', 'mimes:jpeg,jpg,png,gif', 'max:2048'],
            'title'                                 =>      ['required'],
            'robots'                                =>      ['required'],
            'item_prop_name'                        =>      ['required'],
            'canonical'                             =>      ['required'],
            'og_type'                               =>      ['required'],
            'og_title'                              =>      ['required'],

        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function store()
    {
        $data = $this->validate();


        if ($this->item_prop_image) {
            $image = $this->item_prop_image;
            $imageName = time() . '.' . $image->extension();
            $image->storeAs('public/uploads', $imageName);
            $data['item_prop_image'] = 'uploads/' . $imageName;
        }

        if ($this->og_image) {
            $image = $this->og_image;
            $imageName = time() . '.' . $image->extension();
            $image->storeAs('public/uploads', $imageName);
            $data['og_image'] = 'uploads/' . $imageName;
        }

        PageStaticMeta::create($data);

        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',
            'message' => 'Page Static meta added successfully!',
        ]);
    }


    public function render()
    {
        $this->heading = 'Add Meta';
        return view('livewire.admin.page-content.static-meta.add-static-meta')
            ->layout('layouts.app');
    }
}
