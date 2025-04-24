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
define( 'DIS_PLACE_TYPE_TAXONOMY', 'dis-place-type' );
define( 'DIS_PERSON_ROLE_TAXONOMY', 'dis-person-role' );

//DEFAULT WP POST TYPES.
define( 'WP_DEFAULT_POST', 'post' );
define( 'WP_DEFAULT_PAGE', 'page' );

// CUSTOM CONTENT TYPES.
define( 'DIS_CLUSTER_POST_TYPE', 'dis-service-cluster' );
define( 'DIS_SERVICE_POST_TYPE', 'dis-service' );
define( 'DIS_OFFICE_POST_TYPE', 'dis-office' );
define( 'DIS_PERSON_POST_TYPE', 'dis-person' );
define( 'DIS_PROJECT_POST_TYPE', 'dis-project' );
define( 'DIS_PLACE_POST_TYPE', 'dis-place' );
define( 'DIS_EVENT_POST_TYPE', 'dis-event' );
define( 'DIS_USER_STATUS_POST_TYPE', 'dis-user-status' );
define( 'DIS_ATTACHMENT_POST_TYPE', 'dis-attachment' );
define( 'DIS_ALERT_POST_TYPE', 'dis-alert' ); /* no multilanguage */

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
		DIS_USER_STATUS_POST_TYPE,
		DIS_ATTACHMENT_POST_TYPE,
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

// Home Page Sections.
define(
	'DIS_HP_SECTIONS',
	array(
		'main_hero' =>
			array(
				'id'       => 'main_hero',
				'name'     => 'Main hero',
				'template' => 'template-parts/home/main-hero',
			),
		'site_description' =>
			array(
				'id'       => 'cluster_section',
				'name'     => 'Cluster list',
				'template' => 'template-parts/home/cluster-list',
			),
		'events_section' =>
			array(
				'id'       => 'news_section',
				'name'     => 'News',
				'template' => 'template-parts/home/hp-list-news',
			),
		'projects_section' =>
		array(
			'id'       => 'news_section',
			'name'     => 'Projects',
			'template' => 'template-parts/home/hp-list-projects',
		),
		'featured_contents' =>
			array(
				'id'       => 'featured_contents',
				'name'     => 'Contenuti in evidenza',
				'template' => 'template-parts/home/featured-contents',
			),
		'articles_section' =>
			array(
				'id'       => 'articles_section',
				'name'     => 'Articoli',
				'template' => 'template-parts/home/hp-list-article',
			),
		'banners_section' =>
			array(
				'id'       => 'banners_section',
				'name'     => 'Banner',
				'template' => 'template-parts/home/hp-banners-section',
			),
	)
);



// Page that is edited from the backend.
define( 'DIS_STATIC_PAGE_CAT', 'static_page' );
// Automatically built page with forms, maps, etc.
define( 'DIS_CUSTOM_PAGE_CAT', 'custom_page' );
// Page containing the list of posts of a certain type (archive).
define( 'DIS_ARCHIVE_PAGE_CAT', 'archive_page' );
