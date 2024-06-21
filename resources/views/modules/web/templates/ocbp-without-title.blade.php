<?php
/**
 * Template Name: OCBP - Page template without title
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
	<main class="site-main">
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