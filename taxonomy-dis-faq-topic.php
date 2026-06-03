<?php
/**
 * Template page to show FAQ by topic.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Design_ICT_Site
 */

// FAQ topic taxonomy archive: redirect to the FAQ-by-topic page, passing the
// requested topic as a query argument so the dedicated template handles it.
$dis_term_slug  = get_query_var( 'term' );
$dis_topic_page = DIS_MultiLangManager::get_page_by_label( FAQ_TOPIC_PAGE_SLUG );

if ( $dis_topic_page && $dis_term_slug ) {
	wp_safe_redirect( add_query_arg( 'topic', $dis_term_slug, get_permalink( $dis_topic_page ) ) );
} else {
	wp_safe_redirect( home_url( '/' ) );
}
exit;
