<?php

namespace App\Livewire\AdminSaksi;

use Livewire\Component;

class Log extends Component
{
    public ?string $type = null;
    public ?string $user_id = null;
    public ?string $q = null;
    public $datas;
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
            ->when($this->q, function ($query) {
                $query->where(function ($q) {
                    $q->where('aksi', 'like', '%' . $this->q . '%')
                        ->orWhereHas('user', function ($q) {
                            $q->where('name', 'like', '%' . $this->q . '%')
                                ->orWhere('no_hp', 'like', '%' . $this->q . '%');
                        });
                });
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
