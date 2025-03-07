<?php
/**
 * Design Laboratori Italia functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Design_ICT_Site
 */

/**
 * Define the theme parameters and configurations.
 */
require get_template_directory() . '/config-site.php';

/**
 * SETUP THE THEME.
 */
if ( ! class_exists( 'DIS_ThemeManager' ) ) {
	require_once get_template_directory() . '/inc/classes/theme-manager.php';
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
