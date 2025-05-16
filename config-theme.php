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
define( 'DIS_BANNER_POST_TYPE', 'dis-banner' );
define( 'DIS_SPONSOR_POST_TYPE', 'dis-sponsor' );


/* MENU */
define( 'DIS_SLUG_MAIN_MENU', 'DIS_PRIMARY_MENU' );

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
		DIS_OFFICE_POST_TYPE,
		DIS_EVENT_POST_TYPE,
		DIS_USER_STATUS_POST_TYPE,
		DIS_ATTACHMENT_POST_TYPE,
		DIS_SPONSOR_POST_TYPE,
		DIS_BANNER_POST_TYPE,
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
		array(
			'name'     => 'ACF OpenStreetMap Field',
			'slug'     => 'acf-openstreetmap-field',
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
				'template' => 'template-parts/home/hp-main-hero-section',
			),
		'cluster_section' =>
			array(
				'id'       => 'cluster_section',
				'name'     => 'Cluster list',
				'template' => 'template-parts/home/hp-clusters-section',
			),
		'events_section' =>
			array(
				'id'       => 'events_section',
				'name'     => 'Events',
				'template' => 'template-parts/home/hp-events-section',
			),
		'projects_section' =>
			array(
				'id'       => 'projects_section',
				'name'     => 'Projects',
				'template' => 'template-parts/home/hp-projects-section',
			),
		'featured_contents' =>
			array(
				'id'       => 'featured_contents',
				'name'     => 'Featured contents',
				'template' => 'template-parts/home/hp-featured-contents-section',
			),
		'articles_section' =>
			array(
				'id'       => 'articles_section',
				'name'     => 'Articles',
				'template' => 'template-parts/home/hp-articles-section',
			),
		'banners_section' =>
			array(
				'id'       => 'banners_section',
				'name'     => 'Banners',
				'template' => 'template-parts/home/hp-banners-section',
			),
		'sponsors_section' =>
			array(
				'id'       => 'sponsors_section',
				'name'     => 'Sponsors',
				'template' => 'template-parts/home/hp-sponsors-section',
			),
	)
);


define(
	'BOT_LABEL',
	array(
		'bot',
		'crawl',
		'slurp',
		'spider',
		'curl',
		'wget',
		'python-requests',
		'httpclient',
		'google',
		'bing',
		'yahoo',
		'baidu',
		'duckduckbot',
		'yandex',
		'sogou',
		'exabot',
		'facebot',
		'facebookexternalhit',
		'ia_archiver',
		'archive.org_bot',
		'pinterest',
		'linkedinbot',
		'embedly',
		'quora link preview',
		'outbrain',
		'whatsapp',
		'telegrambot',
		'slackbot',
		'discordbot',
		'applebot',
		'twitterbot',
		'nuzzel',
		'vkShare',
		'redditbot',
		'mastodon',
		'skypeuripreview',
		'flipboard',
		'tumblr',
		'bitlybot',
		'screaming frog',
		'ahrefs',
		'semrush',
		'mj12bot',
		'seznambot',
		'dotbot',
		'uptimebot',
		'pingdom',
		'site24x7',
		'datadog',
		'statuscake',
		'newrelicpinger',
		'zabbix',
		'netcraft',
		'node-superagent',
		'axios',
		'libwww-perl',
		'okhttp',
		'go-http-client',
		'jakarta',
		'python-urllib',
		'java/',
		'wordpress/',
		'scrapy',
		'phpspider',
		'guzzlehttp',
	)
);
