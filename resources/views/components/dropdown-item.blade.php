@props([
    'href' => '#',
    'active' => false,
])

<a href="{{ $href }}"
    class="{{ $active ? 'bg-gray-100 dark:bg-gray-600' : '' }} block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
    role="menuitem">
    {{ $slot }}
</a>