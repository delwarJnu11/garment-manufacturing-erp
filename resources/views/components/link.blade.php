@props(['active' => false])

<<<<<<< HEAD
<a {{ $attributes }}
    style="{{ $active ? 'font-weight: 700 !important; border-bottom: 2px solid purple !important; display: inline !important;' : '' }}">
=======
<a {{ $attributes }} style="{{ $active ? 'font-weight: 700 !important; color: purple !important' : '' }}"
    class="{{ $active ? 'active' : '' }}">
>>>>>>> 7c40f0dea86f966e4005cebcd01b5c1cca453ac4
    {{ $slot }}
</a>
