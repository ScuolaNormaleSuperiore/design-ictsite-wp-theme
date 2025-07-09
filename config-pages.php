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
define( 'HOW_TO_PAGE_SLUG', 'HowToPageSlug' );
define( 'HOW_TO_PAGE_TITLE', 'HowToPageTitle' );

// POST TYPE SLUGS.
define( 'ARTICLES_PAGE_SLUG', 'ArticlePageSlug' );
define( 'ARTICLES_PAGE_TITLE', 'ArticlePageTitle' );
define( 'OFFICES_PAGE_SLUG', 'OfficePageSlug' );
define( 'OFFICES_PAGE_TITLE', 'OfficePageTitle' );
define( 'PLACES_PAGE_SLUG', 'PlacePageSlug' );
define( 'PLACES_PAGE_TITLE', 'PlacePageTitle' );
define( 'EVENTS_PAGE_SLUG', 'EventPageSlug' );
define( 'EVENTS_PAGE_TITLE', 'EventPageTitle' );
define( 'NEWS_PAGE_SLUG', 'NewsPageSlug' );
define( 'NEWS_PAGE_TITLE', 'NewsPageTitle' );
define( 'PROJECTS_PAGE_SLUG', 'ProjectPageSlug' );
define( 'PROJECTS_PAGE_TITLE', 'ProjectPageTitle' );
define( 'PEOPLE_PAGE_SLUG', 'PeoplePageSlug' );
define( 'PEOPLE_PAGE_TITLE', 'PeoplePageTitle' );
define( 'SERVICE_CLUSTER_PAGE_SLUG', 'ServiceClusterPageSlug' );
define( 'SERVICE_CLUSTER_PAGE_TITLE', 'ServiceClusterPageTitle' );
define( 'SERVICE_ITEM_PAGE_SLUG', 'ServiceItemPageSlug' );
define( 'SERVICE_ITEM_PAGE_TITLE', 'ServiceItemPageTitle' );
define( 'SERVICE_BY_PROFILE_SLUG', 'ServiceByProfileSlug' );
define( 'SERVICE_BY_PROFILE_TITLE', 'ServiceByProfileTitle' );

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
		SERVICE_BY_PROFILE_SLUG =>
			array(
				'content_slug'     => SERVICE_BY_PROFILE_SLUG,
				'content_file'     => '',
				'content_title'    => SERVICE_BY_PROFILE_TITLE,
				'content'          => '',
				'content_status'   => 'publish',
				'content_author'   => 1,
				'content_template' => 'page-templates/service-profile.php',
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
		NEWS_PAGE_SLUG =>
			array(
				'content_slug'     => NEWS_PAGE_SLUG,
				'content_file'     => '',
				'content_title'    => NEWS_PAGE_TITLE,
				'content'          => '',
				'content_status'   => 'publish',
				'content_author'   => 1,
				'content_template' => 'page-templates/news.php',
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
		OFFICES_PAGE_SLUG =>
			array(
				'content_slug'     => OFFICES_PAGE_SLUG,
				'content_file'     => '',
				'content_title'    => OFFICES_PAGE_TITLE,
				'content'          => '',
				'content_status'   => 'publish',
				'content_author'   => 1,
				'content_template' => 'page-templates/offices.php',
				'content_type'     => 'page',
				'content_parent'   => null,
				'content_category' => DIS_ARCHIVE_PAGE_CAT,
			),
		PLACES_PAGE_SLUG =>
			array(
				'content_slug'     => PLACES_PAGE_SLUG,
				'content_file'     => '',
				'content_title'    => PLACES_PAGE_TITLE,
				'content'          => '',
				'content_status'   => 'publish',
				'content_author'   => 1,
				'content_template' => 'page-templates/places.php',
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
				'content_category' => DIS_ARCHIVE_PAGE_CAT,
			),
		HOW_TO_PAGE_SLUG =>
			array(
				'content_slug'     => HOW_TO_PAGE_SLUG,
				'content_file'     => '',
				'content_title'    => HOW_TO_PAGE_TITLE,
				'content'          => '',
				'content_status'   => 'publish',
				'content_author'   => 1,
				'content_template' => 'page-templates/how-to.php',
				'content_type'     => 'page',
				'content_parent'   => null,
				'content_category' => DIS_ARCHIVE_PAGE_CAT,
			),
	)
);


/**
 *  This feature is used so that translation plugins like Loco Translate
 *  can automatically extract these tags from the theme to translate.
 *  @TODO: Check if it is possible to remove these duplications.
 */
if ( ! function_exists( 'dis_pass_labels_to_translator' ) ) {
	function dis_translate_data() {
		// Standard pages.
		return array(
			'ContactsPageSlug'        => _x( 'ContactsPageSlug', 'DIS_ActivationItems', 'design_ict_site' ),
			'ContactsPageTitle'       => _x( 'ContactsPageTitle', 'DIS_ActivationItems', 'design_ict_site' ),
			'SiteMapPageSlug'         => _x( 'SiteMapPageSlug', 'DIS_ActivationItems', 'design_ict_site' ),
			'SiteMapPageTitle'        => _x( 'SiteMapPageTitle', 'DIS_ActivationItems', 'design_ict_site' ),
			'PrivacyPageSlug'         => _x( 'PrivacyPageSlug', 'DIS_ActivationItems', 'design_ict_site' ),
			'PrivacyPageTitle'        => _x( 'PrivacyPageTitle', 'DIS_ActivationItems', 'design_ict_site' ),
			'NewsletterPageSlug'      => _x( 'NewsletterPageSlug', 'DIS_ActivationItems', 'design_ict_site' ),
			'NewsletterPageTitle'     => _x( 'NewsletterPageTitle', 'DIS_ActivationItems', 'design_ict_site' ),
			'AccessibilityPageSlug'   => _x( 'AccessibilityPageSlug', 'DIS_ActivationItems', 'design_ict_site' ),
			'AccessibilityPageTitle'  => _x( 'AccessibilityPageTitle', 'DIS_ActivationItems', 'design_ict_site' ),
			'LegalNotesPageSlug'      => _x( 'LegalNotesPageSlug', 'DIS_ActivationItems', 'design_ict_site' ),
			'LegalNotesPageTitle'     => _x( 'LegalNotesPageTitle', 'DIS_ActivationItems', 'design_ict_site' ),
			'SiteSearchPageSlug'      => _x( 'SiteSearchPageSlug', 'DIS_ActivationItems', 'design_ict_site' ),
			'SiteSearchPageTitle'     => _x( 'SiteSearchPageTitle', 'DIS_ActivationItems', 'design_ict_site' ),
			'MediaPolicyPageSlug'     => _x( 'MediaPolicyPageSlug', 'DIS_ActivationItems', 'design_ict_site' ),
			'MediaPolicyPageTitle'    => _x( 'MediaPolicyPageTitle', 'DIS_ActivationItems', 'design_ict_site' ),
			'AboutUsPageSlug'         => _x( 'AboutUsPageSlug', 'DIS_ActivationItems', 'design_ict_site' ),
			'AboutUsPageTitle'        => _x( 'AboutUsPageTitle', 'DIS_ActivationItems', 'design_ict_site' ),
			'DocumentationPageSlug'   => _x( 'DocumentationPageSlug', 'DIS_ActivationItems', 'design_ict_site' ),
			'DocumentationPageTitle'  => _x( 'DocumentationPageTitle', 'DIS_ActivationItems', 'design_ict_site' ),
			'FaqPageSlug'             => _x( 'FaqPageSlug', 'DIS_ActivationItems', 'design_ict_site' ),
			'FaqPageTitle'            => _x( 'FaqPageTitle', 'DIS_ActivationItems', 'design_ict_site' ),
			'HowToPageSlug'           => _x( 'HowToPageSlug', 'DIS_ActivationItems', 'design_ict_site' ),
			'HowToPageTitle'          => _x( 'HowToPageTitle', 'DIS_ActivationItems', 'design_ict_site' ),
			// Content type pages.
			'ArticlePageSlug'         => _x( 'ArticlePageSlug', 'DIS_ActivationItems', 'design_ict_site' ),
			'ArticlePageTitle'        => _x( 'ArticlePageTitle', 'DIS_ActivationItems', 'design_ict_site' ),
			'OfficePageSlug'          => _x( 'OfficePageSlug', 'DIS_ActivationItems', 'design_ict_site' ),
			'OfficePageTitle'         => _x( 'OfficePageTitle', 'DIS_ActivationItems', 'design_ict_site' ),
			'PlacePageSlug'           => _x( 'PlacePageSlug', 'DIS_ActivationItems', 'design_ict_site' ),
			'PlacePageTitle'          => _x( 'PlacePageTitle', 'DIS_ActivationItems', 'design_ict_site' ),
			'EventPageSlug'           => _x( 'EventPageSlug', 'DIS_ActivationItems', 'design_ict_site' ),
			'EventPageTitle'          => _x( 'EventPageTitle', 'DIS_ActivationItems', 'design_ict_site' ),
			'NewsPageSlug'           => _x( 'NewsPageSlug', 'DIS_ActivationItems', 'design_ict_site' ),
			'NewsPageTitle'          => _x( 'NewsPageTitle', 'DIS_ActivationItems', 'design_ict_site' ),
			'ProjectPageSlug'         => _x( 'ProjectPageSlug', 'DIS_ActivationItems', 'design_ict_site' ),
			'ProjectPageTitle'        => _x( 'ProjectPageTitle', 'DIS_ActivationItems', 'design_ict_site' ),
			'PeoplePageSlug'          => _x( 'PeoplePageSlug', 'DIS_ActivationItems', 'design_ict_site' ),
			'PeoplePageTitle'         => _x( 'PeoplePageTitle', 'DIS_ActivationItems', 'design_ict_site' ),
			'ServiceClusterPageSlug'  => _x( 'ServiceClusterPageSlug', 'DIS_ActivationItems', 'design_ict_site' ),
			'ServiceClusterPageTitle' => _x( 'ServiceClusterPageTitle', 'DIS_ActivationItems', 'design_ict_site' ),
			'ServiceItemPageSlug'     => _x( 'ServiceItemPageSlug', 'DIS_ActivationItems', 'design_ict_site' ),
			'ServiceItemPageTitle'    => _x( 'ServiceItemPageTitle', 'DIS_ActivationItems', 'design_ict_site' ),
			'ServiceByProfileSlug'    => _x( 'ServiceByProfileSlug', 'DIS_ActivationItems', 'design_ict_site' ),
			'ServiceByProfileTitle'   => _x( 'ServiceByProfileTitle', 'DIS_ActivationItems', 'design_ict_site' ),
		);
	}
}
