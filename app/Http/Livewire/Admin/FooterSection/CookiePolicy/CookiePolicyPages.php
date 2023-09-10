<?php

namespace App\Http\Livewire\Admin\FooterSection\CookiePolicy;

use App\Models\CookiesPolicy;
use Livewire\Component;
use Livewire\WithPagination;

class CookiePolicyPages extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $page_id, $methodType, $modalTitle, $modalBody, $modalActionBtnColor, $modalActionBtnText, $status;

    public $searchQuery = '', $filterByStatus = '';

    public $cookie_policy_pages, $total, $heading, $statuses = [], $languages = [];


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
        $this->modalBody = 'You want to delete this Cookie Policy page!';
        $this->dispatchBrowserEvent('confirm-modal');
    }
    public function delete()
    {
        $page = CookiesPolicy::where('id', $this->page_id);
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
            'message' => 'Cookie Policy Page deleted successfully',
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
        $filteredData = CookiesPolicy::select(
            'cookies_policies.id',
            'cookies_policies.title',
            'cookies_policies.description',
            'languages.name as page_language',
        )
            ->join('languages', 'languages.id', 'cookies_policies.lang_id')
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
                    $query->where('cookies_policies.title', 'like', "%$this->searchQuery%");
                });
            });

        return $filteredData;
    }

    public function render()
    {

        $data = $this->getFilteredData();

        $this->heading = "Cookie Policy Pages";
        $this->cookie_policy_pages = $data->paginate(10);

        $this->total = $this->cookie_policy_pages->total();

        $this->cookie_policy_pages = ['cookie_policy_pages' => $this->cookie_policy_pages];

        return view('livewire.admin.footer-section.cookie-policy.cookie-policy-pages')
            ->layout('layouts.app');
    }
}
