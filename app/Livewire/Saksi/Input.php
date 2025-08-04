<?php

namespace App\Livewire\Saksi;

use App\Models\Formulir;
use App\Models\Saksi;
use Illuminate\Support\Facades\DB;
use Laravolt\Indonesia\Models\Village;
use Livewire\Component;
use Livewire\WithFileUploads;

class Input extends Component
{
    use WithFileUploads;

    public ?array $item = [];
    public $rules = [
        'item.village_id' => 'required',
        'item.foto' => 'required',
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
        DB::beginTransaction();
        try {

            $path = Formulir::path($this->item['village_id']);
            $form = Formulir::create([
                'saksi_id' => auth()->user()->saksi->id,
                'village_id' => $this->item['village_id'],
                'foto' => $this->item['foto'] ? $this->item['foto']->store($path, 'public') : null,
                'suara_tidak_sah' => $this->item['suara_tidak_sah'],
                'status_form' => Formulir::BELUM_VALID,
            ]);
            if (isset($this->item['laporan_kejadian']) && $this->item['laporan_kejadian'] !== '') {
                $form->laporan_kejadian = $this->item['laporan_kejadian'];
                $form->foto_kejadian = $this->item['foto_kejadian'] ? $this->item['foto_kejadian']->store('saksi', 'public') : null;
                $form->status_kejadian = Formulir::KEJADIAN_BELUM_DITANGANI;
                $form->save();
            }
            $this->dispatch('show', 'Berhasil menginput data formulir')->to('livewire-toast');

        } catch (\Throwable $e) {
            DB::rollBack();
            $this->dispatch('show', 'Gagal menginput data formulir: ' . $e->getMessage())->to('livewire-toast');
            return;
        }
    }
}
