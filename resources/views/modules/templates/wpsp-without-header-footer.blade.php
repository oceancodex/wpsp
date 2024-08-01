<?php
/**
 * Template Name: WPSP - Page template without header and footer
 *
 * @package    WordPress
 * @subpackage OceanCodex_Base_Plugin
 * @since      Twenty Fourteen 1.0.1
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