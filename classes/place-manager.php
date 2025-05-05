<?php
/**
 * Definition of the Place Manager.
 *
 * @package Design_ICT_Site
 */


class Place_Manager {
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

		$place_type_labels = array(
			'name'              => _x( 'Place Type', 'DIS_TaxonomyGeneralName', 'design_ict_site' ),
			'singular_name'     => _x( 'Place Type', 'DIS_TaxonomySingularName', 'design_ict_site' ),
			'search_items'      => __( 'Look for a Place Type', 'design_ict_site' ),
			'all_items'         => __( 'All Place Types', 'design_ict_site' ),
			'edit_item'         => __( 'Modify the Place Type', 'design_ict_site' ),
			'update_item'       => __( 'Edit the Place Type', 'design_ict_site' ),
			'add_new_item'      => __( 'Add a Place Type', 'design_ict_site' ),
			'new_item_name'     => __( 'New Place Type', 'design_ict_site' ),
			'menu_name'         => __( 'Place Type', 'design_ict_site' ),
		);

		$place_type_args = array(
			'hierarchical'      => true,
			'labels'            => $place_type_labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => DIS_PLACE_TYPE_TAXONOMY ),
			'show_in_rest'      => true,
		);

		register_taxonomy( DIS_PLACE_TYPE_TAXONOMY, array( DIS_PLACE_POST_TYPE ), $place_type_args );
	}

	/**
	 * Register the post type.
	 *
	 * @return void
	 */
	public function add_post_type() {

		$labels = array(
			'name'                  => _x( 'Places', 'DIS_PostTypeGeneralName', 'design_ict_site' ),
			'singular_name'         => _x( 'Place', 'DIS_PostTypeSingularName', 'design_ict_site' ),
			'add_new'               => _x( 'Add a ', 'DIS_PostTypeSingularName', 'design_ict_site' ),
			'add_new_item'          => _x( 'Add a place', 'DIS_PostTypeSingularName', 'design_ict_site' ),
			'edit_item'             => _x( 'Edit the place', 'DIS_PostTypeSingularName', 'design_ict_site' ),
			'view_item'             => _x( 'View the place', 'DIS_PostTypeSingularName', 'design_ict_site' ),
			'featured_image'        => __( "Place image", 'design_ict_site' ),
			'set_featured_image'    => __( 'Choose place image' ),
			'remove_featured_image' => __( 'Remove place image' , 'design_ict_site' ),
			'use_featured_image'    => __( 'Use as place image' , 'design_ict_site' ),
		);

		$args   = array(
			'label'           => __( 'Place', 'design_ict_site' ),
			'labels'          => $labels,
			'supports'        => array( 'title', 'editor', 'thumbnail' ),
			'hierarchical'    => false,
			'public'          => true,
			'show_in_menu'    => true,
			'menu_position'   => 6,
			'menu_icon'       => 'dashicons-pressthis',
			'has_archive'     => false,
			'show_in_rest'    => true,
			'taxonomies'      => array( DIS_DEFAULT_CATEGORY, DIS_DEFAULT_TAGS ),
		);

		register_post_type( DIS_PLACE_POST_TYPE, $args );

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
		'key' => 'group_67dacafcb8bc4',
		'title' => 'Place Fields',
		'fields' => array(
			array(
				'key' => 'field_67dacafdb15d6',
				'label' => 'GPS position',
				'name' => 'gps_position',
				'aria-label' => '',
				'type' => 'google_map',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'center_lat' => '',
				'center_lng' => '',
				'zoom' => '',
				'height' => '',
				'allow_in_bindings' => 1,
			),
			array(
				'key' => 'field_67dacb2fb15d7',
				'label' => 'Address',
				'name' => 'address',
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
				'key' => 'field_67dacb3db15d8',
				'label' => 'ZIP code',
				'name' => 'zip_code',
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
				'key' => 'field_67dacb69b15d9',
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
				'key' => 'field_67dacb79b15da',
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
				'key' => 'field_67dacb86b15db',
				'label' => 'Opening hours',
				'name' => 'opening_hours',
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
				'key' => 'field_67dacba9b15dc',
				'label' => 'Getting here',
				'name' => 'getting_here',
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
		),
		'location' => array(
			array(
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'dis-place',
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
