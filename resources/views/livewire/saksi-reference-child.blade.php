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
                    <x-tall-crud-label>NIK</x-tall-crud-label>
                    <x-tall-crud-input class="block mt-1 w-full" type="text" wire:model="item.nik"/>
                    @error('item.nik')
                    <x-tall-crud-error-message>{{$message}}</x-tall-crud-error-message> @enderror
                </div>
                <div>
                    <x-tall-crud-label>Nama Lengkap</x-tall-crud-label>
                    <x-tall-crud-input class="block mt-1 w-full" type="text" wire:model="item.nama"/>
                    @error('item.nama')
                    <x-tall-crud-error-message>{{$message}}</x-tall-crud-error-message> @enderror
                </div>
                <x-default-input type="select"
                                 :option="\Laravolt\Indonesia\Models\City::whereHas('province', function ($query) {
                                     $query->where('name', 'papua');
                                    })->get()->pluck('name', 'code')"
                                 label="Kota/Kabupaten"
                                 name="item.city_code"
                                 wire:model="item.province_code"/>
                @if(isset($item['city_code']))
                    <x-default-input type="select"
                                     :option="\Laravolt\Indonesia\Models\District::where('city_code', $item['city_code'])->get()->pluck('name', 'code')"
                                     label="Kecamatan/Distrik"
                                     name="item.district_code"
                                     wire:model="item.city_code"/>
                @else
                    <x-default-input type="select"
                                     :option="[]"
                                     label="Kecamatan/Distrik"
                                     name="item.district_code"/>

                @endif
                @if(isset($item['district_code']))
                    <x-default-input type="select"
                                     :option="\Laravolt\Indonesia\Models\Village::where('district_code', $item['district_code'])->get()->pluck('name', 'id')"
                                     label="Desa"
                                     name="item.village_id"/>
                @else
                    <x-default-input type="select"
                                     :option="[]"
                                     label="Desa"
                                     name="item.village_id"
                                     wire:model="item.district_code"/>
                @endif
                <div>
                    <x-tall-crud-label>No. TPS</x-tall-crud-label>
                    <x-tall-crud-input class="block mt-1 w-full" type="text" wire:model="item.tps"/>
                    @error('item.tps')
                    <x-tall-crud-error-message>{{$message}}</x-tall-crud-error-message> @enderror
                </div>
                <div>
                    <x-tall-crud-label>No. HP</x-tall-crud-label>
                    <x-tall-crud-input class="block mt-1 w-full" type="text" wire:model="item.no_hp"/>
                    @error('item.no_hp')
                    <x-tall-crud-error-message>{{$message}}</x-tall-crud-error-message> @enderror
                </div>
                    <x-default-input type="file"
                                        label="Foto"
                                        name="item.foto"/>
                <x-default-input type="text" name="item.email" label="username"/>
                <x-default-input type="text" name="item.password" label="password"/>
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
                    <x-tall-crud-label>NIK</x-tall-crud-label>
                    <x-tall-crud-input class="block mt-1 w-full" type="text" wire:model="item.nik"/>
                    @error('item.nik')
                    <x-tall-crud-error-message>{{$message}}</x-tall-crud-error-message> @enderror
                </div>
                <div>
                    <x-tall-crud-label>Nama Lengkap</x-tall-crud-label>
                    <x-tall-crud-input class="block mt-1 w-full" type="text" wire:model="item.nama"/>
                    @error('item.nama')
                    <x-tall-crud-error-message>{{$message}}</x-tall-crud-error-message> @enderror
                </div>
                <x-default-input type="select"
                                 :option="\Laravolt\Indonesia\Models\City::whereHas('province', function ($query) {
                                     $query->where('name', 'papua');
                                    })->get()->pluck('name', 'code')"
                                 label="Kota/Kabupaten"
                                 name="item.city_code"
                                 wire:model="item.province_code"/>
                @if(isset($item['city_code']))
                    <x-default-input type="select"
                                     :option="\Laravolt\Indonesia\Models\District::where('city_code', $item['city_code'])->get()->pluck('name', 'code')"
                                     label="Kecamatan/Distrik"
                                     name="item.district_code"
                                     wire:model="item.city_code"/>
                @else
                    <x-default-input type="select"
                                     :option="[]"
                                     label="Kecamatan/Distrik"
                                     name="item.district_code"/>

                @endif
                @if(isset($item['district_code']))
                    <x-default-input type="select"
                                     :option="\Laravolt\Indonesia\Models\Village::where('district_code', $item['district_code'])->get()->pluck('name', 'id')"
                                     label="Desa"
                                     name="item.id"/>
                @else
                    <x-default-input type="select"
                                     :option="[]"
                                     label="Desa"
                                     name="item.id"
                                     wire:model="item.district_code"/>
                @endif
                <div>
                    <x-tall-crud-label>No. TPS</x-tall-crud-label>
                    <x-tall-crud-input class="block mt-1 w-full" type="text" wire:model="item.tps"/>
                    @error('item.tps')
                    <x-tall-crud-error-message>{{$message}}</x-tall-crud-error-message> @enderror
                </div>
                <div>
                    <x-tall-crud-label>No. HP</x-tall-crud-label>
                    <x-tall-crud-input class="block mt-1 w-full" type="text" wire:model="item.no_hp"/>
                    @error('item.no_hp')
                    <x-tall-crud-error-message>{{$message}}</x-tall-crud-error-message> @enderror
                </div>
                <x-default-input type="file"
                                 label="Foto"
                                 name="item.foto"/>
                <x-default-input type="text" name="item.email" label="username"/>
                <x-default-input type="text" name="item.password" label="password"/>
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-tall-crud-button wire:click="$set('confirmingItemEdit', false)">Cancel</x-tall-crud-button>
            <x-tall-crud-button mode="add" wire:loading.attr="disabled" wire:click="editItem()">Save
            </x-tall-crud-button>
        </x-slot>
    </x-tall-crud-dialog-modal>
</div>
