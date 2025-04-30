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

	private $result = array(
		'status' => 0,       // 1: success, 0: error.
		'data'   => array(), // Array of string to write.
	);

	/**
	 * Constructor of the Manager.
	 */
	public function __construct() {}

	public function reload_data() {
		error_log( '*** ACTION RELOAD DATA ***' );
		array_push( $this->result['data'], '*** BEGIN THEME ACTIVATION ***' );

		// Create the pages of the site, if not exist.
		$this->pages_creation( $this->result['data'] );

		// Create the taxonomies of the site, if not exist.
		$this->taxonomies_creation( $this->result['data'] );

		// Create the menus of the site, if not exist.
		$this->menu_creation( $this->result['data'] );

		// Create the custom tables, if not exist.
		$this->create_the_tables( $this->result['data'] );

		$this->result['status'] = 1;
		array_push( $this->result['data'], '*** END THEME ACTIVATION ***' );
		return $this->result;
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

	private function pages_creation( &$messages ) {
		array_push( $this->result['data'], '* BEGIN Pages Creation:' );
		$languages = DIS_MultiLangManager::get_languages_list();
		foreach ( DIS_STATIC_PAGES as $slug => $pg ) {
			$related_posts = array();
			foreach ( $languages as $lang ) {
				$slug_trans = DIS_MultiLangManager::get_dis_translation( $slug, 'DIS_ActivationItems', $lang );
				if ( $slug_trans ) {
					$check_page   = self::get_content( $slug_trans, $pg['content_type'] );
					$new_page_id  = $check_page ? $check_page->ID : 0;
					if ( $new_page_id === 0 ) {
						// Create the page if not exists.
						$title_trans = DIS_MultiLangManager::get_dis_translation( $pg['content_title'], 'DIS_ActivationItems', $lang );
						if ( $title_trans ) {
							// Check if a page template exists.
							$content = '';
							if ( $pg['content_file'] ) {
								$file_path = realpath( DIS_THEME_PATH . str_replace( '_xx.html', '_' . $lang . '.html', $pg['content_file'] ) );
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
							DIS_MultiLangManager::set_post_language( $new_page_id, $lang );
						}
						$msg = sprintf(  __( "Successfully created the page: '%s'.", 'design_ict_site' ), $slug_trans );
						array_push( $messages, $msg );
					} else {
						// $msg = sprintf( __( "Page: '%s' already present", 'design_ict_site' ), $slug_trans );
						// array_push( $messages, $msg );
						$related_posts[ $lang ] = $new_page_id;
					}
				}
			}
			DIS_MultiLangManager::save_post_translations( $related_posts );
		}
		array_push( $this->result['data'], '* END Pages Creation.' );
		return true;
	}

	private function taxonomies_creation( &$messages ) {
		array_push( $this->result['data'], '* BEGIN Taxonomies Creation:' );
		array_push( $this->result['data'], '* END Taxonomies Creation:' );
		return true;
	}

	private function menu_creation( &$messages ) {
		array_push( $this->result['data'], '* BEGIN Menu Creation:' );

		// Creation of all the site menus: each menu is replicated for each available language.
		$languages = DIS_MultiLangManager::get_languages_list();
		foreach ( $languages as $lang ) {
			$this->build_the_menu( $messages, DIS_PRIMARY_MENU, $lang );
			$this->build_the_menu( $messages, DIS_SECONDARY_MENU, $lang );
			$this->build_the_menu( $messages, DIS_HEADER_MENU, $lang );
			$this->build_the_menu( $messages, DIS_FOOTER_MENU, $lang );
			$this->build_the_menu( $messages, DIS_USEFUL_LINKS_MENU, $lang );
		}

		array_push( $this->result['data'], '* END Menu Creation.' );
		return true;
	}

	/**
	 * Create the custom tables.
	 *
	 * @return bool
	 */
	private function create_the_tables( &$messages ) {
		global $wpdb;
		$table_name = $wpdb->prefix . 'dis_custom_translations';
		if ( $wpdb->get_var( "SHOW TABLES LIKE '$table_name'" ) !== $table_name ) {
			require_once ABSPATH . 'wp-admin/includes/upgrade.php';
			$charset_collate = $wpdb->get_charset_collate();
			$sql = "CREATE TABLE $table_name (
					id          BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
					label       TEXT NOT NULL,
					domain      VARCHAR(100) NOT NULL,
					lang        VARCHAR(4) NOT NULL,
					translation TEXT NOT NULL,
				PRIMARY KEY (id),
				KEY idx_text_domain (domain)
				) ENGINE=InnoDB $charset_collate;";
			dbDelta( $sql );
			$msg = sprintf( __( "Table '%s successfully created.", 'design_ict_site' ), $table_name );
			array_push( $messages, $msg );
		} else {
			$msg = sprintf( __( "Table '%s' already present.", 'design_ict_site' ), $table_name );
			array_push( $messages, $msg );
		}
		return true;
	}

	private function build_the_menu( &$messages, $menu, $lang ) {
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
			$menu_id  = wp_create_nav_menu( $menu_name );
			$menu     = get_term_by( 'id', $menu_id, 'nav_menu' );
			foreach ( $menu_items as $menu_item ) {
				if ( ( ! isset( $menu_item['link'] ) ) || ( '' === $menu_item['link'] ) ) {
					// Link to pages or posts.
					$slug_trans = DIS_MultiLangManager::get_dis_translation( $menu_item['slug'], 'DIS_ActivationItems', $lang );
					if ( $slug_trans ) {
						$result      = self::get_content( $slug_trans, $menu_item['content_type'] );
						$title_trans = DIS_MultiLangManager::get_dis_translation( $menu_item['title'], 'DIS_ActivationItems', $lang );
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
					$title_trans  = DIS_MultiLangManager::get_dis_translation( $menu_item['title'], 'DIS_ActivationItems', $lang );
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
