<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class Chart extends Component
{
    public function render()
    {
        return view('livewire.admin.chart')
            ->layout('layouts.guest');
    }
}
