<?php

namespace App\Http\Livewire\Admin\FooterSection\CopyrightAct;

use App\Models\CopyrightAct;
use Livewire\Component;
use Livewire\WithPagination;

class CopyrighActPages extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $page_id, $methodType, $modalTitle, $modalBody, $modalActionBtnColor, $modalActionBtnText, $status;

    public $searchQuery = '', $filterByStatus = '';

    public $copyright_act_pages, $total, $heading, $statuses = [], $languages = [];


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
     * Delete
     */
    public function deleteConfirmModal($id)
    {
        $this->page_id = $id;
        $this->methodType = 'delete';
        $this->modalActionBtnText = 'Delete';
        $this->modalActionBtnColor = 'bg-danger';
        $this->modalBody = 'You want to delete this Copyright Act page!';
        $this->dispatchBrowserEvent('confirm-modal');
    }
    public function delete()
    {
        $page = CopyrightAct::where('id', $this->page_id);
        if (!$page->first()) {
            abort(404);
        }

        $page->delete();

        $this->methodType = '';
        $this->modalActionBtnText = '';
        $this->modalActionBtnColor = '';
        $this->modalBody = '';

        $this->dispatchBrowserEvent('close-modal');
        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',
            'message' => 'Copyright Act page deleted successfully',
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
     * Get Pages
     */
    public function getFilteredData()
    {
        $filteredData = CopyrightAct::select(
            'copyright_acts.id',
            'copyright_acts.title',
            'copyright_acts.description',
            'languages.name as page_language',
        )
            ->join('languages', 'languages.id', 'copyright_acts.lang_id')
            // ->when($this->filterByStatus, function ($query) {
            //     if ($this->filterByStatus == 1) {
            //         $query->where('pages.status', 1);
            //     }
            //     if ($this->filterByStatus == 2) {
            //         $query->where('pages.status', 0);
            //     }
            // })
            ->when($this->searchQuery, function ($query) {
                $query->where(function ($query) {
                    $query->where('copyright_acts.title', 'like', "%$this->searchQuery%");
                });
            });

        return $filteredData;
    }

    public function render()
    {

        $data = $this->getFilteredData();

        $this->heading = "Copyright Act Pages";
        $this->copyright_act_pages = $data->paginate(10);

        $this->total = $this->copyright_act_pages->total();

        $this->copyright_act_pages = ['copyright_act_pages' => $this->copyright_act_pages];

        return view('livewire.admin.footer-section.copyright-act.copyrigh-act-pages')
            ->layout('layouts.app');
    }
}
