<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;
use \Illuminate\View\View;
use App\Models\User;

class UserReferenceChild extends Component
{

    public $item = [];

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
        'item.name' => 'required',
        'item.email' => 'required|email|unique:users,email',
        'item.no_hp' => 'required',
        'item.password' => 'required',
    ];

    /**
     * @var array
     */
    protected $validationAttributes = [
        'item.name' => 'Name',
        'item.email' => 'Email',
        'item.no_hp' => 'No Hp',
        'item.password' => 'Password',
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

    public $user;

    /**
     * @var bool
     */
    public $confirmingItemEdit = false;

    public function render(): View
    {
        return view('livewire.user-reference-child');
    }

    #[On('showDeleteForm')]
    public function showDeleteForm(User $user): void
    {
        $this->confirmingItemDeletion = true;
        $this->user = $user;
    }

    public function deleteItem(): void
    {
        $this->user->delete();
        $this->confirmingItemDeletion = false;
        $this->user = '';
        $this->reset(['item']);
        $this->dispatch('refresh')->to('user-reference');
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
        $currentRouteName = request()->route()->getName();

        $item = User::create([
            'name' => $this->item['name'] ?? '',
            'email' => $this->item['email'] ?? '',
            'no_hp' => $this->item['no_hp'] ?? '',
            'password' => bcrypt($this->item['password'] ?? ''),
        ]);
        if ($currentRouteName === 'saksi-admin') {
            $item->assignRole(User::ADMIN_SAKSI);
        } elseif ($currentRouteName === 'saksi-koordinator') {
            $item->assignRole(User::KOORDINATOR_SAKSI);
        } else {
            $item->assignRole(User::SAKSI);
        }
        $this->confirmingItemCreation = false;
        $this->dispatch('refresh')->to('user-reference');
        $this->dispatch('show', 'Record Added Successfully')->to('livewire-toast');

    }

    #[On('showEditForm')]
    public function showEditForm(User $user): void
    {
        $this->resetErrorBag();
        $this->user = $user;
        $this->item = $user->toArray();
        $this->confirmingItemEdit = true;
    }

    public function editItem(): void
    {
        $this->validate();
        $item = $this->user->update([
            'name' => $this->item['name'] ?? '',
            'email' => $this->item['email'] ?? '',
            'no_hp' => $this->item['no_hp'] ?? '',
        ]);
        if (!empty($this->item['password'])) {
            $this->user->update(['password' => bcrypt($this->item['password'])]);
        }

        $this->confirmingItemEdit = false;
        $this->primaryKey = '';
        $this->dispatch('refresh')->to('user-reference');
        $this->dispatch('show', 'Record Updated Successfully')->to('livewire-toast');

    }

}
