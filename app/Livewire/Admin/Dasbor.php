<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;

class Dasbor extends Component
{
    public ?array $datas;

    public function mount()
    {
        $this->datas = [
            [
                'icon' => 'akar-calendar',
                'label' => 'Progress Saksi TPS',
                'value' =>0,
//                'value' => TPS::count(),
            ],
            [
                'icon' => 'heroicon-o-user',
                'label' => 'Jumlah Saksi',
                'value' => User::role(User::SAKSI)
                    ->count(),
            ],
            [
                'icon' => 'heroicon-o-user',
                'label' => 'Jumlah Admin Saksi',
                'value' => User::role(User::ADMIN_SAKSI)
                    ->count(),
            ],
        ];
    }
    public function test()
    {
        $this->dispatch('show','Berhasil menghapus data absensi')->to('livewire-toast');
    }

    public function render()
    {
        return view('livewire.admin.dasbor');
    }
}
