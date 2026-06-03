<?php
/**
 * Detail page for the post-type: dis-user-status.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Design_ICT_Site
 */

// This post type has no public single view: redirect single requests to the
// home page.
wp_safe_redirect( home_url( '/' ) );
exit;
