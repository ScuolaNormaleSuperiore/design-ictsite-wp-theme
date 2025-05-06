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



	}

}
