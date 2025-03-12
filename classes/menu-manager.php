<?php
/**
 * Definition of the Menu Manager: defines and build all menus.
 *
 * @package Design_ICT_Site
 */


/**
 * The Menu manager.
 *
 */
class DIS_MenuManager {
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

		// Register the menu.
		add_action( 'admin_menu', array( $this, 'register_update_theme_link' ) );

	}

	/**
	 * Creation of the link to load default theme data: Reload default theme data.
	 * WP->Appearance->Reload theme data.
	 *
	 * @return void
	 */
	public function register_update_theme_link() {
		add_theme_page(
			esc_html__( 'Reload theme data', 'design_ict_site'),
			esc_html__( 'Reload theme data', 'design_ict_site'),
			DIS_EDIT_THEME_PERMISSION,
			'dis-reload-data-theme-options',
			array( $this, 'get_reloadthemedata_page' ),
		);
	}

	/**
	 * Render the Settings page.
	 *
	 * @return void
	 */
	public function get_reloadthemedata_page() {
		// @TODO: check the user permission.
		$result_activation = false;
		$is_reload         = false;
		if( isset( $_GET['action'] ) && 'reload' === $_GET['action'] ) {
			$is_reload         = true;
			$actm              = new DIS_ActivationManager();
			$result_activation = $actm->reload_data();
		}

		echo "<div class='wrap'>";
		echo '<h1>' .  __( 'Reload theme data', 'design_ict_site' ) .'</h1>';

		echo '<div class="dis_admin_reload_data">';

		echo '<p>' .  __( 'Click the button to reload theme data: post-types, taxonomies, sections, pages, menu, etc. ', 'design_ict_site' ). '</p>';
		echo '<a href="admin.php?page=dis-reload-data-theme-options&action=reload" class="button button-primary">Reload data</a>';
		echo '</div>';

		if ( $is_reload ) {
			if ( ( $result_activation ) && ( $result_activation['code']= 1 ) ) {
				echo '<div class="dis_admin_reload_result text-primary mt-20"><em>' . __( 'Theme data loaded successfully', 'design_ict_site' ) .'</em><div class="dis_admin_reload_result_text">' . json_encode( $result_activation['data'] )	.'</div></div>';
			} else {
				echo '<div class="dis_admin_reload_result text-danger"><em>' .  __( 'Theme data not reloaded', 'design_ict_site' ) . '</em>.</div>';
			}
		}

		echo '</div>';
	}

}
