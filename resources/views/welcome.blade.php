<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @livewireStyles
    @vite(['resources/css/app.css'])
</head>
<body class="antialiased font-sans bg-gray-100 text-gray-900 dark:bg-dark-eval-0 dark:text-gray-200">
@livewire('tall-crud-generator')
</body>
@livewireScripts
</html>
