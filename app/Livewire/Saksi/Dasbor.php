<?php

namespace App\Livewire\Saksi;

use Livewire\Component;

class Dasbor extends Component
{
    public ?array $datas = [];
    public function mount()
    {
        $this->datas = [
            [
                'icon' => 'akar-file',
                'label' => 'Progress Penginputan TPS anda',
                'value' => \App\Models\Formulir::where('saksi_id', auth()->id())
                    ->count(),
            ],
        ];
    }
    public function render()
    {
        return view('livewire.saksi.dasbor');
    }
}
