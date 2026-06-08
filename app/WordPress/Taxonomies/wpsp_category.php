<?php

namespace WPSP\App\WordPress\Taxonomies;

use Illuminate\Http\Request;
use WPSP\App\Widen\Traits\InstancesTrait;
use WPSPCORE\App\WordPress\Taxonomies\BaseTaxonomy;

/**
 * WordPress register taxonomy docs.
 *
 * @see https://developer.wordpress.org/reference/functions/register_taxonomy/
 */
class wpsp_category extends BaseTaxonomy {

	use InstancesTrait;

//	public $taxonomy				   = 'wpsp_category';
	public $object_type				   = ['post', 'wpsp_content'];

//	public $args					   = null;

	/** Labels. */
	public $name                       = 'WPSP Category';
//	public $singular_name              = null;
//	public $search_items               = null;
//	public $popular_items              = null;
//	public $all_items                  = null;
//	public $parent_item                = null;
//	public $parent_item_colon          = null;
//	public $name_field_description     = null;
//	public $slug_field_description     = null;
//	public $parent_field_description   = null;
//	public $desc_field_description     = null;
//	public $edit_item                  = null;
//	public $view_item                  = null;
//	public $update_item                = null;
//	public $add_new_item               = 'Add new';
//	public $new_item_name              = null;
//	public $separate_items_with_commas = null;
//	public $add_or_remove_items        = null;
//	public $choose_from_most_used      = null;
//	public $not_found                  = null;
//	public $no_terms                   = null;
//	public $filter_by_item             = null;
//	public $items_list_navigation      = null;
//	public $items_list                 = null;
//	public $most_used                  = null;
//	public $back_to_items              = null;
//	public $item_link                  = null;
//	public $item_link_description      = null;

	/** Arguments. */
//	public $labels                     = [];
//	public $description                = null;
//	public $public                     = true;
//	public $publicly_queryable         = true;
//	public $hierarchical               = false;
//	public $show_ui                    = true;
//	public $show_in_menu               = true;
//	public $show_in_nav_menus          = true;
//	public $show_in_rest               = true;
//	public $rest_base                  = null;
//	public $rest_namespace             = null;
//	public $rest_controller_class      = null;
//	public $show_tagcloud              = true;
//	public $show_in_quick_edit         = true;
//	public $show_admin_column          = true;
//	public $meta_box_cb                = null;
//	public $meta_box_sanitize_cb       = null;
//	public $capabilities               = [];		// ['manage_terms' => 'manage_categories', 'edit_terms' => 'manage_categories', 'delete_terms' => 'manage_categories', 'assign_terms' => 'edit_posts']
//	public $rewrite                    = [];		// true/false or ['slug', 'with_front', 'hierarchical', 'ep_mask']
//	public $update_count_callback      = null;
//	public $default_term               = [];		// ['name','slug', 'description']
//	public $sort                       = false;

//	public $query_var                  = null;		// Not for general use. Warning: This attribute can affect article viewing beyond the frontend.
//	public $_builtin                   = false;		// Not for general use

	/*
	 *
	 */

	public function customProperties(Request $request) {
		/**
		 * Modify "taxonomy", "object_type" and "args" properties.
		 */
//		$this->taxonomy = 'wpsp_category';
//		$this->args      = [];

		/**
		 * Modify labels.
		 */

		// Method 1: Define labels via "$this".
//		$this->name = 'Custom taxonomy';
//		$this->singular_name = 'Custom singular taxonomy';

		// Method 2: Define an array and pass it to the "$this->args->labels".
//		$labels = ['name' => 'Custom taxonomy'];
//		$this->args->labels = $labels;

		// Method 3: Define labels via "$this->args->labels".
//		$this->args->labels['name']          = 'Custom taxonomy';
//		$this->args->labels['singular_name'] = 'Custom singular taxonomy';

	}

}