@extends('modules.admin-pages.layout')

@section('title')
    {{ wpsp_trans('Table', true) }}
@endsection

@section('after-title')
    <a href="&action=add_new" class="page-title-action">Thêm Bài Viết</a>
@endsection

@section('content')
    <form method="GET">
        <input type="hidden" name="page" value="{{ $_REQUEST['page'] ?? '' }}"/>
        <input type="hidden" name="tab" value="{{ $_REQUEST['tab'] ?? '' }}"/>
        @php
            $table->prepare_items();
            $table->views();
            $table->search_box('Search', 'search_id');
            $table->display();
        @endphp
    </form>
@endsection