<?php
/**
 * Definition of the Banner Manager.
 *
 * @package Design_ICT_Site
 */


class Banner_Manager {
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
			'name'                  => _x( 'Banners', 'DIS_PostTypeGeneralName', 'design_ict_site' ),
			'singular_name'         => _x( 'Banner', 'DIS_PostTypeSingularName', 'design_ict_site' ),
			'add_new'               => _x( 'Add a banner', 'DIS_PostTypeSingularName', 'design_ict_site' ),
			'add_new_item'          => _x( 'Add a banner', 'DIS_PostTypeSingularName', 'design_ict_site' ),
			'edit_item'             => _x( 'Edit the banner', 'DIS_PostTypeSingularName', 'design_ict_site' ),
			'view_item'             => _x( 'View the banner', 'DIS_PostTypeSingularName', 'design_ict_site' ),
			'featured_image'        => __( 'Banner image', 'design_ict_site' ),
			'set_featured_image'    => __( 'Choose banner image' ),
			'remove_featured_image' => __( 'Remove banner image' , 'design_ict_site' ),
			'use_featured_image'    => __( 'Use a banner image' , 'design_ict_site' ),
		);

		$args = array(
			'label'         => __( 'Banner', 'design_ict_site' ),
			'labels'        => $labels,
			'supports'      => array( 'title', 'editor', 'thumbnail' ),
			'hierarchical'  => false,
			'public'        => true,
			'show_in_menu'  => true,
			'menu_position' => 6,
			'menu_icon'     => 'dashicons-excerpt-view',
			'has_archive'   => false,
			'show_in_rest'  => true,
			'rewrite'       => array( 'slug' => 'banners' ),
			'taxonomies'    => array( DIS_DEFAULT_CATEGORY, DIS_DEFAULT_TAGS ),
		);

		register_post_type( DIS_BANNER_POST_TYPE, $args );

		// Add the custom fields.
		$this->add_fields();
	}

	/**
	 * Add the custom fields of the custom post-type.
	 *
	 * @return void
	 */
	private function add_fields() {


	}

}
