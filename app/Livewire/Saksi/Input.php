<?php

namespace App\Livewire\Saksi;

use Livewire\Component;

class Input extends Component
{
    public ?array $items = [];
    public function render()
    {
        return view('livewire.saksi.input');
    }
}
