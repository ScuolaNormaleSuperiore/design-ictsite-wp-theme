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
define( 'USEFUL_LINKS_LOCATION_SLUG', 'useful-links-menu-location' );
define( 'USEFUL_LINKS_LOCATION_TITLE', 'Useful links' );
define( 'BOTTOM_FOOTER_LOCATION_SLUG', 'bottom-footer-menu-location' );
define( 'BOTTOM_FOOTER_LOCATION_TITLE', 'Bottom footer' );


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
	'DIS_PRIMARY_MENU',
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
				'slug'         => SERVICE_CLUSTER_PAGE_SLUG,
				'title'        => SERVICE_CLUSTER_PAGE_TITLE,
				'content_type' => 'page',
				'post_type'    => 'post_type',
				'status'       => 'publish',
				'classes'      => 'footer-link',
				'link'         => '',
			),
		),
	)
);

define(
	'DIS_SECONDARY_MENU',
	array(
		'name'     => 'Secondary Menu',
		'location' => SECONDARY_LOCATION_SLUG,
		'items'    => array(
			array(
				'slug'         => PROJECTS_PAGE_SLUG,
				'title'        => PROJECTS_PAGE_TITLE,
				'content_type' => 'page',
				'post_type'    => 'post_type',
				'status'       => 'publish',
				'classes'      => 'footer-link',
				'link'         => '',
			),
		),
	)
);

define(
	'DIS_HEADER_MENU',
	array(
		'name'     => 'Header Menu',
		'location' => TOP_HEADER_LOCATION_SLUG,
		'items'    => array(
			array(
				'slug'         => EVENTS_PAGE_SLUG,
				'title'        => EVENTS_PAGE_TITLE,
				'content_type' => 'page',
				'post_type'    => 'post_type',
				'status'       => 'publish',
				'classes'      => 'footer-link',
				'link'         => '',
			),
			array(
				'slug'         => ARTICLES_PAGE_SLUG,
				'title'        => ARTICLES_PAGE_TITLE,
				'content_type' => 'page',
				'post_type'    => 'post_type',
				'status'       => 'publish',
				'classes'      => 'footer-link',
				'link'         => '',
			),
			array(
				'slug'         => OFFICES_PAGE_SLUG,
				'title'        => OFFICES_PAGE_TITLE,
				'content_type' => 'page',
				'post_type'    => 'post_type',
				'status'       => 'publish',
				'classes'      => 'footer-link',
				'link'         => '',
			),
		),
	)
);

define(
	'DIS_FOOTER_MENU',
	array(
		'name'     => 'Footer Menu',
		'location' => BOTTOM_FOOTER_LOCATION_SLUG,
		'items'    => array(
			array(
				'slug'         => PRIVACY_PAGE_SLUG,
				'title'        => PRIVACY_PAGE_TITLE,
				'content_type' => 'page',
				'post_type'    => 'post_type',
				'status'       => 'publish',
				'classes'      => 'footer-link',
				'link'         => '',
			),
			array(
				'slug'         => MEDIA_POLICY_PAGE_SLUG,
				'title'        => MEDIA_POLICY_PAGE_TITLE,
				'content_type' => 'page',
				'post_type'    => 'post_type',
				'status'       => 'publish',
				'classes'      => 'footer-link',
				'link'         => '',
			),
			array(
				'slug'         => LEGAL_NOTES_PAGE_SLUG,
				'title'        => LEGAL_NOTES_PAGE_TITLE,
				'content_type' => 'page',
				'post_type'    => 'post_type',
				'status'       => 'publish',
				'classes'      => 'footer-link',
				'link'         => '',
			),
			array(
				'slug'         => SITE_MAP_PAGE_SLUG,
				'title'        => SITE_MAP_PAGE_TITLE,
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

define(
	'DIS_USEFUL_LINKS_MENU',
	array(
		'name'     => 'Useful Links Menu',
		'location' => USEFUL_LINKS_LOCATION_SLUG,
		'items'    => array(
			array(
				'slug'         => ACCESSIBILITY_PAGE_SLUG,
				'title'        => ACCESSIBILITY_PAGE_TITLE,
				'content_type' => 'page',
				'post_type'    => 'post_type',
				'status'       => 'publish',
				'classes'      => 'footer-link',
				'link'         => '',
			),
			array(
				'slug'         => PLACES_PAGE_SLUG,
				'title'        => PLACES_PAGE_TITLE,
				'content_type' => 'page',
				'post_type'    => 'post_type',
				'status'       => 'publish',
				'classes'      => 'footer-link',
				'link'         => '',
			),
		),
	)
);


define(
	'DIS_SITE_MENU_LIST',
	array(
		DIS_PRIMARY_MENU,
		DIS_SECONDARY_MENU,
		DIS_HEADER_MENU,
		DIS_USEFUL_LINKS_MENU,
		DIS_FOOTER_MENU,
	)
);
