<li>
    <a href="{{ $href }}"
        class="group flex items-center rounded-lg p-2 text-base text-gray-900 hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700">
        {{ $slot }}
        <span class="ml-3" sidebar-toggle-item>{{ $label }}</span>
    </a>
</li>
