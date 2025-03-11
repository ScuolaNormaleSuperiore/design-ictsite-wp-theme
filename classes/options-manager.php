<?php
/**
 * Definition of the Options Manager: builds in the site back-office the Configuration menu of the theme.
 * 
 * @package Design_ICT_Site
 */


/**
 * The manager of the Configuration menu.
 *
 */
class DIS_OptionsManager {
	private $tab_group   = 'dis_options';
	private $parent_slug = 'dis_opt_options';
	private $capability  = 'manage_options';

	/**
	 * Constructor of the Manager.
	*/
	public function __construct() {}

	public function build_conf_menu() {
		add_action( 'cmb2_admin_init', array( $this, 'setup_options' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'setup_option_assets' ) );
	}

	public function setup_option_assets() {
		$current_screen = get_current_screen();
		if( strpos( $current_screen->id, 'configurazione_page_') !== false || $current_screen->id === 'toplevel_page_dis_opt_options' ) {
				wp_enqueue_style( 'style-admin-css', DIS_THEMA_URL . '/admin/css/style-admin.css' );
				wp_enqueue_style( 'dis_options_dialog', DIS_THEMA_URL . '/admin/css/jquery-ui.css' );
				// Hiding the submenu in the WordPress adminmenu.
				wp_enqueue_script( 'dis_options_dialog', DIS_THEMA_URL . '/admin/js/options.js', array('jquery', 'jquery-ui-core', 'jquery-ui-dialog' ), '1.0', true );
		}
	}


	public function setup_options() {
		// 1 - Registers options page "Base options".
		$this->add_opt_base_option( $this->parent_slug, $this->tab_group, $this->capability );
		// 2 - Registers options page "Home Page Layout".
		$this->add_opt_hp_layout( 'dis_opt_hp_layout', $this->tab_group, $this->capability );
		// // 4 - Registers options page "Site Contacts".
		$this->add_opt_site_contacts( 'dis_opt_site_contacts', $this->tab_group, $this->capability );
		// // 5- Registers options page "Social media".
		$this->add_opt_social_media( 'dis_opt_social_media', $this->tab_group, $this->capability );
		// // 6 - Registers options page "Advanced settings".
		$this->add_opt_advanced_settings( 'dis_opt_advanced_settings', $this->tab_group, $this->capability );
	}

	/**
	 * 1 - Registers options page "Base options".
	 *
	 * @return boolean
	 */
	public function add_opt_base_option( $option_key, $tab_group, $capability ) {
		$result = true;
		$args = array(
			'id'           => $option_key . '_id',
			'title'        => esc_html__( 'ICT Site', 'design_ict_site' ),
			'object_types' => array( 'options-page' ),
			'option_key'   => $option_key,
			'tab_group'    => $tab_group,
			'tab_title'    => __( 'Base options', 'design_ict_site' ),
			'capability'   => $capability,
			'position'     => 3, // Menu position. Only applicable if 'parent_slug' is left empty.
			'icon_url'     => 'dashicons-admin-tools', // Menu icon. Only applicable if 'parent_slug' is left empty.
		);
		// 'tab_group' property is supported in > 2.4.0.
		// if ( version_compare( CMB2_VERSION, '2.4.0' ) ) {
		// 	$args['display_cb'] = array( $this, 'options_display_with_tabs' );
		// }
		$base_options = new_cmb2_box( $args );

		$base_options->add_field(
			array(
				'id'   => 'baseoptions_info',
				'name' => __( 'Site configuration', 'design_ict_site' ),
				'desc' => __( 'Section to configure base options.' , 'design_ict_site' ),
				'type' => 'title',
			)
		);
		$base_options->add_field(
			array(
				'id'         => 'site_title',
				'name'       => __( 'Site title', 'design_ict_site' ) . '&nbsp;*',
				'desc'       => __( 'The title of the site.' , 'design_ict_site' ),
				'type'       => 'text',
				'attributes' => array(
					'required'   => 'required',
				),
			)
		);
		$base_options->add_field(
			array(
				'id'         => 'site_tagline',
				'name'       => __( 'Tagline', 'design_ict_site' ),
				'desc'       => __( 'The tagline of the site.' , 'design_ict_site' ),
				'type'       => 'text',
			)
		);
		$base_options->add_field(
			array(
				'id'         => 'site_network_name',
				'name'       => __( 'Network name', 'design_ict_site' ),
				'desc'       => __( 'The name of the network the site is part of.' , 'design_ict_site' ),
				'type'       => 'text',
			)
		);
		$base_options->add_field(
			array(
				'id'         => 'site_network_url',
				'name'       => __( 'Network url', 'design_ict_site' ),
				'desc'       => __( 'The url of the network the site is part of.' , 'design_ict_site' ),
				'type'       => 'text',
			)
		);
		$base_options->add_field(
			array(
				'id' => 'header_logo_visible',
				'name' => __( 'Header logo visible', 'design_ict_site' ),
				'desc' => __( 'Yes if the logo needs to be shown in the header.', 'design_ict_site' ),
				'type' => 'radio_inline',
				'default' => 'false',
				'options' => array(
						'true' => __( 'Yes', 'design_ict_site' ),
						'false' => __( 'No', 'design_ict_site' ),
				),
			)
		);
		$base_options->add_field(
			array(
				'id'         => 'site_logo',
				'name'       => __( 'Logo header', 'design_ict_site' ),
				'desc'       => __( 'The logo of the site, please load an SVG image.' , 'design_ict_site' ),
				'type'       => 'file',
				'query_args' => array(
					'type' => array(
						'image',
					),
				),
			)
		);
		$base_options->add_field(
			array(
				'id' => 'footer_logo_visible',
				'name' => __( 'Footer logo visible', 'design_ict_site' ),
				'desc' => __( 'Yes if the logo needs to be shown in the footer.', 'design_ict_site' ),
				'type' => 'radio_inline',
				'default' => 'false',
				'options' => array(
						'true' => __( 'Yes', 'design_ict_site' ),
						'false' => __( 'No', 'design_ict_site' ),
				),
			)
		);
		$base_options->add_field(
			array(
				'id'         => 'footer_logo',
				'name'       => __( 'Logo footer', 'design_ict_site' ),
				'desc'       => __( 'Choose the the footer logo. If it is not present, but the display of the logo in the footer is enabled, the header logo is shown with inverted colors. It is recommended to upload an image in SVG format.' , 'design_ict_site' ),
				'type'       => 'file',
				'query_args' => array(
					'type' => array(
						'image',
					),
				),
			)
		);
		return $result;
	}

	
	/**
	 * 2 - Registers options page "Home Page Layout".
	 *
	 * @return boolean
	 */
	public function add_opt_hp_layout( $option_key, $tab_group, $capability ) {
		$args = array(
			'id'           => $option_key . '_id',
			'title'        => esc_html__( 'Home Page Layout', 'kk_writer_theme' ),
			'object_types' => array( 'options-page' ),
			'option_key'   => $option_key,
			'capability'   => $capability,
			'parent_slug'  => $this->parent_slug,
			'tab_group'    => $tab_group,
			'tab_title'    => __( 'HP layout', 'kk_writer_theme' ),
		);
		// 'tab_group' property is supported in > 2.4.0.
		// if ( version_compare( CMB2_VERSION, '2.4.0' ) ) {
		// 		$args['display_cb'] = array( $this, 'options_display_with_tabs' );
		// }
		$home_options = new_cmb2_box( $args );

		// CAROUSEL Section (Home Page)
		$home_options->add_field(
			array(
				'id'   => 'home_carousel',
				'name' => __( 'Carousel section', 'kk_writer_theme' ),
				'desc' => __( 'Configure here the carousel section.' , 'kk_writer_theme' ),
				'type' => 'title',
			)
		);
		$home_options->add_field(
			array(
				'id' => 'home_carousel_before_featured_enabled',
				'name' => __( 'Show carousel before featured content', 'kk_writer_theme' ),
				'desc' => __( 'If yes, the carousel is shown before the featured content section.', 'kk_writer_theme' ),
				'type' => 'radio_inline',
				'default' => 'true',
				'options' => array(
						'true' => __( 'Yes', 'kk_writer_theme' ),
						'false' => __( 'No', 'kk_writer_theme' ),
				),
			)
		);
		$home_options->add_field(
			array(
				'id' => 'home_carousel_visible',
				'name' => __( 'Show the Carousel section', 'kk_writer_theme' ),
				'desc' => __( 'Show the main carousel in the Home Page.', 'kk_writer_theme' ),
				'type' => 'radio_inline',
				'default' => 'true',
				'options' => array(
					'true'  => __( 'Yes', 'kk_writer_theme' ),
					'false' => __( 'No', 'kk_writer_theme' ),
				),
			)
		);
	}

	/**
	 * 3 - Registers options page "Site Contacts".
	 *
	 * @return boolean
	 */
	public function add_opt_site_contacts( $option_key, $tab_group, $capability ) {
		$args = array(
			'id'           => $option_key . '_id',
			'title'        => esc_html__( 'Contacts', 'kk_writer_theme' ),
			'object_types' => array( 'options-page' ),
			'option_key'   => $option_key,
			'capability'   => $capability,
			'parent_slug'  => $this->parent_slug,
			'tab_group'    => $tab_group,
			'tab_title'    => __( 'Site contacts', 'kk_writer_theme' ),	
		);
		// // 'tab_group' property is supported in > 2.4.0.
		// if ( version_compare( CMB2_VERSION, '2.4.0' ) ) {
		// 		$args['display_cb'] = 'dis_options_display_with_tabs';
		// }
		$contacts_options = new_cmb2_box( $args );

		$contacts_options->add_field(
			array(
			'id' => 'social_info',
			'name'        => __( 'Contacts', 'kk_writer_theme' ),
			'desc' => __( 'The contact shown in the footer.' , 'kk_writer_theme' ),
			'type' => 'title',
			)
		);
		$contacts_options->add_field(
			array(
				'id'         => 'site_city',
				'name'       => __( 'City', 'kk_writer_theme' ),
				'desc'       => __( 'The city of the site.' , 'kk_writer_theme' ),
				'type'       => 'text',
			)
		);
		$contacts_options->add_field(
			array(
				'id'         => 'site_address',
				'name'       => __( 'Address', 'kk_writer_theme' ),
				'desc'       => __( "The address of the site." , 'kk_writer_theme' ),
				'type'       => 'text',
			)
		);
		$contacts_options->add_field(
			array(
				'id'         => 'site_email',
				'name'       => __( 'E-mail', 'kk_writer_theme' ),
				'desc'       => __( 'The e-mail of the site.' , 'kk_writer_theme' ),
				'type'       => 'text',
			)
		);
		$contacts_options->add_field(
			array(
				'id'         => 'site_telephone',
				'name'       => __( 'Phone number', 'kk_writer_theme' ),
				'desc'       => __( 'The phone number of the site.' , 'kk_writer_theme' ),
				'type'       => 'text',
			)
		);

		$contacts_options->add_field(
			array(
				'id'   => 'smtp',
				'name' => __( 'SMTP', 'kk_writer_theme' ),
				'type' => 'title',
			)
		);
		
		$contacts_options->add_field(
			array(
				'id'         => 'smtp_sender_name',
				'name'       => __( 'SMTP sender name', 'kk_writer_theme' ),
				'desc'       => __( 'The name that must appear on the e-mails sent by the site.' , 'kk_writer_theme' ),
				'type'       => 'text',
			)
		);

		$contacts_options->add_field(
			array(
				'id'         => 'smtp_sender_email',
				'name'       => __( 'SMTP sender email', 'kk_writer_theme' ),
				'desc'       => __( 'The provider e-mail that must be used as sender.' , 'kk_writer_theme' ),
				'type'       => 'text',
			)
		);

	}

	/**
	 * 4 - Registers options page "Social media".
	 *
	 * @return boolean
	 */
	public function add_opt_social_media( $option_key, $tab_group, $capability ) {
		$args = array(
			'id'           => $option_key . '_id',
			'title'        => esc_html__( 'Social media', 'kk_writer_theme' ),
			'object_types' => array( 'options-page' ),
			'option_key'   => $option_key,
			'capability'   => $capability,
			'parent_slug'  => $this->parent_slug,
			'tab_group'    => $tab_group,
			'tab_title'    => __( 'Social media', 'kk_writer_theme' ),
		);
		// // 'tab_group' property is supported in > 2.4.0.
		// if ( version_compare( CMB2_VERSION, '2.4.0' ) ) {
		// 		$args['display_cb'] = 'dis_options_display_with_tabs';
		// }
		$social_options = new_cmb2_box( $args );

		$social_options->add_field(
			array(
				'id' => 'social_info',
				'name'        => __( 'Social media', 'kk_writer_theme' ),
				'desc' => __( 'Insert here the links to your social media.' , 'kk_writer_theme' ),
				'type' => 'title',
			)
		);
		$social_options->add_field(
			array(
				'id' => 'show_socials',
				'name' => __( 'Show social media icons', 'kk_writer_theme' ),
				'desc' => __( 'Enable the display of social media in the header and footer of the page.', 'kk_writer_theme' ),
				'type' => 'radio_inline',
				'default' => 'false',
				'options' => array(
						'true' => __( 'Yes', 'kk_writer_theme' ),
						'false' => __( 'No', 'kk_writer_theme' ),
				),
				'attributes' => array(
						'data-conditional-value' => "false",
				),
			)
		);
		$social_options->add_field(
			array(
				'id'   => 'facebook',
				'name' => 'Facebook',
				'type' => 'text_url',
			)
		);
		$social_options->add_field(
			array(
				'id'   => 'youtube',
				'name' => 'Youtube',
				'type' => 'text_url',
			)
		);
		$social_options->add_field(
			array(
				'id'   => 'instagram',
				'name' => 'Instagram',
				'type' => 'text_url',
			)
		);
		$social_options->add_field(
			array(
			'id'   => 'pinterest',
			'name' => 'Pinterest',
			'type' => 'text_url',
			)
		);
		$social_options->add_field(
			array(
				'id'   => 'twitter',
				'name' => 'Twitter',
				'type' => 'text_url',
			)
		);
		$social_options->add_field(
			array(
			'id'   => 'ics',
			'name' => 'X',
			'type' => 'text_url',
			)
		);
		$social_options->add_field(
			array(
				'id'   => 'linkedin',
				'name' => 'Linkedin',
				'type' => 'text_url',
			)
		);
		$social_options->add_field(
			array(
			'id'   => 'titok',
			'name' => 'TikTok',
			'type' => 'text_url',
			)
		);
		$social_options->add_field(
			array(
			'id'   => 'github',
			'name' => 'GitHub',
			'type' => 'text_url',
			)
		);
		$social_options->add_field(
			array(
			'id'   => 'gitlab',
			'name' => 'GitLab',
			'type' => 'text_url',
			)
		);
	}

	/**
	 * 5 - Registers options page "Advanced settings".
	 *
	 * @return boolean
	 */
	public function add_opt_advanced_settings( $option_key, $tab_group, $capability ) {
		$args = array(
			'id'           => $option_key . '_id',
			'title'        => esc_html__( 'Advanced', 'kk_writer_theme' ),
			'object_types' => array( 'options-page' ),
			'option_key'   => $option_key,
			'tab_title'    => __( 'Advanced', 'kk_writer_theme' ),
			'parent_slug'  => $this->parent_slug,
			'tab_group'    => $tab_group,
			'capability'   => $capability,
		);
		// // 'tab_group' property is supported in > 2.4.0.
		// if ( version_compare( CMB2_VERSION, '2.4.0' ) ) {
		// 	$args['display_cb'] = 'dis_options_display_with_tabs';
		// }
		$advanced_options = new_cmb2_box( $args );
	
		$advanced_options->add_field(
			array(
					'id'   => 'advanced_info',
					'name' => __( 'Advanced configurations', 'kk_writer_theme' ),
					'desc' => __( 'Section to configure advanced settings.' , 'kk_writer_theme' ),
					'type' => 'title',
			)
		);
	
		$advanced_options->add_field(
			array(
				'id'   => 'login',
				'name' => __( 'Login', 'kk_writer_theme' ),
				'type' => 'title',
			)
		);
	
		$advanced_options->add_field(
			array(
				'id'      => 'login_button_visible',
				'name'    => __( 'Login visible', 'kk_writer_theme' ),
				'type'    => 'radio_inline',
				'default' => 'true',
				'options' => array(
						'true'  => __( 'Yes', 'kk_writer_theme' ),
						'false' => __( 'No', 'kk_writer_theme' ),
				),
			)
		);
	
		$advanced_options->add_field(
			array(
				'id'   => 'multilingua',
				'name' => __( 'Multilanguage', 'kk_writer_theme' ),
				'type' => 'title',
			)
		);
	
		$advanced_options->add_field(
			array(
				'id'      => 'language_selector_visible',
				'name'    => __( 'Enable language selector', 'kk_writer_theme' ),
				'type'    => 'radio_inline',
				'default' => 'true',
				'options' => array(
						'true'  => __( 'Yes', 'kk_writer_theme' ),
						'false' => __( 'No', 'kk_writer_theme' ),
				),
			)
		);
	
		$advanced_options->add_field(
			array(
				'id'   => 'analytics',
				'name' => __( 'Web Analytics Code', 'kk_writer_theme' ),
				'type' => 'title',
			)
		);
	
		$advanced_options->add_field(
			array(
				'id'   => 'analytics_code',
				'name' => 'Code',
				'desc' => __( 'Enter the analytics code.', 'kk_writer_theme' ),
				'type' => 'textarea_code',
				'attributes'    => array(
						'rows'  => 10,
						'maxlength'  => '1000',
				),
			)
		);
	
		$advanced_options->add_field(
			array(
				'id'   => 'rest_api',
				'name' => __( 'REST API', 'kk_writer_theme' ),
				'type' => 'title',
			)
		);
		$advanced_options->add_field(
			array(
				'id'      => 'rest_api_enabled',
				'name'    => __( 'Enable the REST API', 'kk_writer_theme' ),
				'desc'    => __( 'Some plugin require the REST API to be enabled.', 'kk_writer_theme' ),
				'type'    => 'radio_inline',
				'default' => 'false',
				'options' => array(
						'true'  => __( 'Yes', 'kk_writer_theme' ),
						'false' => __( 'No', 'kk_writer_theme' ),
				),
			)
		);

		$advanced_options->add_field(
			array(
				'id'   => 'xmlrpc_api',
				'name' => __( 'XMLRPC API', 'kk_writer_theme' ),
				'type' => 'title',
			)
		);
		$advanced_options->add_field(
			array(
				'id'      => 'xmlrpc_api_enabled',
				'name'    => __( 'Enable the XMLRPC API', 'kk_writer_theme' ),
				'desc'    => __( 'Preferably, it should be disabled.', 'kk_writer_theme' ),
				'type'    => 'radio_inline',
				'default' => 'false',
				'options' => array(
						'true'  => __( 'Yes', 'kk_writer_theme' ),
						'false' => __( 'No', 'kk_writer_theme' ),
				),
			)
		);


		$advanced_options->add_field(
			array(
				'id'   => 'seo_section',
				'name' => __( 'SEO', 'kk_writer_theme' ),
				'type' => 'title',
			)
		);
		$advanced_options->add_field(
			array(
				'id'      => 'seo_internal_management_enabled',
				'name'    => __( 'Enable internal SEO management', 'kk_writer_theme' ),
				'desc'    => __( 'Enable the internal management of SEO and OG tags or disable it to delegate this job to an external plugin.', 'kk_writer_theme' ),
				'type'    => 'radio_inline',
				'default' => 'true',
				'options' => array(
						'true'  => __( 'Yes', 'kk_writer_theme' ),
						'false' => __( 'No', 'kk_writer_theme' ),
				),
			)
		);
	}

}
