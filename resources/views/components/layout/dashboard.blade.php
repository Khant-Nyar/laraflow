<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="csrf-token" content="{{ csrf_token() }}">
        @isset($title)
            {{ $title }}
        @endisset
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif
        @stack('styles')

    </head>

    <body class="bg-gray-50 dark:bg-gray-800">

        @isset($nav)
            {{ $nav }}
        @endisset

        <div class="flex overflow-hidden bg-gray-50 pt-16 dark:bg-gray-900">

            @isset($sidebar)
                {{ $sidebar }}
            @endisset

            <div id="main-content" class="relative h-full w-full overflow-y-auto bg-gray-50 dark:bg-gray-900 lg:ml-64">
                <main>

                    {{ $slot }}

                    <p class="my-10 text-center text-sm text-gray-500">
                        &copy; <span id="currentYear"></span> <a href="{{ config('app.url') }}" class="hover:underline"
                            target="_blank">{{ config('app.name') }}</a>. All rights reserved.
                    </p>
                    <script>
                        document.addEventListener("DOMContentLoaded", function() {
                            const currentYear = new Date().getFullYear();
                            document.getElementById('currentYear').innerText = currentYear;
                        });
                    </script>
                </main>
            </div>
        </div>

        @stack('modals')

        @stack('scripts')
    </body>

</html>
