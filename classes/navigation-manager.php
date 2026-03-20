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
	 * Register sitemap XML hooks.
	 *
	 * @return void
	 */
	public function setup() {
		add_action( 'init', array( $this, 'register_sitemap_rewrite_rules' ) );
		add_filter( 'query_vars', array( $this, 'register_sitemap_query_vars' ) );
		add_action( 'template_redirect', array( $this, 'maybe_render_sitemap_xml' ) );
	}

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
							get_permalink( $post->ID ),
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
		return self::get_sitemap_tree();
	}

	/**
	 * Build and return the sitemap tree data.
	 *
	 * @return DIS_TreeItem[]
	 */
	public static function get_sitemap_tree() {
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
					$menu_items = wp_get_nav_menu_items(
						$mid,
						array(
							'orderby' => 'menu_order',
							'order'   => 'ASC',
						)
					);
					$pt[$home->slug]->children[$menu->slug]->children = self::build_menu_branch( $menu_items ?: array(), $slugs );
				}
			}
		}
	
		return $pt;
	}

	/**
	 * Render the sitemap tree as HTML.
	 *
	 * @param DIS_TreeItem[]|null $tree The sitemap tree. When omitted it is built on demand.
	 * @return string
	 */
	public static function render_sitemap_html( ?array $tree = null ) {
		$tree = is_array( $tree ) ? $tree : self::get_sitemap_tree();
		if ( empty( $tree[ DIS_HOMEPAGE_SLUG ] ) ) {
			return '';
		}

		$html  = '<ul class="menutree">';
		$html .= '<li>';
		$html .= sprintf(
			'<a href="%1$s">%2$s</a>',
			esc_url( $tree[ DIS_HOMEPAGE_SLUG ]->link ),
			esc_html( $tree[ DIS_HOMEPAGE_SLUG ]->name )
		);
		$html .= '</li>';
		$html .= self::render_sitemap_html_items( $tree[ DIS_HOMEPAGE_SLUG ]->children );
		$html .= '</ul>';

		return $html;
	}

	/**
	 * Render the sitemap tree as XML.
	 *
	 * @param DIS_TreeItem[]|null $tree The sitemap tree. When omitted it is built on demand.
	 * @return string
	 */
	public static function render_sitemap_xml( ?array $tree = null ) {
		$tree = is_array( $tree ) ? $tree : self::get_sitemap_tree();
		$urls = self::collect_sitemap_urls( $tree );

		$xml = '<?xml version="1.0" encoding="UTF-8"?>';
		$xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
		foreach ( $urls as $url ) {
			$xml .= '<url><loc>' . esc_xml( $url ) . '</loc></url>';
		}
		$xml .= '</urlset>';

		return $xml;
	}

	/**
	 * Render the sitemap index XML.
	 *
	 * @return string
	 */
	public static function render_sitemap_index_xml() {
		$languages = DIS_MultiLangManager::get_languages_list();
		$xml       = '<?xml version="1.0" encoding="UTF-8"?>';
		$xml      .= '<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

		foreach ( $languages as $language ) {
			$xml .= '<sitemap><loc>' . esc_xml( self::get_sitemap_url_for_language( $language ) ) . '</loc></sitemap>';
		}

		$xml .= '</sitemapindex>';

		return $xml;
	}

	/**
	 * Register sitemap rewrite rules.
	 *
	 * @return void
	 */
	public function register_sitemap_rewrite_rules() {
		add_rewrite_rule( '^sitemap-index\.xml$', 'index.php?dis_sitemap=index', 'top' );
		add_rewrite_rule( '^sitemap-([A-Za-z0-9_-]+)\.xml$', 'index.php?dis_sitemap=lang&dis_sitemap_lang=$matches[1]', 'top' );
	}

	/**
	 * Register sitemap query vars.
	 *
	 * @param array $vars Existing query vars.
	 * @return array
	 */
	public function register_sitemap_query_vars( $vars ) {
		$vars[] = 'dis_sitemap';
		$vars[] = 'dis_sitemap_lang';

		return $vars;
	}

	/**
	 * Render XML sitemap endpoints when requested.
	 *
	 * @return void
	 */
	public function maybe_render_sitemap_xml() {
		$sitemap_type = get_query_var( 'dis_sitemap' );
		if ( ! $sitemap_type ) {
			return;
		}

		status_header( 200 );
		nocache_headers();
		header( 'Content-Type: application/xml; charset=' . get_bloginfo( 'charset' ) );

		if ( 'index' === $sitemap_type ) {
			echo self::render_sitemap_index_xml(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			exit;
		}

		$lang = get_query_var( 'dis_sitemap_lang' );
		if ( ! self::is_valid_sitemap_language( $lang ) ) {
			global $wp_query;
			$wp_query->set_404();
			status_header( 404 );
			echo '<?xml version="1.0" encoding="UTF-8"?><error>Not found</error>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			exit;
		}

		DIS_MultiLangManager::switch_language( $lang );
		echo self::render_sitemap_xml( self::get_sitemap_tree() ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		exit;
	}

	private static function get_pt_archive_slugs(){
		$slugs = array();
		$items = dis_ct_data();
		foreach ( $items as $post_type => $item ) {
			if ( DIS_DEFAULT_PAGE === $post_type ) {
				continue;
			}

			$archive_page = DIS_MultiLangManager::get_archive_page( $post_type );
			if ( $archive_page instanceof WP_Post ) {
				$slugs[ $archive_page->post_name ] = $post_type;
				continue;
			}

			$slugs[ $item['slug'] ] = $post_type;
		}

		return $slugs;
	}

	/**
	 * Flatten sitemap tree nodes into a unique URL list.
	 *
	 * @param DIS_TreeItem[] $tree The sitemap tree.
	 * @return string[]
	 */
	private static function collect_sitemap_urls( array $tree ) {
		$urls = array();
		foreach ( $tree as $item ) {
			self::collect_sitemap_urls_from_item( $item, $urls );
		}

		return array_values( array_unique( array_filter( $urls ) ) );
	}

	/**
	 * Collect URLs recursively from a tree item.
	 *
	 * @param DIS_TreeItem $item The current item.
	 * @param array        $urls Collected URLs.
	 * @return void
	 */
	private static function collect_sitemap_urls_from_item( DIS_TreeItem $item, array &$urls ) {
		if ( '' !== $item->link && ! $item->external ) {
			$urls[] = $item->link;
		}

		foreach ( $item->children as $child ) {
			self::collect_sitemap_urls_from_item( $child, $urls );
		}
	}

	/**
	 * Get the XML sitemap URL for a language.
	 *
	 * @param string $language Language slug.
	 * @return string
	 */
	private static function get_sitemap_url_for_language( $language ) {
		return home_url( '/sitemap-' . $language . '.xml' );
	}

	/**
	 * Validate that the requested sitemap language exists.
	 *
	 * @param string $language Language slug.
	 * @return bool
	 */
	private static function is_valid_sitemap_language( $language ) {
		return in_array( $language, DIS_MultiLangManager::get_languages_list(), true );
	}

	/**
	 * Render a list of sitemap items recursively.
	 *
	 * @param DIS_TreeItem[] $items The items to render.
	 * @return string
	 */
	private static function render_sitemap_html_items( array $items ) {
		if ( empty( $items ) ) {
			return '';
		}

		$html = '<ul>';
		foreach ( $items as $item ) {
			$html .= '<li>';
			if ( '' === $item->link ) {
				$html .= esc_html( $item->name );
			} elseif ( $item->external ) {
				$html .= sprintf(
					'<a href="%1$s" target="_blank" rel="noopener noreferrer">%2$s</a>',
					esc_url( $item->link ),
					esc_html( $item->name )
				);
			} else {
				$html .= sprintf(
					'<a href="%1$s">%2$s</a>',
					esc_url( $item->link ),
					esc_html( $item->name )
				);
			}

			$html .= self::render_sitemap_html_items( $item->children );
			$html .= '</li>';
		}
		$html .= '</ul>';

		return $html;
	}

	/**
	 * Build a hierarchical tree from WP nav menu items.
	 *
	 * @param object[] $menu_items The raw menu items.
	 * @param array    $archive_slugs Archive-page slug to post-type map.
	 * @return DIS_TreeItem[]
	 */
	private static function build_menu_branch( array $menu_items, array $archive_slugs ) {
		$children_by_parent = array();

		foreach ( $menu_items as $menu_item ) {
			$parent_id = (int) $menu_item->menu_item_parent;
			if ( ! isset( $children_by_parent[ $parent_id ] ) ) {
				$children_by_parent[ $parent_id ] = array();
			}
			$children_by_parent[ $parent_id ][] = $menu_item;
		}

		return self::build_menu_children( $children_by_parent, 0, $archive_slugs );
	}

	/**
	 * Recursively build sitemap nodes from menu items.
	 *
	 * @param array $children_by_parent Menu items grouped by parent id.
	 * @param int   $parent_id Current parent id.
	 * @param array $archive_slugs Archive-page slug to post-type map.
	 * @return DIS_TreeItem[]
	 */
	private static function build_menu_children( array $children_by_parent, int $parent_id, array $archive_slugs ) {
		$tree = array();

		foreach ( $children_by_parent[ $parent_id ] ?? array() as $menu_item ) {
			$tree_item = self::build_tree_item_from_menu_item( $menu_item );
			$tree_item->children = self::build_menu_children(
				$children_by_parent,
				(int) $menu_item->ID,
				$archive_slugs
			);

			self::append_archive_children( $tree_item, $menu_item, $archive_slugs );
			self::append_service_cluster_children( $tree_item, $menu_item );

			$tree[ (string) $menu_item->ID ] = $tree_item;
		}

		return $tree;
	}

	/**
	 * Convert a nav menu item into a sitemap tree item.
	 *
	 * @param object $menu_item The WordPress nav menu item.
	 * @return DIS_TreeItem
	 */
	private static function build_tree_item_from_menu_item( $menu_item ) {
		if ( 'custom' === $menu_item->type ) {
			return new DIS_TreeItem(
				$menu_item->title,
				sanitize_title( $menu_item->title ),
				$menu_item->url ?: '',
				true
			);
		}

		$object = get_post( $menu_item->object_id );
		$name   = $menu_item->title;
		$slug   = $menu_item->post_name ?: sanitize_title( $menu_item->title );
		$link   = $menu_item->url ?: '';
		$external = true;

		if ( $object instanceof WP_Post ) {
			$name = $object->post_title;
			$slug = $object->post_name;
			$link = get_permalink( $object->ID );
			$external = false;
		}

		return new DIS_TreeItem(
			$name,
			$slug,
			$link,
			$external
		);
	}

	/**
	 * Attach archive contents below archive pages included in the menu.
	 *
	 * @param DIS_TreeItem $tree_item The tree node to enrich.
	 * @param object       $menu_item The source nav menu item.
	 * @param array        $archive_slugs Archive-page slug to post-type map.
	 * @return void
	 */
	private static function append_archive_children( DIS_TreeItem $tree_item, $menu_item, array $archive_slugs ) {
		$type = self::get_archive_type_from_menu_item( $menu_item, $archive_slugs );
		if ( ! $type ) {
			return;
		}

		$results = DIS_ContentsManager::get_sitemap_posts( $type );
		foreach ( $results as $result ) {
			$child_item = new DIS_TreeItem(
				$result->post_title,
				$result->post_name,
				get_permalink( $result ),
				false
			);

			self::append_service_cluster_post_children( $child_item, $result );

			$tree_item->children[ $result->post_name ] = $child_item;
		}
	}

	/**
	 * Resolve the archive post type represented by a menu item.
	 *
	 * @param object $menu_item The source nav menu item.
	 * @param array  $archive_slugs Archive-page slug to post-type map.
	 * @return string
	 */
	private static function get_archive_type_from_menu_item( $menu_item, array $archive_slugs ) {
		$object = get_post( $menu_item->object_id );

		if ( $object instanceof WP_Post ) {
			$matched_type = $archive_slugs[ $object->post_name ] ?? '';
			if ( $matched_type ) {
				return $matched_type;
			}
		}

		$menu_path = wp_parse_url( $menu_item->url, PHP_URL_PATH );
		if ( ! is_string( $menu_path ) || '' === $menu_path ) {
			return '';
		}

		$menu_slug = basename( untrailingslashit( $menu_path ) );

		return $archive_slugs[ $menu_slug ] ?? '';
	}

	/**
	 * Attach services below service-cluster items included in the menu tree.
	 *
	 * @param DIS_TreeItem $tree_item The tree node to enrich.
	 * @param object       $menu_item The source nav menu item.
	 * @return void
	 */
	private static function append_service_cluster_children( DIS_TreeItem $tree_item, $menu_item ) {
		$object = get_post( $menu_item->object_id );

		if ( ! $object instanceof WP_Post ) {
			return;
		}

		self::append_service_cluster_post_children( $tree_item, $object );
	}

	/**
	 * Attach services below a service-cluster post.
	 *
	 * @param DIS_TreeItem $tree_item The tree node to enrich.
	 * @param WP_Post      $cluster_post The service-cluster post.
	 * @return void
	 */
	private static function append_service_cluster_post_children( DIS_TreeItem $tree_item, WP_Post $cluster_post ) {
		if ( DIS_SERVICE_CLUSTER_POST_TYPE !== $cluster_post->post_type ) {
			return;
		}

		$services = DIS_ContentsManager::get_service_list( 'priority', $cluster_post->ID );
		foreach ( $services as $service ) {
			$tree_item->children[ $service->post_name ] = new DIS_TreeItem(
				$service->post_title,
				$service->post_name,
				get_permalink( $service ),
				false
			);
		}
	}

}

if ( ! function_exists( 'dis_render_sitemap_html' ) ) {
	/**
	 * Public renderer for the sitemap HTML output.
	 *
	 * @param DIS_TreeItem[]|null $tree Optional sitemap tree.
	 * @return string
	 */
	function dis_render_sitemap_html( ?array $tree = null ) {
		return DIS_NavigationManager::render_sitemap_html( $tree );
	}
}
