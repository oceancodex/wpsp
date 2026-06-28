<?php

namespace WPSP\routes;

use WPSP\App\Widen\Routes\CommentColumns\CommentColumns as Route;
use WPSP\App\WordPress\CommentColumns\custom_column;
use WPSP\App\WordPress\CommentColumns\custom_column_view;
use WPSPCORE\App\Routes\CommentColumns\CommentColumnsRouteTrait;

class CommentColumns {

	use CommentColumnsRouteTrait;

	/*
	 *
	 */

	public function comment_columns() {
		Route::column('custom_column', [custom_column::class, 'index']);
		Route::column('custom_column_view', [custom_column_view::class, 'index']);
	}

	/*
	 *
	 */

	public function actions() {}

	public function filters() {}

}