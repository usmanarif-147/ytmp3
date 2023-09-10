<?php

namespace App\Http\Livewire\Admin\FooterSection\TermsOfUse;

use App\Http\Livewire\Footer\TermOfUse;
use App\Models\TermsOfUse;
use Livewire\Component;
use Livewire\WithPagination;

class TermsOfUsePages extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $page_id, $methodType, $modalTitle, $modalBody, $modalActionBtnColor, $modalActionBtnText, $status;

    public $searchQuery = '', $filterByStatus = '';

    public $terms_of_use_pages, $total, $heading, $statuses = [], $languages = [];


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
        $this->modalBody = 'You want to delete this Term of Use page!';
        $this->dispatchBrowserEvent('confirm-modal');
    }
    public function delete()
    {
        $page = TermsOfUse::where('id', $this->page_id);
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
            'message' => 'Term of Use Page deleted successfully',
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
        $filteredData = TermsOfUse::select(
            'terms_of_uses.id',
            'terms_of_uses.title',
            'terms_of_uses.description',
            'languages.name as page_language',
        )
            ->join('languages', 'languages.id', 'terms_of_uses.lang_id')
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
                    $query->where('terms_of_uses.title', 'like', "%$this->searchQuery%");
                });
            });

        return $filteredData;
    }

    public function render()
    {

        $data = $this->getFilteredData();

        $this->heading = "Term of Use Pages";
        $this->terms_of_use_pages = $data->paginate(10);

        $this->total = $this->terms_of_use_pages->total();

        $this->terms_of_use_pages = ['terms_of_use_pages' => $this->terms_of_use_pages];

        return view('livewire.admin.footer-section.terms-of-use.terms-of-use-pages')
            ->layout('layouts.app');
    }
}
