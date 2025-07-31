<div class="grid grid-cols-1 gap-4 custom-scrollbar dark:bg-dark-eval-1">
    <x-label class="text-2xl font-semibold">
        Detail Progress TPS Per Distrik/Kecamatan
    </x-label>
    <div class="flex justify-between">
        <div class="flex">
            <x-tall-crud-input-search/>
        </div>
    </div>
    <table class="w-full whitespace-nowrap rounded dark:border-turquoise-500 table-bordered table overflow-hidden"
           wire:poll.5s
           wire:loading.class.delay="opacity-50">
        <thead class="bg-turquoise-500 dark:text-white text-white font-bold">
        <tr>
            <td class="px-3 py-2">Kecamatan</td>
            <td class="px-3 py-2" width="200">Jml. Suara Sah</td>
            <td class="px-3 py-2" width="200">Jml. Suara Tidak Sah</td>
            {{--            <td class="px-3 py-2" width="200">Aksi</td>--}}
        </tr>
        </thead>
        <tbody class="divide-y divide-gray-200 border">
        @forelse($tps as $tp)
            @php($suara = \App\Models\Formulir::countByDistrict($tp->code))
            <tr class="text-left {{ $loop->even ? 'bg-gray-100 dark:bg-dark-eval-2' : 'bg-white dark:bg-dark-eval-1' }}">
                <td class="px-3 py-2 text-sm whitespace-pre-wrap">{!! $tp->city_name .' - '.$tp->name !!}</td>
                <td class="px-3 py-2 text-sm whitespace-pre-wrap text-center font-bold">{{ $suara['suara_sah'] ?? 0 }}</td>
                <td class="px-3 py-2 text-sm whitespace-pre-wrap text-center font-bold">{{ $suara['suara_tidak_sah'] ?? 0 }}</td>
{{--                <td class="px-3 py-2 text-sm whitespace-pre-wrap">--}}
{{--                    <x-button class="flex-shrink" wire:click="showDetail({{ $tp->id }})">--}}
{{--                        <x-icon name="heroicon-o-eye" class="h-5 w-5"/>--}}
{{--                    </x-button>--}}
{{--                </td>--}}
            </tr>
        @empty
            <tr class="bg-white">
                <td colspan="4" class="text-center py-4 text-gray-500 border">
                    Tidak ada data TPS ditemukan.
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>
    <div>
        {{ $tps->links() }}
    </div>
</div>
