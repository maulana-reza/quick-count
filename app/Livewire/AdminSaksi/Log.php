<?php

namespace App\Livewire\AdminSaksi;

use Livewire\Component;

class Log extends Component
{
    public ?string $type = null;
    public ?string $user_id = null;
    public function mount()
    {


    }
    public function render()
    {
        $data = \App\Models\Log::latest()
            ->with(['user'])
            ->when($this->type, function ($query) {
                $query->where('aksi', $this->type);
            })
            ->when($this->user_id, function ($query) {
                $query->where('user_id', $this->user_id);
            })
            ->paginate(10);
        return view('livewire.admin-saksi.log')
            ->with([
                'logs' => $data,
            ]);
    }
}
