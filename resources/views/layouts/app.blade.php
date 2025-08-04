<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('assets/favicon')}}/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('assets/favicon')}}/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets/favicon')}}/favicon-16x16.png">
    <link rel="manifest" href="{{asset('assets/favicon')}}/site.webmanifest">
    <title>{{ config('app.name') }}</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <!-- Styles -->
    <title>{{ config('app.name') }}</title>
    <!-- Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet"/>

    <!-- Styles -->
    <style>
        [x-cloak] {
            display: none;
        }

        * {
            font-family: "Poppins", sans-serif;
        }
        html {
            scroll-behavior: smooth;
        }
    </style>
    @livewireStyles
    <script src="{{ asset('assets/js/app.js') }}?key={{uniqid()}}"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased text-gray-900 dark:text-gray-200">
<div x-data="mainState" :class="{ dark: isDarkMode }" @resize.window="handleWindowResize" x-cloak>
    <x-banner/>

    <div class="min-h-screen text-gray-900 bg-gray-100 dark:bg-dark-eval-0 dark:text-gray-200">
        <!-- Sidebar -->
        <x-sidebar.sidebar/>

        <!-- Page Wrapper -->
        <div class="flex flex-col min-h-screen" :class="{
                    'lg:ml-64': isSidebarOpen,
                    'md:ml-16': !isSidebarOpen
                }" style="transition-property: margin; transition-duration: 150ms;">

            @livewire('navigation-menu')
            <x-mobile-bottom-nav/>
            <!-- Page Heading -->
            <header>
                <div class="px-4 py-6 mx-auto max-w-8xl w-full sm:px-6 lg:px-8">
                    <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                        <h2 class="text-xl font-semibold leading-tight">
                            {{ @$header ?? \App\Helpers\Menu::getMenuLabel(request()->route()->getName()) }}
                        </h2>
                    </div>

                </div>
            </header>
            <!-- Page Content -->
            <main class="flex-1 p-4 mx-auto max-w-8xl w-full sm:p-6 lg:p-8 mb-10">
                {{ $slot }}
            </main>
            <!-- Page Footer -->
            <x-footer/>
        </div>
    </div>
    @livewire('livewire-toast')
</div>


@stack('modals')
@stack('js')
@yield('js')
</body>
@livewireScripts

</html>
