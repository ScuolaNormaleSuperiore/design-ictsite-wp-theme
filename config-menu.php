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
		'primary-menu'      => 'Primary menu on the left',
		'secondary-menu'    => 'Secondary menu on the right',
		'top-header-menu'   => 'Header menu top right',
		'footer-menu'       => 'Low footer menu',
		'useful-links-menu' => 'Footer menu useful links',
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
		),
	)
);
