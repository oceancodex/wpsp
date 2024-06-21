<?php
/**
 * Template Name: Custom page template: wpsp-right-content
 *
 * @package    WordPress
 * @subpackage OceanCodex_Base_Plugin
 * @since      Twenty Fourteen 1.0.1
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

get_header('header');
?>
<div class="content-area">
	<main class="site-main" style="text-align: right;">
		<?php
		while (have_posts()) : the_post();
			the_content();
		endwhile;
		?>
	</main>
</div>

<?php
get_footer();
?>