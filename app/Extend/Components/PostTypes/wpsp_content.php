<?php

namespace WPSP\app\Extend\Components\PostTypes;

use WPSP\app\Traits\InstancesTrait;
use WPSPCORE\Base\BasePostType;

class wpsp_content extends BasePostType {

	use InstancesTrait;

	/**
	 * WordPress register post type docs.
	 *
	 * @see https://developer.wordpress.org/reference/functions/register_post_type/
	 * @see https://developer.wordpress.org/reference/functions/get_post_type_labels/
	 */

	/** Post type. */
//	public mixed $post_type                = 'wpsp_content'; // Override the post type.

	/** Labels. */
	public mixed $name                     = null;
	public mixed $singular_name            = 'WPSP Content';
//	public mixed $add_new                  = '';
//	public mixed $add_new_item             = '';
//	public mixed $edit_item                = '';
//	public mixed $new_item                 = '';
//	public mixed $view_item                = '';
//	public mixed $view_items               = '';
//	public mixed $search_items             = '';
//	public mixed $not_found                = '';
//	public mixed $not_found_in_trash       = '';
//	public mixed $parent_item_colon        = '';
//	public mixed $all_items                = '';
//	public mixed $archives                 = '';
//	public mixed $attributes               = '';
//	public mixed $insert_into_item         = '';
//	public mixed $uploaded_to_this_item    = '';
//	public mixed $featured_image           = '';
//	public mixed $set_featured_image       = '';
//	public mixed $remove_featured_image    = '';
//	public mixed $use_featured_image       = '';
//	public mixed $menu_name                = '';
//	public mixed $filter_items_list        = '';
//	public mixed $filter_by_date           = '';
//	public mixed $items_list_navigation    = '';
//	public mixed $items_list               = '';
//	public mixed $item_published           = '';
//	public mixed $item_published_privately = '';
//	public mixed $item_reverted_to_draft   = '';
//	public mixed $item_trashed             = '';
//	public mixed $item_scheduled           = '';
//	public mixed $item_updated             = '';
//	public mixed $item_link                = '';
//	public mixed $item_link_description    = '';

	/** Arguments. */
//	public mixed $label                           = null;
//	public mixed $labels                          = [];
//	public mixed $description                     = '';
//	public mixed $public                          = true;
//	public mixed $hierarchical                    = true;
//	public mixed $exclude_from_search             = false;
//	public mixed $publicly_queryable              = true;
//	public mixed $show_ui                         = true;
//	public mixed $show_in_menu                    = true;
//	public mixed $show_in_nav_menus               = true;
//	public mixed $show_in_admin_bar               = true;
//	public mixed $show_in_rest                    = true;
//	public mixed $rest_base                       = '';
//	public mixed $rest_namespace                  = '';
//	public mixed $rest_controller_class           = '';
//	public mixed $autosave_rest_controller_class  = '';
//	public mixed $revisions_rest_controller_class = '';
//	public mixed $late_route_registration         = true;
//	public mixed $menu_position                   = null;
//	public mixed $menu_icon                       = null;
//	public mixed $capability_type                 = 'post';
//	public mixed $capabilities                    = [];
//	public mixed $map_meta_cap                    = false;
//	public mixed $supports                        = ['title', 'editor', 'excerpt'];
//	public mixed $register_meta_box_cb            = null;
//	public mixed $taxonomies                      = [];
//	public mixed $has_archive                     = false;
//	public mixed $rewrite                         = true;
//	public mixed $can_export                      = true;
//	public mixed $delete_with_user                = false;
//	public mixed $template                        = [];
//	public mixed $template_lock                   = false;
//	public mixed $_builtin                        = false;

//	public mixed $_edit_link                      = null;     // Warning: This attribute may affect post editing.
//	public mixed $query_var                       = false;    // Warning: This attribute can affect article viewing beyond the frontend.

	/*
	 *
	 */

	public function customProperties(): void {

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
//		$this->args->labels['name']          = null;
//		$this->args->labels['singular_name'] = 'Custom singular name';

	}

}