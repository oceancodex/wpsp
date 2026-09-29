<?php
/**
 * Created by PhpStorm.
 * User: Khanh
 * Date: 29/09/2026
 * Time: 9:06 SA
 */

namespace WPSP\App\Pipes\Users;

use Illuminate\Database\Eloquent\Builder;

class FilterByName {

	public function handle(Builder $query, \Closure $next) {
		$query->where('name', 'admin');

		return $next($query);
	}

}