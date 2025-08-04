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
    <x-default-input type="file" name="item.formulir" label="Formulir C1"/>
    <div>
        <x-label for="item.formulir" class="mb-2">Suara Pasangan Calon</x-label>
        <div class="grid md:grid-cols-3 grid-cols-1 gap-2">
            @foreach(\App\Models\Paslon::all() as $key => $value)
                <div class="grid grid-cols-1 gap-2 border bg-white p-3 rounded-md">
                    <img src="{{ $value->image_asset }}" alt="{{ $value->name }}"
                         class="object-cover rounded mb-2 w-full">
                    <x-default-input type="number"
                                     name="item.{{ $value->id }}"
                                     label="{{ $value->name }}"/>
                </div>
            @endforeach
        </div>
    </div>
    <x-default-input type="number" name="item.suara_tidak_sah" label="Suara Tidak Sah"/>
    <x-button type="submit" class="mt-2 flex gap-4">
        <x-icon name="heroicon-o-check" class="h-5 w-5"/>
        Simpan
    </x-button>
</div>
