<?php
/**
 * Definition of the Event Manager.
 *
 * @package Design_ICT_Site
 */


class Event_Manager {
	/**
	 * Constructor of the Manager.
	 */
	public function __construct() {}

	/**
	 * Install and configure the Course post type.
	 *
	 * @return void
	 */
	public function setup() {
		// Register the post type.
		add_action( 'init', array( $this, 'add_post_type' ) );
	}

	/**
	 * Register the post type.
	 *
	 * @return void
	 */
	public function add_post_type() {

		$labels = array(
			'name'          => dis_ct_data()[DIS_EVENT_POST_TYPE]['plural_name'],
			'singular_name' => dis_ct_data()[DIS_EVENT_POST_TYPE]['singular_name'],
			'add_new'       => __( 'Add an item', 'design_ict_site' ),
			'add_new_item'  => __( 'Add an item', 'design_ict_site' ),
			'edit_item'     => __( 'Edit the item', 'design_ict_site' ),
			'view_item'     => __( 'View the item', 'design_ict_site' ),
		);

		$args = array(
			'label'         => dis_ct_data()[DIS_EVENT_POST_TYPE]['singular_name'],
			'labels'        => $labels,
			'supports'      => array( 'title', 'editor', 'thumbnail' ),
			'hierarchical'  => false,
			'public'        => true,
			'show_in_menu'  => true,
			'menu_position' => 6,
			'menu_icon'     => 'dashicons-calendar',
			'has_archive'   => false,
			'show_in_rest'  => true,
			'rewrite'       => array( 'slug' => dis_ct_data()[DIS_EVENT_POST_TYPE]['slug'] ),
			'taxonomies'    => array( DIS_DEFAULT_CATEGORY, DIS_DEFAULT_TAGS ),
		);

		register_post_type( DIS_EVENT_POST_TYPE, $args );

		// Add the custom fields.
		$this->add_fields();
	}


	/**
	 * Add the custom fields of the custom post-type.
	 *
	 * @return void
	 */
	function add_fields() {

		if ( ! function_exists( 'acf_add_local_field_group' ) ) {
			return;
		}

		acf_add_local_field_group( array(
		'key' => 'group_67dd2497b30b1',
		'title' => 'Event Fields',
		'fields' => array(
			array(
				'key' => 'field_67dd249707c61',
				'label' => 'Short description',
				'name' => 'short_description',
				'aria-label' => '',
				'type' => 'textarea',
				'instructions' => '',
				'required' => false,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'new_lines' => '',
				'maxlength' => '',
				'placeholder' => '',
				'rows' => '',
			),
			array(
				'key' => 'field_67dd250307c62',
				'label' => 'Start date',
				'name' => 'start_date',
				'aria-label' => '',
				'type' => 'date_picker',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'display_format' => 'd/m/Y',
				'return_format' => 'd/m/Y',
				'first_day' => 1,
				'allow_in_bindings' => 0,
			),
			array(
				'key' => 'field_67dd258d07c64',
				'label' => 'Start hour',
				'name' => 'start_hour',
				'aria-label' => '',
				'type' => 'time_picker',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'display_format' => 'H:i',
				'return_format' => 'H:i',
				'allow_in_bindings' => 0,
			),
			array(
				'key' => 'field_67dd257707c63',
				'label' => 'End date',
				'name' => 'end_date',
				'aria-label' => '',
				'type' => 'date_picker',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'display_format' => 'd/m/Y',
				'return_format' => 'd/m/Y',
				'first_day' => 1,
				'allow_in_bindings' => 0,
			),
			array(
				'key' => 'field_67dd25e807c65',
				'label' => 'End hour',
				'name' => 'end_hour',
				'aria-label' => '',
				'type' => 'time_picker',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'display_format' => 'H:i',
				'return_format' => 'H:i',
				'allow_in_bindings' => 0,
			),
			array(
				'key' => 'field_67dd26e207c66',
				'label' => 'Email',
				'name' => 'email',
				'aria-label' => '',
				'type' => 'email',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'allow_in_bindings' => 0,
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
			),
			array(
				'key' => 'field_67dd26f007c67',
				'label' => 'Telephone',
				'name' => 'telephone',
				'aria-label' => '',
				'type' => 'text',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'maxlength' => '',
				'allow_in_bindings' => 0,
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
			),
			array(
				'center_lat' => 53.550640000000001,
				'center_lng' => 10.00065,
				'zoom' => 12,
				'height' => 400,
				'return_format' => 'leaflet',
				'allow_map_layers' => 1,
				'max_markers' => '',
				'layers' => array(
					0 => 'OpenStreetMap.Mapnik',
				),
				'key' => 'field_682c2dad7be11',
				'label' => 'GPS Position',
				'name' => 'gps_position',
				'aria-label' => '',
				'type' => 'open_street_map',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'allow_in_bindings' => 0,
				'leaflet_map' => '{"lat":53.550640000000001,"lng":10.00065,"zoom":12,"layers":["OpenStreetMap.Mapnik"],"markers":[]}',
			),
			array(
				'key' => 'field_67dd271307c69',
				'label' => 'Location',
				'name' => 'location',
				'aria-label' => '',
				'type' => 'text',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'maxlength' => '',
				'allow_in_bindings' => 0,
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
			),
			array(
				'key' => 'field_67dd270707c68',
				'label' => 'Website',
				'name' => 'website',
				'aria-label' => '',
				'type' => 'url',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'allow_in_bindings' => 0,
				'placeholder' => '',
			),
			array(
				'key' => 'field_67dd275f07c6b',
				'label' => 'Attachment 1',
				'name' => 'attachment_1',
				'aria-label' => '',
				'type' => 'file',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'return_format' => 'array',
				'library' => 'all',
				'min_size' => '',
				'max_size' => '',
				'mime_types' => '',
				'allow_in_bindings' => 0,
			),
			array(
				'key' => 'field_67dd2cba02589',
				'label' => 'Detail link',
				'name' => 'detail_link',
				'aria-label' => '',
				'type' => 'select',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'choices' => array(
					'detail_page' => 'Detail page',
					'attachment_1' => 'Attachment 1',
					'website' => 'Web site',
					'no_link' => 'No link',
				),
				'default_value' => false,
				'return_format' => 'value',
				'multiple' => 0,
				'allow_null' => 0,
				'allow_in_bindings' => 0,
				'ui' => 0,
				'ajax' => 0,
				'placeholder' => '',
				'create_options' => 0,
				'save_options' => 0,
			),
			array(
				'key' => 'field_67dd276f07c6c',
				'label' => 'Video',
				'name' => 'video',
				'aria-label' => '',
				'type' => 'url',
				'instructions' => '',
				'required' => false,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
			),
			array(
				'key' => 'field_67dd29ea07c6d',
				'label' => 'Show in carousel',
				'name' => 'show_in_carousel',
				'aria-label' => '',
				'type' => 'true_false',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'message' => '',
				'default_value' => 0,
				'allow_in_bindings' => 0,
				'ui' => 0,
				'ui_on_text' => '',
				'ui_off_text' => '',
			),
			array(
				'key' => 'field_67dd29fc07c6e',
				'label' => 'Show in Home Page',
				'name' => 'show_in_home_page',
				'aria-label' => '',
				'type' => 'true_false',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'message' => '',
				'default_value' => 0,
				'allow_in_bindings' => 0,
				'ui' => 0,
				'ui_on_text' => '',
				'ui_off_text' => '',
			),
			array(
				'key' => 'field_67dd2d9ac6514',
				'label' => 'Office',
				'name' => 'office',
				'aria-label' => '',
				'type' => 'relationship',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'post_type' => array(
					0 => 'dis-office',
				),
				'post_status' => '',
				'taxonomy' => '',
				'filters' => array(
					0 => 'search',
				),
				'return_format' => 'object',
				'min' => '',
				'max' => '',
				'allow_in_bindings' => 0,
				'elements' => '',
				'bidirectional' => 0,
				'bidirectional_target' => array(
				),
			),
			array(
				'key' => 'field_686f674707a24',
				'label' => 'Related items',
				'name' => 'related_items',
				'aria-label' => '',
				'type' => 'relationship',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'post_type' => array(
					0 => 'dis-news',
					1 => 'post',
					2 => 'page',
					3 => 'dis-event',
				),
				'post_status' => '',
				'taxonomy' => '',
				'filters' => array(
					0 => 'search',
				),
				'return_format' => 'object',
				'min' => '',
				'max' => '',
				'allow_in_bindings' => 0,
				'elements' => '',
				'bidirectional' => 0,
				'bidirectional_target' => array(
				),
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'dis-event',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => true,
		'description' => '',
		'show_in_rest' => 0,
		) );

	}

}
