<?php

namespace WPSP\App\Components\PostTypes;

use WPSP\App\Traits\InstancesTrait;
use WPSPCORE\Components\PostTypes\BasePostType;

class wpsp_content extends BasePostType {

	use InstancesTrait;

	/**
	 * WordPress register post type docs.
	 *
	 * @see https://developer.wordpress.org/reference/functions/register_post_type/
	 * @see https://developer.wordpress.org/reference/functions/get_post_type_labels/
	 */

	/** Post type. */
//	public $post_type                       = 'wpsp_content'; // Override the post type.

	/** Labels. */
	public $name                            = 'WPSP Content';
//	public $singular_name                   = '';
//	public $add_new                         = '';
//	public $add_new_item                    = '';
//	public $edit_item                       = '';
//	public $new_item                        = '';
//	public $view_item                       = '';
//	public $view_items                      = '';
//	public $search_items                    = '';
//	public $not_found                       = '';
//	public $not_found_in_trash              = '';
//	public $parent_item_colon               = '';
//	public $all_items                       = '';
//	public $archives                        = '';
//	public $attributes                      = '';
//	public $insert_into_item                = '';
//	public $uploaded_to_this_item           = '';
//	public $featured_image                  = '';
//	public $set_featured_image              = '';
//	public $remove_featured_image           = '';
//	public $use_featured_image              = '';
//	public $menu_name                       = '';
//	public $filter_items_list               = '';
//	public $filter_by_date                  = '';
//	public $items_list_navigation           = '';
//	public $items_list                      = '';
//	public $item_published                  = '';
//	public $item_published_privately        = '';
//	public $item_reverted_to_draft          = '';
//	public $item_trashed                    = '';
//	public $item_scheduled                  = '';
//	public $item_updated                    = '';
//	public $item_link                       = '';
//	public $item_link_description           = '';

	/** Arguments. */
//	public $label                           = null;
//	public $labels                          = [];
//	public $description                     = '';
//	public $public                          = true;
//	public $hierarchical                    = true;
//	public $exclude_from_search             = false;
//	public $publicly_queryable              = true;
//	public $show_ui                         = true;
	public $show_in_menu                    = false;
//	public $show_in_nav_menus               = true;
//	public $show_in_admin_bar               = true;
//	public $show_in_rest                    = true;
//	public $rest_base                       = '';
//	public $rest_namespace                  = '';
//	public $rest_controller_class           = '';
//	public $autosave_rest_controller_class  = '';
//	public $revisions_rest_controller_class = '';
//	public $late_route_registration         = true;
//	public $menu_position                   = null;
//	public $menu_icon                       = null;
//	public $capability_type                 = 'post';
//	public $capabilities                    = [];
//	public $map_meta_cap                    = false;
//	public $supports                        = ['title', 'editor', 'excerpt'];
//	public $register_meta_box_cb            = null;
//	public $taxonomies                      = [];
//	public $has_archive                     = false;
//	public $rewrite                         = true;
//	public $can_export                      = true;
//	public $delete_with_user                = false;
//	public $template                        = [];
//	public $template_lock                   = false;
//	public $_builtin                        = false;

//	public $_edit_link                      = null;     // Warning: This attribute may affect post editing.
//	public $query_var                       = false;    // Warning: This attribute can affect article viewing beyond the frontend.

	/*
	 *
	 */

	public function customProperties() {

		/**
		 * Modify "post_type" and "args" properties.
		 */

//		$this->post_type = 'wpsp_content';
//		$this->args      = [];

		/**
		 * Modify labels.
		 */

		/** Method 1: Define an array and pass it to the "labels" property of "args" property. */
//		$labels = [];
//		$this->args->labels = $labels;

		/** Method 2: Define each label separately. */
//		$this->args->labels['name']          = 'Custom name';
//		$this->args->labels['singular_name'] = 'Custom singular name';

	}

}