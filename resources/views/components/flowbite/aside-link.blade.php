@props(['active'])

@php
    $classes =
        $active ?? false
            ? 'flex items-center p-2 text-white rounded-lg dark:text-white hover:text-white dark:hover:text-gray-900 hover:bg-violet-600 dark:hover:bg-gray-700 group bg-violet-600 dark:bg-gray-700'
            : 'flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:text-white dark:hover:text-gray-900 hover:bg-violet-600 dark:hover:bg-gray-700 group';
@endphp

<li>
    <a {{ $attributes->merge(['class' => $classes]) }}>{{ $slot }}
    </a>
</li>
