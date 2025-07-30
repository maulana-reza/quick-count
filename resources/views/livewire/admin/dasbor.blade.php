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
            </div>
        @endforeach
    </div>
    <div>
        @livewire('admin.chart')
    </div>
    <div class="grid grid-cols-2 gap-4 custom-scrollbar dark:bg-dark-eval-1">
        <div>
            @livewire('admin-saksi.log')
        </div>
        <div class="custom-scrollbar dark:bg-dark-eval-1">
            <div
                wire:init
                wire:poll.3s
                class="grid grid-cols-1 gap-4"
            >
                <div>
                    <x-label class="text-2xl font-semibold m-0">
                        Pengguna Aktif
                    </x-label>
                </div>
                <div class="flex justify-between ">
                    <div class="flex">
                        <x-tall-crud-input-search/>
                    </div>
                </div>

                <table
                    class="w-full whitespace-nowrap rounded overflow-hidden table table-bordered dark:border-turquoise-500"
                    wire:loading.class.delay="opacity-50"
                >
                    <thead class="text-left bg-turquoise-500 text-white font-bold dark:text-white">
                    <tr>
                        <th class="px-3 py-2">Nama</th>
                        <th class="px-3 py-2">No Hp</th>
                        <th class="px-3 py-2">Terakhir Login</th>
                        <th class="px-3 py-2">Terakhir Dilihat</th>
                    </tr>
                    </thead>

                    <tbody>
                    @forelse($users as $user)
                        <tr class="{{ $loop->even ? 'bg-gray-100 dark:bg-dark-eval-2' : 'bg-white dark:bg-dark-eval-1' }}">
                            <td class="px-3 py-2 text-sm whitespace-pre-wrap"><span
                                    class="text-green-500 text-xs">🟢</span> {{ $user->name ?? '-' }} ({{$user->roles->pluck('name')->implode(', ')}})</td>
                            <td class="px-3 py-2 text-sm whitespace-pre-wrap">{!! \App\Helpers\Menu::chatWhatsapp($user->no_hp) !!}</td>
                            <td class="px-3 py-2 text-sm whitespace-pre-wrap">{{ $user->last_login_at ?? '-' }}</td>
                            <td class="px-3 py-2 text-sm whitespace-pre-wrap">{{ $user->last_seen_at ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr class="bg-white">
                            <td colspan="4" class="text-center py-4 text-gray-500">
                                Tidak ada pengguna aktif.
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
