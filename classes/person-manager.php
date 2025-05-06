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
			'name'              => _x( 'Person Roles', 'DIS_TaxonomyGeneralName', 'design_ict_site' ),
			'singular_name'     => _x( 'Person Role', 'DIS_TaxonomySingularName', 'design_ict_site' ),
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
			'name'                  => _x( 'Persons', 'DIS_PostTypeGeneralName', 'design_ict_site' ),
			'singular_name'         => _x( 'Person', 'DIS_PostTypeSingularName', 'design_ict_site' ),
			'add_new'               => _x( 'Add a ', 'DIS_PostTypeSingularName', 'design_ict_site' ),
			'add_new_item'          => _x( 'Add a person', 'DIS_PostTypeSingularName', 'design_ict_site' ),
			'edit_item'             => _x( 'Edit the person', 'DIS_PostTypeSingularName', 'design_ict_site' ),
			'view_item'             => _x( 'View the person', 'DIS_PostTypeSingularName', 'design_ict_site' ),
			'featured_image'        => __( 'Person image', 'design_ict_site' ),
			'set_featured_image'    => __( 'Choose person image', 'design_ict_site' ),
			'remove_featured_image' => __( 'Remove person image', 'design_ict_site' ),
			'use_featured_image'    => __( 'Use as person image', 'design_ict_site' ),
		);

		$args   = array(
			'label'         => __( 'Person', 'design_ict_site' ),
			'labels'        => $labels,
			'supports'      => array( 'title', 'editor', 'thumbnail' ),
			'hierarchical'  => false,
			'public'        => true,
			'show_in_menu'  => true,
			'menu_position' => 6,
			'menu_icon'     => 'dashicons-businessperson',
			'has_archive'   => false,
			'show_in_rest'  => true,
			'rewrite'       => array( 'slug' => 'people' ),
			'taxonomies'    => array( DIS_DEFAULT_CATEGORY, DIS_DEFAULT_TAGS ),
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




	}

}
