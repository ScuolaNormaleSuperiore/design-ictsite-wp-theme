<?php
/**
 * Post template
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Design_ICT_Site
 */

global $post;
get_header();
?>

<div class="container shadow rounded  p-4 pt-3 pb-3 mb-5">
	<h2 class="pb-2"><?php echo get_the_title(); ?></h2>


</div>


<?php
get_footer();
