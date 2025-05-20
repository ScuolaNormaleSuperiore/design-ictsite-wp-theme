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
			'name'                  => _x( 'Places', 'DIS_PostTypeLabels', 'design_ict_site' ),
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
			'label'         => __( 'Place', 'design_ict_site' ),
			'labels'        => $labels,
			'supports'      => array( 'title', 'editor', 'thumbnail' ),
			'hierarchical'  => false,
			'public'        => true,
			'show_in_menu'  => true,
			'menu_position' => 6,
			'menu_icon'     => 'dashicons-pressthis',
			'has_archive'   => false,
			'show_in_rest'  => true,
			'rewrite'       => array( 'slug' => 'places' ),
			'taxonomies'    => array( DIS_DEFAULT_CATEGORY, DIS_DEFAULT_TAGS ),
		);

		register_post_type( DIS_PLACE_POST_TYPE, $args );

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
	'key' => 'group_67dacafcb8bc4',
	'title' => 'Place Fields',
	'fields' => array(
		array(
			'key' => 'field_6821fd4307612',
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
			'key' => 'field_67dacafdb15d6',
			'label' => 'GPS position',
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
			'allow_in_bindings' => 1,
			'leaflet_map' => '{"lat":53.550640000000001,"lng":10.00065,"zoom":12,"layers":["OpenStreetMap.Mapnik"],"markers":[]}',
		),
		array(
			'key' => 'field_6821fd65da573',
			'label' => 'City',
			'name' => 'city',
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
			'key' => 'field_67dacb3db15d8',
			'label' => 'ZIP code',
			'name' => 'zip_code',
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
			'key' => 'field_67dacb2fb15d7',
			'label' => 'Address',
			'name' => 'address',
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
