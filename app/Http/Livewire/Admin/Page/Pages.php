<?php

namespace App\Http\Livewire\Admin\Page;

use App\Models\Language;
use App\Models\Page;
use App\Models\PageDynamicMeta;
use App\Models\PageFaq;
use App\Models\PageFeature;
use App\Models\PageHelp;
use App\Models\PageOldSlug;
use App\Models\PageStaticMeta;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Pages extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap', $check = 1;

    public $page_id, $methodType, $modalTitle, $modalBody, $modalActionBtnColor, $modalActionBtnText, $status, $btnStatus = 0;

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

    /**
     * Delete Page and All Page Content
     */
    public function deleteConfirmModal($id)
    {
        $page = Page::where('id', $id)->first();
        if ($page->default) {
            $this->modalBody = 'You can not delete this page, Please set another page as default then you can delete this page!';
            $this->btnStatus = 1;
        } else {
            $this->modalBody = 'You want to delete page!';
        }
        $this->page_id = $id;
        $this->methodType = 'delete';
        $this->modalActionBtnText = 'Delete';
        $this->modalActionBtnColor = 'bg-danger';
        $this->dispatchBrowserEvent('confirm-modal');
    }
    public function delete()
    {
        $check = 0;
        $pdm = PageDynamicMeta::find($this->page_id);
        if ($pdm) {
            $pdm->delete();
        }
        $pos = PageOldSlug::find($this->page_id);
        if ($pos) {
            $pos->delete();
        }
        $ph = PageHelp::find($this->page_id);
        if ($ph) {
            $ph->delete();
        }
        $pfe = PageFeature::find($this->page_id);
        if ($pfe) {
            $pfe->delete();
        }
        $pf = PageFaq::where('page_id', $this->page_id)->get();
        if ($pf->count() > 0) {
            foreach ($pf as $faq) {
                $faq->delete();
            }
        }
        $p = Page::find($this->page_id);
        if ($p) {
            $check = 1;
            Language::where('id', $p->lang_id)->update([
                'is_content_uploaded' => 0
            ]);
            $p->delete();
        }

        $this->methodType = '';
        $this->modalActionBtnText = '';
        $this->modalActionBtnColor = '';
        $this->modalBody = '';

        $this->dispatchBrowserEvent('close-modal');
        if ($check) {
            $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'success',
                'message' => 'Page deleted successfully',
            ]);
        } else {
            $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'error',
                'message' => 'Page not found',
            ]);
        }
    }


    /**
     * Make Default Page
     */
    public function makeDefaultConfirmModal($id)
    {
        $this->page_id = $id;
        $this->btnStatus = 0;
        $this->methodType = 'setDefault';
        $this->modalActionBtnText = 'Set Default';
        $this->modalActionBtnColor = 'bg-success';
        $this->modalBody = 'You want to make this page as default Page!';
        $this->dispatchBrowserEvent('confirm-modal');
    }
    public function setDefault()
    {
        Page::where('default', 1)->update([
            'default' => 0
        ]);
        $page = Page::where('id', $this->page_id);
        $page->update([
            'default' => 1,
        ]);

        $this->methodType = '';
        $this->modalActionBtnText = '';
        $this->modalActionBtnColor = '';
        $this->modalBody = '';

        $this->dispatchBrowserEvent('close-modal');
        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',
            'message' => 'This Page is set as default page successfully',
        ]);
    }

    /**
     * Close Modal
     */
    public function closeModal()
    {
        $this->dispatchBrowserEvent('close-modal');
        $this->btnStatus = 0;
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
            'pages.default',
            'pages.status',
            'page_dynamic_metas.id as dynamic_meta',
            'page_helps.id as help',
            'page_features.id as feature',
            DB::raw('(SELECT COUNT(*) FROM page_faqs WHERE page_faqs.page_id = pages.id) AS faqs')
        )
            ->join('languages', 'languages.id', 'pages.lang_id')
            ->leftJoin('page_dynamic_metas', 'page_dynamic_metas.page_id', 'pages.id')
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
