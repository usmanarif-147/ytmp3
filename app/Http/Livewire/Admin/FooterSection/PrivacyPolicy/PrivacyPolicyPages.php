<?php

namespace App\Http\Livewire\Admin\FooterSection\PrivacyPolicy;

use App\Models\PrivacyPolicy;
use Livewire\Component;
use Livewire\WithPagination;

class PrivacyPolicyPages extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $page_id, $methodType, $modalTitle, $modalBody, $modalActionBtnColor, $modalActionBtnText, $status;

    public $searchQuery = '', $filterByStatus = '';

    public $privacy_policy_pages, $total, $heading, $statuses = [], $languages = [];


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
        $this->modalBody = 'You want to delete this Privacy Policy page!';
        $this->dispatchBrowserEvent('confirm-modal');
    }
    public function delete()
    {
        $page = PrivacyPolicy::where('id', $this->page_id);
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
            'message' => 'Privacy Policy Page deleted successfully',
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
        $filteredData = PrivacyPolicy::select(
            'privacy_policies.id',
            'privacy_policies.title',
            'privacy_policies.description',
            'languages.name as page_language',
        )
            ->join('languages', 'languages.id', 'privacy_policies.lang_id')
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
                    $query->where('privacy_policies.title', 'like', "%$this->searchQuery%");
                });
            });

        return $filteredData;
    }

    public function render()
    {
        $data = $this->getFilteredData();

        $this->heading = "Privacy Policy Pages";
        $this->privacy_policy_pages = $data->paginate(10);

        $this->total = $this->privacy_policy_pages->total();

        $this->privacy_policy_pages = ['privacy_policy_pages' => $this->privacy_policy_pages];

        return view('livewire.admin.footer-section.privacy-policy.privacy-policy-pages')
            ->layout('layouts.app');
    }
}
