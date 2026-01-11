@extends('admin-pages.layout')

@section('title')
    {{ wpsp_trans('messages.settings') }}
@endsection

@section('content')
    <form method="POST">
        <input name="action" value="save_settings" type="hidden"/>
        @include('admin-pages.poststuff', ['metaboxes' => $metaboxes])
    </form>
@endsection

@section('after-wrap')
    <script>
	    jQuery(document).ready(function ($) {
		    let frame;
		    $('#upload_logo_button').on('click', function (e) {
			    e.preventDefault();

			    if (frame) {
				    frame.open();
				    return;
			    }

			    frame = wp.media({
				    title: 'Chọn hoặc upload ảnh',
				    button: { text: 'Sử dụng ảnh này' },
				    multiple: false
			    });

			    frame.on('select', function () {
				    const attachment = frame.state().get('selection').first().toJSON();
				    $('input[name="settings[logo]"]').val(attachment.url);
				    $('#preview_logo').attr('src', attachment.url);
			    });

			    frame.open();
		    });
	    });
    </script>
@endsection