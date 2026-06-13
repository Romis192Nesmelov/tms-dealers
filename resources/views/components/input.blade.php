@props(['disabled' => false, 'icon' => null, 'name' => null, 'value' => ''])
@if ($icon)
    <img class="icon-input" src="{{ asset('storage/images/'.$icon) }}" />
@endif
<div class="w-full mb-3">
    <input {{ $disabled ? 'disabled' : '' }} {{ 'name='.$name }} value="{{ $value }}" {!! $attributes->merge(['class' => 'w-full h-9 text-sm px-3 bg-white rounded-md '.($icon ? 'pl-7' : '').($name && $errors->count() && $errors->has($name) ? ' text-red-800 border-2 border-red-500' : ' text-gray-800')]) !!}>
    @error($name)
        <div class="w-full mt-2 text-red-500 font-semibold text-left">{{ $errors->first($name) }}</div>
    @enderror
</div>
