<?php
/**
 * Generic meta tags.
 *
 * @package Design_ICT_Site
 */

$dis_current_lang  = $args['current_lang'] ?? '';
$dis_site_title    = $args['site_title'] ?? '';
$dis_tagline       = $args['site_tagline'] ?? '';
$dis_resource_type = 'document';
$dis_charset       = 'text/html; charset=US-ASCII';
$dis_page_title    = get_the_title();
$dis_page_title    = $dis_page_title ? $dis_page_title : $dis_site_title;
$dis_keywords      = preg_replace( '/[^a-zA-Z0-9\s]/', '', $dis_page_title . ' ' . $dis_tagline );
?>

<meta name="resource-type" content="<?php echo esc_attr( $dis_resource_type ); ?>" />
<meta name="description" content="<?php echo esc_attr( $dis_page_title ); ?>" />
<meta name="copyright" content="<?php echo esc_attr( $dis_site_title ); ?>" />
<meta name="keywords" content="<?php echo esc_attr( $dis_keywords ); ?>"/>
<meta name="author" content="ICT Staff">
<meta name="generator" content="">
<meta name="robots" content="noindex">

<meta http-equiv="content-type" content="<?php echo esc_attr( $dis_charset ); ?>" />
<meta http-equiv="content-language" content="<?php echo esc_attr( $dis_current_lang ); ?>" />
