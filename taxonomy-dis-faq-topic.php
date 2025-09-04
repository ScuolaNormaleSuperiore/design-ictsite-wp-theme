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

$taxonomy = get_query_var('taxonomy');
$term     = get_query_var('term');
if ( $taxonomy && $term ) {
?>

TAXONOMY: <?php echo $taxonomy ?><br/>
TERM: <?php echo $term ?><br/>


<?php
}
get_footer();
