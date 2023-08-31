<?php

namespace App\Http\Livewire\Admin;

use App\Models\Language;
use Livewire\Component;
use Livewire\WithPagination;

class OldLanguages extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $lang_id, $methodType, $modalTitle, $modalBody, $modalActionBtnColor, $modalActionBtnText;

    public $searchQuery = '', $filterByStatus = '';

    public $langs, $total, $heading, $statuses = [];

    public function mount()
    {
        $countryName = 'United Kingdom';
        $url = "https://restcountries.com/v3.1/name/$countryName?fullText=true";
        // $url = "https://restcountries.com/v2/name/$countryName?fullText=true";

        dd($url);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        curl_close($ch);

        $data = json_decode($response, true);

        dd($data);

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
     * Create Languages
     */
    private function createLanguages()
    {
        $langs = Language::all();
        if (!$langs->count()) {
            $jsonPath = database_path('languages.json');

            // Read the JSON file contents
            $jsonContents = file_get_contents($jsonPath);

            // Parse the JSON data
            $data = json_decode($jsonContents, true);

            foreach ($data as $lang) {
                Language::create($lang);
            }
        }
    }

    /**
     * Get Languages
     */
    public function getFilteredData()
    {
        // create languages if not exists
        $this->createLanguages();

        $filteredData = Language::select(
            'languages.id',
            'languages.name',
            'languages.code',
            'languages.emoji',
            'languages.image',
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

        return view('livewire.admin.languages')
            ->layout('layouts.app');
    }
}
