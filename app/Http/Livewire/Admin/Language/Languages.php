<?php

namespace App\Http\Livewire\Admin\Language;

use App\Models\Language;
use Livewire\Component;
use Livewire\WithPagination;

class Languages extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $lang_id, $methodType, $modalTitle, $modalBody, $modalActionBtnColor, $modalActionBtnText;

    public $searchQuery = '', $filterByStatus = '';

    public $langs, $total, $heading, $statuses = [];

    public function mount()
    {
        $this->statuses = [
            '1' => 'Active',
            '2' => 'Inactive',
        ];
    }

    /**
     * Filters
     */
    public function updatedSearchQuery()
    {
        $this->resetPage();
    }
    public function updatedFilterByStatus()
    {
        $this->resetPage();
    }


    /**
     * Activate
     */
    public function activateConfirmModal($id)
    {
        $this->lang_id = $id;
        $this->methodType = 'activate';
        $this->modalActionBtnText = 'Activate';
        $this->modalActionBtnColor = 'bg-success';
        $this->modalBody = 'You want to activate this language!';
        $this->dispatchBrowserEvent('confirm-modal');
    }
    public function activate()
    {
        $background = Language::where('id', $this->lang_id);
        $background->update([
            'status' => 1,
        ]);

        $this->methodType = '';
        $this->modalActionBtnText = '';
        $this->modalActionBtnColor = '';
        $this->modalBody = '';

        $this->dispatchBrowserEvent('close-modal');
        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',
            'message' => 'Language activated successfully',
        ]);
    }

    /**
     * Deactivate
     */
    public function deactivateConfirmModal($id)
    {
        $this->lang_id = $id;
        $this->methodType = 'deactivate';
        $this->modalActionBtnText = 'Deactivate';
        $this->modalActionBtnColor = 'bg-danger';
        $this->modalBody = 'You want to deactivate language!';
        $this->dispatchBrowserEvent('confirm-modal');
    }
    public function deactivate()
    {
        $background = Language::where('id', $this->lang_id);
        $background->update([
            'status' => 0,
        ]);

        $this->methodType = '';
        $this->modalActionBtnText = '';
        $this->modalActionBtnColor = '';
        $this->modalBody = '';

        $this->dispatchBrowserEvent('close-modal');
        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',
            'message' => 'Language deactivated successfully',
        ]);
    }

    /**
     * Close Modal
     */
    public function closeModal()
    {
        $this->dispatchBrowserEvent('close-modal');
    }

    /**
     * Get Languages
     */
    public function getFilteredData()
    {
        $filteredData = Language::select(
            'languages.id',
            'languages.name',
            'languages.lang',
            'languages.flag',
            'languages.is_content_uploaded as content',
            'languages.status',
        )
            ->when($this->filterByStatus, function ($query) {
                if ($this->filterByStatus == 1) {
                    $query->where('languages.status', 1);
                }
                if ($this->filterByStatus == 2) {
                    $query->where('languages.status', 0);
                }
            })
            ->when($this->searchQuery, function ($query) {
                $query->where(function ($query) {
                    $query->where('languages.name', 'like', "%$this->searchQuery%");
                });
            });

        return $filteredData;
    }

    public function render()
    {

        $data = $this->getFilteredData();

        $this->heading = "Languages";
        $this->langs = $data->paginate(10);

        $this->total = $this->langs->total();

        $this->langs = ['langs' => $this->langs];

        return view('livewire.admin.language.languages')
            ->layout('layouts.app');
    }
}
