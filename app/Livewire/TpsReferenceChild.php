<?php

namespace App\Livewire;
use Livewire\Attributes\On;
use Livewire\Component;
use \Illuminate\View\View;
use App\Models\Tps;
use Laravolt\Indonesia\Models\Village;

class TpsReferenceChild extends Component
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
    public $villages = [];

    /**
     * @var array
     */
    protected $rules = [
        'item.alamat' => '',
        'item.no_tps' => '',
        'item.village_id' => 'required',
    ];

    /**
     * @var array
     */
    protected $validationAttributes = [
        'item.alamat' => 'Alamat',
        'item.no_tps' => 'No Tps',
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

    public $tps ;

    /**
     * @var bool
     */
    public $confirmingItemEdit = false;

    public function render(): View
    {
        return view('livewire.tps-reference-child');
    }
    #[On('showDeleteForm')]
    public function showDeleteForm(Tps $tps): void
    {
        $this->confirmingItemDeletion = true;
        $this->tps = $tps;
    }

    public function deleteItem(): void
    {
        $this->tps->delete();
        $this->confirmingItemDeletion = false;
        $this->tps = '';
        $this->reset(['item']);
        $this->dispatch('refresh')->to('tps-reference');
        $this->dispatch('show', 'Record Deleted Successfully')->to('livewire-toast');

    }

    #[On('showCreateForm')]
    public function showCreateForm(): void
    {
        $this->confirmingItemCreation = true;
        $this->resetErrorBag();
        $this->reset(['item']);

        $this->villages = Village::orderBy('name')->get();
    }

    public function createItem(): void
    {
        $this->validate();
        $item = Tps::create([
            'alamat' => $this->item['alamat'] ?? '',
            'no_tps' => $this->item['no_tps'] ?? '',
            'village_id' => $this->item['village_id'] ?? 0,
        ]);
        $this->confirmingItemCreation = false;
        $this->dispatch('refresh')->to('tps-reference');
        $this->dispatch('show', 'Record Added Successfully')->to('livewire-toast');

    }

    #[On('showEditForm')]
    public function showEditForm(Tps $tps): void
    {
        $this->resetErrorBag();
        $this->tps = $tps;
        $this->item = $tps->toArray();
        $this->confirmingItemEdit = true;

        $this->villages = Village::orderBy('name')->get();
    }

    public function editItem(): void
    {
        $this->validate();
        $item = $this->tps->update([
            'alamat' => $this->item['alamat'] ?? '',
            'no_tps' => $this->item['no_tps'] ?? '',
         ]);
        $this->confirmingItemEdit = false;
        $this->primaryKey = '';
        $this->dispatch('refresh')->to('tps-reference');
        $this->dispatch('show', 'Record Updated Successfully')->to('livewire-toast');

    }

}
