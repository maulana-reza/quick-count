<div class="grid grid-cols-1 gap-4 rounded-lg custom-scrollbar">
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
        <table class="w-full my-4 whitespace-nowrap rounded shadow overflow-hidden"
               wire:loading.class.delay="opacity-50">
            <thead class="bg-turquoise-500 dark:text-white text-white font-bold">
            <tr class="">
                <td class="px-3 py-2 text-xs whitespace-pre-wrap">#</td>
                <td class="px-3 py-2 text-xs whitespace-pre-wrap">Nama Saksi</td>
                <td class="px-3 py-2 text-xs whitespace-pre-wrap">Lokasi</td>
                <td class="px-3 py-2 text-xs whitespace-pre-wrap">Foto Formulir C1</td>
                <td class="px-3 py-2 text-xs whitespace-pre-wrap">Status Form</td>
                <td class="px-3 py-2 text-xs whitespace-pre-wrap">Actions</td>
            </tr>
            </thead>
            <tbody class="divide-y divide-">
            @forelse($results as $result)
                <tr class="text-left {{ $loop->even ? 'bg-gray-100 dark:bg-dark-eval-2' : 'bg-white dark:bg-dark-eval-0' }}">
                    <td class="px-3 py-2 text-xs whitespace-pre-wrap">{{ $loop->iteration+1 }}</td>
                    <td class="px-3 py-2 text-xs whitespace-pre-wrap">{{ $result->saksi->nama }}</td>
                    <td class="px-3 py-2 text-xs whitespace-pre-wrap">{{ \App\Models\Formulir::path($result->village_id) }} No. TPS {{$formulir->no_tps}}</td>
                    <td class="px-3 py-2 text-xs">@if($result->foto)<a href="#"
                                                                       onclick="window.open('{{ asset('storage/' . $result->foto) }}', 'popup', 'width=800,height=600,scrollbars=yes,resizable=yes'); return false;"
                                                                       class="text-blue-500 hover:underline">Lihat Foto
                        </a>
                        @else Tidak ada foto @endif
                    <td class="px-3 py-2 text-xs whitespace-pre-wrap">{{ $result->status_form }}</td>
                    <td class="px-3 py-2 text-xs">
                        <div class="flex gap-2 items-center justify-content-center justify-items-center text-xs">
                            <x-button variant="success" class="text-green-500 text-xs flex gap-2"
                                      wire:click="validateForm({{ $result->id }})">
                                <x-icon name="heroicon-o-check" class="h-4 w-4"/>
                                VALID
                            </x-button>
                            <x-button variant="danger" class="text-red-500 text-xs flex gap-2"
                                      wire:click="invalidateForm({{ $result->id }})">
                                <x-tall-crud-icon-delete/>
                                TIDAK VALID
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
        <x-tall-crud-confirmation-dialog wire:model="confirm">
            <x-slot name="title">Konfirmasi</x-slot>
            <x-slot name="content">
                @if($confirm == 1)
                    <div class="text-sm text-gray-700">
                        Apakah Anda yakin ingin menandai formulir ini sebagai valid?
                    </div>
                @elseif($confirm == 2)
                    <div class="text-sm text-gray-700">
                        Apakah Anda yakin ingin menandai formulir ini sebagai tidak valid?
                    </div>
                @endif
            </x-slot>
            <x-slot name="footer">
                <x-tall-crud-button variant="secondary" wire:click="$set('confirm', false)">
                    Batal
                </x-tall-crud-button>
                <x-tall-crud-button variant="success" wire:click="confirmFormulir">
                    @if($confirm == 1)
                        Ya, Tandai Valid
                    @elseif($confirm == 2)
                        Ya, Tandai Tidak Valid
                    @endif
                </x-tall-crud-button>
            </x-slot>
        </x-tall-crud-confirmation-dialog>
    </div>
    <div>
        {{ $results->links() }}
    </div>
</div>
