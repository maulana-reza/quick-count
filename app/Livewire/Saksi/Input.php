<?php

namespace App\Livewire\Saksi;

use Livewire\Component;
use Livewire\WithFileUploads;

class Input extends Component
{
    use WithFileUploads;
    public ?array $item = [];
    public $rules = [
        'item.village_id' => 'required|exists:villages,id',
        'item.foto' => 'nullable|image|max:10024',
        'item.suara_tidak_sah' => 'required',
    ];
    public $validationAttributes = [
        'item.village_id' => 'Desa',
        'item.foto' => 'Foto',
        'item.suara_tidak_sah' => 'Suara Tidak Sah',
    ];
    public function render()
    {
        return view('livewire.saksi.input');
    }
    public function save()
    {
        $this->validate($this->rules, [], $this->validationAttributes);
        $this->item['foto'] = $this->item['foto'] ? $this->item['foto']->store('saksi', 'public') : null;
        $this->item['suara_tidak_sah'] = $this->item['suara_tidak_sah'] ? $this->item['suara_tidak_sah']->store('saksi', 'public') : null;




    }
}
