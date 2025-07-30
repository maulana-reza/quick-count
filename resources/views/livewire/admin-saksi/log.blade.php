<div class="grid grid-cols-1 gap-4 custom-scrollbar dark:bg-dark-eval-1">
    <x-label class="text-2xl font-semibold">
        Aktivitas {{ $type ? \App\Models\User::ROLES[$type] : 'Pengguna (Saksi, Saksi Koordinator, Saksi Admin)' }}
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
            <td class="px-3 py-2" width="200">Timestamp</td>
            <td class="px-3 py-2" width="200">Nama Lengkap</td>
            <td class="px-3 py-2">Keterangan</td>
        </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
        @forelse($logs as $log)
            <tr class="text-left font-bold bg-turquoise-500 turquoise-500">
                <td class="px-3 py-2 text-sm whitespace-pre-wrap"
                    width="200">{{ $log->created_at->format('d-m-Y H:i:s') }}</td>
                <td class="px-3 py-2 text-sm whitespace-pre-wrap"
                    width="200">{{ $log->user->name ?? 'Unknown User' }} ({{$log->user->roles->pluck('name')->implode(', ')}})</td>
                <td class="px-3 py-2 text-sm whitespace-pre-wrap">{{ $log->ip_address }}</td>
            </tr>
        @empty
            <tr class="bg-white">
                <td colspan="3" class="text-center py-4 text-gray-500 border">
                    No logs found.
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>
    <div>
        {{ $logs->links() }}
    </div>
</div>
