<?php

namespace WPSP\App\WordPress\PostTypes;

use Illuminate\Http\Request;
use WPSP\App\Widen\Traits\InstancesTrait;
use WPSPCORE\App\WordPress\PostTypes\BasePostType;

/**
 * WordPress register post type docs.
 *
 * @see https://developer.wordpress.org/reference/functions/register_post_type/
 * @see https://developer.wordpress.org/reference/functions/get_post_type_labels/
 */
class wpsp_content extends BasePostType {

	use InstancesTrait;

	/** Post type. */
//	public $post_type                       = 'wpsp_content'; // Override the post type.

	/** Labels. */
	public $name                            = 'WPSP Content';
//	public $singular_name                   = null;
//	public $add_new                         = 'Add new';
//	public $add_new_item                    = 'Add new';
//	public $edit_item                       = null;
//	public $new_item                        = null;
//	public $view_item                       = null;
//	public $view_items                      = null;
//	public $search_items                    = null;
//	public $not_found                       = null;
//	public $not_found_in_trash              = null;
//	public $parent_item_colon               = null;
//	public $all_items                       = null;
//	public $archives                        = null;
//	public $attributes                      = null;
//	public $insert_into_item                = null;
//	public $uploaded_to_this_item           = null;
//	public $featured_image                  = null;
//	public $set_featured_image              = null;
//	public $remove_featured_image           = null;
//	public $use_featured_image              = null;
//	public $menu_name                       = null;
//	public $filter_items_list               = null;
//	public $filter_by_date                  = null;
//	public $items_list_navigation           = null;
//	public $items_list                      = null;
//	public $item_published                  = null;
//	public $item_published_privately        = null;
//	public $item_reverted_to_draft          = null;
//	public $item_trashed                    = null;
//	public $item_scheduled                  = null;
//	public $item_updated                    = null;
//	public $item_link                       = null;
//	public $item_link_description           = null;

	/** Arguments. */
//	public $label                           = null;
//	public $labels                          = [];
//	public $description                     = null;
//	public $public                          = true;
//	public $hierarchical                    = false;
//	public $exclude_from_search             = false;
//	public $publicly_queryable              = true;
//	public $show_ui                         = true;
	public $show_in_menu                    = false;
//	public $show_in_nav_menus               = true;
//	public $show_in_admin_bar               = true;
//	public $show_in_rest                    = true;
//	public $rest_base                       = null;
//	public $rest_namespace                  = null;
//	public $rest_controller_class           = null;
//	public $autosave_rest_controller_class  = null;
//	public $revisions_rest_controller_class = null;
//	public $late_route_registration         = true;
//	public $menu_position                   = null;
//	public $menu_icon                       = null;
//	public $capability_type                 = 'post';
//	public $capabilities                    = [];
//	public $map_meta_cap                    = true;
//	public $supports                        = ['title', 'editor', 'excerpt'];
//	public $register_meta_box_cb            = null;
//	public $taxonomies                      = [];
//	public $has_archive                     = false;
//	public $rewrite                         = true;		// ['slug' => $this->post_type ?? null, 'with_front' => true, 'feeds' => true, 'pages' => true, 'ep_mask' => 0]
//	public $can_export                      = true;
//	public $delete_with_user                = false;
//	public $template                        = [];
//	public $template_lock                   = false;

//	public $query_var                       = false;    // Warning: This attribute can affect article viewing beyond the frontend.
//	public $_builtin                        = false;	// FOR INTERNAL USE ONLY!
//	public $_edit_link                      = null;     // FOR INTERNAL USE ONLY! Warning: This attribute may affect post editing.

	/*
	 *
	 */

	public function customProperties(Request $request) {
		/**
		 * Modify "post_type" and "args" properties.
		 */
//		$this->post_type = 'wpsp_content';
//		$this->args      = [];

		/**
		 * Modify labels.
		 */

		// Method 1: Define labels via "$this".
//		$this->name = 'Custom post type name';
//		$this->singular_name = 'Custom post type singular name';

		// Method 2: Define an array and pass it to the "$this->args->labels".
//		$labels = ['name' => 'Custom post type name'];
//		$this->args->labels = $labels;

		// Method 3: Define labels via "$this->args->labels".
//		$this->args->labels['name']          = 'Custom post type name';
//		$this->args->labels['singular_name'] = 'Custom post type singular name';
	}

}