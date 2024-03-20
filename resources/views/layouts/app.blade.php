<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/js/app.js'])
        <script src="{{ asset('js/vendor/tailwindcss/tailwind.3.4.1.min.js') }}"></script>
        <script defer src="{{ asset('js/vendor/flowbite/flowbite.2.3.0.min.js') }}"></script>
        <script defer src="{{ asset('js/vendor/ironwoods/traces.js') }}"></script>
        <script defer src="{{ asset('js/common/common.js') }}"></script>
        <script defer src="{{ asset('js/common/query.js') }}"></script>

        @stack('custom-scripts')

        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="font-sans antialiased">
        <div id="page-content"
            data-route="{{ getCurrentRoute() }}"
            data-base-route="{{ getAppRoute() }}">
        </div>

        <x-banner />

        <div class="min-h-screen bg-gray-100">
            @livewire('navigation-menu')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            @include('components.feedbacks.error')
            @include('components.feedbacks.success')
            @include('components.feedbacks.warn')

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        @stack('modals')

        @livewireScripts
    </body>
</html>
