@extends('modules.web.admin-pages.layout')

@section('title')
    {{ wpsp_trans('Table', true) }}
@endsection

@section('content')

    <br/>

    <form method="post">
    @php
        $table->prepare_items();
		$table->search_box('search', 'search_id');
		$table->display();
    @endphp
    </form>

@endsection