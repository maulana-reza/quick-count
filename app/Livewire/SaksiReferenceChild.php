<?php

namespace App\Livewire;
use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;
use \Illuminate\View\View;
use App\Models\Saksi;
use Livewire\WithFileUploads;

class SaksiReferenceChild extends Component
{
    use WithFileUploads;

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
        'item.nik' => 'required|unique:saksis,nik|min:15',
        'item.nama' => 'required|min:3',
        'item.tps' => 'required|numeric',
        'item.no_hp' => 'required|numeric|min:10',
        'item.foto' => 'nullable|image',
        'item.email' => 'required|unique:users,email',
        'item.password' => 'required|min:8',
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
        'item.email' => 'Username',
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
        $user = User::create([
            'name' => $this->item['nama'] ?? '',
            'email' => $this->item['email'] ?? '',
            'password' => bcrypt($this->item['password'] ?? ''),
        ]);
        $user->assignRole(User::SAKSI);
        $item = Saksi::create([
            'user_id' => $user->id,
            'nik' => $this->item['nik'] ?? '',
            'nama' => $this->item['nama'] ?? '',
            'tps' => $this->item['tps'] ?? '',
            'no_hp' => $this->item['no_hp'] ?? '',
            'village_id' => $this->item['village_id'] ?? null,
            'foto' => $this->item['foto']->store('saksi-foto','public') ?? '',
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
        $user = $this->saksi->user;
        if ($user->email !== $this->item['email']) {
            $this->validate([
                'item.email' => 'required|unique:users,email,' . $user->id,
            ]);
            $user->email = $this->item['email'];
            if (isset($this->item['password'])) {
                $this->validate([
                    'item.password' => 'required|min:8',
                ]);
                $user->password = bcrypt($this->item['password']);
            }
            $this->save();
        }
        $this->saksi->user->update([
            'name' => $this->item['nama'] ?? '',
            'email' => $this->item['email'] ?? '',
            'password' => isset($this->item['password']) ? bcrypt($this->item['password']) : $this->saksi->user->password,
        ]);
        $this->saksi->update([
            'nik' => $this->item['nik'] ?? '',
            'nama' => $this->item['nama'] ?? '',
            'tps' => $this->item['tps'] ?? '',
            'no_hp' => $this->item['no_hp'] ?? '',
        ]);
        if (isset($this->item['foto'])) {
            $this->saksi->foto = $this->item['foto']->store('saksi-foto', 'public');
            $this->saksi->save();
        }
        $this->confirmingItemEdit = false;
        $this->primaryKey = '';
        $this->dispatch('refresh')->to('saksi-reference');
        $this->dispatch('show', 'Record Updated Successfully')->to('livewire-toast');
    }

}
