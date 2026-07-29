<select id="{{ $id ?? $name ?? '' }}" name="{{ $name ?? '' }}" class="{{ $class ?? '' }}" size="{{ $size ?? 1 }}" {{ isset($multiple) && $multiple ? 'multiple' : '' }}>
	@isset($placeholder)
		<option value="">{{ $placeholder }}</option>
	@endisset
	@if(isset($options) && is_array($options))
		@foreach($options as $key => $option)
			<option value="{{ $option[$option_value] ?? null }}"
			        @if(isset($value) && !is_array($value) && $value == ($option[$option_value] ?? null)) selected @endif
					@if(isset($value) && is_array($value) && in_array(($option[$option_value] ?? null), $value)) selected @endif
					@if(isset($data) && is_array($data))
						@foreach($data as $data_key => $data_val)
							data-{{ $data_key }}="{{ $option[$data_val] ?? null }}"
					@endforeach
					@endif
			>
				@php
					$finalOptionLabel = preg_replace_callback('/\{(.*?)}/i', function($matches) use ($option) {
						$matchKey = $matches[1] ?? null;
						if ($matchKey) {
							return $option[$matchKey] ?? null;
						}
						return null;
					}, $option_label);
					echo $finalOptionLabel;
				@endphp
			</option>
		@endforeach
	@endif
</select>