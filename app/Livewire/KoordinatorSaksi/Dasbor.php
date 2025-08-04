<?php

namespace App\Livewire\KoordinatorSaksi;

use App\Models\Formulir;
use App\Models\User;
use Livewire\Component;

class Dasbor extends Component
{
    public $datas = [];
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
                'label' => 'Jumlah Pengaduan',
                'value' => Formulir::whereNotNull('laporan_kejadian')->count(),
            ]
        ];

    }
    public function render()
    {
        return view('livewire.koordinator-saksi.dasbor');
    }
}
