<?php

namespace WPSP\app\Extend\Components\Taxonomies;

use WPSP\app\Traits\InstancesTrait;
use WPSPCORE\Base\BaseTaxonomy;

class wpsp_category extends BaseTaxonomy {

	use InstancesTrait;

//	public mixed $taxonomy                   = '';
	public mixed $object_type                = 'wpsp_content';

	// Labels.
//	public mixed $name                       = '';
//	public mixed $singular_name              = '';
//	public mixed $search_items               = '';
//	public mixed $popular_items              = '';
//	public mixed $all_items                  = '';
//	public mixed $parent_item                = '';
//	public mixed $parent_item_colon          = '';
//	public mixed $name_field_description     = '';
//	public mixed $slug_field_description     = '';
//	public mixed $parent_field_description   = '';
//	public mixed $desc_field_description     = '';
//	public mixed $edit_item                  = '';
//	public mixed $view_item                  = '';
//	public mixed $update_item                = '';
//	public mixed $add_new_item               = '';
//	public mixed $new_item_name              = '';
//	public mixed $separate_items_with_commas = '';
//	public mixed $add_or_remove_items        = '';
//	public mixed $choose_from_most_used      = '';
//	public mixed $not_found                  = '';
//	public mixed $no_terms                   = '';
//	public mixed $filter_by_item             = '';
//	public mixed $items_list_navigation      = '';
//	public mixed $items_list                 = '';
//	public mixed $most_used                  = '';
//	public mixed $back_to_items              = '';
//	public mixed $item_link                  = '';
//	public mixed $item_link_description      = '';

	// Args.
//	public mixed $labels                     = [];
//	public mixed $description                = '';
//	public mixed $public                     = true;
//	public mixed $publicly_queryable         = true;
//	public mixed $hierarchical               = false;
//	public mixed $show_ui                    = true;
//	public mixed $show_in_menu               = true;
//	public mixed $show_in_nav_menus          = true;
//	public mixed $show_in_rest               = true;
//	public mixed $rest_base                  = '';
//	public mixed $rest_namespace             = '';
//	public mixed $rest_controller_class      = '';
//	public mixed $show_tagcloud              = true;
//	public mixed $show_in_quick_edit         = true;
//	public mixed $show_admin_column          = true;
//	public mixed $meta_box_cb                = null;
//	public mixed $meta_box_sanitize_cb       = null;
//	public mixed $capabilities               = [];           // ['manage_terms', 'edit_terms', 'delete_terms', 'assign_terms']
//	public mixed $rewrite                    = [];           // true/false or ['slug', 'with_front', 'hierarchical', 'ep_mask']
//	public mixed $query_var                  = '';
//	public mixed $update_count_callback      = null;
//	public mixed $default_term               = [];           // ['name','slug', 'description']
//	public mixed $sort                       = null;
//	public mixed $args                       = [];
//	public mixed $_builtin                   = true;

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