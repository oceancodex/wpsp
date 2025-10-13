<?php

namespace WPSP\app\Extras\Components\Taxonomies;

use WPSPCORE\Base\BaseTaxonomy;

class wpsp_category extends BaseTaxonomy {

//	public $taxonomy                   = '';
	public $object_type                = 'wpsp_content';

	// Labels.
	public $name                       = 'WPSP Category';
//	public $singular_name              = '';
//	public $search_items               = '';
//	public $popular_items              = '';
//	public $all_items                  = '';
//	public $parent_item                = '';
//	public $parent_item_colon          = '';
//	public $name_field_description     = '';
//	public $slug_field_description     = '';
//	public $parent_field_description   = '';
//	public $desc_field_description     = '';
//	public $edit_item                  = '';
//	public $view_item                  = '';
//	public $update_item                = '';
//	public $add_new_item               = '';
//	public $new_item_name              = '';
//	public $separate_items_with_commas = '';
//	public $add_or_remove_items        = '';
//	public $choose_from_most_used      = '';
//	public $not_found                  = '';
//	public $no_terms                   = '';
//	public $filter_by_item             = '';
//	public $items_list_navigation      = '';
//	public $items_list                 = '';
//	public $most_used                  = '';
//	public $back_to_items              = '';
//	public $item_link                  = '';
//	public $item_link_description      = '';

	// Args.
//	public $labels                     = [];
//	public $description                = '';
//	public $public                     = true;
//	public $publicly_queryable         = true;
//	public $hierarchical               = false;
//	public $show_ui                    = true;
//	public $show_in_menu               = true;
//	public $show_in_nav_menus          = true;
//	public $show_in_rest               = true;
//	public $rest_base                  = '';
//	public $rest_namespace             = '';
//	public $rest_controller_class      = '';
//	public $show_tagcloud              = true;
//	public $show_in_quick_edit         = true;
//	public $show_admin_column          = true;
//	public $meta_box_cb                = null;
//	public $meta_box_sanitize_cb       = null;
//	public $capabilities               = [];           // ['manage_terms', 'edit_terms', 'delete_terms', 'assign_terms']
//	public $rewrite                    = [];           // true/false or ['slug', 'with_front', 'hierarchical', 'ep_mask']
//	public $query_var                  = '';
//	public $update_count_callback      = null;
//	public $default_term               = [];           // ['name','slug', 'description']
//	public $sort                       = null;
//	public $args                       = [];
//	public $_builtin                   = true;

	public function customProperties() {

		/**
		 * Modify "taxonomy", "object_type" and "args" properties.
		 */

//		$this->taxonomy = 'custom_taxonomy';
//		$this->args      = [];

		/**
		 * Modify labels.
		 */

		/** Method 1: Define an array and pass it to the "labels" property of "args" property. */
//		$labels = [];
//		$this->args->labels = $labels;

		/** Method 2: Define each label separately. */
//		$this->args->labels['name']          = 'Custom taxonomy';
//		$this->args->labels['singular_name'] = 'Custom singular taxonomy';

	}

}