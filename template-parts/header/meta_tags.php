<?php
global $post;

$current_lang  = $args['current_lang'] ?? '';
$site_title    = $args['site_title'] ?? '';
$tagline       = $args['site_tagline'] ?? '';
$copyright     = $site_title;
$resource_type = 'document';
$charset       = 'text/html; charset=US-ASCII';
$page_title    = get_the_title();
$page_title    = $page_title ? $page_title : $site_title;
$keywords      = preg_replace( '/[^a-zA-Z0-9\s]/', '', $page_title . ' ' . $tagline );
?>

<meta name="resource-type" content="<?php echo esc_attr( $resource_type ); ?>" />
<meta name="description" content="<?php echo esc_attr( $page_title ); ?>" />
<meta name="copyright" content="<?php echo esc_attr( $site_title ); ?>" />
<meta name="keywords" content="<?php echo esc_attr( $keywords ); ?>"/>
<meta name="author" content="ICT Staff">
<meta name="generator" content="">
<meta name="robots" content="noindex">

<meta http-equiv="content-type" content="<?php echo esc_attr( $charset ); ?>" />
<meta http-equiv="content-language" content="<?php echo esc_attr( $current_lang ); ?>" />
