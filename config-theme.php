<?php
/**
 * Design ICT Site constants and configurations.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Design_ICT_Site
 */

// Site Map.
define( 'DIS_HOMEPAGE_SLUG', 'homepage' );
define( 'DIS_HOMEPAGE_NAME', 'Home Page' );
define( 'DIS_NETWORK_SLUG', 'network' );
define( 'DIS_NETWORK_NAME', 'Network' );

// DEFAULT WP TAXONOMIES.
define( 'DIS_DEFAULT_CATEGORY', 'category' );
define( 'DIS_DEFAULT_TAGS', 'post-tag' );
define( 'DIS_PLACE_TYPE_TAXONOMY', 'dis-place-type' );
define( 'DIS_PERSON_ROLE_TAXONOMY', 'dis-person-role' );
define( 'DIS_USER_STATUS_TAXONOMY', 'dis-user-status' );
define( 'DIS_FAQ_TOPIC_TAXONOMY', 'dis-faq-topic' );

// DEFAULT WP POST TYPES.
define( 'DIS_DEFAULT_POST', 'post' );
define( 'DIS_DEFAULT_PAGE', 'page' );

// CUSTOM CONTENT TYPES.
define( 'DIS_SERVICE_CLUSTER_POST_TYPE', 'dis-service-cluster' );
define( 'DIS_SERVICE_ITEM_POST_TYPE', 'dis-service' );
define( 'DIS_OFFICE_POST_TYPE', 'dis-office' );
define( 'DIS_PERSON_POST_TYPE', 'dis-person' );
define( 'DIS_PROJECT_POST_TYPE', 'dis-project' );
define( 'DIS_PLACE_POST_TYPE', 'dis-place' );
define( 'DIS_EVENT_POST_TYPE', 'dis-event' );
define( 'DIS_NEWS_POST_TYPE', 'dis-news' );
define( 'DIS_ATTACHMENT_POST_TYPE', 'dis-attachment' );
define( 'DIS_BANNER_POST_TYPE', 'dis-banner' );
define( 'DIS_SPONSOR_POST_TYPE', 'dis-sponsor' );
define( 'DIS_FAQ_POST_TYPE', 'dis-faq' );

// CUSTOM CONTENT BASE DATA.
if ( ! function_exists( 'dis_ct_data' ) ) {
	function dis_ct_data() {
		global $dis_ct_data;
		if ( ! isset( $dis_ct_data ) ) {
			$dis_ct_data = array(
				DIS_EVENT_POST_TYPE => array(
					'type'          => DIS_EVENT_POST_TYPE,
					'singular_name' => _x( 'Event', 'DIS_PostTypeLabels', 'design_ict_site' ),
					'plural_name'   => _x( 'Events', 'DIS_PostTypeLabels', 'design_ict_site' ),
					'slug'          => _x( 'events', 'DIS_PostTypeSlugs', 'design_ict_site' ),
				),
				DIS_NEWS_POST_TYPE => array(
					'type'          => DIS_NEWS_POST_TYPE,
					'singular_name' => _x( 'News', 'DIS_PostTypeLabels', 'design_ict_site' ),
					'plural_name'   => _x( 'News-plural', 'DIS_PostTypeLabels', 'design_ict_site' ),
					'slug'          => _x( 'news', 'DIS_PostTypeSlugs', 'design_ict_site' ),
				),
				DIS_PROJECT_POST_TYPE => array(
					'type'          => DIS_PROJECT_POST_TYPE,
					'singular_name' => _x( 'Project', 'DIS_PostTypeLabels', 'design_ict_site' ),
					'plural_name'   => _x( 'Projects', 'DIS_PostTypeLabels', 'design_ict_site' ),
					'slug'          => _x( 'projects', 'DIS_PostTypeSlugs', 'design_ict_site' ),
				),
				DIS_OFFICE_POST_TYPE => array(
					'type'          => DIS_OFFICE_POST_TYPE,
					'singular_name' => _x( 'Office', 'DIS_PostTypeLabels', 'design_ict_site' ),
					'plural_name'   => _x( 'Offices', 'DIS_PostTypeLabels', 'design_ict_site' ),
					'slug'          => _x( 'offices', 'DIS_PostTypeSlugs', 'design_ict_site' ),
				),
				DIS_SERVICE_CLUSTER_POST_TYPE => array(
					'type'          => DIS_SERVICE_CLUSTER_POST_TYPE,
					'singular_name' => _x( 'Service Cluster', 'DIS_PostTypeLabels', 'design_ict_site' ),
					'plural_name'   => _x( 'Service Clusters', 'DIS_PostTypeLabels', 'design_ict_site' ),
					'slug'          => _x( 'service-clusters', 'DIS_PostTypeSlugs', 'design_ict_site' ),
				),
				DIS_SERVICE_ITEM_POST_TYPE => array(
					'type'          => DIS_SERVICE_ITEM_POST_TYPE,
					'singular_name' => _x( 'Service', 'DIS_PostTypeLabels', 'design_ict_site' ),
					'plural_name'   => _x( 'Services', 'DIS_PostTypeLabels', 'design_ict_site' ),
					'slug'          => _x( 'services', 'DIS_PostTypeSlugs', 'design_ict_site' ),
				),
				DIS_PERSON_POST_TYPE => array(
					'type'          => DIS_PERSON_POST_TYPE,
					'singular_name' => _x( 'Person', 'DIS_PostTypeLabels', 'design_ict_site' ),
					'plural_name'   => _x( 'Persons', 'DIS_PostTypeLabels', 'design_ict_site' ),
					'slug'          => _x( 'people', 'DIS_PostTypeSlugs', 'design_ict_site' ),
				),
				DIS_PLACE_POST_TYPE => array(
					'type'          => DIS_PLACE_POST_TYPE,
					'singular_name' => _x( 'Place', 'DIS_PostTypeLabels', 'design_ict_site' ),
					'plural_name'   => _x( 'Places', 'DIS_PostTypeLabels', 'design_ict_site' ),
					'slug'          => _x( 'places', 'DIS_PostTypeSlugs', 'design_ict_site' ),
				),
				DIS_ATTACHMENT_POST_TYPE => array(
					'type'          => DIS_ATTACHMENT_POST_TYPE,
					'singular_name' => _x( 'Attachment', 'DIS_PostTypeLabels', 'design_ict_site' ),
					'plural_name'   => _x( 'Attachments', 'DIS_PostTypeLabels', 'design_ict_site' ),
					'slug'          => _x( 'attachments', 'DIS_PostTypeSlugs', 'design_ict_site' ),
				),
				DIS_BANNER_POST_TYPE => array(
					'type'          => DIS_BANNER_POST_TYPE,
					'singular_name' => _x( 'Banner', 'DIS_PostTypeLabels', 'design_ict_site' ),
					'plural_name'   => _x( 'Banners', 'DIS_PostTypeLabels', 'design_ict_site' ),
					'slug'          => _x( 'banners', 'DIS_PostTypeSlugs', 'design_ict_site' ),
				),
				DIS_SPONSOR_POST_TYPE => array(
					'type'          => DIS_SPONSOR_POST_TYPE,
					'singular_name' => _x( 'Sponsor', 'DIS_PostTypeLabels', 'design_ict_site' ),
					'plural_name'   => _x( 'Sponsors', 'DIS_PostTypeLabels', 'design_ict_site' ),
					'slug'          => _x( 'sponsors', 'DIS_PostTypeSlugs', 'design_ict_site' ),
				),
				DIS_DEFAULT_POST => array(
					'type'          => DIS_DEFAULT_POST,
					'singular_name' => _x( 'Article', 'DIS_PostTypeLabels', 'design_ict_site' ),
					'plural_name'   => _x( 'Articles', 'DIS_PostTypeLabels', 'design_ict_site' ),
					'slug'          => _x( 'articles', 'DIS_PostTypeSlugs', 'design_ict_site' ),
				),
				DIS_DEFAULT_PAGE => array(
					'type'          => DIS_DEFAULT_PAGE,
					'singular_name' => _x( 'Page', 'DIS_PostTypeLabels', 'design_ict_site' ),
					'plural_name'   => _x( 'Pages', 'DIS_PostTypeLabels', 'design_ict_site' ),
					'slug'          => _x( 'pages', 'DIS_PostTypeSlugs', 'design_ict_site' ),
				),
				DIS_FAQ_POST_TYPE => array(
					'type'          => DIS_FAQ_POST_TYPE,
					'singular_name' => _x( 'Faq', 'DIS_PostTypeLabels', 'design_ict_site' ),
					'plural_name'   => _x( 'Faq', 'DIS_PostTypeLabels', 'design_ict_site' ),
					'slug'          => _x( 'faq', 'DIS_PostTypeSlugs', 'design_ict_site' ),
				),
			);
		}
		return $dis_ct_data;
	}
}


/* MENU */

/* ROLES AND PERMISSIONS */
define( 'DIS_EDIT_PERMISSION', 'edit_posts' );
define( 'DIS_EDIT_THEME_PERMISSION', 'edit_theme_options' );
define( 'DIS_EDIT_CONFIG_PERMISSION', 'dis_edit_site_configuration' );
define( 'DIS_ADMIN_EDIT_CONFIG_PERMISSION', 'manage_options' );

/* Define Super Editor */
define( 'DIS_SUPER_EDITOR_ROLE_SLUG', 'dis_super_editor' );
define( 'DIS_SUPER_EDITOR_ROLE_NAME', 'Super Editor' );


/* MULTILANGUAGE constants*/
define(
	'MULTILANG_TAXONOMIES',
	array(
		DIS_DEFAULT_CATEGORY,
		DIS_DEFAULT_PAGE,
		DIS_PLACE_TYPE_TAXONOMY,
		DIS_PERSON_ROLE_TAXONOMY,
		DIS_USER_STATUS_TAXONOMY,
		DIS_FAQ_TOPIC_TAXONOMY,
	)
);

define(
	'MULTILANG_POST_TYPES',
	array(
		DIS_DEFAULT_POST,
		DIS_DEFAULT_PAGE,
		DIS_SERVICE_CLUSTER_POST_TYPE,
		DIS_SERVICE_ITEM_POST_TYPE,
		DIS_PERSON_POST_TYPE,
		DIS_PROJECT_POST_TYPE,
		DIS_PLACE_POST_TYPE,
		DIS_OFFICE_POST_TYPE,
		DIS_EVENT_POST_TYPE,
		DIS_NEWS_POST_TYPE,
		DIS_ATTACHMENT_POST_TYPE,
		DIS_SPONSOR_POST_TYPE,
		DIS_BANNER_POST_TYPE,
		DIS_FAQ_POST_TYPE,
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
		array(
			'name'     => 'WP Mail SMTP',
			'slug'     => 'wp-mail-smtp',
			'required' => true,
		),
		array(
			'name'     => 'Really Simple CAPTCHA',
			'slug'     => 'really-simple-captcha',
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
		'news_section' =>
			array(
				'id'       => 'news_section',
				'name'     => 'News',
				'template' => 'template-parts/home/hp-news-section',
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
		'video_section' =>
			array(
				'id'       => 'video_section',
				'name'     => 'Video',
				'template' => 'template-parts/home/hp-video-section',
			),
	)
);

// Site Search.
define( 'DIS_ACF_SHORT_DESC_LENGTH', 30 );
define( 'DIS_ACF_SHORT_TEXT_LENGTH', 256 );

// PAGINATION constants.
define( 'DIS_ITEMS_PER_PAGE_EVEN', 10 );
define( 'DIS_ITEMS_PER_PAGE_VALUES_EVEN', array( '4', '10', '20', '30', '40', '50' ) );
define( 'DIS_ITEMS_PER_PAGE_ODD', 9 );
define( 'DIS_ITEMS_PER_PAGE_VALUES_ODD', array( '3', '9', '12', '24', '48' ) );

// Bot definitions.
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
