@props([
    'name',
    'position' => 'right',
    'title'
])

@php
$position = [
    'right' => 'hs-overlay hs-overlay-open:translate-x-0 hidden translate-x-full fixed top-0 right-0 transition-all duration-300 transform h-full max-w-xs w-full w-full z-[70] bg-white border-l dark:bg-gray-800 dark:border-gray-700 hidden',
    'left' => 'hs-overlay-open:translate-x-0 hidden -translate-x-full fixed top-0 left-0 transition-all duration-300 transform h-full max-w-xs w-full w-full z-[70] bg-white border-r dark:bg-gray-800 dark:border-gray-700 hidden',
    'top' => 'hs-overlay-open:translate-y-0 -translate-y-full fixed top-0 inset-x-0 transition-all duration-300 transform max-h-40 h-full w-full z-[70] bg-white border-b dark:bg-gray-800 dark:border-gray-700 hidden',
    'bottom' => 'hs-overlay-open:translate-y-0 translate-y-full fixed bottom-0 inset-x-0 transition-all duration-300 transform max-h-40 h-full w-full z-[70] bg-white border-b dark:bg-gray-800 dark:border-gray-700 hidden',
][$position];
@endphp

<div id="{{$name}}" class="hs-overlay {{ $position }}" tabindex="-1">
    <div class="flex justify-between items-center py-3 px-4 border-b dark:border-gray-700">
        <h3 class="font-bold text-gray-800 dark:text-white">
            {{ $title }}
        </h3>
        <button data-hs-overlay="#{{$name}}" type="button" class="inline-flex flex-shrink-0 justify-center items-center h-8 w-8 rounded-md text-gray-500 hover:text-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2 focus:ring-offset-white text-sm dark:text-gray-500 dark:hover:text-gray-400 dark:focus:ring-gray-700 dark:focus:ring-offset-gray-800">
            <span class="sr-only">Close modal</span>
            <i class="bi bi-x-lg"></i>
        </button>
    </div>
    <div class="p-4">
        {{ $slot }}
    </div>
</div>
