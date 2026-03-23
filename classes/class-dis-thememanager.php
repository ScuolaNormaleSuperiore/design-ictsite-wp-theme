<?php
/**
 * Theme manager bootstrap.
 *
 * @package Design_ICT_Site
 */

/**
 * Definition of the ThemeManager used to create the custom content types.
 * In this file we define the structure of the site.
 *
 * @package Design_ICT_Site
 */

if ( ! class_exists( 'DIS_MultiLangManager' ) ) {
	include_once 'multi-lang-manager.php';
}
if ( ! class_exists( 'DIS_CustomFieldsManager' ) ) {
	include_once 'custom-fields-manager.php';
}
if ( ! class_exists( 'DIS_LayoutManager' ) ) {
	include_once 'class-dis-layoutmanager.php';
}
if ( ! class_exists( 'DIS_OptionsManager' ) ) {
	include_once 'options-manager.php';
}
if ( ! class_exists( 'DIS_ExportManager' ) ) {
	include_once 'class-dis-exportmanager.php';
}
if ( ! class_exists( 'DIS_ActivationManager' ) ) {
	include_once 'class-dis-activationmanager.php';
}
if ( ! class_exists( 'DIS_ContentsManager' ) ) {
	include_once 'class-dis-contentsmanager.php';
}
if ( ! class_exists( 'DIS_NavigationManager' ) ) {
	include_once 'navigation-manager.php';
}
if ( ! class_exists( 'Service_Cluster_Manager' ) ) {
	include_once 'service-cluster-manager.php';
}
if ( ! class_exists( 'Service_Manager' ) ) {
	include_once 'service-manager.php';
}
if ( ! class_exists( 'Office_Manager' ) ) {
	include_once 'office-manager.php';
}
if ( ! class_exists( 'Person_Manager' ) ) {
	include_once 'person-manager.php';
}
if ( ! class_exists( 'Project_Manager' ) ) {
	include_once 'project-manager.php';
}
if ( ! class_exists( 'Event_Manager' ) ) {
	include_once 'event-manager.php';
}
if ( ! class_exists( 'News_Manager' ) ) {
	include_once 'news-manager.php';
}
if ( ! class_exists( 'Place_Manager' ) ) {
	include_once 'place-manager.php';
}
if ( ! class_exists( 'Post_Manager' ) ) {
	include_once 'post-manager.php';
}
if ( ! class_exists( 'Page_Manager' ) ) {
	include_once 'page-manager.php';
}
if ( ! class_exists( 'DIS_AttachmentManager' ) ) {
	include_once 'class-dis-attachmentmanager.php';
}
if ( ! class_exists( 'Banner_Manager' ) ) {
	include_once 'banner-manager.php';
}
if ( ! class_exists( 'Sponsor_Manager' ) ) {
	include_once 'sponsor-manager.php';
}
if ( ! class_exists( 'Faq_Manager' ) ) {
	include_once 'faq-manager.php';
}
if ( ! class_exists( 'DIS_AutocompleteManager' ) ) {
	include_once 'class-dis-autocompletemanager.php';
}
/**
 * The manager that builds the tool and configures WordPress.
 * How to get a manger?
 * $theme_manager = DIS_ThemeManager::get_instance();
 */
class DIS_ThemeManager {
	/**
	 * The static instance of the ThemeManager.
	 *
	 * @var object
	 */
	protected static $instance = null;

	/**
	 * Custom fields manager instance.
	 *
	 * @var DIS_CustomFieldsManager|null
	 */
	public $cfm = null;

	/**
	 * Multilanguage manager instance.
	 *
	 * @var DIS_MultiLangManager|null
	 */
	public $mlm = null;

	/**
	 * Options manager instance.
	 *
	 * @var DIS_OptionsManager|null
	 */
	public $cnm = null;

	/**
	 * Constructor.
	 */
	public function __construct() {}

	/**
	 * Create the instance of the manager.
	 *
	 * @return self
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
	public function theme_setup() {

		// Setup security configurations.
		$this->enable_security_configurations();

		// Setup internationalisation.
		$this->setup_internationalisation();

		// Setup permalink structure.
		$this->setup_site_structure();

		// Setup upload limits structure.
		$this->setup_upload_limits();

		// Setup new roles.
		$this->setup_roles();

		// Setup of the tool to manage multiple languages.
		$this->mlm = new DIS_MultiLangManager();
		$this->mlm->setup();

		// Setup of the tool to manage custom fields.
		$this->cfm = new DIS_CustomFieldsManager();

		// Setup of the layout of the theme.
		$lym = new DIS_LayoutManager();
		$lym->setup();

		// Setup of the Options Configuration Section of the the.
		$this->cnm = new DIS_OptionsManager();
		$this->cnm->build_conf_menu();

		// Setup the export manager.
		$exm = new DIS_ExportManager();
		$exm->setup();

		// Setup the reload data section.
		$acm = new DIS_ActivationManager();
		$acm->setup();

		/***
		 * Setup custom post types and associated taxonomies.
		 */

		// Setup of the Service Cluster post-type.
		$srcm = new Service_Cluster_Manager();
		$srcm->setup();

		// Setup of the Service post-type.
		$srvpt = new Service_Manager();
		$srvpt->setup();

		// Setup of the Office post-type.
		$offm = new Office_Manager();
		$offm->setup();

		// Setup of the People post-type.
		$prsm = new Person_Manager();
		$prsm->setup();

		// Setup of the DIS-Project post-type.
		$prjm = new Project_Manager();
		$prjm->setup();

		// Setup of the DIS-Event post-type.
		$evnm = new Event_Manager();
		$evnm->setup();

		// Setup of the DIS-News post-type.
		$nwsm = new News_Manager();
		$nwsm->setup();

		// Setup of the Place post-type.
		$plcm = new Place_Manager();
		$plcm->setup();

		// Setup of the Post post-type.
		$pstm = new Post_Manager();
		$pstm->setup();

		// Setup of the Page post-type.
		$pgm = new Page_Manager();
		$pgm->setup();

		// Setup of the Attachment post-type.
		$attachment_manager = new DIS_AttachmentManager();
		$attachment_manager->setup();

		// Setup of the Banner post-type.
		$bnm = new Banner_Manager();
		$bnm->setup();

		// Setup of the Sponsor post-type.
		$spm = new Sponsor_Manager();
		$spm->setup();

		// Setup of the Faq post-type.
		$fqm = new Faq_Manager();
		$fqm->setup();

		// Setup of Autocomplete Manager.
		$autocomplete_manager = new DIS_AutocompleteManager();
		$autocomplete_manager->setup();

		// Setup of sitemap renderers and XML endpoints.
		$nvm = new DIS_NavigationManager();
		$nvm->setup();
	}

	/**
	 * Defines the folder with the translation files.
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 *
	 * @return void
	 */
	public function configure_languages() {
		// For the labels of the theme.
		load_theme_textdomain( 'design_ict_site', get_template_directory() . '/languages' ); // phpcs:ignore WordPress.WP.I18n.TextDomainMismatch -- Legacy theme text domain.
	}

	/**
	 * Force the permalink format for this site.
	 *
	 * @return void
	 */
	public function configure_permalink() {
		$desired = '/%postname%/';
		if ( get_option( 'permalink_structure' ) !== $desired ) {
			update_option( 'permalink_structure', $desired );
			global $wp_rewrite;
			$wp_rewrite->flush_rules();
		}
	}

	/**
	 * Enforce upload limits based on file type.
	 *
	 * @param array $file Uploaded file metadata.
	 * @return array
	 */
	public function configure_upload_limits( $file ) {
		$image_max_size = 1024 * 1024;     // 1MB for images.
		$pdf_max_size   = 2 * 1024 * 1024; // 2MB for PDF files.
		$type           = $file['type'];
		$size           = $file['size'];
		// Images limits.
		$image_types = array( 'image/jpeg', 'image/png', 'image/gif', 'image/webp' );
		if ( in_array( $type, $image_types, true ) && $size > $image_max_size ) {
			$file['error'] = __( 'The image is too big. The maximum allowed is: 1MB.', 'design_ict_site' ); // phpcs:ignore WordPress.WP.I18n.TextDomainMismatch -- Legacy theme text domain.
		}
		// PDF size attachment limit.
		if ( 'application/pdf' === $type && $size > $pdf_max_size ) {
			$file['error'] = __( 'The PDF file is too big. the maximum allowed is: 2MB.', 'design_ict_site' ); // phpcs:ignore WordPress.WP.I18n.TextDomainMismatch -- Legacy theme text domain.
		}
		return $file;
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
			function () {
				return __( 'Invalid username or password', 'design_ict_site' ); // phpcs:ignore WordPress.WP.I18n.TextDomainMismatch -- Legacy theme text domain.
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
	private function setup_internationalisation() {
		add_action( 'init', array( $this, 'configure_languages' ) );
	}
	/**
	 * Ensure the super editor role exists and has the expected capabilities.
	 *
	 * @return void
	 */
	public function add_super_editor() {
		// Recupera il ruolo Editor.
		$base_role = get_role( 'editor' );
		// Controlla se il ruolo Editor esiste.
		if ( $base_role ) {
			// Aggiungi un nuovo ruolo basato sul ruolo Editor, se non esiste.
			$new_role = get_role( DIS_SUPER_EDITOR_ROLE_SLUG );
			if ( ! $new_role ) {
				$new_role = add_role( DIS_SUPER_EDITOR_ROLE_SLUG, DIS_SUPER_EDITOR_ROLE_NAME, $base_role->capabilities );
			}
			// Assegna al nuovo ruolo il permesso di lavorare sul tema e sul menu del sito.
			// Abilita la voce: Aspetto/Appearance del backoffice di WP.
			$new_role->add_cap( 'edit_theme_options' );
			// Assegna il permesso di modificare le configurazioni del tema al nuovo ruolo.
			$new_role->add_cap( DIS_EDIT_CONFIG_PERMISSION );
			// Assegna il permesso di modificare le configurazioni del tema all'amministratore del sito.
			$admin_role = get_role( 'administrator' );
			if ( $admin_role ) {
				$admin_role->add_cap( DIS_EDIT_CONFIG_PERMISSION );
			}
		}
	}

	/**
	 * Setup site structure.
	 *
	 * @return void
	 */
	private function setup_site_structure() {
		add_action( 'init', array( $this, 'configure_permalink' ) );
	}

	/**
	 * Hook upload limit filtering.
	 *
	 * @return void
	 */
	private function setup_upload_limits() {
		add_action( 'wp_handle_upload_prefilter', array( $this, 'configure_upload_limits' ) );
	}

	/**
	 * Hook role setup.
	 *
	 * @return void
	 */
	private function setup_roles() {
		add_action( 'init', array( $this, 'add_super_editor' ) );
	}
}
