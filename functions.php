<?php
/**
 * Design ICT Site Italia functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Design_ICT_Site
 */

 /*
* Constants.
*/
define( 'DIS_THEME_PATH', plugin_dir_path( __FILE__ ) );
define( 'DIS_THEME_URL', get_template_directory_uri() );


/**
 * Defining the theme parameters and the theme configurations.
 */
require DIS_THEME_PATH . '/config-theme.php';

/**
 * Defining the pages of the site.
 */
require DIS_THEME_PATH . '/config-pages.php';

/**
 * Defining the menus of the site.
 */
require DIS_THEME_PATH . '/config-menu.php';

/**
 * Defining and managing theme dependencies using TGM.
 */
require DIS_THEME_PATH . '/inc/theme-dependencies.php';

/**
 * Import CMB2 libraries.
 */
require DIS_THEME_PATH . '/inc/cmb2.php';



/**
 * SETUP THE THEME.
 */
if ( ! class_exists( 'DIS_ThemeManager' ) ) {
	require_once get_template_directory() . '/classes/theme-manager.php';
}


if ( class_exists( 'DIS_ThemeManager' ) ) {
	add_action(
		'after_setup_theme',
		function() {
			remove_action( 'after_setup_theme', __FUNCTION__ );
			$theme_manager = DIS_ThemeManager::get_instance();
			$theme_manager->theme_setup();
		},
		2
	);
}

// ////// SETUP THE THEME //////
// if ( class_exists( 'DIS_ThemeManager' ) ) {
// 	include_once get_template_directory() . '/classes/theme-manager.php';
// 	global $theme_manager;
// 	$theme_manager = new DIS_ThemeManager();
// 	$theme_manager->theme_setup();
// }
