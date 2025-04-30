<?php
/**
 * List of the menus of the site.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Design_ICT_Site
 */

define(
	'DIS_MENU_LOCATIONS',
	array(
		'primary-menu-location'      => 'Primary on the left',
		'secondary-menu-location'    => 'Secondary on the right',
		'top-header-menu-location'   => 'Header top',
		'footer-menu-location'       => 'Bottom footer',
		'useful-links-menu-location' => 'Useful links',
	)
);

define(
	'DIS_MAIN_MENU',
	array(
		'name'     => 'Primary Menu',
		'location' => 'primary-menu',
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
				'title'        => 'ReuseLink',
				'content_type' => '',
				'post_type'    => '',
				'status'       => 'publish',
				'classes'      => 'footer-link',
				'link'         => 'https://developers.italia.it/it/software/sns_pi-scuolanormalesuperiore-design-laboratori-wordpress-theme',
			),
		),
	)
);
