<?php
/**
 * Definition of the Service Manager.
 *
 * @package Design_ICT_Site
 */


class Service_Manager {
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
			'name'                  => _x( 'Services', 'DIS_PostTypeGeneralName', 'design_ict_site' ),
			'singular_name'         => _x( 'Service', 'DIS_PostTypeSingularName', 'design_ict_site' ),
			'add_new'               => _x( 'Add a service', 'DIS_PostTypeSingularName', 'design_ict_site' ),
			'add_new_item'          => _x( 'Add a service', 'DIS_PostTypeSingularName', 'design_ict_site' ),
			'edit_item'             => _x( 'Edit the service', 'DIS_PostTypeSingularName', 'design_ict_site' ),
			'view_item'             => _x( 'View the service', 'DIS_PostTypeSingularName', 'design_ict_site' ),
			'featured_image'        => __( "Service image", 'design_ict_site' ),
			'set_featured_image'    => __( 'Choose service image' ),
			'remove_featured_image' => __( 'Remove service image' , 'design_ict_site' ),
			'use_featured_image'    => __( 'Use as service image' , 'design_ict_site' ),
		);

		$args   = array(
			'label'         => __( 'Service', 'design_ict_site' ),
			'labels'        => $labels,
			'supports'      => array( 'title', 'editor', 'thumbnail' ),
			'hierarchical'  => false,
			'public'        => true,
			'show_in_menu'  => true,
			'menu_position' => 6,
			'menu_icon'     => 'dashicons-admin-plugins',
			'has_archive'   => false,
			'show_in_rest'  => true,
			'rewrite'       => array( 'slug' => 'services' ),
			'taxonomies'    => array( DIS_DEFAULT_CATEGORY, DIS_DEFAULT_TAGS ),
		);

		register_post_type( DIS_SERVICE_POST_TYPE, $args );

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
	'key' => 'group_67d2c44fcfc30',
	'title' => 'Service Fields',
	'fields' => array(
		array(
			'key' => 'field_67d2c450ba618',
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
			'key' => 'field_6821f31ca30b9',
			'label' => 'Priority',
			'name' => 'priority',
			'aria-label' => '',
			'type' => 'number',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => 0,
			'min' => '',
			'max' => '',
			'allow_in_bindings' => 0,
			'placeholder' => '',
			'step' => '',
			'prepend' => '',
			'append' => '',
		),
		array(
			'key' => 'field_67dc32770ef2a',
			'label' => 'Cluster',
			'name' => 'cluster',
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
				0 => 'dis-service-cluster',
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
			'key' => 'field_67dc32c30ef2c',
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
			'key' => 'field_67d2f2caf054f',
			'label' => 'How-to title',
			'name' => 'how_to_title',
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
			'key' => 'field_67dc31c20ef24',
			'label' => 'Service link',
			'name' => 'service_link',
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
			'key' => 'field_67d2c4cfba619',
			'label' => 'Features',
			'name' => 'features',
			'aria-label' => '',
			'type' => 'wysiwyg',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'allow_in_bindings' => 1,
			'tabs' => 'all',
			'toolbar' => 'full',
			'media_upload' => 1,
			'delay' => 0,
		),
		array(
			'key' => 'field_67d2f285f054c',
			'label' => 'Requirements',
			'name' => 'requirements',
			'aria-label' => '',
			'type' => 'wysiwyg',
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
			'tabs' => 'all',
			'toolbar' => 'full',
			'media_upload' => 1,
			'delay' => 0,
		),
		array(
			'key' => 'field_67d2f28ff054d',
			'label' => 'Get started',
			'name' => 'get_started',
			'aria-label' => '',
			'type' => 'wysiwyg',
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
			'tabs' => 'all',
			'toolbar' => 'full',
			'media_upload' => 1,
			'delay' => 0,
		),
		array(
			'key' => 'field_67dc31480ef22',
			'label' => 'Rates',
			'name' => 'rates',
			'aria-label' => '',
			'type' => 'wysiwyg',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'allow_in_bindings' => 1,
			'tabs' => 'all',
			'toolbar' => 'full',
			'media_upload' => 1,
			'delay' => 0,
		),
		array(
			'key' => 'field_67dc32a00ef2b',
			'label' => 'Related services',
			'name' => 'related_services',
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
				0 => 'dis-service',
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
			'key' => 'field_67f52fa35ecd5',
			'label' => 'Related documents',
			'name' => 'related_documents',
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
				0 => 'dis-attachment',
			),
			'post_status' => '',
			'taxonomy' => '',
			'filters' => array(
				0 => 'search',
			),
			'return_format' => 'object',
			'min' => '',
			'max' => '',
			'allow_in_bindings' => 1,
			'elements' => '',
			'bidirectional' => 0,
			'bidirectional_target' => array(
			),
		),
		array(
			'key' => 'field_67dc325d0ef29',
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
			'allow_in_bindings' => 1,
			'ui' => 0,
			'ui_on_text' => '',
			'ui_off_text' => '',
		),
		array(
			'key' => 'field_67dc32340ef28',
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
			'key' => 'field_67dc321f0ef27',
			'label' => 'Visit counter',
			'name' => 'visit_counter',
			'aria-label' => '',
			'type' => 'number',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => 0,
			'min' => '',
			'max' => '',
			'allow_in_bindings' => 0,
			'placeholder' => '',
			'step' => '',
			'prepend' => '',
			'append' => '',
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'dis-service',
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
