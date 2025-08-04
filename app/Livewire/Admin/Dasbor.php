<?php

namespace App\Livewire\Admin;

use App\Models\Formulir;
use App\Models\Saksi;
use App\Models\Tps;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;
use Livewire\WithPagination;

class Dasbor extends Component
{
    public ?array $datas;
    public ?array $activeUsers = [];

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
                'value' => Saksi::whereHas('user',function ($query){
                    $query->role(User::SAKSI);
                })
                    ->get()
                    ->count(),
            ],
            [
                'icon' => 'heroicon-o-user',
                'label' => 'Jumlah Admin Saksi',
                'value' => User::role(User::ADMIN_SAKSI)
                    ->get()
                    ->count(),
            ],
            [
                'icon' => 'heroicon-o-user',
                'label' => 'Jumlah Koordinator Saksi',
                'value' => User::role(User::KOORDINATOR_SAKSI)
                    ->get()
                    ->count(),
            ],
        ];
    }


    public function test()
    {
        $this->dispatch('show', 'Berhasil menghapus data absensi')->to('livewire-toast');
    }

    public function render()
    {
        return view('livewire.admin.dasbor');
    }
}
