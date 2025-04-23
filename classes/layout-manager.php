<?php
/**
 * Definition of the Layout Manager: uploads css and js.
 * 
 * @package Design_ICT_Site
 */


/**
 * The manager that uploads the layout of the theme.
 *
 */
class DIS_LayoutManager {
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
		add_action( 'admin_enqueue_scripts', array( $this, 'upload_admin_scripts' ) );
	}

	public function upload_scripts(){

		// Import CSS files.
		wp_enqueue_style( 'dis-wp-style', get_stylesheet_uri() ); // File style.css vuoto.
		wp_enqueue_style( 'dis-font', DIS_THEME_URL . '/assets/css/fonts.css' );
		wp_enqueue_style( 'dis-boostrap-italia', DIS_THEME_URL . '/assets/css/bootstrap-italia-custom.min.css' );
		wp_enqueue_style( 'dis-custom-css', DIS_THEME_URL . '/assets/css/custom-colors.css' );
		wp_enqueue_style( 'dis-main', DIS_THEME_URL . '/assets/css/main.css' );
		// Enqueue Bootstrap Icons.
		wp_enqueue_style( 'bootstrap-icons', DIS_THEME_URL . '/assets/css/bootstrap-icons.css' );

		// Import Javascript files.
		wp_enqueue_script( 'dis-main-js', DIS_THEME_URL . '/assets/js/main.js' );
		wp_enqueue_script( 'dis-boostrap-italia-js', DIS_THEME_URL . '/assets/bootstrap-italia/js/bootstrap-italia.bundle.min.js', array(), false, true);
	}

	public function upload_admin_scripts(){
		// ADMIN style: for Configuration Menu (CMB2) - To put the menu on the left instead of at the top.
		wp_enqueue_style( 'dis-style-admin-css', DIS_THEME_URL . '/admin/css/style-admin.css' );
		wp_enqueue_style( 'dis-admin-css', DIS_THEME_URL . '/admin/css/admin.css' );
	}

}
