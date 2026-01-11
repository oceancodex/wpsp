@extends('admin-pages.admin-page-meta-box', ['id' => 'submitdiv'])

@section('meta-box-title', wpsp_trans('messages.save_changes'))

@section('meta-box-content')
    <div class="p-2 text-end bg-light">
        <button type="submit" class="button button-primary">{{ wpsp_trans('messages.save_changes') }}</button>
    </div>
@endsection