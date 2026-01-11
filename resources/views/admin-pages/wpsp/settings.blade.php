@extends('admin-pages.layout')

@section('title')
    {{ wpsp_trans('messages.settings') }}
@endsection

@section('content')
    <form method="POST" autocomplete="off">
        <input name="action" value="save_settings" type="hidden"/>
        @include('admin-pages.poststuff')
    </form>
@endsection