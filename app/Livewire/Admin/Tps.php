<?php

namespace App\Livewire\Admin;

use Laravolt\Indonesia\Models\District;
use Laravolt\Indonesia\Models\Village;
use Livewire\Component;
use Livewire\WithPagination;

class Tps extends Component
{
    use WithPagination;
    public ?string $q = null;
    public function render()
    {
        $tps = Village::when($this->q, function ($query) {
                $query->where('name', 'like', '%' . $this->q . '%')
                    ->orWhereHas('district', function ($q) {
                        $q->where('name', 'like', '%' . $this->q . '%');
                    })
                    ->orWhereHas('district.city', function ($q) {
                        $q->where('name', 'like', '%' . $this->q . '%');
                    });
            })
            ->whereHas('district.city.province', function ($query) {
                $query->where('name', 'papua');
            })
            ->with(['district.city.province'])
            ->orderBy('name')
            ->paginate(10);
        return view('livewire.admin.tps')
            ->with([
                'tps' => $tps,
            ]);
    }
}
