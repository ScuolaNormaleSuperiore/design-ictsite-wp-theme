<?php
/**
 * Definition of the Activation Manager.
 *
 * @package Design_ICT_Site
 */


/**
 * The Menu manager.
 *
 */
class DIS_ActivationManager {

	private static string $main_page = 'dis-reload-data-theme-options';

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

		// @TODO: Use button and manage_submit_action not href, see: export-manager.php.
		// Register 'Reload data' actions.
		// add_action( 'admin_init', array( $this, 'manage_submit_action' ) );
	}

	/**
	 * Creation of the link to load default theme data: Reload default theme data.
	 * WP->Appearance->Reload theme data.
	 *
	 * @return void
	 */
	public function register_menu_link() {
		add_theme_page(
			esc_html__( 'Reload theme data', 'design_ict_site'),
			esc_html__( 'Reload theme data', 'design_ict_site'),
			DIS_EDIT_THEME_PERMISSION,
			self::$main_page,
			[self::class, 'get_page_code']
		);
	}

	/**
	 * Render the Settings page.
	 *
	 * @return void
	 */
	public static function get_page_code() {
		$result_activation = false;
		$is_reload         = false;
		if( isset( $_GET['action'] ) && 'reload' === $_GET['action'] ) {
			$is_reload         = true;
			$result_activation = self::reload_data();
		}
		echo "<DIV class='wrap'>";
		echo '<H1>' . __( 'Reload theme data', 'design_ict_site' ) .'</H1>';
		echo '<DIV class="dis_admin_reload_data">';
		echo '<P>' . __( 'Click the button to reload theme data: post-types, taxonomies, sections, pages, menu, etc. ', 'design_ict_site' ). '</P>';
		// @TODO: Change link with button.
		echo '<A HREF="admin.php?page=' . self::$main_page . '&action=reload" class="button button-primary">Reload data</A>';
		echo '</DIV>';
		if ( $is_reload ) {
			if ( ( $result_activation ) && ( $result_activation['code']= 1 ) ) {
				echo '<DIV class="dis_admin_reload_result text-primary mt-20"><em>' . __( 'Theme data loaded successfully', 'design_ict_site' ) .'</EM><DIV class="dis_admin_reload_result_text">';
				echo '<H3>' . __( 'List of all activations', 'design_ict_site' ) . ':</H3>';
				echo '<UL>';
				foreach ($result_activation['data'] as $msg ) {
					echo '<LI>' . $msg . '</LI>';
				}
				echo '</UL>';
				echo '</DIV></DIV>';
			} else {
				echo '<DIV class="dis_admin_reload_result text-danger"><EM>' . __( 'Theme data not reloaded', 'design_ict_site' ) . '</EM>.</DIV>';
			}
		}
		echo '</DIV>';
	}

	private static function reload_data() {
		if ( ! current_user_can( DIS_EDIT_THEME_PERMISSION, ) ) return;
		error_log( '*** ACTION RELOAD DATA ***' );
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

	private static function get_content( $slug, $content_type ) {
		$args = array(
			'name'        => $slug,
			'post_type'   => $content_type,
			'post_status' => array( 'publish', 'draft', 'trash', 'pending', 'private' ),
			'numberposts' => 1,
		);
		$posts = get_posts( $args );
		return $posts ? $posts[0] : null;
	}

	private static function get_parent( $par ) {
		return 0;
	}

	private static function pages_creation( &$messages ) {
		array_push( self::$result['data'], '* BEGIN Pages Creation:' );
		$languages = DIS_MultiLangManager::get_languages_list( array( 'fields' => array() ) );
		foreach ( DIS_STATIC_PAGES as $slug => $pg ) {
			$related_posts = array();

			// Save the current locale.
			$default_locale = get_locale();
			foreach ( $languages as $lang ) {
				switch_to_locale( $lang->locale );

				$slug_trans = _x( $pg['content_slug'], 'DIS_ActivationItems', 'design_ict_site' );
				if ( $slug_trans ) {
					$check_page  = self::get_content( $slug_trans, $pg['content_type'] );
					$new_page_id = $check_page ? $check_page->ID : 0;
					if ( $new_page_id === 0 ) {
						// Create the page if not exists.
						$title_trans = _x( $pg['content_title'], 'DIS_ActivationItems', 'design_ict_site' );
						if ( $title_trans ) {
							// Check if a page template exists.
							$content = '';
							if ( $pg['content_file'] ) {
								$file_path = realpath( DIS_THEME_PATH . str_replace( '_xx.html', '_' . $lang->slug . '.html', $pg['content_file'] ) );
								if ( file_exists( $file_path ) ) {
									$content = file_get_contents( $file_path );
								}
							}
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
							// Assign a template to the page.
							if ( $pg['content_template'] ) {
								update_post_meta( $new_page_id, '_wp_page_template', $pg['content_template'] );
							}
							// Assign the IT language to the page.
							DIS_MultiLangManager::set_post_language( $new_page_id, $lang->slug );
						}
						$msg = sprintf(  __( "Successfully created the page: '%s'.", 'design_ict_site' ), $slug_trans );
						array_push( $messages, $msg );
						$related_posts[ $lang->slug ] = $new_page_id;
					} else {
						// $msg = sprintf( __( "Page: '%s' already present", 'design_ict_site' ), $slug_trans );
						// array_push( $messages, $msg );
						$related_posts[ $lang->slug ] = $new_page_id;
					}
				}
			}

			// Back to the original local.
			// restore_previous_locale();
			switch_to_locale( $default_locale );

			DIS_MultiLangManager::save_post_translations( $related_posts );
		}
		array_push( self::$result['data'], '* END Pages Creation.' );
		return true;
	}

	private static function taxonomies_creation( &$messages ) {
		array_push( self::$result['data'], '* BEGIN Taxonomies Creation:' );
		array_push( self::$result['data'], '* END Taxonomies Creation:' );
		return true;
	}

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


	private static function build_the_menu( &$messages, $menu, $lang ) {
		$menu_name     = $menu['name'] . ' [' . strtoupper( $lang ) . ']';
		$menu_items    = $menu['items'];
		$menu_location = $menu['location'];
		$menu_object   = wp_get_nav_menu_object( $menu_name );

		if ( $menu_object ) {
			// Do nothing if the menu exists.
			$msg = sprintf( __( "The menu '%s' already exists.", 'design_ict_site' ), $menu_name );
			array_push( $messages, $msg );
			$menu_id = $menu_object->term_id;
			$menu    = get_term_by( 'id', $menu_id, 'nav_menu' );
		} else {
			$menu_id = wp_create_nav_menu( $menu_name );
			$menu    = get_term_by( 'id', $menu_id, 'nav_menu' );
			foreach ( $menu_items as $menu_item ) {
				if ( ( ! isset( $menu_item['link'] ) ) || ( '' === $menu_item['link'] ) ) {
					// Link to pages or posts.
					$slug_trans = _x( $menu_item['slug'], 'DIS_ActivationItems', 'design_ict_site' );
					if ( $slug_trans ) {
						$result      = self::get_content( $slug_trans, $menu_item['content_type'] );;
						$title_trans = _x($menu_item ['title'], 'DIS_ActivationItems', 'design_ict_site' );
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
					$title_trans = _x( $menu_item['title'], 'DIS_ActivationItems', 'design_ict_site' );
					if ( $title_trans ) {
						wp_update_nav_menu_item(
							$menu->term_id,
							0,
							array(
								'menu-item-title'     => $title_trans,
								'menu-item-status'    => $menu_item['status'],
								'menu-item-url'       => $menu_item['link'],
							)
						);
					}
				}
			}
			$locations_primary_arr                   = get_theme_mod( 'nav_menu_locations' );
			$locations_primary_arr[ $menu_location ] = $menu->term_id;
			set_theme_mod( 'nav_menu_locations', $locations_primary_arr );
			update_option( 'menu_check', true );
			$msg = sprintf( __( "NEW menu '%s' created.", 'design_ict_site' ), $menu_name );
			array_push( $messages, $msg );
		}
	}

}
