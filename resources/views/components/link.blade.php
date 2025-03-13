@props(['active' => false])

<a {{ $attributes }} style="{{ $active ? 'font-weight: 700 !important; color: purple !important' : '' }}"
    class="{{ $active ? 'active' : '' }}">
    {{ $slot }}
</a>
