<?php

namespace WPSP\app\Extend\Components\WPListTables;

use WPSP\Funcs;

class Settings extends \WP_List_Table {

	private $table_data;

	private function get_table_data(): array {
		$settings = \WPSP\app\Models\Settings::all()->toArray();
		return $settings;
	}

	/*
	 *
	 */

	public function column_cb($item) {
		return sprintf(
			'<input type="checkbox" name="element[]" value="%s" />',
			$item['id']
		);
	}

	public function get_columns(): array {
		$columns = [
			'cb'    => '<input type="checkbox" />',
			'key'   => 'Key',
			'value' => 'Value',
		];
		return $columns;
	}

	public function column_default($item, $column_name) {
		switch ($column_name) {
			case 'id':
			case 'name':
			case 'description':
			case 'status':
			case 'order':
			default:
				return $item[$column_name];
		}
	}

	protected function get_sortable_columns(): array {
		$sortable_columns = [
			'key' => ['key', false],
		];
		return $sortable_columns;
	}

	public function prepare_items(): void {
		$this->table_data      = $this->get_table_data();
		$columns               = $this->get_columns();
		$hidden                = [];
		$sortable              = [];
		$primary               = 'key';
		$this->_column_headers = [$columns, $hidden, $sortable, $primary];

		usort($this->table_data, [&$this, 'usort_reorder']);

		/* pagination */
		$per_page     = 5;
		$current_page = $this->get_pagenum();
		$total_items  = count($this->table_data);

		$this->table_data = array_slice($this->table_data, (($current_page - 1) * $per_page), $per_page);

		$this->set_pagination_args([
			'total_items' => $total_items, // total number of items
			'per_page'    => $per_page, // items to show on a page
			'total_pages' => ceil($total_items / $per_page) // use ceil to round up
		]);

		$this->items = $this->table_data;
	}

	public function usort_reorder($a, $b): int {
		// If no sort, default to user_login
		$orderby = (!empty($_GET['orderby'])) ? $_GET['orderby'] : 'user_login';

		// If no order, default to asc
		$order = (!empty($_GET['order'])) ? $_GET['order'] : 'asc';

		// Determine sort order
		$result = strcmp($a[$orderby], $b[$orderby]);

		// Send final sort direction to usort
		return ($order === 'asc') ? $result : -$result;
	}

}