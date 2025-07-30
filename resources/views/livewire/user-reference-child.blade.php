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
                    <x-tall-crud-label>Name</x-tall-crud-label>
                    <x-tall-crud-input class="block mt-1 w-full" type="text" wire:model="item.name"/>
                    @error('item.name')
                    <x-tall-crud-error-message>{{$message}}</x-tall-crud-error-message> @enderror
                </div>
                <div>
                    <x-tall-crud-label>Username</x-tall-crud-label>
                    <x-tall-crud-input class="block mt-1 w-full" type="text" wire:model="item.email"/>
                    @error('item.email')
                    <x-tall-crud-error-message>{{$message}}</x-tall-crud-error-message> @enderror
                </div>
                <div>
                    <x-tall-crud-label>No Hp</x-tall-crud-label>
                    <x-tall-crud-input class="block mt-1 w-full" type="text" wire:model="item.no_hp"/>
                    @error('item.no_hp')
                    <x-tall-crud-error-message>{{$message}}</x-tall-crud-error-message> @enderror
                </div>
                <div>
                    <x-tall-crud-label>Password</x-tall-crud-label>
                    <x-tall-crud-input class="block mt-1 w-full" type="text" wire:model="item.password"/>
                    @error('item.password')
                    <x-tall-crud-error-message>{{$message}}</x-tall-crud-error-message> @enderror
                </div>
                {{--                <div>--}}
                {{--                    <x-tall-crud-label>Role</x-tall-crud-label>--}}
                {{--                    <x-tall-crud-select class="block mt-1 w-full" wire:model="item.role">--}}
                {{--                        <option value="">Select Role</option>--}}
                {{--                        @foreach(\App\Models\User::ROLES as $role)--}}
                {{--                            <option value="{{ $role }}">{{ $role }}</option>--}}
                {{--                        @endforeach--}}
                {{--                    </x-tall-crud-select>--}}
                {{--                    @error('item.role')--}}
                {{--                    <x-tall-crud-error-message>{{$message}}</x-tall-crud-error-message> @enderror--}}
                {{--                </div>--}}
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
                    <x-tall-crud-label>Name</x-tall-crud-label>
                    <x-tall-crud-input class="block mt-1 w-full" type="text" wire:model="item.name"/>
                    @error('item.name')
                    <x-tall-crud-error-message>{{$message}}</x-tall-crud-error-message> @enderror
                </div>
                <div>
                    <x-tall-crud-label>Username</x-tall-crud-label>
                    <x-tall-crud-input class="block mt-1 w-full" type="text" wire:model="item.email"/>
                    @error('item.email')
                    <x-tall-crud-error-message>{{$message}}</x-tall-crud-error-message> @enderror
                </div>
                <div>
                    <x-tall-crud-label>No Hp</x-tall-crud-label>
                    <x-tall-crud-input class="block mt-1 w-full" type="text" wire:model="item.no_hp"/>
                    @error('item.no_hp')
                    <x-tall-crud-error-message>{{$message}}</x-tall-crud-error-message> @enderror
                </div>
                <div>
                    <x-tall-crud-label>Password</x-tall-crud-label>
                    <x-tall-crud-input class="block mt-1 w-full" type="text" wire:model="item.password"/>
                    @error('item.password')
                    <x-tall-crud-error-message>{{$message}}</x-tall-crud-error-message> @enderror
                </div>
                {{--                <div>--}}
                {{--                    <x-tall-crud-label>Role</x-tall-crud-label>--}}
                {{--                    <x-tall-crud-select class="block mt-1 w-full" wire:model="item.role">--}}
                {{--                        <option value="">Select Role</option>--}}
                {{--                        @foreach(\App\Models\User::ROLES as $role)--}}
                {{--                            <option value="{{ $role }}">{{ $role }}</option>--}}
                {{--                        @endforeach--}}
                {{--                    </x-tall-crud-select>--}}
                {{--                    @error('item.role')--}}
                {{--                    <x-tall-crud-error-message>{{$message}}</x-tall-crud-error-message> @enderror--}}
                {{--                </div>--}}
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-tall-crud-button wire:click="$set('confirmingItemEdit', false)">Cancel</x-tall-crud-button>
            <x-tall-crud-button mode="add" wire:loading.attr="disabled" wire:click="editItem()">Save
            </x-tall-crud-button>
        </x-slot>
    </x-tall-crud-dialog-modal>
</div>
