<?php

namespace App\Http\Livewire\Admin\PageContent\StaticMeta;

use App\Models\PageStaticMeta;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditStaticMeta extends Component
{
    use WithFileUploads;

    public $page_static_meta_id, $item_prop_image_preview = null, $og_image_preview = null;

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
            'item_prop_image'                       =>      ['nullable', 'mimes:jpeg,jpg,png,gif', 'max:2048'],
            'og_image'                              =>      ['nullable', 'mimes:jpeg,jpg,png,gif', 'max:2048'],
            'title'                                 =>      ['required'],
            'robots'                                =>      ['required'],
            'item_prop_name'                        =>      ['required'],
            'canonical'                             =>      ['required'],
            'og_type'                               =>      ['required'],
            'og_title'                              =>      ['required'],

        ];
    }

    public function mount()
    {
        $pageStaticMeta = PageStaticMeta::first();

        $this->page_static_meta_id = $pageStaticMeta->id;
        $this->item_prop_image_preview = $pageStaticMeta->item_prop_image;
        $this->og_image_preview = $pageStaticMeta->og_image;
        $this->title = $pageStaticMeta->title;
        $this->robots = $pageStaticMeta->robots;
        $this->item_prop_name = $pageStaticMeta->item_prop_name;
        $this->canonical = $pageStaticMeta->canonical;
        $this->og_type = $pageStaticMeta->og_type;
        $this->og_title = $pageStaticMeta->og_title;
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function update()
    {
        $data = $this->validate();

        if (!$data['item_prop_image']) {
            $data['item_prop_image'] = $this->item_prop_image_preview;
        } else {
            $prop_image = $data['item_prop_image'];
            $prop_image_name = time() . '.' . $prop_image->extension();
            $prop_image->storeAs('public/uploads', $prop_image_name);
            $data['item_prop_image'] = 'uploads/' . $prop_image_name;
            if ($this->item_prop_image_preview) {
                if (Storage::exists('public/' . $this->item_prop_image_preview)) {
                    Storage::delete('public/' . $this->item_prop_image_preview);
                }
            }
        }

        if (!$data['og_image']) {
            $data['og_image'] = $this->og_image_preview;
        } else {
            $og_image = $data['og_image'];
            $og_image_name = time() . '.' . $og_image->extension();
            $og_image->storeAs('public/uploads', $og_image_name);
            $data['og_image'] = 'uploads/' . $og_image_name;
            if ($this->og_image_preview) {
                if (Storage::exists('public/' . $this->og_image_preview)) {
                    Storage::delete('public/' . $this->og_image_preview);
                }
            }
        }

        PageStaticMeta::where('id', $this->page_static_meta_id)->update($data);
        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',
            'message' => 'Page static meta updated successfully!',
        ]);
    }

    public function render()
    {
        $this->heading = 'Edit Meta';
        return view('livewire.admin.page-content.static-meta.edit-static-meta')
            ->layout('layouts.app');
    }
}
