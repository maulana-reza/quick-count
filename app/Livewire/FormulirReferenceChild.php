<?php

namespace App\Livewire;
use Livewire\Attributes\On;
use Livewire\Component;
use \Illuminate\View\View;
use App\Models\Formulir;
use App\Models\Tps;
use App\Models\Saksi;
use Laravolt\Indonesia\Models\Village;

class FormulirReferenceChild extends Component
{

    public $item=[];

    /**
     * @var array
     */
    protected $listeners = [
        'showDeleteForm',
        'showCreateForm',
        '',
    ];

    /**
     * @var array
     */
    public $tps = [];

    /**
     * @var array
     */
    public $saksis = [];

    /**
     * @var array
     */
    public $villages = [];

    /**
     * @var array
     */
    protected $rules = [
        'item.no_formulir' => '',
        'item.foto' => '',
        'item.status_form' => '',
        'item.laporan_kejadian' => '',
        'item.foto_kejadian' => '',
        'item.status_kejadian' => '',
        'item.tps_id' => 'required',
        'item.saksi_id' => 'required',
        'item.village_id' => 'required',
    ];

    /**
     * @var array
     */
    protected $validationAttributes = [
        'item.no_formulir' => 'No. Formulir',
        'item.foto' => 'Foto Formulir C1',
        'item.status_form' => 'Status Form',
        'item.laporan_kejadian' => 'Laporan Kejadian',
        'item.foto_kejadian' => 'Bukti Kejadian',
        'item.status_kejadian' => 'Status',
        'item.tps_id' => 'Tps',
        'item.saksi_id' => 'Saksi',
        'item.village_id' => 'Village',
    ];

    /**
     * @var bool
     */
    public $confirmingItemDeletion = false;

    /**
     * @var string | int
     */
    public $primaryKey;

    /**
     * @var bool
     */
    public $confirmingItemCreation = false;

    public $formulir ;


    public function render(): View
    {
        return view('livewire.formulir-reference-child');
    }
    #[On('showDeleteForm')]
    public function showDeleteForm(Formulir $formulir): void
    {
        $this->confirmingItemDeletion = true;
        $this->formulir = $formulir;
    }

    public function deleteItem(): void
    {
        $this->formulir->delete();
        $this->confirmingItemDeletion = false;
        $this->formulir = '';
        $this->reset(['item']);
        $this->dispatch('refresh')->to('formulir-reference');
        $this->dispatch('show', 'Record Deleted Successfully')->to('livewire-toast');

    }

    #[On('showCreateForm')]
    public function showCreateForm(): void
    {
        $this->confirmingItemCreation = true;
        $this->resetErrorBag();
        $this->reset(['item']);

        $this->tps = Tps::orderBy('no_tps')->get();

        $this->saksis = Saksi::orderBy('nama')->get();

        $this->villages = Village::orderBy('name')->get();
    }

    public function createItem(): void
    {
        $this->validate();
        $item = Formulir::create([
            'no_formulir' => $this->item['no_formulir'] ?? '',
            'foto' => $this->item['foto'] ?? '',
            'status_form' => $this->item['status_form'] ?? '',
            'laporan_kejadian' => $this->item['laporan_kejadian'] ?? '',
            'foto_kejadian' => $this->item['foto_kejadian'] ?? '',
            'status_kejadian' => $this->item['status_kejadian'] ?? '',
            'tps_id' => $this->item['tps_id'] ?? 0,
            'saksi_id' => $this->item['saksi_id'] ?? 0,
            'village_id' => $this->item['village_id'] ?? 0,
        ]);
        $this->confirmingItemCreation = false;
        $this->dispatch('refresh')->to('formulir-reference');
        $this->dispatch('show', 'Record Added Successfully')->to('livewire-toast');

    }

}
