<div class="grid md:grid-cols-2 grid-cols-1 gap-4 custom-scrollbar">
    @livewire('admin-saksi.log',[], key('admin-saksi-log'))
    <div class="custom-scrollbar" wire:ignore.self>
        <div
            wire:poll.5s
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
                    <th class="px-3 py-2 text-xs whitespace-pre-wrap">Nama</th>
                    <th class="px-3 py-2 text-xs whitespace-pre-wrap">No Hp</th>
                    <th class="px-3 py-2 text-xs whitespace-pre-wrap">Terakhir Login</th>
                    <th class="px-3 py-2 text-xs whitespace-pre-wrap">Terakhir Dilihat</th>
                </tr>
                </thead>

                <tbody>
                @forelse($users as $user)
                    <tr class="{{ $loop->even ? 'bg-gray-100 dark:bg-dark-eval-2' : 'bg-white dark:bg-dark-eval-1' }}">
                        <td class="px-3 py-2 text-xs whitespace-pre-wrap"><span
                                class="text-green-500 text-xs">🟢</span> {{ $user->name ?? '-' }}({{$user->roles->pluck('name')->implode(', ')}})</td>
                        <td class="px-3 py-2 text-xs whitespace-pre-wrap">{!! \App\Helpers\Menu::chatWhatsapp($user->no_hp) !!}</td>
                        <td class="px-3 py-2 text-xs whitespace-pre-wrap">{{ $user->last_login_at ?? '-' }}</td>
                        <td class="px-3 py-2 text-xs whitespace-pre-wrap">{{ $user->last_seen_at ?? '-' }}</td>
                    </tr>
                @empty
                    <tr class="bg-white">
                        <td colspan="4" class="text-center py-4 text-gray-500 text-xs">
                            Tidak ada pengguna aktif.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
            <div>
                {!! $users->links() !!}
            </div>
        </div>
    </div>
</div>
