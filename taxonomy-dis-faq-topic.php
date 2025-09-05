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

$taxonomy_slug = get_query_var( 'taxonomy' );
$term_slug     = get_query_var( 'term' );
if ( $taxonomy_slug && $term_slug ) {
?>


REDIRECT TO:
<BR/>
<?php echo $taxonomy_slug; ?>
<BR/>
<?php echo $term_slug; ?>
<BR/>


<?php
}
get_footer();
