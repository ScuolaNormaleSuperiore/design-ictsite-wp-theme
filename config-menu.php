<?php
/**
 * List of the menus of the site.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Design_ICT_Site
 */

define( 'PRIMARY_LOCATION_SLUG', 'primary-menu-location' );
define( 'PRIMARY_LOCATION_TITLE', 'Primary on the left' );
define( 'SECONDARY_LOCATION_SLUG', 'secondary-menu-location' );
define( 'SECONDARY_LOCATION_TITLE', 'Secondary on the right' );
define( 'TOP_HEADER_LOCATION_SLUG', 'top-header-menu-location' );
define( 'TOP_HEADER_LOCATION_TITLE', 'Header top' );
define( 'BOTTOM_FOOTER_LOCATION_SLUG', 'bottom-footer-menu-location' );
define( 'BOTTOM_FOOTER_LOCATION_TITLE', 'Bottom footer' );
define( 'USEFUL_LINKS_LOCATION_SLUG', 'useful-links-menu-location' );
define( 'USEFUL_LINKS_LOCATION_TITLE', 'Useful links' );


define(
	'DIS_MENU_LOCATIONS',
	array(
		PRIMARY_LOCATION_SLUG       => PRIMARY_LOCATION_TITLE,
		SECONDARY_LOCATION_SLUG     => SECONDARY_LOCATION_TITLE,
		TOP_HEADER_LOCATION_SLUG    => TOP_HEADER_LOCATION_TITLE,
		BOTTOM_FOOTER_LOCATION_SLUG => BOTTOM_FOOTER_LOCATION_TITLE,
		USEFUL_LINKS_LOCATION_SLUG  => USEFUL_LINKS_LOCATION_TITLE,
	)
);

define(
	'DIS_MAIN_MENU',
	array(
		'name'     => 'Primary Menu',
		'location' => PRIMARY_LOCATION_SLUG,
		'items'    => array(
			array(
				'slug'         => PEOPLE_PAGE_SLUG,
				'title'        => PEOPLE_PAGE_TITLE,
				'content_type' => 'page',
				'post_type'    => 'post_type',
				'status'       => 'publish',
				'classes'      => 'footer-link',
				'link'         => '',
			),
			array(
				'slug'         => SERVICE_ITEM_PAGE_SLUG,
				'title'        => SERVICE_ITEM_PAGE_TITLE,
				'content_type' => 'page',
				'post_type'    => 'post_type',
				'status'       => 'publish',
				'classes'      => 'footer-link',
				'link'         => '',
			),
			array(
				'slug'         => '',
				'title'        => 'ReuseLinkTitle',
				'content_type' => '',
				'post_type'    => '',
				'status'       => 'publish',
				'classes'      => 'footer-link',
				'link'         => 'https://developers.italia.it/it/software/sns_pi-scuolanormalesuperiore-design-laboratori-wordpress-theme',
			),
		),
	)
);
