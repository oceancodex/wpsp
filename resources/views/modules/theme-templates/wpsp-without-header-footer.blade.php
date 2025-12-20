<?php
/**
 * Template Name: WPSP - Page template without header and footer
 *
 * @see https://developer.wordpress.org/themes/classic-themes/templates/page-template-files/
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

?>
<?php
while (have_posts()) : the_post();
	the_content();
endwhile;
?>