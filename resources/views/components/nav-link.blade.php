@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 pt-1 border-b-2 border-[#e6ffcc] dark:border-[#b5df9f] text-sm font-medium leading-5 text-white dark:text-white focus:outline-none focus:border-white transition duration-150 ease-in-out'
            : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-white dark:text-[#b5df9f] hover:text-white dark:hover:text-white hover:border-[#b5df9f] dark:hover:border-[#b5df9f] focus:outline-none focus:text-white focus:border-gray-300 dark:focus:border-gray-700 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
