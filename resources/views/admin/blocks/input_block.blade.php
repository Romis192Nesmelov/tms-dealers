<div class="mb-3">
    @if (isset($label) && $label)
        <label {{ isset($name) ? 'for='.$name : '' }}>{{ $label }}</label>
    @endif
    <div class="form-group {{ count($errors) && $errors->has($name) ? "error" : '' }}">
        <input
            type="{{ isset($type) && $type ? $type : 'text' }}"
            name="{{ $name }}" {{ isset($step) ? 'step='.$step : '' }}
            value="{{ old($name, ($value ?? '')) }}"
            class="@error($name) error @enderror form-control"
            placeholder="{{ isset($placeholder) && $placeholder ? $placeholder : '' }}"
            {{ isset($min) ? (!isset($type) || $type == 'text' ? 'minlength=' : 'min=').$min : '' }}
            {{ isset($max) ? (!isset($type) || $type == 'text' ? 'maxlength=' : 'max=').$max : '' }}
            {{ isset($step) ? 'step='.$step : '' }}
            {{ isset($disabled) && $disabled ? 'disabled=disabled' : '' }}
        >
        @error($name)
            @include('admin.blocks.error_block')
        @enderror
    </div>
</div>
