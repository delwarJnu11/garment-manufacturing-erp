<<<<<<< HEAD
<a {{$attributes}} class="{{request()->is('users') ? 'active': ''}}">{{$slot}}</a>
=======
@props(['active' => false])

<a {{ $attributes }}
    style="{{ $active ? 'font-weight: 700 !important; border-bottom: 2px solid purple !important; display: inline !important;' : '' }}"
    class="{{ $active ? 'active' : '' }}">
    {{ $slot }}
</a>
>>>>>>> a9792f43dbcf60dee82c98be2dc098fffdc46595
