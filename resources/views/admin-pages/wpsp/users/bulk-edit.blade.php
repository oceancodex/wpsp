@extends('admin-pages.common.wp-list-table-bulk-edit')

@section('qe_title')
    Chỉnh sửa hàng loạt
@endsection

@section('qe_content')
	<div class="row">
		<div class="col col-auto">
			<label for="bulk_edit[name]" class="d-block mb-1">Name</label>
			<input type="text" id="bulk_edit[name]" name="bulk_edit[name]"/>
		</div>
		<div class="col col-auto">
			<label for="bulk_edit[email]" class="d-block mb-1">Email</label>
			<input type="text" id="bulk_edit[email]" name="bulk_edit[email]"/>
		</div>
		<div class="col col-auto">
			<label for="bulk_edit[email]" class="d-block mb-1">{{ $testService->test() }}</label>
			{{ $testService->subTestService->subTest() }}
		</div>
	</div>
@endsection