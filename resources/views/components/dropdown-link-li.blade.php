@props(['active'])

@php
$classes = $active ?? false ? 'active treeview' : 'treeview';
@endphp

<li {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</li>
