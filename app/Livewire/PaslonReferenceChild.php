<?php

namespace App\Livewire;
use Livewire\Attributes\On;
use Livewire\Component;
use \Illuminate\View\View;
use App\Models\Paslon;

class PaslonReferenceChild extends Component
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
        'item.kepala' => '',
        'item.wakil' => '',
        'item.no_urut' => '',
        'item.foto_kepala' => '',
    ];

    /**
     * @var array
     */
    protected $validationAttributes = [
        'item.kepala' => 'Nama',
        'item.wakil' => 'Nama Wakil',
        'item.no_urut' => 'No. Urut',
        'item.foto_kepala' => 'Foto',
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

    public $paslon ;

    /**
     * @var bool
     */
    public $confirmingItemEdit = false;

    public function render(): View
    {
        return view('livewire.paslon-reference-child');
    }
    #[On('showDeleteForm')]
    public function showDeleteForm(Paslon $paslon): void
    {
        $this->confirmingItemDeletion = true;
        $this->paslon = $paslon;
    }

    public function deleteItem(): void
    {
        $this->paslon->delete();
        $this->confirmingItemDeletion = false;
        $this->paslon = '';
        $this->reset(['item']);
        $this->dispatch('refresh')->to('paslon-reference');
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
        $item = Paslon::create([
            'kepala' => $this->item['kepala'] ?? '',
            'wakil' => $this->item['wakil'] ?? '',
            'no_urut' => $this->item['no_urut'] ?? '',
            'foto_kepala' => $this->item['foto_kepala'] ?? '',
        ]);
        $this->confirmingItemCreation = false;
        $this->dispatch('refresh')->to('paslon-reference');
        $this->dispatch('show', 'Record Added Successfully')->to('livewire-toast');

    }

    #[On('showEditForm')]
    public function showEditForm(Paslon $paslon): void
    {
        $this->resetErrorBag();
        $this->paslon = $paslon;
        $this->item = $paslon->toArray();
        $this->confirmingItemEdit = true;
    }

    public function editItem(): void
    {
        $this->validate();
        $item = $this->paslon->update([
            'kepala' => $this->item['kepala'] ?? '',
            'wakil' => $this->item['wakil'] ?? '',
            'no_urut' => $this->item['no_urut'] ?? '',
            'foto_kepala' => $this->item['foto_kepala'] ?? '',
         ]);
        $this->confirmingItemEdit = false;
        $this->primaryKey = '';
        $this->dispatch('refresh')->to('paslon-reference');
        $this->dispatch('show', 'Record Updated Successfully')->to('livewire-toast');

    }

}
