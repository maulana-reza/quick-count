<?php

namespace App\Livewire\Admin;

use Laravolt\Indonesia\Models\District;
use Livewire\Component;
use Livewire\WithPagination;

class Tps extends Component
{
    use WithPagination;
    public ?string $q = null;
    public function render()
    {
        $tps = District::when($this->q, function ($query) {
                $query->where('name', 'like', '%' . $this->q . '%')
                    ->orWhereHas('city', function ($q) {
                        $q->where('name', 'like', '%' . $this->q . '%');
                    });
            })
            ->with(['city'])
            ->orderBy('name')
            ->paginate(10);
        return view('livewire.admin.tps')
            ->with([
                'tps' => $tps,
            ]);
    }
}
