@props([
    'buttonId' => 'dropdownButton',
    'dropdownId' => 'dropdownMenu',
    'buttonText' => 'Dropdown',
    'imgUrl' => null,
    'icon' => null,
])

<div>
    <button type="button"
        class="flex rounded-full bg-gray-800 text-sm focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"
        id="{{ $buttonId }}" aria-expanded="false" data-dropdown-toggle="{{ $dropdownId }}">
        <span class="sr-only">Open {{ $buttonText }} menu</span>
        @if ($imgUrl)
            <img class="h-8 w-8 rounded-full" src="{{ $imgUrl }}" alt="user photo">
        @elseif($icon)
            {{ $icon }}
        @else
            {{ $buttonText }}
        @endif

    </button>
</div>

<div class="z-50 my-4 hidden list-none divide-y divide-gray-100 rounded bg-white text-base shadow dark:divide-gray-600 dark:bg-gray-700"
    id="{{ $dropdownId }}">
    <div class="px-4 py-3" role="none">
        {{ $slot }}
    </div>
</div>
