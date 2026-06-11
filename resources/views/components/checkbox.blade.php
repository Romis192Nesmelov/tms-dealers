@props(['name' => null, 'checked' => false, 'label' => ''])
<div class="w-full flex items-center mb-4">
    <input type="checkbox" name="{{ $name }}" {{ $checked ? 'checked=checked' : '' }} class="w-4 h-4 text-green-600 rborder-gray-300 focus:ring-green-500">
    <label for="default-checkbox" class="ml-2 text-sm font-medium text-white dark:text-gray-300">{{ $label }}</label>
</div>
