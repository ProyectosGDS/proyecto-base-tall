<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="tallstackui_darkTheme()">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $tabName ?? '' }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <!-- Styles / Scripts -->
        <tallstackui:script /> 
        @livewireStyles
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body 
        class="font-family antialiased text-gray-600 dark:text-gray-300"
        x-cloak
        x-data="{ name: @js(auth()->user()->name) }"
        x-on:name-updated.window="name = $event.detail.name"
        x-bind:class="{ 'dark bg-gray-900': darkTheme, 'bg-gray-100': !darkTheme }">

        <x-Side-Bar :pages="$pages" />
        <main class="p-2 lg:p-8 sm:ml-64">
            <div class="p-4 lg:p-8 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700">
                {{ $slot }}
            </div>
        </main>

        <x-toast />

        @stack('modals')
        @stack('scripts')
        
        @livewireScripts
    </body>
</html>
