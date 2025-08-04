<?php

namespace App\Livewire;

use Dflydev\DotAccessData\Data;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Database\Eloquent\Builder;
use \Illuminate\View\View;

use App\Models\Formulir;

class FormulirReference extends Component
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
    public $selected_formulir;


    public function mount(): void
    {

    }

    public function render(): View
    {
        $results = $this->query()
            ->when($this->q, function ($query) {
                return $query->where(function ($query) {
                    $query->where('no_formulir', 'like', '%' . $this->q . '%');
                });
            })
            ->paginate($this->per_page);

        return view('livewire.formulir-reference', [
            'results' => $results
        ]);
    }

    public function updatingQ(): void
    {
        $this->resetPage();
    }

    public function validateForm($id)
    {
        $this->confirm = 1;
        $this->selected_formulir = $id;
    }
    public function invalidateForm($id)
    {
        $this->confirm = 2;
        $this->selected_formulir = $id;
    }
    public function confirmFormulir()
    {
        if ($this->confirm == 1) {
            $formulir = Formulir::find($this->selected_formulir);
            if ($formulir) {
                $formulir->update(['status_form' => Formulir::SUDAH_VALID]);
                $this->dispatch('show', 'Formulir has been validated successfully.')->to('livewire-toast');
            }
        } elseif ($this->confirm == 2) {
            $formulir = Formulir::find($this->selected_formulir);
            if ($formulir) {
                $formulir->update(['status_form' => Formulir::TIDAK_VALID]);
                $this->dispatch('show', 'Formulir has been invalidated successfully.')->to('livewire-toast');
            }
        }
        $this->confirm = '';

    }

    public function updatingPerPage(): void
    {
        $this->resetPage();
    }

    public ?string $confirm = '';

    public function query(): Builder
    {
        return Formulir::query();
    }
}
