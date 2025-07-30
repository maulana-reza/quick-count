<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Database\Eloquent\Builder;
use \Illuminate\View\View;

use App\Models\User;

class UserReference extends Component
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
        $currentRouteName = request()->route()->getName();
        $results = $this->query()
            ->when($this->q, function ($query) {
                return $query->where(function ($query) {
                    $query->where('name', 'like', '%' . $this->q . '%')
                        ->orWhere('email', 'like', '%' . $this->q . '%')
                        ->orWhere('no_hp', 'like', '%' . $this->q . '%');
                });
            })
            ->when($currentRouteName === 'saksi-admin', function ($query) {
                return $query->whereHas('roles', function ($query) {
                    $query->where('name', User::ADMIN_SAKSI);
                });
            })
            ->when($currentRouteName === 'saksi-koordinator', function ($query) {
                return $query->whereHas('roles', function ($query) {
                    $query->where('name', User::KOORDINATOR_SAKSI);
                });
            })
            ->when($currentRouteName === 'saksi', function ($query) {
                return $query->whereHas('roles', function ($query) {
                    $query->where('name', User::SAKSI);
                });
            })
            ->paginate($this->per_page);
        return view('livewire.user-reference', [
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
        return User::query();
    }
}
