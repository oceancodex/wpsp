<?php

namespace WPSP\App\WordPress\Integrations\YoastSEO;

class YoastSEO {

	public $robots                            = null;
	public $canonical                         = null;
	public $title                             = null;
	public $description                       = null;

	public $opengraphURL                      = null;
	public $opengraphTitle                    = null;
	public $opengraphDescription              = null;

	public $schema                            = null;
	public $schemaPriority                    = 10;
	public $schemaAcceptedArgs                = 0;

	public $schemaWebpage                     = null;
	public $schemaWebpagePriority             = 10;
	public $schemaWebpageAcceptedArgs         = 0;

	public $schemaBreadcrumb                  = null;
	public $schemaBreadcrumbPriority          = 10;
	public $schemaBreadcrumbAcceptedArgs      = 0;

	public $breadcrumbLinks                   = [];
	public $breadcrumbLinksPriority           = 10;
	public $breadcrumbLinksAcceptedArgs       = 0;

	public $breadcrumbSingleLink              = [];
	public $breadcrumbSingleLinkPriority      = 10;
	public $breadcrumbSingleLinkAcceptedArgs  = 0;

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
		$this->breadcrumbLinks();
		$this->breadcrumbSingleLink();
	}

	/*
	 * Runner.
	 */

	public function robots() {
		if ($this->robots) {
			add_filter('wpseo_robots', function($robots, $presentation) {
				return $this->robots;
			}, 10, 2);
		}
	}

	public function canonical() {
		if ($this->canonical) {
			add_filter('wpseo_canonical', function($canonical) {
				return $this->canonical;
			});
		}
	}

	public function title() {
		if ($this->title) {
			add_filter('wpseo_title', function($title) {
				return $this->title;
			});
//			add_filter('pre_get_document_title', function($title) {
//				return $this->title;
//			}, 10000, 1);
		}
	}

	public function description() {
		if ($this->description) {
			add_filter('wpseo_metadesc', function($description) {
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
			add_filter('wpseo_opengraph_desc', function($description) {
				return $this->opengraphDescription;
			});
		}
	}

	public function ogURL() {
		if ($this->opengraphURL) {
			add_filter('wpseo_opengraph_url', function($url) {
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
				'wpseo_schema_breadcrumb',
				$this->schemaBreadcrumb,
				$this->schemaBreadcrumbPriority,
				$this->schemaBreadcrumbAcceptedArgs
			);
		}
	}

	public function schemaWebpage() {
		if (is_callable($this->schemaWebpage)) {
			add_filter(
				'wpseo_schema_webpage',
				$this->schemaWebpage,
				$this->schemaWebpagePriority,
				$this->schemaWebpageAcceptedArgs
			);
		}
	}

	public function breadcrumbLinks() {
		if (is_callable($this->breadcrumbLinks)) {
			add_filter('wpseo_breadcrumb_links',
				$this->breadcrumbLinks,
				$this->breadcrumbLinksPriority,
				$this->breadcrumbLinksAcceptedArgs
			);
		}
	}

	public function breadcrumbSingleLink() {
		if (is_callable($this->breadcrumbSingleLink)) {
			add_filter('wpseo_breadcrumb_single_link',
				$this->breadcrumbSingleLink,
				$this->breadcrumbSingleLinkPriority,
				$this->breadcrumbSingleLinkAcceptedArgs
			);
		}
	}

	/*
	 *
	 */

	public function setBreadcrumbLinks($breadcrumbLinks, $priority = 10, $accepted_args = 0) {
		$this->breadcrumbLinks             = $breadcrumbLinks;
		$this->breadcrumbLinksPriority     = $priority;
		$this->breadcrumbLinksAcceptedArgs = $accepted_args;
	}

	public function getBreadcrumbLinks() {
		return $this->breadcrumbLinks;
	}

	public function setBreadcrumbSingleLink($breadcrumbSingleLink, $priority = 10, $accepted_args = 0) {
		$this->breadcrumbSingleLink             = $breadcrumbSingleLink;
		$this->breadcrumbSingleLinkPriority     = $priority;
		$this->breadcrumbSingleLinkAcceptedArgs = $accepted_args;
	}

	public function getBreadcrumbSingleLink() {
		return $this->breadcrumbSingleLink;
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

	public function setDocumentTitle($title) {
		add_filter('pre_get_document_title', function($title) {
			return $this->title;
		});
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