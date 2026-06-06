<label for="_customize-input-{{ $control->id }}" class="customize-control-title">
	{{ esc_html($control->label) }} (Blade)
</label>

<span class="description customize-control-description">
    {{ esc_html($control->description) }}
</span>

<input id="_customize-input-{{ $control->id }}" type="text" {!! $control->link() !!} value="{{ esc_attr($control->value()) }}"/>