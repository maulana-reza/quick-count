<div>
    <div class="bg-white rounded-lg px-4 py-4 custom-scrollbar dark:bg-dark-eval-1">
        <div class="flex justify-between">
            <div class="text-2xl">
            </div>
            <x-button type="submit" wire:click="$dispatchTo('user-reference-child', 'showCreateForm');"
                      class="text-blue-500">
                <x-tall-crud-icon-add/>
            </x-button>
        </div>
        <div class="mt-6">
            <div class="flex justify-between">
                <div class="flex">
                    <x-tall-crud-input-search/>
                </div>
                <div class="flex">
                    <x-tall-crud-page-dropdown/>
                </div>
            </div>
            <table class="w-full my-4 whitespace-nowrap rounded shadow overflow-hidden"
                   wire:loading.class.delay="opacity-50">
                <thead class="bg-turquoise-500 dark:text-white text-white font-bold">
                <tr class="">
                    <td class="px-3 py-2">Name</td>
                    <td class="px-3 py-2">Email</td>
                    <td class="px-3 py-2">No Hp</td>
                    <td class="px-3 py-2">Last Login At</td>
                    <td class="px-3 py-2">Last Seen At</td>
                    <td class="px-3 py-2">Actions</td>
                </tr>
                </thead>
                <tbody class="divide-y divide-">
                @forelse($results as $result)
                    <tr class="text-left {{ $loop->even ? 'bg-gray-100 dark:bg-dark-eval-2' : 'bg-white dark:bg-dark-eval-1' }}">
                        <td class="px-3 py-2 text-sm whitespace-pre-wrap">{{ $result->name }}</td>
                        <td class="px-3 py-2 text-sm whitespace-pre-wrap">{{ $result->email }}</td>
                        <td class="px-3 py-2 text-sm whitespace-pre-wrap">{{ $result->no_hp }}</td>
                        <td class="px-3 py-2 text-sm whitespace-pre-wrap">{{ $result->last_login_at }}</td>
                        <td class="px-3 py-2 text-sm whitespace-pre-wrap">{{ $result->last_seen_at }}</td>
                        <td class="px-3 py-2 text-sm whitespace-pre-wrap flex gap-2">
                            <x-button variant="warning" type="submit"
                                    wire:click="$dispatchTo('user-reference-child', 'showEditForm', { user: {{ $result->id}} });"
                                    class="text-green-500">
                                <x-tall-crud-icon-edit/>
                            </x-button>
                            <x-button variant="danger" type="submit"
                                    wire:click="$dispatchTo('user-reference-child', 'showDeleteForm', { user: {{ $result->id}} });"
                                    class="text-red-500">
                                <x-tall-crud-icon-delete/>
                            </x-button>
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
</div>
