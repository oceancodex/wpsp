<select id="{{ $id ?? $name ?? '' }}" name="{{ $name ?? '' }}" class="{{ $class ?? '' }}" size="{{ $size ?? 1 }}" {{ isset($multiple) && $multiple ? 'multiple' : '' }}>
    @isset($placeholder) <option>{{ $placeholder }}</option> @endisset
    @if(isset($options) && is_array($options))
        @foreach($options as $optionKey => $optionLabel)
            <option value="{{ $optionKey }}"
                    @if(isset($value) && !is_array($value) && $value == $optionKey) selected @endif
                    @if(isset($value) && is_array($value) && in_array($optionKey, $value)) selected @endif
            >
                {{ $optionLabel }}
            </option>
        @endforeach
    @endif
</select>