<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UserAktif extends Component
{
    public ?string $q = '';
    use WithPagination;

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
        return view('livewire.admin.user-aktif')
            ->with([
                'users' => $query->paginate(10),
            ]);
    }
}
