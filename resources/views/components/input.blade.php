@props(['disabled' => false, 'icon' => null, 'name' => null])
@if ($icon)
    <img class="icon-input" src="{{ asset('storage/images/'.$icon) }}" />
@endif
<div class="w-full mb-5">
    <input {{ $disabled ? 'disabled' : '' }} {{ 'name='.$name }} {!! $attributes->merge(['class' => 'w-full h-10 text-gray-800 px-3 bg-white rounded-md '.($icon ? 'pl-7' : '')]) !!}>
    @if ($name && $errors->count() && $errors->has($name))
        <div class="w-full mt-2 text-red-500 font-semibold text-left">{{ $errors->first($name) }}</div>
    @endif
</div>
