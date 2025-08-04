<div class="custom-scrollbar grid grid-cols-1 gap-4">
    <div class="flex justify-between items-end">
        <div>
        </div>
        <x-button type="submit" wire:click="$dispatchTo('paslon-reference-child', 'showCreateForm');"
                  class="text-blue-500">
            <x-tall-crud-icon-add/>
        </x-button>
    </div>

    <div class="mt-6">
        <div class="flex justify-between">
            <div class="flex">
                <x-tall-crud-input-search/>
            </div>
            <div class="flex">

                <x-tall-crud-page-dropdown/>
                @livewire('paslon-reference-child')
            </div>
        </div>
    </div>
    <div class="w-full overflow-x-auto">
        <table class="w-full whitespace-nowrap rounded shadow overflow-hidden" wire:loading.class.delay="opacity-50">
            <thead class="bg-turquoise-500 dark:text-white text-white font-bold">
            <tr class="">
                <td class="px-3 py-2 text-xs whitespace-pre-wrap">Nama</td>
                <td class="px-3 py-2 text-xs whitespace-pre-wrap">Nama Wakil</td>
                <td class="px-3 py-2 text-xs whitespace-pre-wrap">No. Urut</td>
                <td class="px-3 py-2 text-xs whitespace-pre-wrap">Foto</td>
                <td class="px-3 py-2 text-xs whitespace-pre-wrap">Actions</td>
            </tr>
            </thead>
            <tbody class="divide-y divide-">
            @forelse($results as $result)
                <tr class="text-left {{ $loop->even ? 'bg-gray-100 dark:bg-dark-eval-2' : 'bg-white dark:bg-dark-eval-1' }}">
                    <td class="px-3 py-2 text-xs whitespace-pre-wrap">{{ $result->kepala }}</td>
                    <td class="px-3 py-2 text-xs whitespace-pre-wrap">{{ $result->wakil }}</td>
                    <td class="px-3 py-2 text-xs whitespace-pre-wrap">{{ $result->no_urut }}</td>
                    <td class="px-3 py-2 text-xs whitespace-pre-wrap">@if($result->foto_kepala)
                            <img src="{{ asset('storage/' . $result->foto_kepala) }}" alt="Foto Paslon"
                                 class="w-16 h-16 object-cover rounded">
                        @else
                            <span class="text-gray-500">No Photo</span>
                        @endif</td>
                    <td class="px-3 py-2 text-xs">
                        <div class="flex gap-2 items-center justify-content-center justify-items-center text-xs">
                            <x-button variant="warning" type="submit"
                                      wire:click="$dispatchTo('paslon-reference-child', 'showEditForm', { paslon: {{ $result->id}} });"
                                      class="text-green-500">
                                <x-tall-crud-icon-edit/>
                            </x-button>
                            <x-button variant="danger" type="submit"
                                      wire:click="$dispatchTo('paslon-reference-child', 'showDeleteForm', { paslon: {{ $result->id}} });"
                                      class="text-red-500">
                                <x-tall-crud-icon-delete/>
                            </x-button>
                        </div>
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
    </div>
    <div class="mt-4">
        {{ $results->links() }}
    </div>
</div>
