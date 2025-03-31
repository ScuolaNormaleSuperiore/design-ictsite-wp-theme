<?php
/**
 * Design ICT Site constants and configurations.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Design_ICT_Site
 */


// DEFAULT WP TAXONOMIES.
define( 'DIS_DEFAULT_CATEGORY', 'category' );
define( 'DIS_DEFAULT_TAGS', 'post-tag' );
define( 'DIS_PLACE_TYPE_TAXONOMY', 'place-type' );
define( 'DIS_PERSON_ROLE_TAXONOMY', 'person-role' );

//DEFAULT WP POST TYPES.
define( 'WP_DEFAULT_POST', 'post' );
define( 'WP_DEFAULT_PAGE', 'page' );

// CUSTOM CONTENT TYPES.
define( 'DIS_CLUSTER_POST_TYPE', 'service-cluster' );
define( 'DIS_SERVICE_POST_TYPE', 'service' );
define( 'DIS_OFFICE_POST_TYPE', 'office' );
define( 'DIS_PERSON_POST_TYPE', 'person' );
define( 'DIS_PROJECT_POST_TYPE', 'project' );
define( 'DIS_PLACE_POST_TYPE', 'place' );
define( 'DIS_EVENT_POST_TYPE', 'event' );
define( 'DIS_ALERT_POST_TYPE', 'alert' ); /* no multilanguage */

/* MENU */
define( 'DIS_SLUG_MAIN_MENU', 'dis_main_menu' );

/* ROLES AND PERMISSIONS */
define( 'DIS_EDIT_PERMISSION', 'edit_posts' );
define( 'DIS_EDIT_THEME_PERMISSION', 'edit_theme_options' );


/* MULTILANGUAGE */

define(
	'MULTILANG_TAXONOMIES',
	array(
		DIS_DEFAULT_CATEGORY,
		WP_DEFAULT_PAGE,
		DIS_PLACE_TYPE_TAXONOMY,
		DIS_PERSON_ROLE_TAXONOMY,
	)
);

define(
	'MULTILANG_POST_TYPES',
	array(
		WP_DEFAULT_POST,
		WP_DEFAULT_PAGE,
		DIS_CLUSTER_POST_TYPE,
		DIS_SERVICE_POST_TYPE,
		DIS_PERSON_POST_TYPE,
		DIS_PROJECT_POST_TYPE,
		DIS_PLACE_POST_TYPE,
		DIS_EVENT_POST_TYPE,
	)
);

/**
 *  The mandatory plugin used by this theme.
 */
define(
	'REQUIRED_PLUGINS',
	array(
		array(
			'name'     => 'Polylang - Multilanguage support',
			'slug'     => 'polylang',
			'required' => true,
		),
		array(
			'name'     => 'Advanced Custom Fields',
			'slug'     => 'advanced-custom-fields',
			'required' => true,
		),
	)
);
