<?php

namespace App\Livewire\AdminSaksi;

use App\Models\Formulir;
use App\Models\User;
use Livewire\Component;

class Dasbor extends Component
{
    public ?array $datas;
    public function mount()
    {
        $this->datas = [
            [
                'icon' => 'akar-file',
                'label' => 'Progress Penginputan TPS',
                'value' => Formulir::count(),
            ],
            [
                'icon' => 'heroicon-o-user',
                'label' => 'Jumlah Saksi',
                'value' => User::role(User::SAKSI)
                    ->count(),
            ],
            [
                'icon' => 'heroicon-o-user',
                'label' => 'Jumlah Koordinator Saksi',
                'value' => User::role(User::KOORDINATOR_SAKSI)
                    ->count(),
            ],
        ];


    }
    public function render()
    {
        return view('livewire.admin-saksi.dasbor');
    }
}
