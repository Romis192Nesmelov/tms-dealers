<div class="form-group has-feedback has-feedback-left {{ count($errors) && $errors->has($name) ? "error" : '' }} {{ $addClass ?? '' }}" {!! $attrString ?? '' !!}>
    @if (isset($label))
        <label {{ isset($name) ? 'for='.$name : '' }}>{{ $label }}</label>
    @endif
    <select name="{{ $name }}" class="form-control" {{ isset($disabled) && $disabled ? 'disabled=disabled' : '' }}>
        @if (is_array($values))
            @foreach ($values as $value => $options)
                <option value="{{ $value }}" {{ (!count($errors) ? $value == $selected : $value == old($name)) ? 'selected' : '' }}>{{ $options }}</option>
            @endforeach
        @else
            @foreach ($values as $value)
                <option {{ isset($value->ltd) ? 'ltd='.$value->ltd : '' }} value="{{ $value->id }}" {{ (!count($errors) ? $value->id == $selected : $value->id == old($name)) ? 'selected' : '' }}>{{ $value->name }}</option>
            @endforeach
        @endif
    </select>
    @error($name)
        @include('admin.blocks.error_block')
    @enderror
</div>
