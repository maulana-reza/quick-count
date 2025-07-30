<div>
    <div class="bg-white rounded-lg px-4 py-4 custom-scrollbar dark:bg-dark-eval-1 grid grid-cols-1 gap-4">
        <div class="flex justify-between">
            <div class="text-2xl">Saksi</div>
            <x-button type="submit" wire:click="$dispatchTo('saksi-reference-child', 'showCreateForm');"
                      class="text-blue-500">
                <x-tall-crud-icon-add/>
            </x-button>
        </div>
        <div class="">
            <div class="flex justify-between">
                <div class="flex">
                    <x-tall-crud-input-search/>
                </div>
                <div class="flex">
                    <x-tall-crud-page-dropdown/>
                </div>
            </div>
        </div>
        <table class="w-full whitespace-nowrap rounded shadow overflow-hidden"
               wire:loading.class.delay="opacity-50">
            <thead class="bg-turquoise-500 dark:text-white text-white font-bold">
            <tr class="">
                <td class="px-3 py-2">NIK</td>
                <td class="px-3 py-2">Nama Lengkap</td>
                <td class="px-3 py-2">No. TPS</td>
                <td class="px-3 py-2">No. HP</td>
                <td class="px-3 py-2">Foto</td>
                <td class="px-3 py-2">Actions</td>
            </tr>
            </thead>
            <tbody class="divide-y divide-">
            @forelse($results as $result)
                <tr class="text-left {{ $loop->even ? 'bg-gray-100 dark:bg-dark-eval-2' : 'bg-white dark:bg-dark-eval-1' }}">
                    <td class="px-3 py-2">{{ $result->nik }}</td>
                    <td class="px-3 py-2">{{ $result->nama }}</td>
                    <td class="px-3 py-2">{{ $result->tps }}</td>
                    <td class="px-3 py-2">{{ $result->no_hp }}</td>
                    <td class="px-3 py-2">{{ $result->foto }}</td>
                    <td class="px-3 py-2">
                        <button type="submit"
                                wire:click="$dispatchTo('saksi-reference-child', 'showEditForm', { saksi: {{ $result->id}} });"
                                class="text-green-500">
                            <x-tall-crud-icon-edit/>
                        </button>
                        <button type="submit"
                                wire:click="$dispatchTo('saksi-reference-child', 'showDeleteForm', { saksi: {{ $result->id}} });"
                                class="text-red-500">
                            <x-tall-crud-icon-delete/>
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td class="text-center py-4 text-gray-500">
                        No records found.
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
        <div class="mt-4">
            {{ $results->links() }}
        </div>
        @livewire('saksi-reference-child')
    </div>
</div>
