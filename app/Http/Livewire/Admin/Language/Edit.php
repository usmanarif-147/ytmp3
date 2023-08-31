<?php

namespace App\Http\Livewire\Admin\Language;

use App\Models\Language;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{

    use WithFileUploads;

    public $heading, $lang_id, $flag_preview = null;

    public
        $name,
        $lang,
        $flag,
        $status;

    protected function rules()
    {

        return [
            'name'           =>        ['required'],
            'lang'           =>        ['required'],
            'flag'           =>        ['nullable', 'mimes:jpeg,jpg,png,gif', 'max:2048'],
            'status'         =>        ['required', 'not_in:0'],
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function mount($id)
    {

        $this->lang_id = $id;
        $language = Language::where('id', $id)->first();

        $this->name = $language->name;
        $this->lang = $language->lang;
        $this->flag_preview = $language->flag;
        $this->status = $language->status ? $language->status : 2;
    }

    public function deleteImage($image)
    {

        if ($image) {
            if (Storage::exists('public/' . $image)) {
                Storage::delete('public/' . $image);
            }
        }
        $this->flag_preview = null;
        Language::where('id', $this->lang_id)->update([
            'flag' => null
        ]);
    }

    public function update()
    {
        $data = $this->validate();
        // dd($data);

        if (!$data['flag']) {
            $data['flag'] = $this->flag_preview;
        } else {
            $image = $data['flag'];
            $imageName = time() . '.' . $image->extension();
            $image->storeAs('public/uploads', $imageName);
            $data['flag'] = 'uploads/' . $imageName;
            if ($this->flag_preview) {
                if (Storage::exists('public/' . $this->flag_preview)) {
                    Storage::delete('public/' . $this->flag_preview);
                }
            }
        }

        if ($data['status'] == 2) {
            $data['status'] = 0;
        }

        Language::where('id', $this->lang_id)->update($data);

        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',
            'message' => 'Language updated successfully!',
        ]);
    }

    public function render()
    {
        $this->heading = "Edit";
        return view('livewire.admin.language.edit')
            ->layout('layouts.app');
    }
}
