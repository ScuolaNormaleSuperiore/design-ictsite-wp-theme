<?php
/**
 * Definition of the Multi Language Manager: wrapper for Polylang.
 *
 * @package Design_ICT_Site
 */
/**
 * The manager that wraps Polylang's libraries.
 *
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
		// return pll_home_url();
		$curr = self::get_current_language();
		$def  = self::get_default_language();
		if ( $curr === $def ){
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
	public static function get_languages_list( $args=[] ): array {
		return pll_languages_list( $args );
	}

	/**
	 * Sets the language of a taxonomy term.
	 *
	 * @param [type] $term
	 * @param [type] $lang
	 * @return void
	 */
	public static function set_term_language( $term, $lang ) {
		return pll_set_term_language( $term, $lang );
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

	public static function get_default_language( $type = 'slug' ){
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
		} else {

			if ( $post ) {
				// Altre pagine del sito (non HP).
				$traduzioni = self::get_post_translations( $post->ID );
				$selectors  = array(
					array(
						'slug' => $current_language,
						'url'  => get_permalink( $post ),
					),
				);
				foreach ( $languages_list as $lang_slug ) {
					if ( ( $lang_slug !== $current_language ) && array_key_exists( $lang_slug , $traduzioni ) ){
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
				if ( ! in_array( $ml_id, $ids ) ) {
					if ( isset( $items[ $ml_lang ] ) ) {
						array_push( $items[$ml_lang], array( $name => $ml_id ) );
						array_push( $ids, $ml_id );
					} else {
						$items[$ml_lang] = array();
						array_push( $items[ $ml_lang ], array( $name => $ml_id ) );
						array_push( $ids, $ml_id );
					}
				}
			}
		}
		return $items[ $lang ];
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
	 * @return object
	 */
	public static function get_page_by_label( string $label ):object {
		$translated_label = dis_translate_data()[ $label ];
		return get_page_by_path( $translated_label, OBJECT, 'page' );
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
		if ( ! $post ) return '';
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
		if ( ! $page ) return '';
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
		$slug = dis_ct_data()[$type]['slug'];
		if ( ! $slug ) return '';
		$page = get_page_by_path( $slug );
		return $page;
	}


}
