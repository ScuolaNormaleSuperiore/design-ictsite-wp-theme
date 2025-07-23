<?php
/**
 * Definition of the Page Manager.
 *
 * @package Design_ICT_Site
 */


class Page_Manager {
	/**
	 * Constructor of the Manager.
	 */
	public function __construct() {}

	/**
	 * Install and configure the Course page type.
	 *
	 * @return void
	 */
	public function setup() {
		// Register the page type.
		add_action( 'init', array( $this, 'add_fields' ) );
		add_action( 'init', array( $this, 'add_excerpt' ) );
		add_action( 'add_meta_boxes', array( $this, 'edit_excerpt_metabox' ) );
	}


	/**
	 * Enable the excerpt.
	 *
	 * @return void
	 */
	public function add_excerpt() {
		add_post_type_support( DIS_DEFAULT_PAGE, 'excerpt' );
	}

	/**
	 * Edit the excerpt metabox.
	 *
	 * @return void
	 */
	public function edit_excerpt_metabox() {
		remove_meta_box( 'postexcerpt', DIS_DEFAULT_POST, 'normal' );
		// Adds the metabox under the main editor.
		add_meta_box(
			'postexcerpt',
			__('Excerpt'),
			'post_excerpt_meta_box',
			[DIS_DEFAULT_PAGE,],
			'normal',
			'high'
		);
	}


	/**
	 * Add the custom fields of the custom page-type.
	 *
	 * @return void
	 */
	public function add_fields() {

		if ( ! function_exists( 'acf_add_local_field_group' ) ) {
			return;
		}

		acf_add_local_field_group( array(
		'key' => 'group_67dd2f3b83454',
		'title' => 'Page Fields',
		'fields' => array(
			array(
				'key' => 'field_67dd2f3b1320c',
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
					0 => 'post',
					1 => 'page',
					2 => 'dis-event',
					3 => 'dis-news',
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
					'value' => 'page',
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
