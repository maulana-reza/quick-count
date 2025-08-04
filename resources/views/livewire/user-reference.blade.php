<div class="rounded-lg custom-scrollbar grid grid-cols-1 gap-4">
    <div class="flex justify-between">
        <div class="text-2xl">
        </div>
        <x-button type="submit" wire:click="$dispatchTo('user-reference-child', 'showCreateForm');"
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
        </div>

    </div>
    <div class="overflow-x-auto w-full">
        <table class="w-full whitespace-nowrap rounded shadow overflow-hidden"
               wire:loading.class.delay="opacity-50">
            <thead class="bg-turquoise-500 dark:text-white text-white font-bold">
            <tr class="">
                <td class="px-3 py-2 text-xs whitespace-pre-wrap">Name</td>
                <td class="px-3 py-2 text-xs whitespace-pre-wrap">Email</td>
                <td class="px-3 py-2 text-xs whitespace-pre-wrap">No Hp</td>
                <td class="px-3 py-2 text-xs whitespace-pre-wrap">Last Login At</td>
                <td class="px-3 py-2 text-xs whitespace-pre-wrap">Last Seen At</td>
                <td class="px-3 py-2 text-xs whitespace-pre-wrap">Actions</td>
            </tr>
            </thead>
            <tbody class="divide-y divide-">
            @forelse($results as $result)
                <tr class="text-left {{ $loop->even ? 'bg-gray-100 dark:bg-dark-eval-2' : 'bg-white dark:bg-dark-eval-1' }}">
                    <td class="px-3 py-2 text-xs whitespace-pre-wrap">{{ $result->name }}</td>
                    <td class="px-3 py-2 text-xs whitespace-pre-wrap">{{ $result->email }}</td>
                    <td class="px-3 py-2 text-xs whitespace-pre-wrap">{!! \App\Helpers\Menu::chatWhatsapp($result->no_hp) !!}</td>
                    <td class="px-3 py-2 text-xs whitespace-pre-wrap">{{ $result->last_login_at }}</td>
                    <td class="px-3 py-2 text-xs whitespace-pre-wrap">{{ $result->last_seen_at }}</td>
                    <td class="px-3 py-2 text-xs">
                        <div class="flex gap-2">
                            <x-button variant="warning" type="submit"
                                      wire:click="$dispatchTo('user-reference-child', 'showEditForm', { user: {{ $result->id}} });"
                                      class="text-green-500">
                                <x-tall-crud-icon-edit/>
                            </x-button>
                            <x-button variant="danger" type="submit"
                                      wire:click="$dispatchTo('user-reference-child', 'showDeleteForm', { user: {{ $result->id}} });"
                                      class="text-red-500 text-xs">
                                <x-tall-crud-icon-delete/>
                            </x-button>
                            <a href="{{ route('impersonate', ['id' => $result->id]) }}">
                                <x-button class="text-xs" variant="secondary" type="submit">
                                    Login Sebagai
                                </x-button>
                            </a>
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
    </div>
    <div class="mt-4">
        {{ $results->links() }}
    </div>
    @livewire('user-reference-child')
</div>
