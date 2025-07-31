<div class="grid grid-cols-1 gap-4">
    <x-label class="text-2xl font-semibold">
        Rekap Data
    </x-label>
    <div>
        <div class="grid md:grid-cols-1 grid-cols-1 gap-2">
            @foreach($datas as $data)
                <div
                    class="flex gap-5 bg-white p-3 shadow rounded dark:bg-dark-eval-1 border-turquoise-500 border-t-[6px]">
                    <div>
                        @svg($data['icon'], 'h-12 w-12 text-gray-400')
                    </div>
                    <div class="ml-2 flex-grow">
                        <div class="text-sm text-gray-500">{{ $data['label'] }}</div>
                        <div class="text-2xl font-semibold">{!! $data['value'] !!}</div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    @livewire('admin.chart')
</div>
