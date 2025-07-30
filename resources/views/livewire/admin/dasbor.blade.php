<div class="grid grid-cols-1 gap-4">
    <x-label class="text-2xl font-semibold">
        Rekap Data
    </x-label>
    <div class="grid md:grid-cols-4 grid-cols-1 gap-2">
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
                {{--                    <x-button wire:click="download('{{ $data['label'] }}')">--}}
                {{--                        @svg('heroicon-o-arrow-down-on-square', 'h-5 w-5')--}}
                {{--                    </x-button>--}}
            </div>
        @endforeach
    </div>
    <div class="grid gap-4 md:grid-cols-5 ">
        <div class="md:col-span-3">
            @livewire('admin-saksi.log')
        </div>
        <div wire:init="getActiveUsers" class="md:col-span-2 rounded dark:bg-dark-eval-1 overflow-hidden" wire:polling.3s="getActiveUsers">
            <x-label>
                Pengguna Aktif
            </x-label>
            <table class="w-full my-4 whitespace-nowrap rounded shadow overflow-hidden"
                   wire:loading.class.delay="opacity-50">
                <thead class="bg-turquoise-500 dark:text-white text-white font-bold">
                <tr class="">
                    <th class="px-3 py-2">
                        Nama
                    </th>
                    <th class="px-3 py-2">
                        No Hp
                    </th>
                    <th class="px-3 py-2">
                        Terakhir Login
                    </th>
                    <th class="px-3 py-2">
                        Terakhir Dilihat
                    </th>
                </tr>
                </thead>
                <tbody class="divide-y divide-">
                @forelse($activeUsers as $user)
                    <tr class="text-left {{ $loop->even ? 'bg-gray-100 dark:bg-dark-eval-2' : 'bg-white dark:bg-dark-eval-1' }}">
                        <td class="px-3 py-2 text-sm whitespace-pre-wrap">{{ $user['name'] }}</td>
                        <td class="px-3 py-2 text-sm whitespace-pre-wrap">{{ $user['no_hp'] }}</td>
                        <td class="px-3 py-2 text-sm whitespace-pre-wrap">{{ $user['last_login_at'] }}</td>
                        <td class="px-3 py-2 text-sm whitespace-pre-wrap">{{ $user['last_seen_at'] }}</td>
                    </tr>
                @empty
                    <tr class="bg-white">
                        <td class="text-center py-4 text-gray-500" colspan="4">
                            Tidak ada pengguna aktif.
                        </td>
                    </tr>
                @endforelse
            </table>
        </div>
    </div>
</div>
