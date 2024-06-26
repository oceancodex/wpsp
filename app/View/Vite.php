<?php
namespace Illunimate\Foundation;

use WPSP\Funcs;

class Vite extends \WPSPCORE\View\Vite {

	public function __construct() {
		$this->mainPath = Funcs::instance()->_getMainPath();
        parent::__construct();
    }

}