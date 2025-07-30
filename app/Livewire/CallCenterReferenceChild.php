<?php

namespace App\Livewire;
use Livewire\Attributes\On;
use Livewire\Component;
use \Illuminate\View\View;
use App\Models\CallCenter;

class CallCenterReferenceChild extends Component
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
        'item.nama' => '',
        'item.no_hp' => '',
    ];

    /**
     * @var array
     */
    protected $validationAttributes = [
        'item.nama' => 'Nama',
        'item.no_hp' => 'No Hp',
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

    public $callcenter ;

    /**
     * @var bool
     */
    public $confirmingItemEdit = false;

    public function render(): View
    {
        return view('livewire.call-center-reference-child');
    }
    #[On('showDeleteForm')]
    public function showDeleteForm(CallCenter $callcenter): void
    {
        $this->confirmingItemDeletion = true;
        $this->callcenter = $callcenter;
    }

    public function deleteItem(): void
    {
        $this->callcenter->delete();
        $this->confirmingItemDeletion = false;
        $this->callcenter = '';
        $this->reset(['item']);
        $this->dispatch('refresh')->to('call-center-reference');
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
        $item = CallCenter::create([
            'nama' => $this->item['nama'] ?? '',
            'no_hp' => $this->item['no_hp'] ?? '',
        ]);
        $this->confirmingItemCreation = false;
        $this->dispatch('refresh')->to('call-center-reference');
        $this->dispatch('show', 'Record Added Successfully')->to('livewire-toast');

    }

    #[On('showEditForm')]
    public function showEditForm(CallCenter $callcenter): void
    {
        $this->resetErrorBag();
        $this->callcenter = $callcenter;
        $this->item = $callcenter->toArray();
        $this->confirmingItemEdit = true;
    }

    public function editItem(): void
    {
        $this->validate();
        $item = $this->callcenter->update([
            'nama' => $this->item['nama'] ?? '',
            'no_hp' => $this->item['no_hp'] ?? '',
         ]);
        $this->confirmingItemEdit = false;
        $this->primaryKey = '';
        $this->dispatch('refresh')->to('call-center-reference');
        $this->dispatch('show', 'Record Updated Successfully')->to('livewire-toast');

    }

}
