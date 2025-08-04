<div class="custom-scrollbar grid grid-cols-1 gap-4">
    <div class="flex justify-between items-end justify-content-end">
        <div></div>
        <x-button type="submit" wire:click="$dispatchTo('call-center-reference-child', 'showCreateForm');"
                  class="text-blue-500">
            <x-tall-crud-icon-add/>
        </x-button>
    </div>
    <div class="flex justify-between">
        <div class="flex">
            <x-tall-crud-input-search/>
        </div>
        <div class="flex">

            <x-tall-crud-page-dropdown/>
            @livewire('call-center-reference-child')
        </div>
    </div>
    <table class="w-full my-4 whitespace-nowrap rounded shadow overflow-hidden"
           wire:loading.class.delay="opacity-50">
        <thead class="bg-turquoise-500 dark:text-white text-white font-bold">
        <tr class="">
            <td class="px-3 py-2  text-sm whitespace-pre-wrap">Nama</td>
            <td class="px-3 py-2  text-sm whitespace-pre-wrap">No Hp</td>
            <td class="px-3 py-2  text-sm whitespace-pre-wrap">Actions</td>
        </tr>
        </thead>
        <tbody class="divide-y border">
        @forelse($results as $result)
            <tr class="text-left {{ $loop->even ? 'bg-gray-100 dark:bg-dark-eval-2' : 'bg-white dark:bg-dark-eval-1' }}">
                <td class="px-3 py-2  text-sm whitespace-pre-wrap">{{ $result->nama }}</td>
                <td class="px-3 py-2  text-sm whitespace-pre-wrap">{{ $result->no_hp }}</td>
                <td class="px-3 py-2  text-sm whitespace-pre-wrap ">
                    <div class="flex gap-2 items-center justify-content-center justify-items-center text-xs">

                    <x-button variant="warning" type="submit"
                              wire:click="$dispatchTo('call-center-reference-child', 'showEditForm', { callcenter: {{ $result->id}} });"
                              class="text-green-500">
                        <x-tall-crud-icon-edit/>
                    </x-button>
                    <x-button variant="danger" type="submit"
                              wire:click="$dispatchTo('call-center-reference-child', 'showDeleteForm', { callcenter: {{ $result->id}} });"
                              class="text-red-500">
                        <x-tall-crud-icon-delete/>
                    </x-button>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td class="text-center py-4 text-gray-500">
                    No records found.
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>
    <div >
        {{ $results->links() }}
    </div>
</div>
