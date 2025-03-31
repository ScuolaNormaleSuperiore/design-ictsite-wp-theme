<?php
/**
 * Definition of the Person Manager.
 *
 * @package Design_ICT_Site
 */


class Person_Manager {
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

		// Register the taxonomies used by this post type.
		add_action( 'init', array( $this, 'add_taxonomies' ) );

		// Register the post type.
		add_action( 'init', array( $this, 'add_post_type' ) );

		// Customize the post type layout of the admin interface.
		// add_action( 'edit_form_after_title', array( $this, 'custom_layout' ) );
	}

	/**
	 * Register the taxonomies.
	 *
	 * @return void
	 */
	public function add_taxonomies() {
		// aggiungo la tassonomia tipologia luogo.

		$person_role_labels = array(
			'name'              => _x( 'Person Roles', 'taxonomy general name', 'design_ict_site' ),
			'singular_name'     => _x( 'Person Role', 'taxonomy singular name', 'design_ict_site' ),
			'search_items'      => __( 'Look for a person role', 'design_ict_site' ),
			'all_items'         => __( 'All person roles', 'design_ict_site' ),
			'edit_item'         => __( 'Modify the person role', 'design_ict_site' ),
			'update_item'       => __( 'Edit the person role Type', 'design_ict_site' ),
			'add_new_item'      => __( 'Add a person role', 'design_ict_site' ),
			'new_item_name'     => __( 'New person role', 'design_ict_site' ),
			'menu_name'         => __( 'Person Roles', 'design_ict_site' ),
		);

		$person_role_args = array(
			'hierarchical'      => true,
			'labels'            => $person_role_labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => DIS_PERSON_ROLE_TAXONOMY ),
			'show_in_rest'      => true,
		);

		register_taxonomy( DIS_PERSON_ROLE_TAXONOMY, array( DIS_PERSON_POST_TYPE ), $person_role_args );
	}


	/**
	 * Register the post type.
	 *
	 * @return void
	 */
	public function add_post_type() {

		$labels = array(
			'name'                  => _x( 'Persons', 'Post Type General Name', 'design_ict_site' ),
			'singular_name'         => _x( 'Person', 'Post Type Singular Name', 'design_ict_site' ),
			'add_new'               => _x( 'Add a ', 'Post Type Singular Name', 'design_ict_site' ),
			'add_new_item'          => _x( 'Add a person', 'Post Type Singular Name', 'design_ict_site' ),
			'edit_item'             => _x( 'Edit the person', 'Post Type Singular Name', 'design_ict_site' ),
			'view_item'             => _x( 'View the person', 'Post Type Singular Name', 'design_ict_site' ),
			'featured_image'        => __( "Person image", 'design_ict_site' ),
			'set_featured_image'    => __( 'Choose person image' ),
			'remove_featured_image' => __( 'Remove person image' , 'design_ict_site' ),
			'use_featured_image'    => __( 'Use as person image' , 'design_ict_site' ),
		);

		$args   = array(
			'label'           => __( 'Person', 'design_ict_site' ),
			'labels'          => $labels,
			'supports'        => array( 'title', 'editor', 'thumbnail' ),
			'hierarchical'    => false,
			'public'          => true,
			'show_in_menu'    => true,
			'menu_position'   => 6,
			'menu_icon'       => 'dashicons-businessperson',
			'has_archive'     => false,
			'show_in_rest'    => true,
			'taxonomies'      => array( DIS_DEFAULT_CATEGORY, DIS_DEFAULT_TAGS ),
		);

		register_post_type( DIS_PERSON_POST_TYPE, $args );

		// Add the custom fields.
		$this->add_fields();
	}

	// /**
	//  * Customize the layout of the admin interface.
	//  *
	//  * @param Object $post - The custom post.
	//  * @return string
	//  */
	// public function custom_layout( $post ) {
	// 	if ( EVENT_POST_TYPE === $post->post_type ) {
	// 		echo '<h1>';
	// 		_e( 'Descrizione evento', 'design_ict_site' );
	// 		echo '</h1>';
	// 	}
	// }

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
		'key' => 'group_67dacf3c44560',
		'title' => 'Person Fields',
		'fields' => array(
			array(
				'key' => 'field_67dacf3c763f5',
				'label' => 'Name',
				'name' => 'name',
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
				'key' => 'field_67dad05591ecc',
				'label' => 'Surname',
				'name' => 'surname',
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
				'key' => 'field_67dad06091ecd',
				'label' => 'Honorific',
				'name' => 'honorific',
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
				'key' => 'field_67dad0c891ece',
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
				'key' => 'field_67dad0d091ecf',
				'label' => 'Telephone',
				'name' => 'telephone',
				'aria-label' => '',
				'type' => 'text',
				'instructions' => '',
				'required' => false,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'maxlength' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
			),
			array(
				'key' => 'field_67dad0ea91ed0',
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
				'key' => 'field_67dad1da91ed3',
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
				'key' => 'field_67dad16491ed2',
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
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'person',
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
