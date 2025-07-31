<?php

namespace App\Livewire\Admin;

use App\Models\Formulir;
use App\Models\Tps;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;
use Livewire\WithPagination;

class Dasbor extends Component
{
    use WithPagination;
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
                'value' => User::role(User::SAKSI)
                    ->count(),
            ],
            [
                'icon' => 'heroicon-o-user',
                'label' => 'Jumlah Admin Saksi',
                'value' => User::role(User::ADMIN_SAKSI)
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

    public ?string $q = '';

    public function test()
    {
        $this->dispatch('show', 'Berhasil menghapus data absensi')->to('livewire-toast');
    }

    public function render()
    {
        $query = User::query();

        if ($this->q) {
            $query->where(function ($q) {
                $q->where('name', 'like', '%' . $this->q . '%')
                    ->orWhere('no_hp', 'like', '%' . $this->q . '%')
                    ->orWhere('email', 'like', '%' . $this->q . '%');
            });
        }

        // Hanya user yang aktif dalam 5 menit terakhir
        $query->where('last_seen_at', '>=', now()->subMinutes(10));
        return view('livewire.admin.dasbor')
            ->with([
                'users' => $query->paginate(10),
            ]);
    }
}
