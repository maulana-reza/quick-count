<div class="grid grid-cols-1 gap-4 dark:bg-dark-eval-1 rounded-lg custom-scrollbar">
    <div class="flex justify-between">
        <div class="flex">
            <x-tall-crud-input-search/>
        </div>
        <div class="flex">
            <x-tall-crud-page-dropdown/>
            @livewire('formulir-reference-child')
        </div>
    </div>
    <div class="overflow-x-auto w-full">
        <table class="w-full my-4 whitespace-nowrap rounded shadow overflow-scroll"
               wire:loading.class.delay="opacity-50">
            <thead class="bg-turquoise-500 dark:text-white text-white font-bold">
            <tr class="">
                <td class="px-3 py-2 text-xs whitespace-pre-wrap">Nama Saksi</td>
                <td class="px-3 py-2 text-xs whitespace-pre-wrap">Foto Formulir C1</td>
                <td class="px-3 py-2 text-xs whitespace-pre-wrap">Status Form</td>
                <td class="px-3 py-2 text-xs whitespace-pre-wrap">Actions</td>
            </tr>
            </thead>
            <tbody class="divide-y divide-">
            @forelse($results as $result)
                <tr class="text-left bg-turquoise-500 turquoise-500">
                    <td class="px-3 py-2 text-xs whitespace-pre-wrap">{{ $result->saksi->nama }}</td>
                    <td class="px-3 py-2 text-xs whitespace-pre-wrap">@if($result->foto_formulir)<a
                            href="{{ asset('storage/' . $result->foto_formulir) }}" target="_blank"
                            class="text-blue-500 hover:underline">Lihat Foto</a>@else Tidak ada foto @endif
                    <td class="px-3 py-2 text-xs whitespace-pre-wrap">{{ $result->status_form }}</td>
                    <td class="px-3 py-2 text-xs">
                        <div class="flex gap-2 items-center justify-content-center justify-items-center text-xs">

                            <x-button variant="danger" type="submit"
                                      wire:click="$dispatchTo('formulir-reference-child', 'showDeleteForm', { formulir: {{ $result->id}} });"
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
    <div>
        {{ $results->links() }}
    </div>
</div>
