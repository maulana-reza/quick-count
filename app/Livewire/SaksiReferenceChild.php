<?php

namespace App\Livewire;
use Livewire\Attributes\On;
use Livewire\Component;
use \Illuminate\View\View;
use App\Models\Saksi;

class SaksiReferenceChild extends Component
{

    public $item=[];

    /**
     * @var array
     */
    protected $listeners = [
        'showDeleteForm',
        'showCreateForm',
        'showEditForm',
    ];

    /**
     * @var array
     */
    protected $rules = [
        'item.nik' => '',
        'item.nama' => '',
        'item.tps' => '',
        'item.no_hp' => '',
        'item.foto' => '',
    ];

    /**
     * @var array
     */
    protected $validationAttributes = [
        'item.nik' => 'NIK',
        'item.nama' => 'Nama Lengkap',
        'item.tps' => 'No. TPS',
        'item.no_hp' => 'No. HP',
        'item.foto' => 'Foto',
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

    public $saksi ;

    /**
     * @var bool
     */
    public $confirmingItemEdit = false;

    public function render(): View
    {
        return view('livewire.saksi-reference-child');
    }
    #[On('showDeleteForm')]
    public function showDeleteForm(Saksi $saksi): void
    {
        $this->confirmingItemDeletion = true;
        $this->saksi = $saksi;
    }

    public function deleteItem(): void
    {
        $this->saksi->delete();
        $this->confirmingItemDeletion = false;
        $this->saksi = '';
        $this->reset(['item']);
        $this->dispatch('refresh')->to('saksi-reference');
        $this->dispatch('show', 'Record Deleted Successfully')->to('livewire-toast');

    }

    #[On('showCreateForm')]
    public function showCreateForm(): void
    {
        $this->confirmingItemCreation = true;
        $this->resetErrorBag();
        $this->reset(['item']);
    }

    public function createItem(): void
    {
        $this->validate();
        $item = Saksi::create([
            'nik' => $this->item['nik'] ?? '',
            'nama' => $this->item['nama'] ?? '',
            'tps' => $this->item['tps'] ?? '',
            'no_hp' => $this->item['no_hp'] ?? '',
            'foto' => $this->item['foto'] ?? '',
        ]);
        $this->confirmingItemCreation = false;
        $this->dispatch('refresh')->to('saksi-reference');
        $this->dispatch('show', 'Record Added Successfully')->to('livewire-toast');

    }

    #[On('showEditForm')]
    public function showEditForm(Saksi $saksi): void
    {
        $this->resetErrorBag();
        $this->saksi = $saksi;
        $this->item = $saksi->toArray();
        $this->confirmingItemEdit = true;
    }

    public function editItem(): void
    {
        $this->validate();
        $item = $this->saksi->update([
            'nik' => $this->item['nik'] ?? '',
            'nama' => $this->item['nama'] ?? '',
            'tps' => $this->item['tps'] ?? '',
            'no_hp' => $this->item['no_hp'] ?? '',
            'foto' => $this->item['foto'] ?? '',
         ]);
        $this->confirmingItemEdit = false;
        $this->primaryKey = '';
        $this->dispatch('refresh')->to('saksi-reference');
        $this->dispatch('show', 'Record Updated Successfully')->to('livewire-toast');

    }

}
