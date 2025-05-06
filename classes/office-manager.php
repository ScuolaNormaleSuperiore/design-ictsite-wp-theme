<?php
/**
 * Definition of the Office Manager.
 *
 * @package Design_ICT_Site
 */


class Office_Manager {
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
			'name'                  => _x( 'Offices', 'DIS_PostTypeGeneralName', 'design_ict_site' ),
			'singular_name'         => _x( 'Office', 'DIS_PostTypeSingularName', 'design_ict_site' ),
			'add_new'               => _x( 'Add an office ', 'DIS_PostTypeSingularName', 'design_ict_site' ),
			'add_new_item'          => _x( 'Add an office', 'DIS_PostTypeSingularName', 'design_ict_site' ),
			'edit_item'             => _x( 'Edit the office', 'DIS_PostTypeSingularName', 'design_ict_site' ),
			'view_item'             => _x( 'View the office', 'DIS_PostTypeSingularName', 'design_ict_site' ),
			'featured_image'        => __( 'Office image', 'design_ict_site' ),
			'set_featured_image'    => __( 'Choose office image' ),
			'remove_featured_image' => __( 'Remove office image' , 'design_ict_site' ),
			'use_featured_image'    => __( 'Use as office image' , 'design_ict_site' ),
		);

		$args   = array(
			'label'         => __( 'Office', 'design_ict_site' ),
			'labels'        => $labels,
			'supports'      => array( 'title', 'editor', 'thumbnail' ),
			'hierarchical'  => false,
			'public'        => true,
			'show_in_menu'  => true,
			'menu_position' => 6,
			'menu_icon'     => 'dashicons-building',
			'has_archive'   => false,
			'show_in_rest'  => true,
			'rewrite'       => array( 'slug' => 'offices' ),
			'taxonomies'    => array( DIS_DEFAULT_CATEGORY, DIS_DEFAULT_TAGS ),
		);

		register_post_type( DIS_OFFICE_POST_TYPE, $args );

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
