<?php

namespace App\Http\Livewire\Admin\Language;

use App\Models\Language;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{

    use WithFileUploads;

    public $heading;

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
            'flag'           =>        ['required', 'mimes:jpeg,jpg,png,gif', 'max:2048'],
            'status'         =>        ['required', 'not_in:0'],
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function store()
    {
        $data = $this->validate();

        if ($this->flag) {
            $image = $this->flag;
            $imageName = time() . '.' . $image->extension();
            $image->storeAs('public/uploads', $imageName);
            $data['flag'] = 'uploads/' . $imageName;
        }

        if ($data['status'] == 2) {
            $data['status'] = 0;
        }

        Language::create($data);

        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',
            'message' => 'New Language created successfully!',
        ]);
    }

    public function render()
    {
        $this->heading = 'Create';
        return view('livewire.admin.language.create')
            ->layout('layouts.app');
    }
}
