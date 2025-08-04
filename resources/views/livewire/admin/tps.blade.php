<div class="grid grid-cols-1 gap-4 custom-scrollbar dark:bg-dark-eval-1 ">
    <x-label class="text-2xl font-semibold">
        Detail Progress TPS Per Distrik/Kecamatan
    </x-label>
    <div class="flex justify-between">
        <div class="flex">
            <x-tall-crud-input-search/>
        </div>
    </div>
    <div class="w-full">
        <table class="w-full whitespace-nowrap rounded dark:border-turquoise-500 table-bordered table overflow-hidden"
               wire:ignore.self
               wire:poll.5s
               wire:loading.class.delay="opacity-50">
            <thead class="bg-turquoise-500 dark:text-white text-white font-bold">
            <tr>
                <td class="px-3 py-2 text-xs whitespace-pre-wrap">Provinsi - Kab/Kota - Kecamatan/Distrik - Kel/Desa</td>
                <td class="px-3 py-2 text-xs whitespace-pre-wrap" width="200">Jml. Suara Sah</td>
                <td class="px-3 py-2 text-xs whitespace-pre-wrap" width="200">Jml. Suara Tidak Sah</td>
                {{--            <td class="px-3 py-2" width="200">Aksi</td>--}}
            </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 border">
            @forelse($tps as $tp)
                @php($suara = \App\Models\Formulir::countByDistrict($tp->code))
                @if(!isset($province[$tp->district->city->province_code]))
                    @php($province[$tp->district->city->province_code] = \App\Models\Formulir::countByProvince($tp->district->city->province_code))
                @endif
                @if(!isset($city[$tp->district->city_code]))
                    @php($city[$tp->district->city_code] = \App\Models\Formulir::countByCities($tp->district->city_code))
                @endif
                @if(!isset($district[$tp->district_code]))
                    @php($district[$tp->district_code] = \App\Models\Formulir::countByDistrict($tp->district_code))
                @endif
                <tr class="text-left {{ $loop->even ? 'bg-gray-100 dark:bg-dark-eval-2' : 'bg-white dark:bg-dark-eval-1' }}">
                    <td class="px-3 py-2 text-xs whitespace-pre-wrap">{!! $tp->province_name . ' (' .
                            ($province[$tp->district->city->province_code]['suara_sah'] ?? 0) . ' / ' .
                            ($province[$tp->district->city->province_code]['suara_tidak_sah'] ?? 0) . ') - ' .
                            $tp->city_name . ' (' .
                            ($city[$tp->district->city_code]['suara_sah'] ?? 0) . ' / ' .
                            ($city[$tp->district->city_code]['suara_tidak_sah'] ?? 0) . ') - ' .
                            $tp->district_name . ' (' .
                            ($district[$tp->district_code]['suara_sah'] ?? 0) . ' / ' .
                            ($district[$tp->district_code]['suara_tidak_sah'] ?? 0) . ') - ' .
                            $tp->name !!}</td>
                    <td class="px-3 py-2 text-xs whitespace-pre-wrap text-center font-bold">{{ $suara['suara_sah'] ?? 0 }}</td>
                    <td class="px-3 py-2 text-xs whitespace-pre-wrap text-center font-bold">{{ $suara['suara_tidak_sah'] ?? 0 }}</td>
                    {{--                <td class="px-3 py-2 text-xs whitespace-pre-wrap">--}}
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
    </div>
    <div class="w-full overflow-x-auto">
        {{ $tps->links() }}
    </div>
</div>
