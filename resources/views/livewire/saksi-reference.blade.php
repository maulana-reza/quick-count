<div class="custom-scrollbar dark:bg-dark-eval-1 grid grid-cols-1 gap-4">
    <div class="flex justify-between">
        <div class="text-2xl"></div>
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
    <div class="w-full overflow-x-auto">
        <table class="w-full whitespace-nowrap rounded shadow overflow-hidden"
               wire:loading.class.delay="opacity-50">
            <thead class="bg-turquoise-500 dark:text-white text-white font-bold">
            <tr class="">
                <td class="px-3 py-2 text-xs">NIK</td>
                <td class="px-3 py-2 text-xs">Nama Lengkap</td>
                <td class="px-3 py-2 text-xs">No. TPS</td>
                <td class="px-3 py-2 text-xs">No. HP</td>
                <td class="px-3 py-2 text-xs">Foto</td>
                <td class="px-3 py-2 text-xs">Actions</td>
            </tr>
            </thead>
            <tbody class="divide-y divide-">
            @forelse($results as $result)
                <tr class="text-left {{ $loop->even ? 'bg-gray-100 dark:bg-dark-eval-2' : 'bg-white dark:bg-dark-eval-0' }}">
                    <td class="px-3 py-2 whitespace-pre-wrap text-xs">{{ $result->nik }}</td>
                    <td class="px-3 py-2 whitespace-pre-wrap text-xs">{{ $result->nama }}</td>
                    <td class="px-3 py-2 whitespace-pre-wrap text-xs">{{ $result->tps }}</td>
                    <td class="px-3 py-2 whitespace-pre-wrap text-xs">{{ $result->no_hp }}</td>
                    <td class="px-3 py-2 whitespace-pre-wrap text-xs">
                        @if($result->foto)
                            <img src="{{ asset('storage/' . $result->foto) }}" alt="Foto Saksi"
                                 class="w-16 h-16 object-cover rounded">
                        @else
                            <span class="text-gray-500">No Photo</span>
                    @endif
                    <td class="px-3 py-2 gap-2 ">
                        <div class="flex gap-2 items-center justify-content-center justify-items-center text-xs">
                            <x-button type="submit"
                                      variant="warning"
                                      wire:click="$dispatchTo('saksi-reference-child', 'showEditForm', { saksi: {{ $result->id}} });"
                                      class="text-green-500 text-xs">
                                <x-tall-crud-icon-edit class="w-3 h-3"/>
                            </x-button>
                            <x-button type="submit"
                                      variant="danger"
                                      wire:click="$dispatchTo('saksi-reference-child', 'showDeleteForm', { saksi: {{ $result->id}} });"
                                      class="text-red-500 text-xs">
                                <x-tall-crud-icon-delete/>
                            </x-button>
                            @if(auth()->user()->can('manage users'))
                                <a href="{{ route('impersonate', ['id' => $result->id]) }}">
                                    <x-button variant="secondary" class="text-xs" type="submit">
                                        Login Sebagai
                                    </x-button>
                                </a>
                            @endif
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
    @livewire('saksi-reference-child')
</div>
