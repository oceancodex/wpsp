<?php

namespace WPSP\App\WordPress\Integrations\RankmathSEO;

class RankmathSEO {

	public $robots                       = null;
	public $canonical                    = null;
	public $title                        = null;
	public $description                  = null;

	public $opengraphURL                 = null;
	public $opengraphTitle               = null;
	public $opengraphDescription         = null;

	public $schema                       = null;
	public $schemaPriority               = 10;
	public $schemaAcceptedArgs           = 0;

	public $schemaWebpage                = null;
	public $schemaWebpagePriority        = 10;
	public $schemaWebpageAcceptedArgs    = 0;

	public $schemaBreadcrumb             = null;
	public $schemaBreadcrumbPriority     = 10;
	public $schemaBreadcrumbAcceptedArgs = 0;

	/*
	 *
	 */

	public function apply() {
		$this->robots();
		$this->canonical();
		$this->ogURL();
		$this->title();
		$this->description();
		$this->ogTitle();
		$this->ogDescription();
		$this->schema();
		$this->schemaWebpage();
		$this->schemaBreadcrumb();
	}

	/*
	 * Runner.
	 */

	public function robots() {
		if ($this->robots) {
			add_filter('rank_math/frontend/robots', function($robots) {
				if (is_string($this->robots)) {
					return [$this->robots];
				}
				else {
					return $this->robots;
				}
			}, 10, 1);
		}
	}

	public function canonical() {
		if ($this->canonical) {
			add_filter('rank_math/frontend/canonical', function($canonical) {
				return $this->canonical;
			});
		}
	}

	public function title() {
		if ($this->title) {
			add_filter('rank_math/frontend/title', function($title) {
				return $this->title;
			});
			add_filter('pre_get_document_title', function($title) {
				return $this->title;
			}, 10000, 1);
		}
	}

	public function description() {
		if ($this->description) {
			add_filter('rank_math/frontend/description', function($description) {
				return $this->description;
			});
		}
	}

	public function ogTitle() {
		if ($this->opengraphTitle) {
			add_filter('wpseo_opengraph_title', function($title) {
				return $this->opengraphTitle;
			});
		}
	}

	public function ogDescription() {
		if ($this->opengraphDescription) {
			add_filter('wpseo_opengraph_description', function($description) {
				return $this->opengraphDescription;
			});
		}
	}

	public function ogURL() {
		if ($this->opengraphURL) {
			add_filter('rank_math/opengraph/url', function($url) {
				return $this->opengraphURL;
			});
		}
	}

	public function schema() {
		if (is_callable($this->schema)) {
			add_filter('wpseo_schema_graph', $this->schema, $this->schemaPriority, $this->schemaAcceptedArgs);
		}
	}

	public function schemaBreadcrumb() {
		if (is_callable($this->schemaBreadcrumb)) {
			add_filter(
				'rank_math/snippet/breadcrumb',
				$this->schemaBreadcrumb,
				$this->schemaBreadcrumbPriority,
				$this->schemaBreadcrumbAcceptedArgs
			);
		}
	}

	public function schemaWebpage() {
		if (is_callable($this->schemaWebpage)) {
			add_filter(
				'rank_math/snippet/webpage',
				$this->schemaWebpage,
				$this->schemaWebpagePriority,
				$this->schemaWebpageAcceptedArgs
			);
		}
	}

	/*
	 *
	 */

	public function setRobots($robots) {
		$this->robots = $robots;
	}

	public function getRobots() {
		return $this->robots;
	}

	public function setCanonical($canonical) {
		$this->canonical = $canonical;
	}

	public function getCanonical() {
		return $this->canonical;
	}


	/*
	 *
	 */

	public function setTitle($title) {
		$this->title = $title;
	}

	public function getTitle() {
		return $this->title;
	}

	public function setDescription($description) {
		$this->description = $description;
	}

	public function getDescription() {
		return $this->description;
	}

	public function setOpengraphTitle($opengraphTitle) {
		$this->opengraphTitle = $opengraphTitle;
	}

	public function getOpengraphTitle() {
		return $this->opengraphTitle;
	}

	public function setOpengraphDescription($opengraphDescription) {
		$this->opengraphDescription = $opengraphDescription;
	}

	public function getOpengraphDescription() {
		return $this->opengraphDescription;
	}

	public function setOpengraphURL($opengraphURL) {
		$this->opengraphURL = $opengraphURL;
	}

	public function getOpengraphURL() {
		return $this->opengraphURL;
	}

	/*
	 *
	 */

	public function setSchema($schema, $priority = 10, $accepted_args = 0) {
		$this->schema             = $schema;
		$this->schemaPriority     = $priority;
		$this->schemaAcceptedArgs = $accepted_args;
	}

	public function getSchema() {
		return $this->schema;
	}

	public function setSchemaWebpage($schemaWebpage, $priority = 10, $accepted_args = 0) {
		$this->schemaWebpage             = $schemaWebpage;
		$this->schemaWebpagePriority     = $priority;
		$this->schemaWebpageAcceptedArgs = $accepted_args;
	}

	public function getSchemaWebpage() {
		return $this->schemaWebpage;
	}

	public function setSchemaBreadcrumb($schemaBreadcrumb, $priority = 10, $accepted_args = 0) {
		$this->schemaBreadcrumb             = $schemaBreadcrumb;
		$this->schemaBreadcrumbPriority     = $priority;
		$this->schemaBreadcrumbAcceptedArgs = $accepted_args;
	}

	public function getSchemaBreadcrumb() {
		return $this->schemaBreadcrumb;
	}

}