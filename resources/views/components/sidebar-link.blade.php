
@props(['active'])

@php
$classes = ($active === false)
            ? 'flex  text-gray-100 duration-700 hover:text-gray-800 items-center p-2 text-base font-normal hover:font-bold text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700'
            : 'flex  items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white bg-gray-100 dark:hover:bg-gray-700';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>