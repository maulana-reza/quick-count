<?php

namespace App\Livewire\Admin;

use App\Models\Formulir;
use App\Models\Tps;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class Dasbor extends Component
{
    public ?array $datas;
    public ?array $activeUsers = [];

    public function mount()
    {
        $this->datas = [
            [
                'icon' => 'akar-calendar',
                'label' => 'Progress Saksi TPS',
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
        $this->getActiveUsers();
    }

    public ?string $q = '';

    public function getActiveUsers()
    {
        $allUsers = User::when($this->q, function ($query) {
            $query->where('name', 'like', '%' . $this->q . '%')
                ->orWhere('no_hp', 'like', '%' . $this->q . '%')
                ->orWhere('email', 'like', '%' . $this->q . '%')
                ->get();
        })->get();

        // Filter hanya yang online (ada di cache)
        $this->activeUsers = $allUsers->filter(function ($user) {
            return Cache::has('user-is-online-' . $user->id);
        })->map(function ($user) {
            return [
                'id' => $user->id,
                'name' => $user->name,
                'no_hp' => $user->no_hp,
                'last_seen_at' => $user->last_seen_at,
                'is_online' => Cache::has('user-is-online-' . $user->id),
                'last_login_at' => $user->last_login_at,
                'role' => $user->getRoleNames()->first() ?: 'Tidak ada peran',
            ];
        })->toArray();
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
