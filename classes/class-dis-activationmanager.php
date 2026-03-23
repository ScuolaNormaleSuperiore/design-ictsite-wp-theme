<?php
/**
 * Definition of the Activation Manager.
 *
 * @package Design_ICT_Site
 */

/**
 * The Menu manager.
 */
class DIS_ActivationManager {

	/**
	 * Admin page slug for the reload tool.
	 *
	 * @var string
	 */
	private static string $main_page = 'dis-reload-data-theme-options';

	/**
	 * Result payload for the reload process.
	 *
	 * @var array
	 */
	public static $result = array(
		'status' => 0,       // 1: success, 0: error.
		'data'   => array(), // Array of string to write.
	);

	/**
	 * Constructor of the Manager.
	 */
	public function __construct() {}

	/**
	 * Setup the Settings and the menu of the plugin.
	 *
	 * @return void
	 */
	public function setup() {
		// Register 'Reload data' menu.
		add_action( 'admin_menu', array( $this, 'register_menu_link' ) );

		// Register 'Reload data' actions.
		add_action( 'admin_init', array( $this, 'manage_submit_action' ) );
	}

	/**
	 * Creation of the link to load default theme data: Reload default theme data.
	 * WP->Appearance->Reload theme data.
	 *
	 * @return void
	 */
	public function register_menu_link() {
		add_theme_page(
			esc_html__( 'Reload theme data', 'design_ict_site' ),
			esc_html__( 'Reload theme data', 'design_ict_site' ),
			DIS_EDIT_THEME_PERMISSION,
			self::$main_page,
			array( self::class, 'get_page_code' )
		);
	}

	/**
	 * Render the Settings page.
	 *
	 * @return void
	 */
	public static function get_page_code() {
		// phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Read-only admin notice flag after safe redirect.
		$is_reload = isset( $_GET['reloaded'] );
		// phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Read-only admin notice flag after safe redirect.
		$reloaded_ok = $is_reload && ( '1' === sanitize_text_field( wp_unslash( $_GET['reloaded'] ) ) );
		echo "<DIV class='wrap'>";
		echo '<H1>' . esc_html__( 'Reload theme data', 'design_ict_site' ) . '</H1>';
		echo '<DIV class="dis_admin_reload_data">';
		echo '<P>' . esc_html__( 'Click the button to reload theme data: post-types, taxonomies, sections, pages, menu, etc. ', 'design_ict_site' ) . '</P>';
		echo '<form method="post">';
		wp_nonce_field( 'dis_reload_nonce_action', 'dis_reload_nonce' );
		echo '<button type="submit" name="reload_data" class="button button-primary">' . esc_html__( 'Reload data', 'design_ict_site' ) . '</button>';
		echo '</form>';
		echo '</DIV>';
		if ( $is_reload ) {
			if ( $reloaded_ok ) {
				echo '<DIV class="dis_admin_reload_result text-primary mt-20"><EM>' . esc_html__( 'Theme data loaded successfully', 'design_ict_site' ) . '</EM></DIV>';
			} else {
				echo '<DIV class="dis_admin_reload_result text-danger"><EM>' . esc_html__( 'Theme data not reloaded', 'design_ict_site' ) . '</EM></DIV>';
			}
		}
		echo '</DIV>';
	}

	/**
	 * Handle POST submission for the reload action.
	 *
	 * @return void
	 */
	public function manage_submit_action() {
		if ( ! current_user_can( DIS_EDIT_THEME_PERMISSION ) ) {
			return;
		}
		if (
			isset( $_POST['reload_data'] ) &&
			check_admin_referer( 'dis_reload_nonce_action', 'dis_reload_nonce' )
		) {
			$result     = self::reload_data();
			$is_success = is_array( $result ) && isset( $result['status'] ) && 1 === (int) $result['status'];
			$status     = $is_success ? '1' : '0';
			$redirect   = add_query_arg(
				array(
					'page'     => self::$main_page,
					'reloaded' => $status,
				),
				admin_url( 'admin.php' )
			);
			wp_safe_redirect( $redirect );
			exit;
		}
	}

	/**
	 * Reload theme-managed content such as pages and menus.
	 *
	 * @return array
	 */
	private static function reload_data() {
		if ( ! current_user_can( DIS_EDIT_THEME_PERMISSION ) ) {
			return self::$result;
		}

		self::$result = array(
			'status' => 0,
			'data'   => array(),
		);

		array_push( self::$result['data'], '*** BEGIN THEME ACTIVATION ***' );

		// Create the pages of the site, if not exist.
		self::pages_creation( self::$result['data'] );

		// Create the taxonomies of the site, if not exist.
		self::taxonomies_creation( self::$result['data'] );

		// Create the menus of the site, if not exist.
		self::menu_creation( self::$result['data'] );

		self::$result['status'] = 1;
		array_push( self::$result['data'], '*** END THEME ACTIVATION ***' );
		return self::$result;
	}

	/**
	 * Get one content item by slug and type.
	 *
	 * Trashed content is intentionally excluded so the reload flow can recreate
	 * missing system pages without being blocked by items left in Trash.
	 *
	 * @param string $slug         Content slug.
	 * @param string $content_type Post type.
	 * @return WP_Post|null
	 */
	private static function get_content( $slug, $content_type ) {
		$args  = array(
			'name'        => $slug,
			'post_type'   => $content_type,
			'post_status' => array( 'publish', 'draft', 'pending', 'private' ),
			'numberposts' => 1,
		);
		$posts = get_posts( $args );
		return $posts ? $posts[0] : null;
	}

	/**
	 * Resolve the parent post ID for a seeded page.
	 *
	 * Parent relationships are not currently used by the seed configuration,
	 * so the fallback remains the root level.
	 *
	 * @param mixed $par Parent configuration value.
	 * @return int
	 */
	private static function get_parent( $par ) {
		unset( $par );
		return 0;
	}

	/**
	 * Read the seed HTML file for a specific language when available.
	 *
	 * @param string $content_file Relative file path pattern.
	 * @param string $language_slug Language slug.
	 * @return string
	 */
	private static function get_page_seed_content( $content_file, $language_slug ) {
		if ( empty( $content_file ) ) {
			return '';
		}

		$file_path = realpath(
			DIS_THEME_PATH . str_replace( '_xx.html', '_' . $language_slug . '.html', $content_file )
		);

		if ( false === $file_path || ! file_exists( $file_path ) ) {
			return '';
		}

		global $wp_filesystem;
		if ( empty( $wp_filesystem ) ) {
			require_once ABSPATH . 'wp-admin/includes/file.php';
			WP_Filesystem();
		}
		$content = $wp_filesystem->get_contents( $file_path );

		return false === $content ? '' : $content;
	}

	/**
	 * Assign a nav menu to its theme location.
	 *
	 * @param WP_Term $menu_term Menu term.
	 * @param string  $menu_location Theme menu location.
	 * @return void
	 */
	private static function assign_menu_location( $menu_term, $menu_location ) {
		if ( ! $menu_term || empty( $menu_term->term_id ) ) {
			return;
		}

		$locations = get_theme_mod( 'nav_menu_locations' );
		$locations = is_array( $locations ) ? $locations : array();

		if ( isset( $locations[ $menu_location ] ) && (int) $locations[ $menu_location ] === (int) $menu_term->term_id ) {
			return;
		}

		$locations[ $menu_location ] = (int) $menu_term->term_id;
		set_theme_mod( 'nav_menu_locations', $locations );
	}

	/**
	 * Create missing static pages for each configured language.
	 *
	 * @param array $messages Collected status messages.
	 * @return bool
	 */
	private static function pages_creation( &$messages ) {
		array_push( self::$result['data'], '* BEGIN Pages Creation:' );
		$languages = DIS_MultiLangManager::get_languages_list( array( 'fields' => array() ) );
		foreach ( DIS_STATIC_PAGES as $slug => $pg ) {
			$related_posts = array();

			// Save the current locale.
			$default_locale = get_locale();
			foreach ( $languages as $lang ) {
				switch_to_locale( $lang->locale );

				// phpcs:ignore WordPress.WP.I18n.NonSingularStringLiteralText -- Seed config stores translation keys.
				$slug_trans = _x( $pg['content_slug'], 'DIS_ActivationItems', 'design_ict_site' ); // phpcs:ignore WordPress.WP.I18n.NonSingularStringLiteralText -- Seed config stores translation keys.
				if ( $slug_trans ) {
					$check_page  = self::get_content( $slug_trans, $pg['content_type'] );
					$new_page_id = $check_page ? $check_page->ID : 0;
					if ( 0 === $new_page_id ) {
						// Create the page if not exists.
						// phpcs:ignore WordPress.WP.I18n.NonSingularStringLiteralText -- Seed config stores translation keys.
						$title_trans = _x( $pg['content_title'], 'DIS_ActivationItems', 'design_ict_site' ); // phpcs:ignore WordPress.WP.I18n.NonSingularStringLiteralText -- Seed config stores translation keys.
						if ( $title_trans ) {
							// Check if a page template exists.
							$content = self::get_page_seed_content( $pg['content_file'], $lang->slug );

							$new_page = array(
								'post_type'    => $pg['content_type'],
								'post_name'    => $slug_trans,
								'post_title'   => $title_trans,
								'post_content' => $content,
								'post_status'  => $pg['content_status'],
								'post_author'  => intval( $pg['content_author'] ),
								'post_parent'  => self::get_parent( $pg['content_parent'] ),
							);
							// Page creation.
							$new_page_id = wp_insert_post( $new_page );

							if ( is_wp_error( $new_page_id ) || empty( $new_page_id ) ) {
								$msg = sprintf(
									/* translators: 1: page slug, 2: error message. */
									__( "Unable to create the page '%1\$s': %2\$s", 'design_ict_site' ),
									$slug_trans,
									is_wp_error( $new_page_id ) ? $new_page_id->get_error_message() : __( 'unknown error', 'design_ict_site' )
								);
								array_push( $messages, $msg );
								continue;
							}

							// Assign a template to the page.
							if ( $pg['content_template'] ) {
								update_post_meta( $new_page_id, '_wp_page_template', $pg['content_template'] );
							}
							// Assign the language to the page.
							DIS_MultiLangManager::set_post_language( $new_page_id, $lang->slug );
						}
						/* translators: %s: page slug. */
						$msg = sprintf( __( "Successfully created the page: '%s'.", 'design_ict_site' ), $slug_trans );
						array_push( $messages, $msg );
						$related_posts[ $lang->slug ] = $new_page_id;
					} else {
						$related_posts[ $lang->slug ] = $new_page_id;
					}
				}
			}

			// Restore the original locale after processing all language variants.
			switch_to_locale( $default_locale );

			DIS_MultiLangManager::save_post_translations( $related_posts );
		}
		array_push( self::$result['data'], '* END Pages Creation.' );
		return true;
	}

	/**
	 * Placeholder for taxonomy seeding.
	 *
	 * @param array $messages Collected status messages.
	 * @return bool
	 */
	private static function taxonomies_creation( &$messages ) {
		unset( $messages );
		array_push( self::$result['data'], '* BEGIN Taxonomies Creation:' );
		array_push( self::$result['data'], '* END Taxonomies Creation:' );
		return true;
	}

	/**
	 * Create missing navigation menus for all configured languages.
	 *
	 * @param array $messages Collected status messages.
	 * @return bool
	 */
	private static function menu_creation( &$messages ) {
		array_push( self::$result['data'], '* BEGIN Menu Creation:' );

		// Creation of all the site menus: each menu is replicated for each available language.
		$languages      = DIS_MultiLangManager::get_languages_list( array( 'fields' => array() ) );
		$default_locale = get_locale();

		foreach ( $languages as $lang ) {
			switch_to_locale( $lang->locale );
			self::build_the_menu( $messages, DIS_PRIMARY_MENU, $lang->slug );
			self::build_the_menu( $messages, DIS_SECONDARY_MENU, $lang->slug );
			self::build_the_menu( $messages, DIS_HEADER_MENU, $lang->slug );
			self::build_the_menu( $messages, DIS_FOOTER_MENU, $lang->slug );
			self::build_the_menu( $messages, DIS_USEFUL_LINKS_MENU, $lang->slug );
		}
		switch_to_locale( $default_locale );

		array_push( self::$result['data'], '* END Menu Creation.' );
		return true;
	}

	/**
	 * Create one themed menu for a specific language when missing.
	 *
	 * Existing menu items are preserved; only the theme location is reattached.
	 *
	 * @param array  $messages Collected status messages.
	 * @param array  $menu     Menu configuration.
	 * @param string $lang     Language slug.
	 * @return void
	 */
	private static function build_the_menu( &$messages, $menu, $lang ) {
		$menu_name     = $menu['name'] . ' [' . strtoupper( $lang ) . ']';
		$menu_items    = $menu['items'];
		$menu_location = $menu['location'];
		$menu_object   = wp_get_nav_menu_object( $menu_name );

		if ( $menu_object ) {
			// Preserve existing menu items, but keep the location assignment in sync.
			/* translators: %s: menu name. */
			$msg = sprintf( __( "The menu '%s' already exists.", 'design_ict_site' ), $menu_name );
			array_push( $messages, $msg );
			$menu_id = $menu_object->term_id;
			$menu    = get_term_by( 'id', $menu_id, 'nav_menu' );
			self::assign_menu_location( $menu, $menu_location );
		} else {
			$menu_id = wp_create_nav_menu( $menu_name );
			$menu    = get_term_by( 'id', $menu_id, 'nav_menu' );
			foreach ( $menu_items as $menu_item ) {
				if ( ( ! isset( $menu_item['link'] ) ) || ( '' === $menu_item['link'] ) ) {
					// Link to pages or posts.
					// phpcs:ignore WordPress.WP.I18n.NonSingularStringLiteralText -- Menu config stores translation keys.
					$slug_trans = _x( $menu_item['slug'], 'DIS_ActivationItems', 'design_ict_site' ); // phpcs:ignore WordPress.WP.I18n.NonSingularStringLiteralText -- Menu config stores translation keys.
					if ( $slug_trans ) {
						$result = self::get_content( $slug_trans, $menu_item['content_type'] );

						// phpcs:ignore WordPress.WP.I18n.NonSingularStringLiteralText -- Menu config stores translation keys.
						$title_trans = _x( $menu_item['title'], 'DIS_ActivationItems', 'design_ict_site' ); // phpcs:ignore WordPress.WP.I18n.NonSingularStringLiteralText -- Menu config stores translation keys.
						if ( $result ) {
							$menu_item_id = $result->ID;
							wp_update_nav_menu_item(
								$menu->term_id,
								0,
								array(
									'menu-item-title'     => $title_trans,
									'menu-item-object-id' => $menu_item_id,
									'menu-item-object'    => $menu_item['content_type'],
									'menu-item-status'    => $menu_item['status'],
									'menu-item-type'      => $menu_item['post_type'],
									'menu-item-url'       => $menu_item['link'],
								)
							);
						}
					}
				} else {
					// External links.
					$title_trans = _x( $menu_item['title'], 'DIS_ActivationItems', 'design_ict_site' ); // phpcs:ignore WordPress.WP.I18n.NonSingularStringLiteralText -- Menu config stores translation keys.
					if ( $title_trans ) {
						wp_update_nav_menu_item(
							$menu->term_id,
							0,
							array(
								'menu-item-title'  => $title_trans,
								'menu-item-status' => $menu_item['status'],
								'menu-item-url'    => $menu_item['link'],
							)
						);
					}
				}
			}
			self::assign_menu_location( $menu, $menu_location );
			update_option( 'menu_check', true );
			/* translators: %s: menu name. */
			$msg = sprintf( __( "NEW menu '%s' created.", 'design_ict_site' ), $menu_name );
			array_push( $messages, $msg );
		}
	}
}
