@props([
    'logoUrl' => '',
    'title' => config('app.name'),
    'href' => '#',
])

<a href="{{ $href }}" class="ml-2 flex md:mr-24">
    @if ($logoUrl)
        <img src="{{ $logoUrl }}" class="mr-3 h-8" alt="{{ $title }}" />
    @endif
    <span class="self-center whitespace-nowrap text-xl font-semibold dark:text-white sm:text-2xl">
        {{ $title }}
    </span>
</a>
