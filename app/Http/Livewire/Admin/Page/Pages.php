<?php

namespace App\Http\Livewire\Admin\Page;

use App\Models\Language;
use App\Models\Page;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Pages extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $page_id, $methodType, $modalTitle, $modalBody, $modalActionBtnColor, $modalActionBtnText, $status;

    public $searchQuery = '', $filterByStatus = '';

    public $pages, $total, $heading, $statuses = [], $languages = [];

    // relations
    public $pageMeta, $pageFeature, $pageHelp, $pageFaqs;

    public function mount()
    {
        $this->languages = Language::all()->pluck('name', 'id')->toArray();

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
    // public function updatedStatus()
    // {
    //     $this->page_id = 1;
    //     $this->methodType = 'activate';
    //     $this->modalActionBtnText = 'Activate';
    //     $this->modalActionBtnColor = 'bg-success';
    //     $this->modalBody = 'You want to activate this page!';
    //     $this->dispatchBrowserEvent('confirm-modal');
    // }


    /**
     * Activate
     */
    public function activateConfirmModal($id)
    {
        $this->page_id = $id;
        $this->methodType = 'activate';
        $this->modalActionBtnText = 'Activate';
        $this->modalActionBtnColor = 'bg-success';
        $this->modalBody = 'You want to activate this page!';
        $this->dispatchBrowserEvent('confirm-modal');
    }
    public function activate()
    {
        $background = Page::where('id', $this->page_id);
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
            'message' => 'Page activated successfully',
        ]);
    }

    /**
     * Deactivate
     */
    public function deactivateConfirmModal($id)
    {
        $this->page_id = $id;
        $this->methodType = 'deactivate';
        $this->modalActionBtnText = 'Deactivate';
        $this->modalActionBtnColor = 'bg-danger';
        $this->modalBody = 'You want to deactivate page!';
        $this->dispatchBrowserEvent('confirm-modal');
    }
    public function deactivate()
    {
        $background = Page::where('id', $this->page_id);
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
            'message' => 'Page deactivated successfully',
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
        $filteredData = Page::select(
            'pages.id',
            'languages.name as page_language',
            'pages.page_title',
            'pages.slug',
            'pages.status',
            'page_metas.id as meta',
            'page_helps.id as help',
            'page_features.id as feature',
            DB::raw('(SELECT COUNT(*) FROM page_faqs WHERE page_faqs.page_id = pages.id) AS faqs')
        )
            ->join('languages', 'languages.id', 'pages.lang_id')
            ->leftJoin('page_metas', 'page_metas.page_id', 'pages.id')
            ->leftJoin('page_helps', 'page_helps.page_id', 'pages.id')
            ->leftJoin('page_features', 'page_features.page_id', 'pages.id')
            ->when($this->filterByStatus, function ($query) {
                if ($this->filterByStatus == 1) {
                    $query->where('pages.status', 1);
                }
                if ($this->filterByStatus == 2) {
                    $query->where('pages.status', 0);
                }
            })
            ->when($this->searchQuery, function ($query) {
                $query->where(function ($query) {
                    $query->where('pages.page_title', 'like', "%$this->searchQuery%");
                });
            });

        return $filteredData;
    }

    public function render()
    {

        $data = $this->getFilteredData();

        $this->heading = "Pages";
        $this->pages = $data->paginate(10);

        $this->total = $this->pages->total();

        $this->pages = ['pages' => $this->pages];

        return view('livewire.admin.page.pages')
            ->layout('layouts.app');
    }
}
