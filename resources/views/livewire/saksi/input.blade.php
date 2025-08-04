<div>

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
</div>
