<?php
/**
 * Template Name: WPSP - Page template center content
 *
 * @see https://developer.wordpress.org/themes/classic-themes/templates/page-template-files/
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

get_header('header');
?>
<div class="content-area">
	<main class="site-main" style="text-align: center;">
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