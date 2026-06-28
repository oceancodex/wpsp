<?php

namespace WPSP\routes;

use WPSP\App\Widen\Routes\CommentColumns\CommentColumns as Route;
use WPSP\App\WordPress\CommentColumns\custom_column;
use WPSPCORE\App\Routes\CommentColumns\CommentColumnsRouteTrait;

class CommentColumns {

	use CommentColumnsRouteTrait;

	/*
	 *
	 */

	public function comment_columns() {
		Route::column('custom_column', [custom_column::class, 'index']);
	}

	/*
	 *
	 */

	public function actions() {}

	public function filters() {}

}