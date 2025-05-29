<?php
/**
 *
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Design_ICT_Site
 */

// Page that is edited from the backend.
define( 'DIS_STATIC_PAGE_CAT', 'static_page' );
// Automatically built page with forms, maps, etc.
define( 'DIS_CUSTOM_PAGE_CAT', 'custom_page' );
// Page containing the list of posts of a certain type (archive).
define( 'DIS_ARCHIVE_PAGE_CAT', 'archive_page' );


/* PAGE SLUGS */
define( 'CONTACTS_PAGE_SLUG', 'ContactsPageSlug' );
define( 'CONTACTS_PAGE_TITLE', 'ContactsPageTitle' );
define( 'SITE_MAP_PAGE_SLUG', 'SiteMapPageSlug' );
define( 'SITE_MAP_PAGE_TITLE', 'SiteMapPageTitle' );
define( 'PRIVACY_PAGE_SLUG', 'PrivacyPageSlug' );
define( 'PRIVACY_PAGE_TITLE', 'PrivacyPageTitle' );
define( 'NEWSLETTER_PAGE_SLUG', 'NewsletterPageSlug' );
define( 'NEWSLETTER_PAGE_TITLE', 'NewsletterPageTitle' );
define( 'ACCESSIBILITY_PAGE_SLUG', 'AccessibilityPageSlug' );
define( 'ACCESSIBILITY_PAGE_TITLE', 'AccessibilityPageTitle' );
define( 'LEGAL_NOTES_PAGE_SLUG', 'LegalNotesPageSlug' );
define( 'LEGAL_NOTES_PAGE_TITLE', 'LegalNotesPageTitle' );
define( 'SITE_SEARCH_PAGE_SLUG', 'SiteSearchPageSlug' );
define( 'SITE_SEARCH_PAGE_TITLE', 'SiteSearchPageTitle' );
define( 'MEDIA_POLICY_PAGE_SLUG', 'MediaPolicyPageSlug' );
define( 'MEDIA_POLICY_PAGE_TITLE', 'MediaPolicyPageTitle' );
define( 'ABOUT_US_PAGE_SLUG', 'AboutUsPageSlug' );
define( 'ABOUT_US_PAGE_TITLE', 'AboutUsPageTitle' );
define( 'DOCUMENTATION_PAGE_SLUG', 'DocumentationPageSlug' );
define( 'DOCUMENTATION_PAGE_TITLE', 'DocumentationPageTitle' );
define( 'FAQ_PAGE_SLUG', 'FaqPageSlug' );
define( 'FAQ_PAGE_TITLE', 'FaqPageTitle' );

// POST TYPE SLUGS.
define( 'ARTICLES_PAGE_SLUG', 'ArticlePageSlug' );
define( 'ARTICLES_PAGE_TITLE', 'ArticlePageTitle' );
define( 'OFFICES_PAGE_SLUG', 'OfficePageSlug' );
define( 'OFFICES_PAGE_TITLE', 'OfficePageTitle' );
define( 'PLACES_PAGE_SLUG', 'PlacePageSlug' );
define( 'PLACES_PAGE_TITLE', 'PlacePageTitle' );

define( 'EVENTS_PAGE_SLUG', 'EventPageSlug' );
define( 'EVENTS_PAGE_TITLE', 'EventPageTitle' );
define( 'PROJECTS_PAGE_SLUG', 'ProjectPageSlug' );
define( 'PROJECTS_PAGE_TITLE', 'ProjectPageTitle' );
define( 'PEOPLE_PAGE_SLUG', 'PeoplePageSlug' );
define( 'PEOPLE_PAGE_TITLE', 'PeoplePageTitle' );
define( 'SERVICE_CLUSTER_PAGE_SLUG', 'ServiceClusterPageSlug' );
define( 'SERVICE_CLUSTER_PAGE_TITLE', 'ServiceClusterPageTitle' );
define( 'SERVICE_ITEM_PAGE_SLUG', 'ServiceItemPageSlug' );
define( 'SERVICE_ITEM_PAGE_TITLE', 'ServiceItemPageTitle' );

/* PAGES */
define(
	'DIS_STATIC_PAGES',
	array(
		CONTACTS_PAGE_SLUG =>
			array(
				'content_slug'     => CONTACTS_PAGE_SLUG,
				'content_file'     => '',
				'content_title'    => CONTACTS_PAGE_TITLE,
				'content'          => '',
				'content_status'   => 'publish',
				'content_author'   => 1,
				'content_template' => 'page-templates/contacts.php',
				'content_type'     => 'page',
				'content_parent'   => null,
				'content_category' => DIS_CUSTOM_PAGE_CAT,
			),
		SITE_MAP_PAGE_SLUG =>
			array(
				'content_slug'     => SITE_MAP_PAGE_SLUG,
				'content_file'     => '',
				'content_title'    => SITE_MAP_PAGE_TITLE,
				'content'          => '',
				'content_status'   => 'publish',
				'content_author'   => 1,
				'content_template' => 'page-templates/site-map.php',
				'content_type'     => 'page',
				'content_parent'   => null,
				'content_category' => DIS_CUSTOM_PAGE_CAT,
			),
		PRIVACY_PAGE_SLUG =>
			array(
				'content_slug'     => PRIVACY_PAGE_SLUG,
				'content_file'     => 'assets/html/privacy_xx.html',
				'content_title'    => PRIVACY_PAGE_TITLE,
				'content'          => '',
				'content_status'   => 'publish',
				'content_author'   => 1,
				'content_template' => 'page-templates/privacy.php',
				'content_type'     => 'page',
				'content_parent'   => null,
				'content_category' => DIS_CUSTOM_PAGE_CAT,
			),
		NEWSLETTER_PAGE_SLUG =>
			array(
				'content_slug'     => NEWSLETTER_PAGE_SLUG,
				'content_file'     => '',
				'content_title'    => NEWSLETTER_PAGE_TITLE,
				'content'          => '',
				'content_status'   => 'publish',
				'content_author'   => 1,
				'content_template' => 'page-templates/newsletter.php',
				'content_type'     => 'page',
				'content_parent'   => null,
				'content_category' => DIS_CUSTOM_PAGE_CAT,
			),
		ACCESSIBILITY_PAGE_SLUG =>
			array(
				'content_slug'     => ACCESSIBILITY_PAGE_SLUG,
				'content_file'     => 'assets/html/accessibility_xx.html',
				'content_title'    => ACCESSIBILITY_PAGE_TITLE,
				'content'          => '',
				'content_status'   => 'publish',
				'content_author'   => 1,
				'content_template' => '',
				'content_type'     => 'page',
				'content_parent'   => null,
				'content_category' => DIS_STATIC_PAGE_CAT,
			),
		LEGAL_NOTES_PAGE_SLUG =>
			array(
				'content_slug'     => LEGAL_NOTES_PAGE_SLUG,
				'content_file'     => 'assets/html/legal_notes_xx.html',
				'content_title'    => LEGAL_NOTES_PAGE_TITLE,
				'content'          => '',
				'content_status'   => 'publish',
				'content_author'   => 1,
				'content_template' => '',
				'content_type'     => 'page',
				'content_parent'   => null,
				'content_category' => DIS_STATIC_PAGE_CAT,
			),
		SITE_SEARCH_PAGE_SLUG =>
			array(
				'content_slug'     => SITE_SEARCH_PAGE_SLUG,
				'content_file'     => '',
				'content_title'    => SITE_SEARCH_PAGE_TITLE,
				'content'          => '',
				'content_status'   => 'publish',
				'content_author'   => 1,
				'content_template' => 'page-templates/search.php',
				'content_type'     => 'page',
				'content_parent'   => null,
				'content_category' => DIS_CUSTOM_PAGE_CAT,
			),
		PEOPLE_PAGE_SLUG =>
			array(
				'content_slug'     => PEOPLE_PAGE_SLUG,
				'content_file'     => '',
				'content_title'    => PEOPLE_PAGE_TITLE,
				'content'          => '',
				'content_status'   => 'publish',
				'content_author'   => 1,
				'content_template' => 'page-templates/people.php',
				'content_type'     => 'page',
				'content_parent'   => null,
				'content_category' => DIS_ARCHIVE_PAGE_CAT,
			),
		SERVICE_CLUSTER_PAGE_SLUG =>
			array(
				'content_slug'     => SERVICE_CLUSTER_PAGE_SLUG,
				'content_file'     => '',
				'content_title'    => SERVICE_CLUSTER_PAGE_TITLE,
				'content'          => '',
				'content_status'   => 'publish',
				'content_author'   => 1,
				'content_template' => 'page-templates/service-clusters.php',
				'content_type'     => 'page',
				'content_parent'   => null,
				'content_category' => DIS_ARCHIVE_PAGE_CAT,
			),
		SERVICE_ITEM_PAGE_SLUG =>
			array(
				'content_slug'     => SERVICE_ITEM_PAGE_SLUG,
				'content_file'     => '',
				'content_title'    => SERVICE_ITEM_PAGE_TITLE,
				'content'          => '',
				'content_status'   => 'publish',
				'content_author'   => 1,
				'content_template' => 'page-templates/service-items.php',
				'content_type'     => 'page',
				'content_parent'   => null,
				'content_category' => DIS_ARCHIVE_PAGE_CAT,
			),
		EVENTS_PAGE_SLUG =>
			array(
				'content_slug'     => EVENTS_PAGE_SLUG,
				'content_file'     => '',
				'content_title'    => EVENTS_PAGE_TITLE,
				'content'          => '',
				'content_status'   => 'publish',
				'content_author'   => 1,
				'content_template' => 'page-templates/events.php',
				'content_type'     => 'page',
				'content_parent'   => null,
				'content_category' => DIS_ARCHIVE_PAGE_CAT,
			),
		ARTICLES_PAGE_SLUG =>
			array(
				'content_slug'     => ARTICLES_PAGE_SLUG,
				'content_file'     => '',
				'content_title'    => ARTICLES_PAGE_TITLE,
				'content'          => '',
				'content_status'   => 'publish',
				'content_author'   => 1,
				'content_template' => 'page-templates/articles.php',
				'content_type'     => 'page',
				'content_parent'   => null,
				'content_category' => DIS_ARCHIVE_PAGE_CAT,
			),
		PROJECTS_PAGE_SLUG =>
			array(
				'content_slug'     => PROJECTS_PAGE_SLUG,
				'content_file'     => '',
				'content_title'    => PROJECTS_PAGE_TITLE,
				'content'          => '',
				'content_status'   => 'publish',
				'content_author'   => 1,
				'content_template' => 'page-templates/projects.php',
				'content_type'     => 'page',
				'content_parent'   => null,
				'content_category' => DIS_ARCHIVE_PAGE_CAT,
			),
		MEDIA_POLICY_PAGE_SLUG =>
			array(
				'content_slug'     => MEDIA_POLICY_PAGE_SLUG,
				'content_file'     => '',
				'content_title'    => MEDIA_POLICY_PAGE_TITLE,
				'content'          => '',
				'content_status'   => 'publish',
				'content_author'   => 1,
				'content_template' => '',
				'content_type'     => 'page',
				'content_parent'   => null,
				'content_category' => DIS_STATIC_PAGE_CAT,
			),
		ABOUT_US_PAGE_SLUG =>
			array(
				'content_slug'     => ABOUT_US_PAGE_SLUG,
				'content_file'     => '',
				'content_title'    => ABOUT_US_PAGE_TITLE,
				'content'          => '',
				'content_status'   => 'publish',
				'content_author'   => 1,
				'content_template' => '',
				'content_type'     => 'page',
				'content_parent'   => null,
				'content_category' => DIS_STATIC_PAGE_CAT,
			),
		DOCUMENTATION_PAGE_SLUG =>
			array(
				'content_slug'     => DOCUMENTATION_PAGE_SLUG,
				'content_file'     => '',
				'content_title'    => DOCUMENTATION_PAGE_TITLE,
				'content'          => '',
				'content_status'   => 'publish',
				'content_author'   => 1,
				'content_template' => 'page-templates/documentation.php',
				'content_type'     => 'page',
				'content_parent'   => null,
				'content_category' => DIS_CUSTOM_PAGE_CAT,
			),
		FAQ_PAGE_SLUG =>
			array(
				'content_slug'     => FAQ_PAGE_SLUG,
				'content_file'     => '',
				'content_title'    => FAQ_PAGE_TITLE,
				'content'          => '',
				'content_status'   => 'publish',
				'content_author'   => 1,
				'content_template' => 'page-templates/faq.php',
				'content_type'     => 'page',
				'content_parent'   => null,
				'content_category' => DIS_CUSTOM_PAGE_CAT,
			),
	)
);
