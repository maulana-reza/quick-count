<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Database\Eloquent\Builder;
use \Illuminate\View\View;

use App\Models\Saksi;

class SaksiReference extends Component
{
    use WithPagination;

    /**
     * @var array
     */
    protected $listeners = ['refresh' => '$refresh'];
    /**
     * @var string
     */
    public $q;

    /**
     * @var int
     */
    public $per_page = 15;


    public function mount(): void
    {

    }

    public function render(): View
    {
        $results = $this->query()
            ->when($this->q, function ($query) {
                return $query->where(function ($query) {
                    $query->where('nik', 'like', '%' . $this->q . '%')
                        ->orWhere('nama', 'like', '%' . $this->q . '%')
                        ->orWhere('tps', 'like', '%' . $this->q . '%');
                });
            })
            ->paginate($this->per_page);

        return view('livewire.saksi-reference', [
            'results' => $results
        ]);
    }

    public function updatingQ(): void
    {
        $this->resetPage();
    }

    public function updatingPerPage(): void
    {
        $this->resetPage();
    }

    public function query(): Builder
    {
        return Saksi::query();
    }
}
