<?php

namespace App\Http\Livewire\Admin\FooterSection\LegalDisclaimer;

use App\Models\LeagalDisclaimer;
use Livewire\Component;
use Livewire\WithPagination;

class LegalDisclaimerPages extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $page_id, $methodType, $modalTitle, $modalBody, $modalActionBtnColor, $modalActionBtnText, $status;

    public $searchQuery = '', $filterByStatus = '';

    public $leagal_disclaimer_pages, $total, $heading, $statuses = [], $languages = [];


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
        $this->modalBody = 'You want to delete this Leagal Disclaimer page!';
        $this->dispatchBrowserEvent('confirm-modal');
    }
    public function delete()
    {
        $page = LeagalDisclaimer::where('id', $this->page_id);
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
            'message' => 'Leagal Disclaimer Page deleted successfully',
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
        $filteredData = LeagalDisclaimer::select(
            'leagal_disclaimers.id',
            'leagal_disclaimers.title',
            'leagal_disclaimers.description',
            'languages.name as page_language',
        )
            ->join('languages', 'languages.id', 'leagal_disclaimers.lang_id')
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
                    $query->where('leagal_disclaimers.title', 'like', "%$this->searchQuery%");
                });
            });

        return $filteredData;
    }

    public function render()
    {

        $data = $this->getFilteredData();

        $this->heading = "Leagal Disclaimer Pages";
        $this->leagal_disclaimer_pages = $data->paginate(10);

        $this->total = $this->leagal_disclaimer_pages->total();

        $this->leagal_disclaimer_pages = ['leagal_disclaimer_pages' => $this->leagal_disclaimer_pages];

        return view('livewire.admin.footer-section.legal-disclaimer.legal-disclaimer-pages')
            ->layout('layouts.app');
    }
}
