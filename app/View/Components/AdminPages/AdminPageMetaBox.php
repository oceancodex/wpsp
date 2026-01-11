<?php

namespace WPSP\App\View\Components\AdminPages;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AdminPageMetaBox extends Component {

	public string $id;
	public array  $adminPageMetaBoxes;
	public bool   $isClosed;
	public bool   $isHidden;

	/**
	 * Create a new component instance.
	 */
	public function __construct(
		string $id = '',
		array $adminPageMetaBoxes = [],
	) {
		$this->id                 = $id;
		$this->adminPageMetaBoxes = $adminPageMetaBoxes;

		$this->isClosed = isset($adminPageMetaBoxes['closed'][$id]);
		$this->isHidden = isset($adminPageMetaBoxes['hidden'][$id]);
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string {
		return view('components.admin-pages.admin-page-meta-box');
	}

}
