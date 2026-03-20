<?php
/**
 * Template page to show FAQ by topic.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Design_ICT_Site
 */

global $post;
global $wp_query;
get_header();

$dis_taxonomy_slug = get_query_var( 'taxonomy' );
$dis_term_slug     = get_query_var( 'term' );
if ( $dis_taxonomy_slug && $dis_term_slug ) {
	?>


REDIRECT TO:
<BR/>
	<?php echo esc_html( $dis_taxonomy_slug ); ?>
<BR/>
	<?php echo esc_html( $dis_term_slug ); ?>
<BR/>


	<?php
}
get_footer();
