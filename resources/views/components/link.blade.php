@props(['active' => false])

<a {{ $attributes }}
    style="{{ $active ? 'font-weight: 700 !important; border-bottom: 2px solid purple !important; display: inline !important;' : '' }}"
    class="{{ $active ? 'active' : '' }}">
    {{ $slot }}
</a>
