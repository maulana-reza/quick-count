<div>

    <x-tall-crud-confirmation-dialog wire:model.live="confirmingItemDeletion">
        <x-slot name="title">
            Delete Record
        </x-slot>

        <x-slot name="content">
            Are you sure you want to Delete Record?
        </x-slot>

        <x-slot name="footer">
            <x-tall-crud-button wire:click="$set('confirmingItemDeletion', false)">Cancel</x-tall-crud-button>
            <x-tall-crud-button mode="delete" wire:loading.attr="disabled" wire:click="deleteItem()">Delete
            </x-tall-crud-button>
        </x-slot>
    </x-tall-crud-confirmation-dialog>

    <x-tall-crud-dialog-modal wire:model.live="confirmingItemCreation">
        <x-slot name="title">
            Add Record
        </x-slot>

        <x-slot name="content">
            <div class="grid md:grid-cols-2 grid-cols-1 gap-4">
                <div>
                    <x-tall-crud-label>Nama</x-tall-crud-label>
                    <x-tall-crud-input class="block mt-1 w-full" type="text" wire:model="item.kepala"/>
                    @error('item.kepala')
                    <x-tall-crud-error-message>{{$message}}</x-tall-crud-error-message> @enderror
                </div>
                <div>
                    <x-tall-crud-label>Nama Wakil</x-tall-crud-label>
                    <x-tall-crud-input class="block mt-1 w-full" type="text" wire:model="item.wakil"/>
                    @error('item.wakil')
                    <x-tall-crud-error-message>{{$message}}</x-tall-crud-error-message> @enderror
                </div>
                <div>
                    <x-tall-crud-label>No. Urut</x-tall-crud-label>
                    <x-tall-crud-input class="block mt-1 w-full" type="text" wire:model="item.no_urut"/>
                    @error('item.no_urut')
                    <x-tall-crud-error-message>{{$message}}</x-tall-crud-error-message> @enderror
                </div>
                <x-default-input type="file"
                                 label="Foto Paslon"
                                 name="item.foto_kepala"
                                 wire:model.live="item.foto_kepala"/>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-tall-crud-button wire:click="$set('confirmingItemCreation', false)">Cancel</x-tall-crud-button>
            <x-tall-crud-button mode="add" wire:loading.attr="disabled" wire:click="createItem()">Save
            </x-tall-crud-button>
        </x-slot>
    </x-tall-crud-dialog-modal>

    <x-tall-crud-dialog-modal wire:model.live="confirmingItemEdit">
        <x-slot name="title">
            Edit Record
        </x-slot>

        <x-slot name="content">
            <div class="grid md:grid-cols-2 grid-cols-1 gap-4">
                <div>
                    <x-tall-crud-label>Nama</x-tall-crud-label>
                    <x-tall-crud-input class="block mt-1 w-full" type="text" wire:model="item.kepala"/>
                    @error('item.kepala')
                    <x-tall-crud-error-message>{{$message}}</x-tall-crud-error-message> @enderror
                </div>
                <div>
                    <x-tall-crud-label>Nama Wakil</x-tall-crud-label>
                    <x-tall-crud-input class="block mt-1 w-full" type="text" wire:model="item.wakil"/>
                    @error('item.wakil')
                    <x-tall-crud-error-message>{{$message}}</x-tall-crud-error-message> @enderror
                </div>
                <div>
                    <x-tall-crud-label>No. Urut</x-tall-crud-label>
                    <x-tall-crud-input class="block mt-1 w-full" type="text" wire:model="item.no_urut"/>
                    @error('item.no_urut')
                    <x-tall-crud-error-message>{{$message}}</x-tall-crud-error-message> @enderror
                </div>
                <x-default-input type="file"
                                 label="Foto Paslon"
                                 name="item.foto_kepala"
                                 wire:model.live="item.foto_kepala"/>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-tall-crud-button wire:click="$set('confirmingItemEdit', false)">Cancel</x-tall-crud-button>
            <x-tall-crud-button mode="add" wire:loading.attr="disabled" wire:click="editItem()">Save
            </x-tall-crud-button>
        </x-slot>
    </x-tall-crud-dialog-modal>
</div>
