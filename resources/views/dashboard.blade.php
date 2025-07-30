<x-app-layout>
    <x-slot name="header">
        {{ __('Dashboard') }}
    </x-slot>
    <div class="p-6 flex flex-col gap-6 overflow-hidden bg-white rounded-md shadow-md lg:flex-row md:justify-between dark:bg-dark-eval-1">
        <div>
            <x-label class="text-base font-medium whitespace-nowrap">Daftar pengguna Aktif</x-label>
        </div>
    </div>
</x-app-layout>
