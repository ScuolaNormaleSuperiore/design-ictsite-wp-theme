<?php
/**
 * Definition of the Attachment Manager.
 *
 * @package Design_ICT_Site
 */


class Attachment_Manager {
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

		// Customize the post type layout of the admin interface.
		// add_action( 'edit_form_after_title', array( $this, 'custom_layout' ) );
	}

	/**
	 * Register the post type.
	 *
	 * @return void
	 */
	public function add_post_type() {

		$labels = array(
			'name'          => dis_ct_data()[DIS_ATTACHMENT_POST_TYPE]['plural_name'],
			'singular_name' => dis_ct_data()[DIS_ATTACHMENT_POST_TYPE]['singular_name'],
			'add_new'       => __( 'Add an item', 'design_ict_site' ),
			'add_new_item'  => __( 'Add an item', 'design_ict_site' ),
			'edit_item'     => __( 'Edit the item', 'design_ict_site' ),
			'view_item'     => __( 'View the item', 'design_ict_site' ),
		);

		$args   = array(
			'label'         => dis_ct_data()[DIS_ATTACHMENT_POST_TYPE]['singular_name'],
			'labels'        => $labels,
			'supports'      => array( 'title', 'editor', 'thumbnail' ),
			'hierarchical'  => false,
			'public'        => true,
			'show_in_menu'  => true,
			'menu_position' => 6,
			'menu_icon'     => 'dashicons-admin-links',
			'has_archive'   => false,
			'show_in_rest'  => true,
			'rewrite'       => array( 'slug' => dis_ct_data()[DIS_ATTACHMENT_POST_TYPE]['slug'] ),
		);

		register_post_type( DIS_ATTACHMENT_POST_TYPE, $args );

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
		'key' => 'group_67f52d0006c80',
		'title' => 'Attachment Fields',
		'fields' => array(
			array(
				'key' => 'field_67f52d00156c1',
				'label' => 'Link',
				'name' => 'link',
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
				'allow_in_bindings' => 1,
				'placeholder' => '',
			),
			array(
				'key' => 'field_67f52ec74de69',
				'label' => 'File',
				'name' => 'file',
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
		),
		'location' => array(
			array(
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'dis-attachment',
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
