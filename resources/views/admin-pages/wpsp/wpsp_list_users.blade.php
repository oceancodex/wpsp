@extends('admin-pages.layout')

@section('title')
    {{ wpsp_trans('Users', true) }}
@endsection

@section('after-title')
    <a href="?page={{$menuSlug}}&tab=users&action=create" class="page-title-action">{{ wpsp_trans('Add new', true) }}</a>
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