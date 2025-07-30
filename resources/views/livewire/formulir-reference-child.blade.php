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
            <x-tall-crud-button mode="delete" wire:loading.attr="disabled" wire:click="deleteItem()">Delete</x-tall-crud-button>
        </x-slot>
    </x-tall-crud-confirmation-dialog>

    <x-tall-crud-dialog-modal wire:model.live="confirmingItemCreation">
        <x-slot name="title">
            Add Record
        </x-slot>

        <x-slot name="content"><div class="grid md:grid-cols-2 grid-cols-1 gap-4">
            <div>
                <x-tall-crud-label>No. Formulir</x-tall-crud-label>
                <x-tall-crud-input class="block mt-1 w-full" type="text" wire:model="item.no_formulir" />
                @error('item.no_formulir') <x-tall-crud-error-message>{{$message}}</x-tall-crud-error-message> @enderror
            </div>
            <div>
                <x-tall-crud-label>Foto Formulir C1</x-tall-crud-label>
                <x-tall-crud-input class="block mt-1 w-full" type="text" wire:model="item.foto" />
                @error('item.foto') <x-tall-crud-error-message>{{$message}}</x-tall-crud-error-message> @enderror
            </div>
            <div>
                <x-tall-crud-label>Status Form</x-tall-crud-label>
                <x-tall-crud-input class="block mt-1 w-full" type="text" wire:model="item.status_form" />
                @error('item.status_form') <x-tall-crud-error-message>{{$message}}</x-tall-crud-error-message> @enderror
            </div>
            <div>
                <x-tall-crud-label>Laporan Kejadian</x-tall-crud-label>
                <x-tall-crud-input class="block mt-1 w-full" type="text" wire:model="item.laporan_kejadian" />
                @error('item.laporan_kejadian') <x-tall-crud-error-message>{{$message}}</x-tall-crud-error-message> @enderror
            </div>
            <div>
                <x-tall-crud-label>Bukti Kejadian</x-tall-crud-label>
                <x-tall-crud-input class="block mt-1 w-full" type="text" wire:model="item.foto_kejadian" />
                @error('item.foto_kejadian') <x-tall-crud-error-message>{{$message}}</x-tall-crud-error-message> @enderror
            </div>
            <div>
                <x-tall-crud-label>Status</x-tall-crud-label>
                <x-tall-crud-input class="block mt-1 w-full" type="text" wire:model="item.status_kejadian" />
                @error('item.status_kejadian') <x-tall-crud-error-message>{{$message}}</x-tall-crud-error-message> @enderror
            </div>

            <div class="grid grid-cols-3">
                <div class="mt-4">
                    <x-tall-crud-label>Tps</x-tall-crud-label>
                    <x-tall-crud-select class="block mt-1 w-full" wire:model="item.tps_id">
                        <option value="">Please Select</option>
                        @foreach($tps as $c)
                        <option value="{{$c->id}}">{{$c->no_tps}}</option>
                        @endforeach
                    </x-tall-crud-select>
                    @error('item.tps_id') <x-tall-crud-error-message>{{$message}}</x-tall-crud-error-message> @enderror
                </div>
            </div>

            <div class="grid grid-cols-3">
                <div class="mt-4">
                    <x-tall-crud-label>Saksi</x-tall-crud-label>
                    <x-tall-crud-select class="block mt-1 w-full" wire:model="item.saksi_id">
                        <option value="">Please Select</option>
                        @foreach($saksis as $c)
                        <option value="{{$c->id}}">{{$c->nama}}</option>
                        @endforeach
                    </x-tall-crud-select>
                    @error('item.saksi_id') <x-tall-crud-error-message>{{$message}}</x-tall-crud-error-message> @enderror
                </div>
            </div>

            <div class="grid grid-cols-3">
                <div class="mt-4">
                    <x-tall-crud-label>Village</x-tall-crud-label>
                    <x-tall-crud-select class="block mt-1 w-full" wire:model="item.village_id">
                        <option value="">Please Select</option>
                        @foreach($villages as $c)
                        <option value="{{$c->id}}">{{$c->name}}</option>
                        @endforeach
                    </x-tall-crud-select>
                    @error('item.village_id') <x-tall-crud-error-message>{{$message}}</x-tall-crud-error-message> @enderror
                </div>
            </div></div>
        </x-slot>

        <x-slot name="footer">
            <x-tall-crud-button wire:click="$set('confirmingItemCreation', false)">Cancel</x-tall-crud-button>
            <x-tall-crud-button mode="add" wire:loading.attr="disabled" wire:click="createItem()">Save</x-tall-crud-button>
        </x-slot>
    </x-tall-crud-dialog-modal>

</div>
