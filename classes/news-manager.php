<?php
/**
 * Definition of the News Manager.
 *
 * @package Design_ICT_Site
 */


class News_Manager {
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
			'name'          => dis_ct_data()[ DIS_NEWS_POST_TYPE ]['plural_name'],
			'singular_name' => dis_ct_data()[ DIS_NEWS_POST_TYPE ]['singular_name'],
			'add_new'       => __( 'Add an item', 'design_ict_site' ),
			'add_new_item'  => __( 'Add an item', 'design_ict_site' ),
			'edit_item'     => __( 'Edit the item', 'design_ict_site' ),
			'view_item'     => __( 'View the item', 'design_ict_site' ),
		);

		$args = array(
			'label'         => dis_ct_data()[ DIS_NEWS_POST_TYPE ]['singular_name'],
			'labels'        => $labels,
			'supports'      => array( 'title', 'editor', 'thumbnail' ),
			'hierarchical'  => false,
			'public'        => true,
			'show_in_menu'  => true,
			'menu_position' => 6,
			'menu_icon'     => 'dashicons-welcome-widgets-menus',
			'has_archive'   => false,
			'show_in_rest'  => true,
			'rewrite'       => array( 'slug' => dis_ct_data()[ DIS_NEWS_POST_TYPE ]['slug'] ),
			'taxonomies'    => array( DIS_DEFAULT_CATEGORY, DIS_DEFAULT_TAGS ),
		);

		register_post_type( DIS_NEWS_POST_TYPE, $args );

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
		'key' => 'group_686f687226329',
		'title' => 'News Fields',
		'fields' => array(
			array(
				'key' => 'field_686f68722f3df',
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
				'key' => 'field_686f68725031e',
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
				'key' => 'field_686f687253e05',
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
				'key' => 'field_686f68725775e',
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
				'key' => 'field_686f68725b4b2',
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
				'key' => 'field_686f68725f098',
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
				'key' => 'field_686f687262cb6',
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
				'key' => 'field_686f6872667d3',
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
				'key' => 'field_686f68726a251',
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
					'value' => 'dis-news',
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
