<?php
/**
 * Autocomplete manager bootstrap.
 *
 * @package Design_ICT_Site
 */

/**
 * Definition of the Autocomplete Manager: manages the site autocomplete features.
 *
 * @package Design_ICT_Site
 */

define( 'DIS_AUTCOMPLETE_MAX_CHARS', 200 );
define( 'DIS_AUTCOMPLETE_MAX_NUM_RESULTS', 8 );

/**
 * The manager that uploads the layout of the theme.
 */
class DIS_AutocompleteManager {
	/**
	 * Constructor of the Manager.
	 */
	public function __construct() {}

	/**
	 * Uploading css, jss and all layout's stuff.
	 *
	 * @return void
	 */
	public function setup() {
		add_action( 'wp_enqueue_scripts', array( $this, 'upload_scripts' ) );
		add_action( 'wp_ajax_theme_autocomplete', array( $this, 'theme_autocomplete_callback' ) );
		add_action( 'wp_ajax_nopriv_theme_autocomplete', array( $this, 'theme_autocomplete_callback' ) );
	}

	/**
	 * Enqueue autocomplete assets when one of the related features is enabled.
	 *
	 * @return void
	 */
	public function upload_scripts() {
		$home_autocomplete_enabled = ( 'true' === DIS_OptionsManager::dis_get_option( 'home_search_autocomplete_enabled', 'dis_opt_hp_layout' ) );
		$doc_autocomplete_enabled  = ( 'true' === DIS_OptionsManager::dis_get_option( 'doc_autocomplete_enabled', 'dis_opt_hp_layout' ) );
		$faq_autocomplete_enabled  = ( 'true' === DIS_OptionsManager::dis_get_option( 'faq_autocomplete_enabled', 'dis_opt_hp_layout' ) );
		$site_autocomplete_enabled = ( 'true' === DIS_OptionsManager::dis_get_option( 'site_search_autocomplete_enabled', 'dis_opt_hp_layout' ) );

		if (
			$home_autocomplete_enabled ||
			$doc_autocomplete_enabled ||
			$faq_autocomplete_enabled ||
			$site_autocomplete_enabled
		) {
			// Algolia library.
			wp_enqueue_script(
				'dis-algolia-autocomplete',
				DIS_THEME_URL . '/assets/algolia/dis-algolia.js',
				array(),
				filemtime( DIS_THEME_PATH . 'assets/algolia/dis-algolia.js' ),
				true
			);
			// Custom Algolia.
			wp_enqueue_script(
				'dis-autocomplete-init',
				get_template_directory_uri() . '/assets/algolia/dis-autocomplete-init.js',
				array( 'dis-algolia-autocomplete' ),
				filemtime( DIS_THEME_PATH . 'assets/algolia/dis-autocomplete-init.js' ),
				true
			);
			// Algolia CSS.
			wp_enqueue_style(
				'dis-algolia-autocomplete-css',
				DIS_THEME_URL . '/assets/algolia/dis-algolia.css',
				array(),
				filemtime( DIS_THEME_PATH . 'assets/algolia/dis-algolia.css' )
			);

			// Passing variables from PHP to JS.
			wp_localize_script(
				'dis-autocomplete-init',
				'disHpAutocompleteAjax',
				array(
					'ajaxUrl'        => admin_url( 'admin-ajax.php' ),
					'nonce'          => wp_create_nonce( 'sf_site_autocomplete_nonce' ),
					'searchLabel'    => __( 'Search...', 'design_ict_site' ), // phpcs:ignore WordPress.WP.I18n.TextDomainMismatch -- Legacy theme text domain.
					'noResultString' => __( 'No results found for', 'design_ict_site' ), // phpcs:ignore WordPress.WP.I18n.TextDomainMismatch -- Legacy theme text domain.
				)
			);
		}
	}

	/**
	 * Route AJAX requests to the proper autocomplete handler.
	 *
	 * @return mixed
	 */
	public function theme_autocomplete_callback() {
		check_ajax_referer( 'sf_site_autocomplete_nonce', 'nonce' );
		$selector = isset( $_POST['selector'] ) ? sanitize_text_field( wp_unslash( $_POST['selector'] ) ) : '';
		if ( 'home_search_autocomplete' === $selector ) {
			return $this->home_search_autocomplete_callback();
		} elseif ( 'faq_search_autocomplete' === $selector ) {
			return $this->faq_search_autocomplete_callback();
		} elseif ( 'doc_search_autocomplete' === $selector ) {
			return $this->doc_search_autocomplete_callback();
		}

		wp_send_json( array() );
	}

	/**
	 * Return autocomplete results for the global site search.
	 *
	 * @return void
	 */
	public function home_search_autocomplete_callback() {
		check_ajax_referer( 'sf_site_autocomplete_nonce', 'nonce' );
		$q       = isset( $_POST['q'] ) ? sanitize_text_field( wp_unslash( $_POST['q'] ) ) : '';
		$results = array();

		if ( strlen( $q ) >= 1 ) {
			// Retrieve the posts.
			$types      = DIS_ContentsManager::searchable_post_types();
			$type_slugs = array_column( $types, 'slug' );
			$the_query  = new WP_Query(
				array(
					's'              => $q,
					'post_type'      => $type_slugs,
					'posts_per_page' => DIS_AUTCOMPLETE_MAX_NUM_RESULTS,
					'post_status'    => 'publish',
				)
			);

			if ( $the_query->have_posts() ) {
				foreach ( $the_query->posts as $p ) {
					$type = dis_ct_data()[ $p->post_type ]['singular_name'];
					array_push(
						$results,
						array(
							'name' => html_entity_decode( get_the_title( $p ), ENT_QUOTES, 'UTF-8' ),
							'text' => html_entity_decode( self::get_post_snippet_by_search( $q, $p ), ENT_QUOTES, 'UTF-8' ),
							'icon' => '',
							'type' => $type,
							'link' => get_permalink( $p ),
						)
					);
				}
			}
			wp_reset_postdata();
		}
		wp_send_json( $results );
	}

	/**
	 * Return autocomplete results for FAQs.
	 *
	 * @return void
	 */
	public function faq_search_autocomplete_callback() {
		check_ajax_referer( 'sf_site_autocomplete_nonce', 'nonce' );
		$q       = isset( $_POST['q'] ) ? sanitize_text_field( wp_unslash( $_POST['q'] ) ) : '';
		$results = array();

		if ( strlen( $q ) >= 1 ) {
			// Retrieve the posts.
			$the_query = new WP_Query(
				array(
					's'              => $q,
					'post_type'      => DIS_FAQ_POST_TYPE,
					'posts_per_page' => DIS_AUTCOMPLETE_MAX_NUM_RESULTS,
					'post_status'    => 'publish',
				)
			);

			if ( $the_query->have_posts() ) {
				foreach ( $the_query->posts as $p ) {
					$type = dis_ct_data()[ $p->post_type ]['singular_name'];
					array_push(
						$results,
						array(
							'name' => html_entity_decode( get_the_title( $p ), ENT_QUOTES, 'UTF-8' ),
							'text' => html_entity_decode( self::get_post_snippet_by_search( $q, $p ), ENT_QUOTES, 'UTF-8' ),
							'icon' => '',
							'type' => $type,
							'link' => get_permalink( $p ),
						)
					);
				}
			}
			wp_reset_postdata();
		}
		wp_send_json( $results );
	}

	/**
	 * Return autocomplete results for documentation attachments.
	 *
	 * @return void
	 */
	public function doc_search_autocomplete_callback() {
		check_ajax_referer( 'sf_site_autocomplete_nonce', 'nonce' );
		$q       = isset( $_POST['q'] ) ? sanitize_text_field( wp_unslash( $_POST['q'] ) ) : '';
		$results = array();

		if ( strlen( $q ) >= 1 ) {
			// Retrieve the posts.
			$the_query = new WP_Query(
				array(
					's'              => $q,
					'post_type'      => DIS_ATTACHMENT_POST_TYPE,
					'posts_per_page' => DIS_AUTCOMPLETE_MAX_NUM_RESULTS,
					'post_status'    => 'publish',
				)
			);

			if ( $the_query->have_posts() ) {
				foreach ( $the_query->posts as $p ) {
					$type               = dis_ct_data()[ $p->post_type ]['singular_name'];
					$attachment_file    = DIS_CustomFieldsManager::get_field( 'file', $p->ID );
					$attachment_link    = DIS_CustomFieldsManager::get_field( 'link', $p->ID );
					$documentation_link = $attachment_file ? $attachment_file['url'] : $attachment_link;
					array_push(
						$results,
						array(
							'name' => html_entity_decode( get_the_title( $p ), ENT_QUOTES, 'UTF-8' ),
							'text' => html_entity_decode( self::get_post_snippet_by_search( $q, $p ), ENT_QUOTES, 'UTF-8' ),
							'icon' => '',
							'type' => $type,
							'link' => esc_url( $documentation_link ),
						)
					);
				}
			}
			wp_reset_postdata();
		}
		wp_send_json( $results );
	}

	/**
	 * Returns a snippet of the post containing the first sentence with $search_string,
	 * or the first sentence of the post if $search_string is not found.
	 * Limits the output to DIS_AUTCOMPLETE_MAX_CHARS characters.
	 *
	 * @param string  $search_string The string to search for.
	 * @param WP_Post $post          The WordPress post object.
	 * @return string The desired snippet.
	 */
	private function get_post_snippet_by_search( $search_string, $post ) {
		if ( ! $post instanceof WP_Post ) {
			return '';
		}
		// Remove HTML tags from the content.
		$content = self::clean_post_body( $post->post_content );
		// Split the content into sentences.
		$sentences = preg_split( '/(?<=[.?!;])\s+/', $content, -1, PREG_SPLIT_NO_EMPTY );
		$result    = '';

		// Try to find the first sentence containing the search string.
		foreach ( $sentences as $sentence ) {
			if ( stripos( $sentence, $search_string ) !== false ) {
				$result = trim( $sentence );
				break;
			}
		}
		// If not found, use the first sentence.
		if ( empty( $result ) && ! empty( $sentences ) ) {
			$result = trim( $sentences[0] );
		}

		// Limit to DIS_AUTCOMPLETE_MAX_CHARS characters without cutting words in half.
		if ( strlen( $result ) > DIS_AUTCOMPLETE_MAX_CHARS ) {
			$result = substr( $result, 0, DIS_AUTCOMPLETE_MAX_CHARS );
			// Cut at the last space before the DIS_AUTCOMPLETE_MAX_CHARSth character.
			$last_space = strrpos( $result, ' ' );
			if ( false !== $last_space ) {
				$result = substr( $result, 0, $last_space ) . '...';
			} else {
				$result .= '...';
			}
		}

		return $result;
	}

	/**
	 * Convert post content to plain text for snippet generation.
	 *
	 * @param string $content Raw post content.
	 * @return string
	 */
	public function clean_post_body( $content ) {
		$plain_text = wp_strip_all_tags( $content );
		$plain_text = preg_replace( '/&nbsp;/', ' ', $plain_text );
		$plain_text = html_entity_decode( $plain_text, ENT_QUOTES | ENT_HTML5, 'UTF-8' );
		return $plain_text;
	}
}
