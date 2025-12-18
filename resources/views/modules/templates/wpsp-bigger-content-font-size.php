<?php
/**
 * Template Name: Custom page template: wpsp-bigger-content-font-size
 *
 * @see https://developer.wordpress.org/themes/classic-themes/templates/page-template-files/
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

get_header('header');
?>
<div class="content-area">
	<main class="site-main" style="font-size: 200%;">
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