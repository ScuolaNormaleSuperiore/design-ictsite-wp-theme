<?php
/**
 * Definition of the Faq Manager.
 *
 * @package Design_ICT_Site
 */


class Faq_Manager {
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
			'name'          => dis_ct_data()[DIS_FAQ_POST_TYPE]['plural_name'],
			'singular_name' => dis_ct_data()[DIS_FAQ_POST_TYPE]['singular_name'],
			'add_new'       => __( 'Add an item', 'design_ict_site' ),
			'add_new_item'  => __( 'Add an item', 'design_ict_site' ),
			'edit_item'     => __( 'Edit the item', 'design_ict_site' ),
			'view_item'     => __( 'View the item', 'design_ict_site' ),
		);

		$args   = array(
			'label'         => dis_ct_data()[DIS_FAQ_POST_TYPE]['singular_name'],
			'labels'        => $labels,
			'supports'      => array( 'title', 'editor', 'thumbnail' ),
			'hierarchical'  => false,
			'public'        => true,
			'show_in_menu'  => true,
			'menu_position' => 6,
			'menu_icon'     => 'dashicons-code-standards',
			'has_archive'   => false,
			'show_in_rest'  => true,
			'taxonomies'    => array( DIS_DEFAULT_CATEGORY, DIS_DEFAULT_TAGS ),
		);

		register_post_type( DIS_FAQ_POST_TYPE, $args );

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
		'key' => 'group_686382cd6a5b1',
		'title' => 'Faq fields',
		'fields' => array(
			array(
				'key' => 'field_686382cd3ebac',
				'label' => 'Service',
				'name' => 'service',
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
		),
		'location' => array(
			array(
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'dis-faq',
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
