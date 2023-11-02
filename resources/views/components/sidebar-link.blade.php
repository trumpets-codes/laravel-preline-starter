@props(['active'])

@php
    $classes = ($active ?? false)
                ? 'flex items-center gap-x-3.5 py-2 px-2.5 bg-gray-100 text-sm text-slate-700 rounded-md hover:bg-gray-100
                   dark:bg-gray-900 dark:text-white'
                : 'flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-slate-700 rounded-md hover:bg-gray-100
                   dark:hover:bg-gray-900 dark:text-slate-400 dark:hover:text-slate-300';
@endphp

<li>
    <a {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </a>
</li>
