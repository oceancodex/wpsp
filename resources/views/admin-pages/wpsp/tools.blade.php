@extends('admin-pages.layout')

@section('title')
    {{ wpsp_trans('messages.tools') }}
@endsection

@section('content')
    <div id="poststuff">
        <div id="post-body" class="metabox-holder columns-{{ $screen_columns ?? 2  }}">
            <div id="postbox-container-1" class="postbox-container">
                @php
                    do_meta_boxes(get_current_screen(), 'side', null);
                @endphp
            </div>
            <div id="postbox-container-2" class="postbox-container">
                @php
                    do_meta_boxes(get_current_screen(), 'normal', null);
                @endphp
            </div>
        </div>
    </div>
@endsection