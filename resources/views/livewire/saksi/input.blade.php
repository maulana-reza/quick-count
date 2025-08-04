<div class="grid grid-cols-1 gap-2">
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
                         name="item.district_code"/>
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
                         name="item.village_id"/>
    @endif
    <x-default-input type="file" name="item.foto" label="Formulir C1"/>
    <div>
        <x-label for="item.paslon" class="mb-2">Suara Pasangan Calon</x-label>
        <div class="grid md:grid-cols-3 grid-cols-1 gap-2">
            @foreach(\App\Models\Paslon::all() as $key => $value)
                <div class="grid grid-cols-1 gap-2 border bg-white p-3 rounded-md">
                    @if($value->foto_kepala)
                        <img src="{{ $value->image_asset }}" alt="{{ $value->name }}"
                             class="object-cover rounded mb-2 w-full">
                    @else
                        <div class="h-20 w-full bg-gray-200 rounded mb-2">
                            No Image
                        </div>
                    @endif
                    <x-default-input type="number"
                                     name="item.{{ $value->id }}"
                                     label="{{ $value->name }}"/>
                </div>
            @endforeach
        </div>
    </div>
    <x-default-input type="number" name="item.suara_tidak_sah" label="Suara Tidak Sah"/>
    <div x-data="{ isOpen: false }" class="w-full mt-4 my-5">
        <div class="flex items-center gap-2 w-full justify-center ">
            <x-label class="text-turquoise-500 flex gap-2 hover:cursor-pointer " @click="isOpen = !isOpen">
                <x-icon name="heroicon-o-information-circle" class="h-5 w-5"/>
                Buat Laporan Pengaduan
            </x-label>
        </div>
        <div x-show="isOpen" class="grid grid-cols-1 gap-2 mt-2">
            <x-default-input type="textarea" name="item.laporan_kejadian" label="Keterangan Laporan"/>
            <x-default-input type="file" name="item.laporan" label="Unggah Bukti Laporan"/>
        </div>
    </div>
    <x-button type="submit" class="mt-2 flex gap-4" wire:click="save">
        <x-icon name="heroicon-o-check" class="h-5 w-5"/>
        Simpan
    </x-button>
</div>
