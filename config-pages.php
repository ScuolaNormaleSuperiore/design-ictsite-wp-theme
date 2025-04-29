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


/* SLUGS */
define( 'SLUG_CONTACTS', 'ContactsPageSlug' );
define( 'SLUG_SITE_MAP', 'SiteMapPageSlug' );
define( 'SLUG_PRIVACY', 'PrivacyPageSlug' );
define( 'SLUG_NEWSLETTER', 'NewsletterPageSlug' );
define( 'SLUG_ACCESSIBILITY', 'AccessibilityPageSlug' );
define( 'SLUG_LEGAL_NOTES', 'LegalNotesPageSlug' );
define( 'SLUG_SITE_SEARCH', 'SiteSearchPageSlug' );
define( 'SLUG_PEOPLE', 'PeoplePageSlug' );
define( 'SLUG_SERVICE_CLUSTER', 'ServiceClusterPageSlug' );
define( 'SLUG_SERVICE_ITEM', 'ServiceItemPageSlug' );


/* PAGES */
define(
	'DIS_STATIC_PAGES',
	array(
		SLUG_CONTACTS =>
			array(
				'content_slug'     => SLUG_CONTACTS,
				'content_file'     => '',
				'content_title'    => 'ContactsPageTitle',
				'content'          => '',
				'content_status'   => 'publish',
				'content_author'   => 1,
				'content_template' => 'page-templates/contacts.php',
				'content_type'     => 'page',
				'content_parent'   => null,
				'content_category' => DIS_CUSTOM_PAGE_CAT,
			),
		SLUG_SITE_MAP =>
			array(
				'content_slug'     => SLUG_SITE_MAP,
				'content_file'     => '',
				'content_title'    => 'SiteMapPageTitle',
				'content'          => '',
				'content_status'   => 'publish',
				'content_author'   => 1,
				'content_template' => 'page-templates/site-map.php',
				'content_type'     => 'page',
				'content_parent'   => null,
				'content_category' => DIS_CUSTOM_PAGE_CAT,
			),
		SLUG_PRIVACY =>
			array(
				'content_slug'     => SLUG_PRIVACY,
				'content_file'     => 'assets/html/privacy_xx.html', // To load the initial content of a page from a file (eg. privacy_en.html, privacy_it.html,... ).
				'content_title'    => 'PrivacyPageTitle',
				'content'          => '',
				'content_status'   => 'publish',
				'content_author'   => 1,
				'content_template' => 'page-templates/privacy.php',
				'content_type'     => 'page',
				'content_parent'   => null,
				'content_category' => DIS_CUSTOM_PAGE_CAT,
			),
		SLUG_NEWSLETTER =>
			array(
				'content_slug'     => SLUG_NEWSLETTER,
				'content_file'     => '',
				'content_title'    => 'NewsletterPageTitle',
				'content'          => '',
				'content_status'   => 'publish',
				'content_author'   => 1,
				'content_template' => 'page-templates/newsletter.php',
				'content_type'     => 'page',
				'content_parent'   => null,
				'content_category' => DIS_CUSTOM_PAGE_CAT,
			),
		SLUG_ACCESSIBILITY =>
			array(
				'content_slug'     => SLUG_ACCESSIBILITY,
				'content_file'     => 'assets/html/accessibility_xx.html',
				'content_title'    => 'AccessibilityPageTitle',
				'content'          => '',
				'content_status'   => 'publish',
				'content_author'   => 1,
				'content_template' => '',
				'content_type'     => 'page',
				'content_parent'   => null,
				'content_category' => DIS_STATIC_PAGE_CAT,
			),
		SLUG_LEGAL_NOTES =>
			array(
				'content_slug'     => SLUG_LEGAL_NOTES,
				'content_file'     => 'assets/html/legal_notes_xx.html',
				'content_title'    => 'LegalNotesPageTitle',
				'content'          => '',
				'content_status'   => 'publish',
				'content_author'   => 1,
				'content_template' => '',
				'content_type'     => 'page',
				'content_parent'   => null,
				'content_category' => DIS_STATIC_PAGE_CAT,
			),
		SLUG_SITE_SEARCH =>
			array(
				'content_slug'     => SLUG_SITE_SEARCH,
				'content_file'     => 'assets/html/site_search_xx.html',
				'content_title'    => 'SiteSearchPageTitle',
				'content'          => '',
				'content_status'   => 'publish',
				'content_author'   => 1,
				'content_template' => 'page-templates/search.php',
				'content_type'     => 'page',
				'content_parent'   => null,
				'content_category' => DIS_CUSTOM_PAGE_CAT,
			),
		SLUG_PEOPLE =>
			array(
				'content_slug'     => SLUG_PEOPLE,
				'content_file'     => '',
				'content_title'    => 'PeoplePageTitle',
				'content'          => '',
				'content_status'   => 'publish',
				'content_author'   => 1,
				'content_template' => 'page-templates/people.php',
				'content_type'     => 'page',
				'content_parent'   => null,
				'content_category' => DIS_ARCHIVE_PAGE_CAT,
			),
		SLUG_SERVICE_CLUSTER =>
			array(
				'content_slug'     => SLUG_SERVICE_CLUSTER,
				'content_file'     => '',
				'content_title'    => 'ServiceClusterPageTitle',
				'content'          => '',
				'content_status'   => 'publish',
				'content_author'   => 1,
				'content_template' => 'page-templates/service-cluster.php',
				'content_type'     => 'page',
				'content_parent'   => null,
				'content_category' => DIS_ARCHIVE_PAGE_CAT,
			),
		SLUG_SERVICE_ITEM =>
			array(
				'content_slug'     => SLUG_SERVICE_ITEM,
				'content_file'     => '',
				'content_title'    => 'ServiceItemPageTitle',
				'content'          => '',
				'content_status'   => 'publish',
				'content_author'   => 1,
				'content_template' => 'page-templates/service-item.php',
				'content_type'     => 'page',
				'content_parent'   => null,
				'content_category' => DIS_ARCHIVE_PAGE_CAT,
			),
	)
);
