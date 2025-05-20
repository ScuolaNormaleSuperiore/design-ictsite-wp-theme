<?php
/**
 * Definition of the Office Manager.
 *
 * @package Design_ICT_Site
 */


class Office_Manager {
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
			'name'                  => _x( 'Offices', 'DIS_PostTypeLabels', 'design_ict_site' ),
			'singular_name'         => _x( 'Office', 'DIS_PostTypeSingularName', 'design_ict_site' ),
			'add_new'               => _x( 'Add an office ', 'DIS_PostTypeSingularName', 'design_ict_site' ),
			'add_new_item'          => _x( 'Add an office', 'DIS_PostTypeSingularName', 'design_ict_site' ),
			'edit_item'             => _x( 'Edit the office', 'DIS_PostTypeSingularName', 'design_ict_site' ),
			'view_item'             => _x( 'View the office', 'DIS_PostTypeSingularName', 'design_ict_site' ),
			'featured_image'        => __( 'Office image', 'design_ict_site' ),
			'set_featured_image'    => __( 'Choose office image' ),
			'remove_featured_image' => __( 'Remove office image' , 'design_ict_site' ),
			'use_featured_image'    => __( 'Use as office image' , 'design_ict_site' ),
		);

		$args   = array(
			'label'         => __( 'Office', 'design_ict_site' ),
			'labels'        => $labels,
			'supports'      => array( 'title', 'editor', 'thumbnail' ),
			'hierarchical'  => false,
			'public'        => true,
			'show_in_menu'  => true,
			'menu_position' => 6,
			'menu_icon'     => 'dashicons-building',
			'has_archive'   => false,
			'show_in_rest'  => true,
			'rewrite'       => array( 'slug' => 'offices' ),
			'taxonomies'    => array( DIS_DEFAULT_CATEGORY, DIS_DEFAULT_TAGS ),
		);

		register_post_type( DIS_OFFICE_POST_TYPE, $args );

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
		'key' => 'group_67dac7fdf0360',
		'title' => 'Office Fields',
		'fields' => array(
			array(
				'key' => 'field_67dac7fe78be2',
				'label' => 'Short name',
				'name' => 'short_name',
				'aria-label' => '',
				'type' => 'text',
				'instructions' => '',
				'required' => 1,
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
				'key' => 'field_67dac84b78be3',
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
				'key' => 'field_67dac86778be4',
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
				'allow_in_bindings' => 1,
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
			),
			array(
				'key' => 'field_67dacc2ed84a7',
				'label' => 'Places',
				'name' => 'places',
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
					0 => 'dis-place',
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
				'key' => 'field_67dad2896616f',
				'label' => 'Members',
				'name' => 'members',
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
					0 => 'dis-person',
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
				'key' => 'field_681875b9e092e',
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
		),
		'location' => array(
			array(
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'dis-office',
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
