<?php
// phpcs:ignoreFile WordPress.Files.FileName.InvalidClassFileName
/**
 * Definition of the Multi Language Manager: wrapper for Polylang.
 *
 * @package Design_ICT_Site
 */

// phpcs:disable Squiz.Commenting.FunctionComment.Missing
// phpcs:disable Squiz.Commenting.FunctionComment.MissingParamComment
// phpcs:disable WordPress.WP.I18n.NonSingularStringLiteralText

/**
 * The manager that wraps Polylang's libraries.
 */
class DIS_MultiLangManager {
	const REWRITE_RULES_VERSION = '20260427-translated-cpt-slugs-aliases';

	/**
	 * Constructor of the Manager.
	 */
	public function __construct() {}

	/**
	 * Defining the post types and taxonomies that need to be translated.
	 *
	 * @return void
	 */
	public function setup() {
		add_filter( 'pll_get_post_types', array( $this, 'add_cpt_to_pll' ), 10, 2 );
		add_filter( 'pll_get_taxonomies', array( $this, 'add_tax_to_pll' ), 10, 2 );
		add_filter( 'post_type_link', array( $this, 'filter_post_type_link' ), 10, 2 );
		add_action( 'init', array( $this, 'add_translated_cpt_rewrite_rules' ), 20 );
		add_action( 'wp_loaded', array( $this, 'maybe_flush_rewrite_rules' ), 20 );
	}

	/**
	 * All the post types that must be managed by Polylang.
	 *
	 * @return array
	 */
	public function add_cpt_to_pll() {
		return MULTILANG_POST_TYPES;
	}

	/**
	 * All the taxonomies that must be managed by Polylang.
	 *
	 * @return array
	 */
	public function add_tax_to_pll() {
		return MULTILANG_TAXONOMIES;
	}

	/**
	 * Returns the Home Page in the right language.
	 *
	 * @return string
	 */
	public static function get_home_url() {
		$curr = self::get_current_language();
		$def  = self::get_default_language();
		if ( $curr === $def ) {
			return get_site_url();
		}
		return get_site_url() . '/' . $curr;
	}

	/**
	 * Retrieves the default language of the site.
	 *
	 * @param string $type
	 * @return string
	 */
	public static function get_current_language( $type = 'slug' ) {
		$cl = pll_current_language( $type );
		return $cl;
	}


	/**
	 * Returns all the translations of a page with language and flag.
	 *
	 * @return array|string
	 */
	public static function get_all_languages() {
		return pll_the_languages( array( 'raw' => 1 ) );
	}


	/**
	 * Retrieves the list of the languages supported by the site.
	 *
	 * @param [type] $args
	 * @return object[]
	 */
	public static function get_languages_list( $args = array() ): array {
		return pll_languages_list( $args );
	}

	/**
	 * Switch the current Polylang language.
	 *
	 * @param string $lang Language slug.
	 * @return void
	 */
	public static function switch_language( $lang ) {
		if ( function_exists( 'pll_switch_language' ) ) {
			pll_switch_language( $lang );
		}
	}

	/**
	 * Sets the language of a taxonomy term.
	 *
	 * @param [type] $term
	 * @param [type] $lang
	 * @return void
	 */
	public static function set_term_language( $term, $lang ) {
		pll_set_term_language( $term, $lang );
	}

	/**
	 * Defines a term as translation of another.
	 *
	 * @param [type] $related_taxonomies
	 * @return array
	 */
	public static function save_term_translations( $related_taxonomies ) {
		return pll_save_term_translations( $related_taxonomies );
	}


	/**
	 * Sets the language of a post.
	 *
	 * @param [type] $post
	 * @param [type] $lang
	 * @return bool
	 */
	public static function set_post_language( $post, $lang ) {
		return pll_set_post_language( $post, $lang );
	}

	/**
	 * Defines a post as the translation of another.
	 *
	 * @param [type] $related_posts
	 * @return array
	 */
	public static function save_post_translations( $related_posts ) {
		return pll_save_post_translations( $related_posts );
	}

	public static function get_default_language( $type = 'slug' ) {
		return pll_default_language( $type );
	}

	public static function get_page_selectors() {
		global $post;
		$selectors        = array();
		$site_url         = self::get_home_url();
		$languages_list   = self::get_languages_list();
		$default_language = self::get_default_language();
		$current_language = self::get_current_language();
		// Home Page is the same for all languages.
		if ( is_home() ) {

			// Home Page.
			foreach ( $languages_list as $lang_slug ) {
				if ( $lang_slug !== $default_language ) {
					$url = $site_url . '/' . $lang_slug;
				} else {
					$url = $site_url;
				}
				array_push(
					$selectors,
					array(
						'slug' => $lang_slug,
						'url'  => $url,
					)
				);
			}
		} elseif ( $post ) {

				// Altre pagine del sito (non HP).
				$traduzioni = self::get_post_translations( $post->ID );
				$selectors  = array(
					array(
						'slug' => $current_language,
						'url'  => get_permalink( $post ),
					),
				);
			foreach ( $languages_list as $lang_slug ) {
					if ( ( $lang_slug !== $current_language ) && array_key_exists( $lang_slug, $traduzioni ) ) {
						array_push(
							$selectors,
							array(
								'slug' => $lang_slug,
								'url'  => get_permalink( $traduzioni[ $lang_slug ] ),
							)
						);
					}
			}
		}
		return $selectors;
	}

	public static function get_all_menus_by_lang( $lang ) {
		$options        = get_option( 'polylang' );
		$menu_locations = $options['nav_menus']['design-ictsite-wp-theme'];
		$items          = array();
		$ids            = array();
		foreach ( $menu_locations as $name => $menu_langs ) {
			foreach ( $menu_langs as $ml_lang => $ml_id ) {
				if ( ! in_array( $ml_id, $ids, true ) ) {
					if ( isset( $items[ $ml_lang ] ) ) {
						array_push( $items[ $ml_lang ], array( $name => $ml_id ) );
						array_push( $ids, $ml_id );
					} else {
						$items[ $ml_lang ] = array();
						array_push( $items[ $ml_lang ], array( $name => $ml_id ) );
						array_push( $ids, $ml_id );
					}
				}
			}
		}
		return $items[ $lang ] ?? array();
	}

	/**
	 * Retrieve the translations of a post by id.
	 *
	 * @param id $post_id
	 * @return array
	 */
	public static function get_post_translations( $post_id ): array {
		return pll_get_post_translations( $post_id );
	}

	/**
	 * Add custom post type rewrite rules for every translated language slug.
	 *
	 * @return void
	 */
	public function add_translated_cpt_rewrite_rules() {
		foreach ( self::get_languages_data() as $language_slug => $locale ) {
			$language_prefix = self::get_language_url_prefix( $language_slug );

			foreach ( array_keys( self::get_translatable_cpt_slug_sources() ) as $post_type ) {
				if ( ! post_type_exists( $post_type ) ) {
					continue;
				}

				foreach ( self::get_all_translated_cpt_slugs( $post_type ) as $post_type_slug ) {
					$rule_base = trim( $language_prefix . '/' . $post_type_slug, '/' );
					if ( ! $rule_base ) {
						continue;
					}

					add_rewrite_rule(
						'^' . preg_quote( $rule_base, '#' ) . '/([^/]+)/?$',
						'index.php?post_type=' . $post_type . '&name=$matches[1]&lang=' . $language_slug,
						'top'
					);
				}
			}
		}
	}

	/**
	 * Normalize custom post type links to the slug translated for the post language.
	 *
	 * @param string  $post_link The generated permalink.
	 * @param WP_Post $post      The post object.
	 * @return string
	 */
	public function filter_post_type_link( $post_link, $post ) {
		if ( ! $post instanceof WP_Post ) {
			return $post_link;
		}

		if ( ! array_key_exists( $post->post_type, self::get_translatable_cpt_slug_sources() ) ) {
			return $post_link;
		}

		$locale = function_exists( 'pll_get_post_language' ) ? pll_get_post_language( $post->ID, 'locale' ) : '';
		if ( ! $locale ) {
			return $post_link;
		}

		$target_slug = self::get_translated_cpt_slug( $post->post_type, $locale );
		if ( ! $target_slug ) {
			return $post_link;
		}

		foreach ( self::get_all_translated_cpt_slugs( $post->post_type ) as $known_slug ) {
			$post_link = preg_replace(
				'~/' . preg_quote( $known_slug, '~' ) . '/(?=[^/]+/?(?:[?#]|$))~',
				'/' . $target_slug . '/',
				$post_link,
				1
			);
		}

		return $post_link;
	}

	/**
	 * Flush rewrite rules once after the translated CPT rules version changes.
	 *
	 * @return void
	 */
	public function maybe_flush_rewrite_rules() {
		$option_name = 'dis_translated_cpt_rewrite_rules_version';

		if ( self::REWRITE_RULES_VERSION === get_option( $option_name ) ) {
			return;
		}

		flush_rewrite_rules( false );
		update_option( $option_name, self::REWRITE_RULES_VERSION, false );
	}

	/**
	 * Return the custom post type source slugs used by theme translations.
	 *
	 * @return array<string, string>
	 */
	private static function get_translatable_cpt_slug_sources() {
		return array(
			DIS_EVENT_POST_TYPE           => 'events',
			DIS_NEWS_POST_TYPE            => 'news',
			DIS_PROJECT_POST_TYPE         => 'projects',
			DIS_OFFICE_POST_TYPE          => 'offices',
			DIS_SERVICE_CLUSTER_POST_TYPE => 'service-clusters',
			DIS_SERVICE_ITEM_POST_TYPE    => 'services',
			DIS_PERSON_POST_TYPE          => 'people',
			DIS_PLACE_POST_TYPE           => 'places',
			DIS_ATTACHMENT_POST_TYPE      => 'attachments',
			DIS_BANNER_POST_TYPE          => 'banners',
			DIS_SPONSOR_POST_TYPE         => 'sponsors',
			DIS_FAQ_POST_TYPE             => 'faq',
		);
	}

	/**
	 * Return available language slugs mapped to locales.
	 *
	 * @return array<string, string>
	 */
	private static function get_languages_data() {
		static $languages = null;

		if ( null !== $languages ) {
			return $languages;
		}

		if ( ! function_exists( 'pll_languages_list' ) ) {
			$languages = array();
			return $languages;
		}

		$language_slugs   = pll_languages_list( array( 'fields' => 'slug' ) );
		$language_locales = pll_languages_list( array( 'fields' => 'locale' ) );
		$languages        = array();

		foreach ( $language_slugs as $index => $language_slug ) {
			if ( ! empty( $language_locales[ $index ] ) ) {
				$languages[ $language_slug ] = $language_locales[ $index ];
			}
		}

		return $languages;
	}

	/**
	 * Return the URL path prefix used by Polylang for a language.
	 *
	 * @param string $language_slug Language slug.
	 * @return string
	 */
	private static function get_language_url_prefix( $language_slug ) {
		if ( ! function_exists( 'pll_home_url' ) ) {
			return $language_slug === self::get_default_language() ? '' : $language_slug;
		}

		$home_path     = trim( (string) wp_parse_url( home_url( '/' ), PHP_URL_PATH ), '/' );
		$language_path = trim( (string) wp_parse_url( pll_home_url( $language_slug ), PHP_URL_PATH ), '/' );

		if ( $home_path && 0 === strpos( $language_path, $home_path ) ) {
			$language_path = trim( substr( $language_path, strlen( $home_path ) ), '/' );
		}

		return $language_path;
	}

	/**
	 * Return a custom post type slug translated for a locale.
	 *
	 * @param string $post_type Custom post type.
	 * @param string $locale    Locale code.
	 * @return string
	 */
	private static function get_translated_cpt_slug( $post_type, $locale ) {
		static $translated_slugs = array();

		$sources = self::get_translatable_cpt_slug_sources();
		if ( empty( $sources[ $post_type ] ) ) {
			return '';
		}

		$cache_key = $post_type . '|' . $locale;
		if ( isset( $translated_slugs[ $cache_key ] ) ) {
			return $translated_slugs[ $cache_key ];
		}

		if ( $locale && function_exists( 'switch_to_locale' ) ) {
			switch_to_locale( $locale );
			$slug = _x( $sources[ $post_type ], 'DIS_PostTypeSlugs', 'design_ict_site' );
			restore_previous_locale();
		} else {
			$slug = _x( $sources[ $post_type ], 'DIS_PostTypeSlugs', 'design_ict_site' );
		}

		$translated_slugs[ $cache_key ] = sanitize_title( $slug );

		return $translated_slugs[ $cache_key ];
	}

	/**
	 * Return all translated slugs known for a custom post type.
	 *
	 * @param string $post_type Custom post type.
	 * @return string[]
	 */
	private static function get_all_translated_cpt_slugs( $post_type ) {
		$slugs = array();

		foreach ( self::get_languages_data() as $locale ) {
			$slug = self::get_translated_cpt_slug( $post_type, $locale );
			if ( $slug ) {
				$slugs[] = $slug;
			}
		}

		return array_unique( $slugs );
	}

	/**
	 * Retrieve a page given the 'DIS_ActivationItems' label used in dis_translate_data.
	 *
	 * @param string $label
	 * @return object|null
	 */
	public static function get_page_by_label( string $label ) {
		$candidates = array_filter(
			array_unique(
				array(
					dis_translate_data()[ $label ] ?? '',
					_x( $label, 'DIS_ActivationItems', 'design_ict_site' ),
					_x( $label, 'DIS_ActivationItems', 'design_ict_site' ),
					$label,
				)
			)
		);

		foreach ( $candidates as $candidate ) {
			$page = get_page_by_path( $candidate, OBJECT, 'page' );
			if ( $page ) {
				return $page;
			}
		}

		return null;
	}

	/**
	 * Get the link of a standard page given the slug.
	 *
	 * @param string $page_slug
	 * @return string
	 */
	public static function get_page_link( $page_slug ) {
		$slug_trans = _x( $page_slug, 'DIS_ActivationItems', 'design_ict_site' );
		$post       = get_page_by_path( $slug_trans, OBJECT, 'page' );
		if ( ! $post ) {
			return '';
		}
		return get_permalink( $post );
	}

	/**
	 * Get the archive page url given the content-type in the right language.
	 *
	 * @param string $type
	 * @return string
	 */
	public static function get_archive_link( $type ) {
		$page = self::get_archive_page( $type );
		if ( ! $page ) {
			return '';
		}
		$url = get_permalink( $page->ID );
		return $url;
	}

	/**
	 * Get the archive page given the content-type in the right language.
	 *
	 * @param string $type
	 * @return object
	 */
	public static function get_archive_page( $type ) {
		$archive_label = self::get_archive_page_label( $type );
		if ( $archive_label ) {
			$page = self::get_page_by_label( $archive_label );
			if ( $page ) {
				return $page;
			}
		}

		$slug = dis_ct_data()[ $type ]['slug'] ?? '';
		if ( ! $slug ) {
			return '';
		}

		return get_page_by_path( $slug );
	}

	/**
	 * Map a post type to its archive-page activation label.
	 *
	 * @param string $type
	 * @return string
	 */
	private static function get_archive_page_label( $type ) {
		$map = array(
			DIS_DEFAULT_POST              => ARTICLES_PAGE_SLUG,
			DIS_OFFICE_POST_TYPE          => OFFICES_PAGE_SLUG,
			DIS_PLACE_POST_TYPE           => PLACES_PAGE_SLUG,
			DIS_EVENT_POST_TYPE           => EVENTS_PAGE_SLUG,
			DIS_NEWS_POST_TYPE            => NEWS_PAGE_SLUG,
			DIS_PROJECT_POST_TYPE         => PROJECTS_PAGE_SLUG,
			DIS_PERSON_POST_TYPE          => PEOPLE_PAGE_SLUG,
			DIS_SERVICE_CLUSTER_POST_TYPE => SERVICE_CLUSTER_PAGE_SLUG,
			DIS_SERVICE_ITEM_POST_TYPE    => SERVICE_ITEM_PAGE_SLUG,
			DIS_FAQ_POST_TYPE             => FAQ_PAGE_SLUG,
		);

		return $map[ $type ] ?? '';
	}
}
