<?php
/**
 * Design Laboratori Italia functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Design_ICT_Site
 */

/**
 * Defining the theme parameters and the theme configurations.
 */
require get_template_directory() . '/config-theme.php';

/**
 * Defining and managing theme dependencies using TGM.
 */
require get_template_directory() . '/inc/theme-dependencies.php';

/**
 * Import CMB2 libraries.
 */
require get_template_directory() . '/inc/cmb2.php';



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
			$theme_manager = DIS_ThemeManager::get_instance();
			$theme_manager->plugin_setup();
		}
	);
}
