<?php
/**
 * Category archive redirect.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Design_ICT_Site
 */

// Category archives are not part of the theme's public navigation: redirect
// direct requests instead of exposing the legacy placeholder page.
wp_safe_redirect( home_url( '/' ) );
exit;
