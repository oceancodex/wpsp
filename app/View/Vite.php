<?php
namespace Illunimate\Foundation;

use WPSP\Funcs;

class Vite extends \WPSPCORE\View\Vite {

	public function __construct() {
		$this->mainPath = Funcs::instance()->getMainPath();
        parent::__construct();
    }

}