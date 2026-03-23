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
// phpcs:disable WordPress.WP.I18n.TextDomainMismatch
/**
 * The manager that wraps Polylang's libraries.
 */
class DIS_MultiLangManager {
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
					_x( $label, 'DIS_ActivationItems', 'design_laboratori_italia' ),
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
