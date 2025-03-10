<?php
/**
 * Definition of the ThemeManager used to create the custom content types.
 * 
 * @package Design_ICT_Site
 */

if ( ! class_exists( 'DIS_MultiLangManager' ) ) {
	include_once 'multilang-manager.php';
}

/**
 * The manager that builds the tool and configures Wordpress.
 * How to get a manger?
 * $theme_manager = DIS_ThemeManager::get_instance();
 *
 */
class DIS_ThemeManager {
	/**
	 * The static instance of the ThemeManager.
	 *
	 * @var object
	 */
	protected static $instance = null;

	private function __construct() {}

	/**
	 * Create the instance of the manager.
	 *
	 * @return object.
	 */
	public static function get_instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * Used to install and configure the plugin.
	 *
	 * @return void
	 */
	public function plugin_setup() {

		// Setup security configurations.
		$this->enable_security_configurations();

		// Setup internationalisation.
		$this->setup_internationalisation();

		// Setup permalink structure.
		$this->setup_site_structure();

		// Multi language setup.
		$mlg = new DIS_MultiLangManager();
		$mlg->setup();

		// Setup custom post types and associated taxonomies.
		
	}

	/**
	 * Defines the folder with the translation files.
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 *
	 * @return void
	 */
	public function configure_languages() {
		load_theme_textdomain( 'design_ict_site', get_template_directory() . '/languages' );
	}

	/**
	 * Force the permalink format for this site.
	 *
	 * @return void
	 */
	public function configure_permalink() {
		update_option( 'permalink_structure', '/%postname%/' );
		global $wp_rewrite;
		$wp_rewrite->flush_rules();
	}

	/**
	 * Set minimal security configurations.
	 *
	 * @return void
	 */
	private function enable_security_configurations() {
		// Hook to hide the login error message.
		add_filter(
			'login_errors',
			function() {
				return __( 'Invalid username or password', 'kk_writer_theme' );
			}
		);
		// Hook per nascondere la versione del CMS (tag generator).
		add_filter( 'the_generator', '__return_null' );
		// Disable XMLRPC service.
		add_filter( 'xmlrpc_enabled', '__return_false' );
	}

	/**
	 * Setup internationalisation.
	 *
	 * @return void
	 */
	private function setup_internationalisation(){
		add_action( 'init', array( $this, 'configure_languages' ) );
	}

	/**
	 * Setup site structure.
	 *
	 * @return void
	 */
	private function setup_site_structure(){
		add_action( 'init', array( $this, 'configure_permalink' ) );
	}

}


/**
 * To prevent class clonation.
 */
final class DIS_ThemeManager_Singleton extends DIS_ThemeManager {
	private function __clone() {}
	public function __wakeup() {}
}
