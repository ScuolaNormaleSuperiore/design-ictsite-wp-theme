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
	 * @return void
	 */
	public function add_cpt_to_pll() {
		return MULTILANG_POST_TYPES;
	}

	/**
	 *  all the taxonomies that must be managed by Polylang.
	 *
	 * @return void
	 */
	public function add_tax_to_pll() {
		return MULTILANG_TAXONOMIES;
	}

	/**
	 * Returns the Home Page in the right language.
	 * @return string
	 */
	public static function get_home_url() {
		return pll_home_url();
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
	 * @return array|string
	 */
	public static function get_all_languages() {
		return pll_the_languages( array ( 'raw' => 1) );
	}


	/**
	 * Retrieves the list of the languages supported by the site.
	 *
	 * @param [type] $args
	 * @return string[]
	 */
	public static function get_languages_list( ): array {
		$args = array();
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
	 * @return void
	 */
	public static function save_term_translations( $related_taxonomies ) {
		return pll_save_term_translations( $related_taxonomies );
	}


	/**
	 * Sets the language of a post.
	 *
	 * @param [type] $post
	 * @param [type] $lang
	 * @return void
	 */
	public static function set_post_language( $post, $lang ) {
		return pll_set_post_language( $post, $lang );
	}

	/**
	 * Defines a post as the translation of another.
	 *
	 * @param [type] $related_posts
	 * @return void
	 */
	public static function save_post_translations( $related_posts ) {
		return pll_save_post_translations( $related_posts );
	}

// 	/**
// 	* Retrieves the ID of the page in the current language.
// 	*
// 	* @param string $slug
// 	* @return void
// 	*/
// 	public static function get_page_by_slug( $slug ) {
// 		$page        = get_page_by_path( $slug );
// 		$page_id     = 0;
// 		$current_lang = pll_current_language();
// 		if ( $page ) {
// 			$page_id      = pll_get_post( $page->ID , $current_lang );
// 		}
// 		return $page_id;
// 	}

// /**
// 	* Retrieves the ID of the page in the current language.
// 	*
// 	* @param string $id
// 	* @return int
// 	*/
// 	public static function get_page_by_id( $id ):int {
// 		$id           = intval( $id );
// 		$page_id      = 0;
// 		$current_lang = pll_current_language();
// 		$page_id      = pll_get_post( $id , $current_lang );
// 		return $page_id;
// 	}

// 	/**
// 	 * Retrieves the translations of a post in all the site languages, if present.
// 	 *
// 	 * @param [type] $related_posts
// 	 * @return array
// 	 */
// 	public static function get_post_translations( $post_id ): array {
// 		return pll_get_post_translations( $post_id );
// 	}


}
