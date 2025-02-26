@props(['active' => false])

<a href="javascript:void(0);" style="{{ $active ? 'background-color: purple !important; color:#fff !important;' : '' }}"
    class="subdrop {{ $active ? 'active' : '' }}">
    <i data-feather="users"></i><span style="{{ $active ? 'color:#fff !important;' : '' }}">{{ $slot }}</span>
    <span class="menu-arrow"></span>
</a>
