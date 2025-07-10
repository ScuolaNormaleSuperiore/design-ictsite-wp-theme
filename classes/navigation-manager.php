<?php
/**
 * Definition of the Navigation Manager.
 *
 * @package Design_ICT_Site
 */

class DIS_TreeItem {
	public string $name;
	public string $slug;
	public string $link;
	public bool   $external;
	public array  $children;

	public function __construct( $name, $slug, $link, $external=false, $children=array() ) {
		$this->name     = $name;
		$this->slug     = $slug;
		$this->link     = $link;
		$this->external = $external;
		$this->children = $children;
	}
}

class DIS_BreadItem {
	public string $label;
	public string $url;
	public string $class;

	public function __construct( $label, $url, $class ) {
		$this->label = $label;
		$this->url   = $url;
		$this->class = $class;
	}
}


/**
 * The manager for the site contents.
 *
 */
class DIS_NavigationManager {
	/**
	 * Constructor of the Manager.
	 */
	public function __construct() {}

	/**
	 * Return the path of the breadcrumb.
	 * 
	 * @param mixed $post
	 * @return object[]
	 */
	public static function build_content_path( $post ) {
		$home_url = DIS_MultiLangManager::get_home_url();
		$root     = new DIS_BreadItem( 'Home',  $home_url, 'breadcrumb-item' );
		$steps    = array();
		array_push( $steps, $root );

		if ( $post ) {
			switch ( $post->post_type ) {
				case DIS_DEFAULT_PAGE:
					$post_parent = $post->post_parent;
					$post_parents = array();
					while ( $post_parent !== 0 ) {
						$post_tmp       = get_post( $post_parent );
						$post_parents[] = new DIS_BreadItem(
							$post_tmp->post_title,
							get_permalink( $post_tmp->ID ),
							'breadcrumb-item'
						);
						$post_parent = $post_tmp->post_parent;
					}
					$post_parents = count( $post_parents ) > 1 ? array_reverse( $post_parents ) : $post_parents;
					foreach ( $post_parents as $parent ) {
						array_push(
							$steps,
							$parent,
						);
					}
					array_push(
						$steps,
						new DIS_BreadItem(
							$post->post_title,
							$post->post_url,
							'breadcrumb-item active'
						),
					);
					break;
				case DIS_DEFAULT_POST:
					$ct    = DIS_MultiLangManager::get_archive_page( $post->post_type );
					array_push(
						$steps,
						$post_parents[] = new DIS_BreadItem(
							$ct->post_title,
							get_permalink( $ct ),
							'breadcrumb-item'
						),
					);
					array_push(
						$steps,
						$post_parents[] = new DIS_BreadItem(
							$post->post_title,
							'',
							'breadcrumb-item active'
						),
					);
					break;
				default:
					$ct = DIS_MultiLangManager::get_archive_page( $post->post_type );
					array_push(
						$steps,
						$post_parents[] = new DIS_BreadItem(
							$ct->post_title,
							get_permalink( $ct ),
							'breadcrumb-item'
						),
					);
					array_push(
						$steps,
						$post_parents[] = new DIS_BreadItem(
							$post->post_title,
							'',
							'breadcrumb-item active'
						),
					);
					break;
				}
		}
		return $steps;
	}

	/**
	 * Get the tree of the Site Map.
	 *
	 * @return DIS_TreeItem[]
	 */
	public static function get_site_tree() {
		$pt       = array(); // Page Tree.
		$site_url = DIS_MultiLangManager::get_home_url();
		
		// 1 - Home Page.
		$home =  new DIS_TreeItem(
			DIS_HOMEPAGE_NAME,
			DIS_HOMEPAGE_SLUG,
			$site_url
		);
		$pt[DIS_HOMEPAGE_SLUG] = $home;

		// 2 - Network Page.
		$network_url  = DIS_OptionsManager::dis_get_option( 'site_network_url', 'dis_opt_options' );
		if ( $network_url ) {
			$network_name = DIS_OptionsManager::dis_get_option( 'site_network_name', 'dis_opt_options' );
			$network_name = $network_name ? $network_name : DIS_NETWORK_NAME;
			$network      =  new DIS_TreeItem(
				$network_name,
				DIS_NETWORK_SLUG,
				$network_url,
				true
			);
			$pt[DIS_HOMEPAGE_SLUG]->children[DIS_NETWORK_SLUG] = $network;
		}

		// The list of the defined menus.
		$current_lang = DIS_MultiLangManager::get_current_language();
		$menus        = DIS_MultiLangManager::get_all_menus_by_lang( $current_lang );
		$slugs        = self::get_pt_archive_slugs();

		// Add to the tree the menu items.
		foreach ( $menus as $item ) {
			$mname = key( $item );
			if ( $mname ) {
				$mid     = $item[ $mname ];
				$menu    = wp_get_nav_menu_object( $mid );
				if ( $menu ) {
					$element =  new DIS_TreeItem(
						$menu->name,
						$menu->slug,
						'',
						true
					);
					$pt[$home->slug]->children[$menu->slug] = $element;
					$menu_items = wp_get_nav_menu_items( $mid, array( 'order' => 'DESC' ) );
					// Add to the tree the content of each menu voice.
					foreach( $menu_items as $child ) {
						$object_id = $child->object_id;
						$object    = get_post( $object_id );
						$child_el  = new DIS_TreeItem(
							$object->post_title,
							$object->post_name,
							get_permalink( $object->ID ),
							true
						);
						$pt[$home->slug]->children[$menu->slug]->children[$object->post_title] = $child_el;
						// For archive pages add all content of that type to the tree.
						$type = $object->post_type;
						$name = $object->post_name;
						$type = isset( $slugs[ $object->post_name ] ) ? $slugs[ $object->post_name ] : '';
						if ( $type ) {
							$results = DIS_ContentsManager::get_sitemap_posts( $type );
							foreach ( $results as $r ){
								$post_el = new DIS_TreeItem(
							$r->post_title,
							$r->post_name,
							get_permalink( $r ),
							true
								);
								$pt[$home->slug]->children[$menu->slug]->children[$object->post_title]->children[$r->post_name] = $post_el;
							}
						}
					}
				}
			}
		}
	
		return $pt;
	}

	private static function get_pt_archive_slugs(){
		$slugs = array();
		$items =  dis_ct_data();
		foreach( $items as $pt => $items ){
			if ( $pt !== DIS_DEFAULT_PAGE ) {
				$slugs[$items['slug']] = $pt;
			}
		}
		return $slugs;
	}

}
