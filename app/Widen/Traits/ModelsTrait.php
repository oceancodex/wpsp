<?php

namespace WPSP\App\Widen\Traits;

use WPSP\Funcs;

trait ModelsTrait {

//	public function __construct($attributes = []) {
//		parent::__construct($attributes);
//		if (defined('WPSP_PLUGIN_START')) {
//			parent::setConnectionResolver(Funcs::app()->make('db'));
//		}
//	}

	/*
	 *
	 */

	/**
	 * Phân trang dữ liệu dạng cây phân cấp (hierarchy/tree).
	 *
	 * Hàm này:
	 * 1. Query toàn bộ dữ liệu từ database.
	 * 2. Group dữ liệu theo parent_id.
	 * 3. Flatten tree thành mảng phẳng nhưng vẫn giữ level hierarchy.
	 * 4. Phân trang trên flattened rows.
	 *
	 * Ví dụ:
	 *
	 * Danh mục cha\
	 * — Danh mục con 1\
	 * —— Danh mục cháu 1
	 *
	 * Sau khi flatten:
	 *
	 * [\
	 *     ['id' => 1, 'label' => 'Danh mục cha'],\
	 *     ['id' => 2, 'label' => '— Danh mục con 1'],\
	 *     ['id' => 3, 'label' => '—— Danh mục cháu 1'],\
	 * ]
	 *
	 * @param int|string    $perPage   Số item hiển thị mỗi trang.
	 * @param int|string    $page      Trang hiện tại.
	 * @param string 		$parentKey Tên column parent_id trong database.
	 * @param string 		$labelKey  Tên column dùng để hiển thị label.
	 * @param string 		$orderBy   Column dùng để sort.
	 * @param string 		$order     Kiểu sort asc|desc.
	 *
	 * @return array{
	 *     items: array,
	 *     total: int,
	 *     per_page: int,
	 *     current_page: int,
	 *     last_page: int
	 * }
	 */
	public static function hierarchyPaginate(
		int|string $perPage = 20,
		int|string $page = 1,
		string $parentKey = 'parent_id',
		string $labelKey = 'name',
		string $orderBy = 'name',
		string $order = 'asc'
	): array {
		/*
		|--------------------------------------------------------------------------
		| Query toàn bộ dữ liệu chỉ 1 lần duy nhất
		|--------------------------------------------------------------------------
		|
		| Không query recursive nhiều lần để tránh:
		| - N+1 queries
		| - Recursive SQL
		| - Performance kém khi tree lớn
		|
		| Toàn bộ hierarchy sẽ được xử lý bằng PHP memory.
		|
		*/

		$items = static::query()->orderBy($orderBy, $order)->get();

		/*
		|--------------------------------------------------------------------------
		| Group dữ liệu theo parent_id
		|--------------------------------------------------------------------------
		|
		| Ví dụ:
		|
		| [
		|     0 => [
		|         Category A,
		|         Category B,
		|     ],
		|
		|     1 => [
		|         Child A1,
		|         Child A2,
		|     ],
		| ]
		|
		| Root categories sẽ có key = 0
		|
		*/

		$grouped = $items->groupBy(function($item) use ($parentKey) {

			/*
			 * Nếu parent_id null => convert về 0
			 * để dễ xử lý root nodes.
			 */
			return (string)($item->$parentKey ?: 0);

		});

		/*
		|--------------------------------------------------------------------------
		| Build flattened hierarchy rows
		|--------------------------------------------------------------------------
		|
		| Convert tree:
		|
		| Parent
		| ├ Child
		| │ └ Grandchild
		|
		| Thành:
		|
		| [
		|     Parent,
		|     — Child,
		|     —— Grandchild
		| ]
		|
		*/

		$allRows = [];

		static::buildHierarchyRows($grouped, $labelKey, 0, 0, $allRows);

		/*
		|--------------------------------------------------------------------------
		| Tổng số rows thực tế
		|--------------------------------------------------------------------------
		|
		| Dùng cho pagination:
		| - total_items
		| - last_page
		|
		*/

		$total = count($allRows);

		/*
		|--------------------------------------------------------------------------
		| Tính offset pagination
		|--------------------------------------------------------------------------
		|
		| Ví dụ:
		|
		| Page 1 => offset 0
		| Page 2 => offset 20
		| Page 3 => offset 40
		|
		*/

		$offset = ($page - 1) * $perPage;

		/*
		|--------------------------------------------------------------------------
		| Cắt mảng theo phân trang
		|--------------------------------------------------------------------------
		|
		| array_slice dùng để paginate flattened rows.
		|
		| Lưu ý:
		| Child category có thể orphan nếu nằm đầu page.
		|
		*/

		$pageRows = array_slice($allRows, $offset, $perPage);

		/*
		|--------------------------------------------------------------------------
		| Trả về pagination data
		|--------------------------------------------------------------------------
		|
		| Format tương tự Laravel paginator.
		|
		*/

		return [
			/*
			 * Danh sách item của page hiện tại
			 */
			'items' => array_values($pageRows),

			/*
			 * Tổng số rows
			 */
			'total' => $total,

			/*
			 * Số item mỗi trang
			 */
			'per_page' => $perPage,

			/*
			 * Trang hiện tại
			 */
			'current_page' => $page,

			/*
			 * Tổng số trang
			 */
			'last_page' => (int) ceil($total / $perPage),
		];
	}

	/**
	 * Recursive function dùng để flatten hierarchy tree.
	 *
	 * Ví dụ:
	 *
	 * Parent\
	 * ├ Child 1\
	 * │ └ Grandchild\
	 * └ Child 2
	 *
	 * Thành:
	 *
	 * [\
	 *     Parent,\
	 *     — Child 1,\
	 *     —— Grandchild,\
	 *     — Child 2,\
	 * ]
	 *
	 * @param \Illuminate\Support\Collection $grouped	Collection đã group theo parent_id.
	 *
	 * @param string                         $labelKey	Tên field dùng làm label.
	 *
	 * @param int|string                     $parentId	Parent hiện tại đang recursive.
	 *
	 * @param int|string					 $level
	 *        Level depth hiện tại.
	 *        Root = 0
	 *        Child = 1
	 *        Grandchild = 2
	 *
	 * @param array $result		Mảng kết quả flatten cuối cùng.
	 *
	 * @param array $visited	Danh sách ID đã duyệt để tránh cyclic recursion.
	 *
	 * @return void
	 */
	private static function buildHierarchyRows(
		\Illuminate\Support\Collection $grouped,
		string $labelKey,
		int|string $parentId = 0,
		int|string $level = 0,
		array &$result = [],
		array $visited = []
	): void {
		/*
		|--------------------------------------------------------------------------
		| Lấy danh sách children của parent hiện tại
		|--------------------------------------------------------------------------
		|
		| Nếu không tồn tại children => mảng rỗng
		|
		*/

		$items = $grouped[(string)$parentId] ?? [];

		/*
		|--------------------------------------------------------------------------
		| Loop từng child item
		|--------------------------------------------------------------------------
		*/

		foreach ($items as $item) {

			/*
			 |--------------------------------------------------------------------------
			 | Prevent cyclic recursion
			 |--------------------------------------------------------------------------
			 |
			 | Tránh trường hợp dữ liệu lỗi:
			 |
			 | A -> B
			 | B -> C
			 | C -> A
			 |
			 | Nếu không check sẽ gây infinite recursion.
			 |
			 */

			if (in_array($item->id, $visited)) {
				continue;
			}

			/*
			 |--------------------------------------------------------------------------
			 | Tạo prefix hierarchy
			 |--------------------------------------------------------------------------
			 |
			 | Level 0 => ""
			 | Level 1 => "— "
			 | Level 2 => "— — "
			 |
			 */

			$prefix = str_repeat('— ', $level);

			/*
			 |--------------------------------------------------------------------------
			 | Push row vào flattened result
			 |--------------------------------------------------------------------------
			 */

			$result[] = [

				/*
				 * Primary key
				 */
				'id' => $item->id,

				/*
				 * Label hiển thị có hierarchy prefix
				 */
				'label' => $prefix . $item->$labelKey,

				/*
				 * Level depth hiện tại
				 */
				'level' => $level,

				/*
				 * Model object gốc
				 */
				'model' => $item,

			];

			/*
			 |--------------------------------------------------------------------------
			 | Recursive children
			 |--------------------------------------------------------------------------
			 |
			 | Tiếp tục build subtree của item hiện tại.
			 |
			 */

			static::buildHierarchyRows(
				$grouped,
				$labelKey,
				$item->id,
				$level + 1,
				$result,

				/*
				 * Thêm current ID vào visited stack
				 */
				[
					...$visited,
					$item->id
				]
			);
		}
	}

}