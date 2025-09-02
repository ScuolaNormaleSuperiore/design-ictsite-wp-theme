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
		add_action( 'cmb2_admin_init', array( $this, 'advanced_options' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'setup_option_assets' ) );
	}

	public function setup_option_assets() {
		$current_screen = get_current_screen();
		if ( strpos( $current_screen->id, 'dis_opt' ) !== false ) {
				wp_enqueue_style( 'dis_options_dialog', DIS_THEME_URL . '/admin/css/jquery-ui.css' );
				// Hiding the submenu in the WordPress adminmenu.
				wp_enqueue_script( 'dis_options_dialog', DIS_THEME_URL . '/admin/js/options.js', array( 'jquery', 'jquery-ui-core', 'jquery-ui-dialog' ), '1.0', true );
		}
	}

	public function advanced_options() {
		// 1 - Registers options page "Base options".
		$this->add_opt_base_option( $this->parent_slug, $this->tab_group, $this->capability );
		// 2 - Registers options page "Site alerts".
		$this->add_opt_site_alerts( 'dis_opt_site_alerts', $this->tab_group, $this->capability );
		// 3 - Registers options page "Home Page Sections".
		$this->add_opt_hp_sections( 'dis_opt_hp_sections', $this->tab_group, $this->capability );
		// 4 - Registers options page "Home Page Layout".
		$this->add_opt_hp_layout( 'dis_opt_hp_layout', $this->tab_group, $this->capability );
		// 5 - Registers options page "Main Hero".
		$this->add_opt_main_hero( 'dis_opt_main_hero', $this->tab_group, $this->capability );
		// 6 - Registers options page "Site Contacts".
		$this->add_opt_site_contacts( 'dis_opt_site_contacts', $this->tab_group, $this->capability );
		// 7- Registers options page "Social media".
		$this->add_opt_social_media( 'dis_opt_social_media', $this->tab_group, $this->capability );
		// 8 - Registers options page "Newsletter settings".
		$this->add_opt_newsletter_settings( 'dis_opt_newsletter_settings', $this->tab_group, $this->capability );
		// 9 - Registers options page "Advanced settings".
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
			'position'     => 2, // Menu position. Only applicable if 'parent_slug' is left empty.
			'icon_url'     => 'dashicons-admin-tools', // Menu icon. Only applicable if 'parent_slug' is left empty.
		);
		// 'tab_group' property is supported in > 2.4.0.
		if ( version_compare( CMB2_VERSION, '2.4.0' ) ) {
			$args['display_cb'] = array( $this, 'options_display_with_tabs' );
		}
		$base_options = new_cmb2_box( $args );

		$base_options->add_field(
			array(
				'id'   => 'baseoptions_info',
				'name' => __( 'Site configurations', 'design_ict_site' ),
				'desc' => __( 'Section to configure base options.', 'design_ict_site' ),
				'type' => 'title',
			)
		);
		$base_options->add_field(
			array(
				'id'         => 'site_title',
				'name'       => __( 'Site title', 'design_ict_site' ) . '&nbsp;*',
				'desc'       => __( 'The title of the site.', 'design_ict_site' ),
				'type'       => 'text',
				'attributes' => array(
					'required' => 'required',
				),
			)
		);
		$base_options->add_field(
			array(
				'id'   => 'site_tagline',
				'name' => __( 'Tagline', 'design_ict_site' ),
				'desc' => __( 'The tagline of the site.', 'design_ict_site' ),
				'type' => 'text',
			)
		);
		$base_options->add_field(
			array(
				'id'   => 'site_network_name',
				'name' => __( 'Network name', 'design_ict_site' ),
				'desc' => __( 'The name of the network the site is part of.', 'design_ict_site' ),
				'type' => 'text',
			)
		);
		$base_options->add_field(
			array(
				'id'   => 'site_network_url',
				'name' => __( 'Network url', 'design_ict_site' ),
				'desc' => __( 'The url of the network the site is part of.', 'design_ict_site' ),
				'type' => 'text',
			)
		);
		$base_options->add_field(
			array(
				'id'      => 'header_logo_visible',
				'name'    => __( 'Header logo visible', 'design_ict_site' ),
				'desc'    => __( 'Yes if the logo needs to be shown in the header.', 'design_ict_site' ),
				'type'    => 'radio_inline',
				'default' => 'false',
				'options' => array(
					'true'  => __( 'Yes', 'design_ict_site' ),
					'false' => __( 'No', 'design_ict_site' ),
				),
			)
		);
		$base_options->add_field(
			array(
				'id'         => 'site_logo',
				'name'       => __( 'Logo header', 'design_ict_site' ),
				'desc'       => __( 'The logo of the site, please load an SVG image.', 'design_ict_site' ),
				'type'       => 'file',
				'query_args' => array(
					'type' => array( 'image', ),
				),
			)
		);
		$base_options->add_field(
			array(
				'id'      => 'footer_logo_visible',
				'name'    => __( 'Footer logo visible', 'design_ict_site' ),
				'desc'    => __( 'Yes if the logo needs to be shown in the footer.', 'design_ict_site' ),
				'type'    => 'radio_inline',
				'default' => 'false',
				'options' => array(
					'true'  => __( 'Yes', 'design_ict_site' ),
					'false' => __( 'No', 'design_ict_site' ),
				),
			)
		);
		$base_options->add_field(
			array(
				'id'         => 'footer_logo',
				'name'       => __( 'Logo footer', 'design_ict_site' ),
				'desc'       => __( 'Choose the the footer logo. If it is not present, but the display of the logo in the footer is enabled, the header logo is shown with inverted colors. It is recommended to upload an image in SVG format.', 'design_ict_site' ),
				'type'       => 'file',
				'query_args' => array(
					'type' => array( 'image', ),
				),
			)
		);
		return $result;
	}

	/**
	 * 2 - Registers options page "Advanced settings".
	 *
	 * @return boolean
	 */
	public function add_opt_site_alerts( $option_key, $tab_group, $capability ) {
		$args = array(
			'id'           => $option_key . '_id',
			'title'        => esc_html__( 'HP alerts', 'design_ict_site' ),
			'object_types' => array( 'options-page' ),
			'option_key'   => $option_key,
			'tab_title'    => __( 'HP alerts', 'design_ict_site' ),
			'parent_slug'  => $this->parent_slug,
			'tab_group'    => $tab_group,
			'capability'   => $capability,
		);
		// 'tab_group' property is supported in > 2.4.0.
		if ( version_compare( CMB2_VERSION, '2.4.0' ) ) {
			$args['display_cb'] = array( $this, 'options_display_with_tabs' );
		}

		$alerts_options = new_cmb2_box( $args );
		$alerts_options->add_field(
			array(
				'id'   => 'alerts_instructions',
				'name' => __( 'Home Page alerts', 'design_ict_site' ),
				'desc' => __( 'Enter messages that will be displayed on the homepage', 'design_ict_site' ) . '.',
				'type' => 'title',
			)
		);
		$alerts_group_id = $alerts_options->add_field(
			array(
				'id'          => 'messages',
				'type'        => 'group',
				'desc'        => __( 'Each message is built through a short description (max 300 characters) and expiration date (optional) translated into all languages supported by the site', 'design_ict_site' )   . '.',
				'repeatable'  => true,
				'options'     => array(
					'group_title'    => __( 'Message', 'design_ict_site' ) . ' {#}',
					'add_button'     => __( 'Add a message', 'design_ict_site' ),
					'remove_button'  => __( 'Remove the message', 'design_ict_site' ),
					'sortable'       => true,
					'closed'         => true,
					'remove_confirm' => esc_html__( 'Are you sure you want to remove?', 'design_ict_site' ),
				),
			)
		);
		$alerts_options->add_group_field(
			$alerts_group_id,
			array(
				'name'    => 'Choose the color of the message',
				'id'      => 'message_color',
				'type'    => 'radio_inline',
				'options' => array(
					'danger'  => '<span class="radio-color red"></span>' . __( 'Danger', 'design_ict_site' ),
					'success' => '<span class="radio-color green"></span>' . __( 'Success', 'design_ict_site' ),
					'warning' => '<span class="radio-color brown"></span>' . __( 'Warning', 'design_ict_site' ),
					'info'    => '<span class="radio-color gray"></span>' . __( 'Info', 'design_ict_site' ),
				),
				'default' => 'info',
			)
		);
		$alerts_options->add_group_field(
			$alerts_group_id,
			array(
				'id'         => 'message_text',
				'name'       => __( 'Text', 'design_ict_site' ),
				'desc'       => __( 'Maximum 300 characters', 'design_ict_site' ),
				'type'       => 'textarea_small',
				'attributes' => array(
					'rows'      => 3,
					'maxlength' => '300',
				),
			)
		);
		$alerts_options->add_group_field(
			$alerts_group_id,
			array(
				'id'   => 'message_link',
				'name' => __( 'Link', 'design_ict_site' ),
				'desc' => __( 'Link to a more in-depth page, even external to the site', 'design_ict_site' ),
				'type' => 'text_url',
			)
		);

	}

	/**
	 * 3 - Registers options page "Home Page Sections".
	 *
	 * @return boolean
	 */
	public function add_opt_hp_sections( $option_key, $tab_group, $capability ) {
		$args = array(
			'id'           => $option_key . '_id',
			'title'        => esc_html__( 'HP Sections', 'design_ict_site' ),
			'object_types' => array( 'options-page' ),
			'option_key'   => $option_key,
			'capability'   => $capability,
			'parent_slug'  => $this->parent_slug,
			'tab_group'    => $tab_group,
			'tab_title'    => __( 'HP sections', 'design_ict_site' ),
		);
		// 'tab_group' property is supported in > 2.4.0.
		if ( version_compare( CMB2_VERSION, '2.4.0' ) ) {
				$args['display_cb'] = array( $this, 'options_display_with_tabs' );
		}
		$section_options = new_cmb2_box( $args );

		$section_options->add_field(
			array(
				'id'   => 'sectionoptions_info',
				'name' => __( 'Home Page sections', 'design_ict_site' ),
				'desc' => __( 'Configure the sections of the site.', 'design_ict_site' ),
				'type' => 'title',
			)
		);
		$section_group_id = $section_options->add_field(
			array(
				'id'          => 'site_sections',
				'type'        => 'group',
				'desc'        => __( 'Choose the site sections', 'design_ict_site' ) . '.',
				'repeatable'  => true,
				'options'     => array(
					'group_title'    => __( 'Section', 'design_ict_site' ) . ' {#}',
					'add_button'     => __( 'Add the section', 'design_ict_site' ),
					'remove_button'  => __( 'Remove the section', 'design_ict_site' ),
					'sortable'       => true,
					'closed'         => true,
					'remove_confirm' => esc_html__( 'Are you sure you want to remove?', 'design_ict_site' ),
				),
			)
		);
		$section_options->add_group_field(
			$section_group_id,
			array(
				'id'               => 'id',
				'name'             => __( 'Section', 'design_ict_site' ),
				'desc'             => __( 'Choose the section.', 'design_ict_site' ),
				'type'             => 'select',
				'default'          => 'never',
				'show_option_none' => false,
				'options'          => DIS_ContentsManager::get_hp_section_list(),
			)
		);
		$section_options->add_group_field(
			$section_group_id,
			array(
				'id'      => 'enabled',
				'name'    => __( 'Enable this section', 'design_ict_site' ),
				'desc'    => __( 'If yes, the section is shown in the Home Page.', 'design_ict_site' ),
				'type'    => 'radio_inline',
				'default' => 'true',
				'options' => array(
					'true'  => __( 'Yes', 'design_ict_site' ),
					'false' => __( 'No', 'design_ict_site' ),
				),
			)
		);
		$section_options->add_group_field(
			$section_group_id,
			array(
				'id'      => 'show_title',
				'name'    => __( 'Show the section title', 'design_ict_site' ),
				'desc'    => __( 'If yes, the title of the section is shown.', 'design_ict_site' ),
				'type'    => 'radio_inline',
				'default' => 'true',
				'options' => array(
					'true'  => __( 'Yes', 'design_ict_site' ),
					'false' => __( 'No', 'design_ict_site' ),
				),
			)
		);
	}

	/**
	 * 4 - Registers options page "Home Page Layout".
	 *
	 * @return boolean
	 */
	public function add_opt_hp_layout( $option_key, $tab_group, $capability ) {
		$args = array(
			'id'           => $option_key . '_id',
			'title'        => esc_html__( 'HP Layout', 'design_ict_site' ),
			'object_types' => array( 'options-page' ),
			'option_key'   => $option_key,
			'capability'   => $capability,
			'parent_slug'  => $this->parent_slug,
			'tab_group'    => $tab_group,
			'tab_title'    => __( 'HP layout', 'design_ict_site' ),
		);
		// 'tab_group' property is supported in > 2.4.0.
		if ( version_compare( CMB2_VERSION, '2.4.0' ) ) {
				$args['display_cb'] = array( $this, 'options_display_with_tabs' );
		}
		$home_options = new_cmb2_box( $args );

		// HP HERO SECTION options.
		$home_options->add_field(
			array(
				'id'   => 'hp_layout_settings',
				'name' => __( 'Home Page layout', 'design_ict_site' ),
				'desc' => __( 'Home Page layout settings.', 'design_ict_site' ),
				'type' => 'title',
			)
		);

		$home_options->add_field(
			array(
				'id'   => 'home_page_video',
				'name' => __( 'Home Page Video', 'design_ict_site' ),
				'type' => 'title',
			)
		);
		$home_options->add_field(
			array(
				'id'   => 'home_page_video_url',
				'name' => 'Home Page Video URL',
				'desc' => __( 'The URL of the video to show in Home Page', 'design_ict_site' ),
				'type' => 'text_url',
			)
		);
		// AUTOCOMPLETE options.
		$home_options->add_field(
			array(
				'id'   => 'autocomplete_sections',
				'name' => __( 'Autocomplete sections', 'design_ict_site' ),
				'type' => 'title',
			)
		);
		$home_options->add_field(
			array(
				'id'      => 'home_search_autocomplete_enabled',
				'name'    => __( 'Enable Home Page autocomplete', 'design_ict_site' ),
				'desc'    => __( 'Enable the autocomplete in the main hero of the Home Page', 'design_ict_site' ),
				'type'    => 'radio_inline',
				'default' => 'false',
				'options' => array(
					'true'  => __( 'Yes', 'design_ict_site' ),
					'false' => __( 'No', 'design_ict_site' ),
				),
			)
		);
		$home_options->add_field(
			array(
				'id'      => 'site_search_autocomplete_enabled',
				'name'    => __( 'Enable site search autocomplete', 'design_ict_site' ),
				'desc'    => __( 'Enable the autocomplete in the site search page', 'design_ict_site' ),
				'type'    => 'radio_inline',
				'default' => 'false',
				'options' => array(
					'true'  => __( 'Yes', 'design_ict_site' ),
					'false' => __( 'No', 'design_ict_site' ),
				),
			)
		);
		$home_options->add_field(
			array(
				'id'      => 'faq_autocomplete_enabled',
				'name'    => __( 'Enable site FAQ autocomplete', 'design_ict_site' ),
				'desc'    => __( 'Enable the autocomplete in the FAQ page', 'design_ict_site' ),
				'type'    => 'radio_inline',
				'default' => 'false',
				'options' => array(
					'true'  => __( 'Yes', 'design_ict_site' ),
					'false' => __( 'No', 'design_ict_site' ),
				),
			)
		);
	}

	/**
	 * 5 - Registers options page "Home Page Layout".
	 *
	 * @return boolean
	 */
	public function add_opt_main_hero( $option_key, $tab_group, $capability ) {
		$args = array(
			'id'           => $option_key . '_id',
			'title'        => esc_html__( 'Main hero', 'design_ict_site' ),
			'object_types' => array( 'options-page' ),
			'option_key'   => $option_key,
			'capability'   => $capability,
			'parent_slug'  => $this->parent_slug,
			'tab_group'    => $tab_group,
			'tab_title'    => __( 'Main hero', 'design_ict_site' ),
		);
		// 'tab_group' property is supported in > 2.4.0.
		if ( version_compare( CMB2_VERSION, '2.4.0' ) ) {
				$args['display_cb'] = array( $this, 'options_display_with_tabs' );
		}
		$main_hero_options = new_cmb2_box( $args );

		// HP HERO SECTION options.
		$main_hero_options->add_field(
			array(
				'id'   => 'home_main_hero',
				'name' => __( 'Main hero', 'design_ict_site' ),
				'desc' => __( 'The hero section of the Home Page.', 'design_ict_site' ),
				'type' => 'title',
			)
		);
		$main_hero_options->add_field(
			array(
				'id'         => 'main_hero_title',
				'name'       => __( 'Title', 'design_ict_site' ),
				'desc'       => __( 'To translate the text refers to the domain DIS_SiteOptionLabel.', 'design_ict_site' ),
				'type'       => 'text',
				'default'    => 'MainHeroTitle',
				'attributes' => array( 'disabled' => true ),
			)
		);
		$main_hero_options->add_field(
			array(
				'id'         => 'main_hero_text',
				'name'       => __( 'Text', 'design_ict_site' ),
				'desc'       => __( 'To translate the text refers to the domain DIS_SiteOptionLabel.', 'design_ict_site' ),
				'type'       => 'text',
				'default'    => 'MainHeroText',
				'attributes' => array( 'disabled' => true ),
			)
		);
		$main_hero_options->add_field(
			array(
				'id'         => 'main_hero_search_button_label',
				'name'       => __( 'Search button label', 'design_ict_site' ),
				'desc'       => __( 'To translate the text refers to the domain DIS_SiteOptionLabel.', 'design_ict_site' ),
				'default'    => 'MainHeroSearchButtonLabel',
				'attributes' => array( 'disabled' => true ),
				'type'       => 'text',
			)
		);
		$main_hero_options->add_field(
			array(
				'id'         => 'main_hero_left_button_label',
				'name'       => __( 'Left button label', 'design_ict_site' ),
				'desc'       => __( 'To translate the text refers to the domain DIS_SiteOptionLabel.', 'design_ict_site' ),
				'default'    => 'MainHeroLeftButtonLabel',
				'attributes' => array( 'disabled' => true ),
				'type'       => 'text',
			)
		);
		$main_hero_options->add_field(
			array(
				'id'         => 'main_hero_right_button_label',
				'name'       => __( 'Right button label', 'design_ict_site' ),
				'desc'       => __( 'To translate the text refers to the domain DIS_SiteOptionLabel.', 'design_ict_site' ),
				'default'    => 'MainHeroRightButtonLabel',
				'attributes' => array( 'disabled' => true ),
				'type'       => 'text',
			)
		);
		$main_hero_options->add_field(
			array(
				'id'         => 'main_hero_image',
				'name'       => __( 'Background image', 'design_ict_site' ),
				'desc'       => __( 'Image in png or jpg format.', 'design_ict_site' ),
				'type'       => 'file',
				'query_args' => array(
					'type' => array(
						'image/png',
						'image/jpg',
						'image/jpeg',
					),
				),
			)
		);
	}

	/**
	 * 6 - Registers options page "Site Contacts".
	 *
	 * @return boolean
	 */
	public function add_opt_site_contacts( $option_key, $tab_group, $capability ) {
		$args = array(
			'id'           => $option_key . '_id',
			'title'        => esc_html__( 'Site contacts', 'design_ict_site' ),
			'object_types' => array( 'options-page' ),
			'option_key'   => $option_key,
			'capability'   => $capability,
			'parent_slug'  => $this->parent_slug,
			'tab_group'    => $tab_group,
			'tab_title'    => __( 'Site contacts', 'design_ict_site' ),
		);
		// 'tab_group' property is supported in > 2.4.0.
		if ( version_compare( CMB2_VERSION, '2.4.0' ) ) {
				$args['display_cb'] = array( $this, 'options_display_with_tabs' );
		}
		$contacts_options = new_cmb2_box( $args );
		$contacts_options->add_field(
			array(
				'id'   => 'social_info',
				'name' => __( 'Site contacts', 'design_ict_site' ),
				'desc' => __( 'The contact shown in the footer.', 'design_ict_site' ),
				'type' => 'title',
			)
		);
		$contacts_options->add_field(
			array(
				'id'   => 'site_city',
				'name' => __( 'City', 'design_ict_site' ),
				'desc' => __( 'The city of the site.', 'design_ict_site' ),
				'type' => 'text',
			)
		);
		$contacts_options->add_field(
			array(
				'id'   => 'site_address',
				'name' => __( 'Address', 'design_ict_site' ),
				'desc' => __( 'The address of the site.', 'design_ict_site' ),
				'type' => 'text',
			)
		);
		$contacts_options->add_field(
			array(
				'id'   => 'site_email',
				'name' => __( 'E-mail', 'design_ict_site' ),
				'desc' => __( 'The e-mail of the site.', 'design_ict_site' ),
				'type' => 'text',
			)
		);
		$contacts_options->add_field(
			array(
				'id'   => 'site_telephone',
				'name' => __( 'Phone number', 'design_ict_site' ),
				'desc' => __( 'The phone number of the site.', 'design_ict_site' ),
				'type' => 'text',
			)
		);
		$contacts_options->add_field(
			array(
				'id'   => 'smtp',
				'name' => __( 'SMTP', 'design_ict_site' ),
				'type' => 'title',
			)
		);
		$contacts_options->add_field(
			array(
				'id'   => 'smtp_sender_name',
				'name' => __( 'SMTP sender name', 'design_ict_site' ),
				'desc' => __( 'The name that must appear on the e-mails sent by the site.', 'design_ict_site' ),
				'type' => 'text',
			)
		);
		$contacts_options->add_field(
			array(
				'id'   => 'smtp_sender_email',
				'name' => __( 'SMTP sender email', 'design_ict_site' ),
				'desc' => __( 'The provider e-mail that must be used as sender.', 'design_ict_site' ),
				'type' => 'text',
			)
		);

	}

	/**
	 * 7 - Registers options page "Social media".
	 *
	 * @return boolean
	 */
	public function add_opt_social_media( $option_key, $tab_group, $capability ) {
		$args = array(
			'id'           => $option_key . '_id',
			'title'        => esc_html__( 'Social media', 'design_ict_site' ),
			'object_types' => array( 'options-page' ),
			'option_key'   => $option_key,
			'capability'   => $capability,
			'parent_slug'  => $this->parent_slug,
			'tab_group'    => $tab_group,
			'tab_title'    => __( 'Social media', 'design_ict_site' ),
		);
		// 'tab_group' property is supported in > 2.4.0.
		if ( version_compare( CMB2_VERSION, '2.4.0' ) ) {
				$args['display_cb'] = array( $this, 'options_display_with_tabs' );
		}
		$social_options = new_cmb2_box( $args );

		$social_options->add_field(
			array(
				'id'   => 'social_info',
				'name' => __( 'Social media', 'design_ict_site' ),
				'desc' => __( 'Insert here the links to your social media.', 'design_ict_site' ),
				'type' => 'title',
			)
		);
		$social_options->add_field(
			array(
				'id'      => 'show_socials',
				'name'    => __( 'Show social media icons', 'design_ict_site' ),
				'desc'    => __( 'Enable the display of social media in the header and footer of the page.', 'design_ict_site' ),
				'type'    => 'radio_inline',
				'default' => 'false',
				'options' => array(
					'true'  => __( 'Yes', 'design_ict_site' ),
					'false' => __( 'No', 'design_ict_site' ),
				),
				'attributes' => array(
					'data-conditional-value' => 'false',
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
				'name' => 'Twitter-X',
				'type' => 'text_url',
			)
		);
		$social_options->add_field(
			array(
				'id'   => 'bluesky',
				'name' => 'Blue Sky',
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
				'id'   => 'tiktok',
				'name' => 'TikTok',
				'type' => 'text_url',
			)
		);
		$social_options->add_field(
			array(
				'id'   => 'snapchat',
				'name' => 'Snapchat',
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
	 * 8 - Registers options page "Newsletter settings".
	 *
	 * @return boolean
	 */
	public function add_opt_newsletter_settings( $option_key, $tab_group, $capability ) {
		$args = array(
			'id'           => $option_key . '_id',
			'title'        => esc_html__( 'Newsletter options', 'design_ict_site' ),
			'object_types' => array( 'options-page' ),
			'option_key'   => $option_key,
			'tab_title'    => __( 'Newsletter options', 'design_ict_site' ),
			'parent_slug'  => $this->parent_slug,
			'tab_group'    => $tab_group,
			'capability'   => $capability,
		);
		// 'tab_group' property is supported in > 2.4.0.
		if ( version_compare( CMB2_VERSION, '2.4.0' ) ) {
			$args['display_cb'] = array( $this, 'options_display_with_tabs' );
		}
		$newsletter_options = new_cmb2_box( $args );

		$newsletter_options->add_field(
			array(
				'id'   => 'newsletter',
				'name' => __( 'Newsletter', 'design_ict_site' ),
				'type' => 'title',
			)
		);
		$newsletter_options->add_field(
			array(
				'id'      => 'newsletter_enabled',
				'name'    => __( 'Enable the newsletter', 'design_ict_site' ),
				'type'    => 'radio_inline',
				'default' => 'false',
				'options' => array(
					'true'  => __( 'Yes', 'design_ict_site' ),
					'false' => __( 'No', 'design_ict_site' ),
				),
			)
		);
		$newsletter_options->add_field(
			array(
				'id'               => 'newsletter_manager',
				'name'             => __( 'Newsletter manager', 'design_ict_site' ),
				'desc'             => __( 'Selection of the program used to manage the site newsletter', 'design_ict_site' ),
				'type'             => 'select',
				'default'          => 'default',
				'show_option_none' => false,
				'options'          => array(
					'brevo' => __( 'Brevo', 'design_ict_site' ),
				),
			)
		);
		$newsletter_options->add_field(
			array(
				'id'         => 'newsletter_api_token',
				'name'       => __( 'API token', 'design_ict_site' ),
				'type'       => 'text',
				'attributes' => array(
					'type' => 'password',
				),
			)
		);
		$newsletter_options->add_field(
			array(
				'id'         => 'newsletter_list_id',
				'name'       => __( 'List ID', 'design_ict_site' ),
				'desc'       => __( 'ID of the list associated with the site', 'design_ict_site' ),
				'type'       => 'text_small',
				'attributes' => array(
					'type'    => 'number',
					'pattern' => '\d*',
				),
				'sanitization_cb' => 'absint',
				'escape_cb'       => 'absint',
			)
		);
		$newsletter_options->add_field(
			array(
				'id'         => 'newsletter_template_id',
				'name'       => __( 'Template ID', 'design_ict_site' ),
				'desc'       => __( 'ID of the page template that handles the double OptIn', 'design_ict_site' ),
				'type'       => 'text_small',
				'attributes' => array(
					'type'    => 'number',
					'pattern' => '\d*',
				),
				'sanitization_cb' => 'absint',
				'escape_cb'       => 'absint',
			)
		);
	}

	/**
	 * 9 - Registers options page "Advanced settings".
	 *
	 * @return boolean
	 */
	public function add_opt_advanced_settings( $option_key, $tab_group, $capability ) {
		$args = array(
			'id'           => $option_key . '_id',
			'title'        => esc_html__( 'Advanced options', 'design_ict_site' ),
			'object_types' => array( 'options-page' ),
			'option_key'   => $option_key,
			'tab_title'    => __( 'Advanced options', 'design_ict_site' ),
			'parent_slug'  => $this->parent_slug,
			'tab_group'    => $tab_group,
			'capability'   => $capability,
		);
		// 'tab_group' property is supported in > 2.4.0.
		if ( version_compare( CMB2_VERSION, '2.4.0' ) ) {
			$args['display_cb'] = array( $this, 'options_display_with_tabs' );
		}
		$advanced_options = new_cmb2_box( $args );

		$advanced_options->add_field(
			array(
					'id'   => 'advanced_info',
					'name' => __( 'Advanced options', 'design_ict_site' ),
					'desc' => __( 'Section to configure advanced settings.', 'design_ict_site' ),
					'type' => 'title',
			)
		);

		$advanced_options->add_field(
			array(
				'id'   => 'login',
				'name' => __( 'Login', 'design_ict_site' ),
				'type' => 'title',
			)
		);
		$advanced_options->add_field(
			array(
				'id'      => 'login_button_visible',
				'name'    => __( 'Login visible', 'design_ict_site' ),
				'type'    => 'radio_inline',
				'default' => 'true',
				'options' => array(
					'true'  => __( 'Yes', 'design_ict_site' ),
					'false' => __( 'No', 'design_ict_site' ),
				),
			)
		);

		$advanced_options->add_field(
			array(
				'id'   => 'multilingua',
				'name' => __( 'Multilanguage', 'design_ict_site' ),
				'type' => 'title',
			)
		);
		$advanced_options->add_field(
			array(
				'id'      => 'language_selector_visible',
				'name'    => __( 'Enable language selector', 'design_ict_site' ),
				'type'    => 'radio_inline',
				'default' => 'true',
				'options' => array(
					'true'  => __( 'Yes', 'design_ict_site' ),
					'false' => __( 'No', 'design_ict_site' ),
				),
			)
		);

		$advanced_options->add_field(
			array(
				'id'   => 'analytics',
				'name' => __( 'Web Analytics Code', 'design_ict_site' ),
				'type' => 'title',
			)
		);
		$advanced_options->add_field(
			array(
				'id'   => 'analytics_code',
				'name' => 'Code',
				'desc' => __( 'Enter the analytics code.', 'design_ict_site' ),
				'type' => 'textarea_code',
				'attributes'    => array(
					'rows'       => 10,
					'maxlength'  => '1000',
				),
			)
		);
		$advanced_options->add_field(
			array(
				'id'   => 'rest_api',
				'name' => __( 'REST API', 'design_ict_site' ),
				'type' => 'title',
			)
		);
		$advanced_options->add_field(
			array(
				'id'      => 'rest_api_enabled',
				'name'    => __( 'Enable the REST API', 'design_ict_site' ),
				'desc'    => __( 'Some plugin require the REST API to be enabled.', 'design_ict_site' ),
				'type'    => 'radio_inline',
				'default' => 'false',
				'options' => array(
					'true'  => __( 'Yes', 'design_ict_site' ),
					'false' => __( 'No', 'design_ict_site' ),
				),
			)
		);
		$advanced_options->add_field(
			array(
				'id'   => 'xmlrpc_api',
				'name' => __( 'XMLRPC API', 'design_ict_site' ),
				'type' => 'title',
			)
		);
		$advanced_options->add_field(
			array(
				'id'      => 'xmlrpc_api_enabled',
				'name'    => __( 'Enable the XMLRPC API', 'design_ict_site' ),
				'desc'    => __( 'Preferably, it should be disabled.', 'design_ict_site' ),
				'type'    => 'radio_inline',
				'default' => 'false',
				'options' => array(
					'true'  => __( 'Yes', 'design_ict_site' ),
					'false' => __( 'No', 'design_ict_site' ),
				),
			)
		);
		$advanced_options->add_field(
			array(
				'id'   => 'seo_section',
				'name' => __( 'SEO', 'design_ict_site' ),
				'type' => 'title',
			)
		);
		$advanced_options->add_field(
			array(
				'id'      => 'seo_internal_management_enabled',
				'name'    => __( 'Enable internal SEO management', 'design_ict_site' ),
				'desc'    => __( 'Enable the internal management of SEO and OG tags or disable it to delegate this job to an external plugin.', 'design_ict_site' ),
				'type'    => 'radio_inline',
				'default' => 'true',
				'options' => array(
					'true'  => __( 'Yes', 'design_ict_site' ),
					'false' => __( 'No', 'design_ict_site' ),
				),
			)
		);

		$advanced_options->add_field(
		array(
				'id'   => 'page_counter',
				'name' => __( 'Page counters', 'design_ict_site' ),
				'type' => 'title',
			)
		);
		$advanced_options->add_field(
			array(
				'id'      => 'ignore_robots',
				'name'    => __( 'Ignore robots', 'design_ict_site' ),
				'desc'    => __( 'Do not count the views of the robots.', 'design_ict_site' ),
				'type'    => 'radio_inline',
				'default' => 'false',
				'options' => array(
					'true'  => __( 'Yes', 'design_ict_site' ),
					'false' => __( 'No', 'design_ict_site' ),
				),
			)
		);
		$advanced_options->add_field(
			array(
				'id'      => 'service_page_counter_enabled',
				'name'    => __( 'Service views counter', 'design_ict_site' ),
				'desc'    => __( 'Enable the counter of the views of the service detail page.', 'design_ict_site' ),
				'type'    => 'radio_inline',
				'default' => 'false',
				'options' => array(
					'true'  => __( 'Yes', 'design_ict_site' ),
					'false' => __( 'No', 'design_ict_site' ),
				),
			)
		);
		$advanced_options->add_field(
			array(
				'id'      => 'faq_page_counter_enabled',
				'name'    => __( 'FAQ views counter', 'design_ict_site' ),
				'desc'    => __( 'Enable the counter of the views of the FAQ detail page.', 'design_ict_site' ),
				'type'    => 'radio_inline',
				'default' => 'false',
				'options' => array(
					'true'  => __( 'Yes', 'design_ict_site' ),
					'false' => __( 'No', 'design_ict_site' ),
				),
			)
		);

	}


	/**
	* A CMB2 options-page display callback override which adds tab navigation among
	* CMB2 options pages which share this same display callback.
	* Used to put the configuration menu on the left.
	*
	* @param CMB2_Options_Hookup $cmb_options The CMB2_Options_Hookup object.
	*/
	public function options_display_with_tabs( $cmb_options ) {
		$tabs = self::options_page_tabs( $cmb_options );
		?>
		<div class="wrap cmb2-options-page option-<?php echo $cmb_options->option_key; ?>">
			<?php if ( get_admin_page_title() ) : ?>
				<h2><?php echo wp_kses_post( get_admin_page_title() ); ?></h2>
			<?php endif; ?>
				<div class="cmb2-options-box">
					<div class="nav-tab-wrapper">
						<?php foreach ( $tabs as $option_key => $tab_title ) : ?>
							<a class="nav-tab<?php if ( isset( $_GET['page'] ) && $option_key === $_GET['page'] ) : ?> nav-tab-active<?php endif; ?>" href="<?php menu_page_url( $option_key ); ?>"><?php echo wp_kses_post( $tab_title ); ?></a>
						<?php endforeach; ?>
					</div>
					<form class="cmb-form" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="POST" id="<?php echo $cmb_options->cmb->cmb_id; ?>" enctype="multipart/form-data" encoding="multipart/form-data">
						<fieldset class="form-content">
							<input type="hidden" name="action" value="<?php echo esc_attr( $cmb_options->option_key ); ?>">
							<?php $cmb_options->options_page_metabox(); ?>
						</fieldset>
						<fieldset class="form-footer">
								<div class="submit-box"><?php submit_button( esc_attr( $cmb_options->cmb->prop( 'save_button' ) ), 'primary', 'submit-cmb', false ); ?></div>
						</fieldset>
					</form>
					<div class="clear-form"></div>
				</div>
		</div>
		<?php
	}

	/**
	* Gets navigation tabs array for CMB2 options pages which share the given
	* display_cb param.
	* Used to put the configuration menu on the left.
	*
	* @param CMB2_Options_Hookup $cmb_options The CMB2_Options_Hookup object.
	*
	* @return array Array of tab information.
	*/
	private function options_page_tabs( $cmb_options ) {
		$tab_group = $cmb_options->cmb->prop( 'tab_group' );
		$tabs      = array();
		foreach ( CMB2_Boxes::get_all() as $cmb_id => $cmb ) {
			if ( $tab_group === $cmb->prop( 'tab_group' ) ) {
				$tabs[ $cmb->options_page_keys()[0] ] = $cmb->prop( 'tab_title' )
					? $cmb->prop( 'tab_title' )
					: $cmb->prop( 'title' );
			}
		}
		return $tabs;
	}

	/**
	 * Wrapper function around cmb2_get_option
	 * @since  0.1.0
	 * @param  string $key     Options array key
	 * @param  mixed  $default Optional default value
	 * @return mixed           Option value
	 */
	public static function dis_get_option( $key, $option_key, $default = false ) {
		if ( function_exists( 'cmb2_get_option' ) ) {
			// Use cmb2_get_option as it passes through some key filters.
			return cmb2_get_option( $option_key, $key, $default );
		}
		// Fallback to get_option if CMB2 is not loaded yet.
		$opts = get_option( $option_key, $default );
		$val = $default;
		if ( 'all' == $key ) {
			$val = $opts;
		} elseif ( is_array( $opts ) && array_key_exists( $key, $opts ) && false !== $opts[ $key ] ) {
			$val = $opts[ $key ];
		}
		return $val;
	}

}
