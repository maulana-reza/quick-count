<x-perfect-scrollbar as="nav" aria-label="main" class="flex flex-col flex-1 gap-4 px-3 ">
    @php($user = auth()->user())
    @foreach(config('nav') as $key => $item)
        @if(count(@$item['child'] ?: []) <= 0 && $user->can($item['can']))
            <x-sidebar.link :title="ucfirst($key)" href="{{ route($item['route']) }}"
                            :isActive="request()->routeIs($item['route'])">
                <x-slot name="icon">
                    <div class="flex-shrink-0 w-6 h-6">
                        @svg($item['icon'])
                    </div>
                </x-slot>
            </x-sidebar.link>
        @elseif($user->can($item['can']))
            <x-sidebar.dropdown :title="ucfirst($key)" :active="Str::startsWith(request()->route()->uri(), 'buttons')">
                <x-slot name="icon">
                    <x-heroicon-o-view-columns class="flex-shrink-0 w-6 h-6" aria-hidden="true"/>
                </x-slot>
                @foreach($item['child'] as $k => $child)
                    @if(isset($child['can']) && $user->can($child['can']))
                        <x-sidebar.sublink :title="$k" href="{{ route($child['route']) }}"
                                           :active="request()->routeIs('buttons.text')"/>
                    @elseif(!isset($child['can']))
                        <x-sidebar.sublink :title="$k" href="{{ route($child['route']) }}"
                                           :active="request()->routeIs('buttons.text')"/>
                    @endif
                @endforeach
            </x-sidebar.dropdown>
        @endif
    @endforeach
    <div>
        <x-label class="text-base font-medium whitespace-nowrap" x-show="isSidebarOpen || isSidebarHovered">Hak akses</x-label>
        <div class="bg-turquoise-500 py-1 px-3 rounded text-white my-2 shadow text-sm" x-show="isSidebarOpen || isSidebarHovered">
            {!! \Illuminate\Support\Facades\Auth::user()->roles->implode('name', '</div><div class="text-white bg-orange-eval-0 py-1 px-3 rounded my-2 shadow">') !!}
        </div>
    </div>
    {{-- <x-sidebar.link title="Dashboard" href="{{ route('dashboard') }}" :isActive="request()->routeIs('dashboard')" /> --}}
    {{-- <x-sidebar.dropdown title="Buttons" :active="Str::startsWith(request()->route()->uri(), 'buttons')">
        <x-slot name="icon">
            <x-heroicon-o-view-grid class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>
        <x-sidebar.sublink title="Text button" href="{{ route('buttons.text') }}"
            :active="request()->routeIs('buttons.text')" />
        <x-sidebar.sublink title="Icon button" href="{{ route('buttons.icon') }}"
            :active="request()->routeIs('buttons.icon')" />
        <x-sidebar.sublink title="Text with icon" href="{{ route('buttons.text-icon') }}"
            :active="request()->routeIs('buttons.text-icon')" />
    </x-sidebar.dropdown> --}}

</x-perfect-scrollbar>
