<?php
/**
 * Definition of the Contents Manager.
 *
 * @package Design_ICT_Site
 */
class DIS_OG_Wrapper {
	public string $id           = '';
	public string $title        = '';
	public string $shared_title = '';
	public string $type         = '';
	public string $description  = '';
	public string $url          = '';
	public string $locale       = '';
	public string $site_title   = '';
	public string $site_tagline = '';
	public string $image        = '';
	public string $img_width    = '';
	public string $img_height   = '';
	public string $img_type     = '';
	public string $site_url     = '';
	public string $domain       = '';
}

class DIS_Search_Wrapper {
	public string $id            = '';
	public string $title         = '';
	public string $description   = '';
	public string $slug          = '';
	public string $link          = '';
	public string $date          = '';
	public string $long_date     = '';
	public string $content_type  = '';
	public string $type          = '';
	public string $type_link     = '';
	public string $category      = '';
	public string $category_link = '';
	public string $image_url     = '';
	public string $image_alt     = '';
	public string $image_title   = '';
}


/**
 * The manager for the site contents.
 *
 */
class DIS_ContentsManager {
	/**
	 * Constructor of the Manager.
	 */
	public function __construct() {}

	/**
	 * Function to retrieve the og data needed to share contents on social and for SEO optimization.
	 *
	 * @return object
	 */
	public static function get_og_data() {
		global $post;
		$og_data    = new DIS_OG_Wrapper();
		$item_id   = $post && $post->ID ? $post->ID : '';
		$item_type = $item_id && $post->post_type ? $post->post_type : 'homepage';
		if ( is_home() || ( $item_id && in_array( $item_type, MULTILANG_POST_TYPES ) ) ) {
			// Get data to fill OG structure.
			$site_title   = DIS_OptionsManager::dis_get_option( 'site_title', 'dis_opt_options' );
			$site_tagline = DIS_OptionsManager::dis_get_option( 'site_tagline', 'dis_opt_options' );
			$item_title   = is_home() ? $site_title : $post->post_title;
			$item_desc    = is_home() ? $site_tagline: self::clean_and_truncate_text( $post->post_content, DIS_ACF_SHORT_TEXT_LENGTH );
			$item_url     = get_permalink();
			$img_id       = is_home() ? null : get_post_thumbnail_id( $item_id );
			$img_array    = wp_get_attachment_image_src( $img_id, 'large' );
			$file_path    = $img_id ? get_attached_file( $img_id ) : '';
			$file_info    = $img_id ? wp_check_filetype( $file_path ) : '';
			$img_type     = $img_id ? $file_info['type'] : '';
			$item_image   = $img_id && count( $img_array ) ? $img_array[0] : '';
			$site_url     = site_url();
			$parsed_url   = parse_url( $site_url );
			$domain       = $parsed_url['host'];
			$shared_title = is_home() ? $site_title : $site_title . ' - ' . $post->post_title;
			// Fill OG data:
			$og_data->id           = is_home() ? $item_id : 0;
			$og_data->title        = $item_title;
			$og_data->type         = $item_type;
			$og_data->description  = $item_desc;
			$og_data->site_url     = $site_url;
			$og_data->url          = is_home() ? $site_url : $item_url;
			$og_data->locale       = DIS_MultiLangManager::get_current_language();
			$og_data->site_title   = $site_title;
			$og_data->site_tagline = $site_tagline;
			$og_data->image        = $item_image;
			$og_data->img_width    = $img_id && count( $img_array ) > 1 ? $img_array[1] : '0';
			$og_data->img_height   = $img_id && count( $img_array ) > 2 ? $img_array[2] : '0';
			$og_data->img_type     = $img_type;
			$og_data->domain       = $domain;
			$og_data->shared_title = $shared_title;
		}
		return $og_data;
	}

	public static function get_hp_sections() {
		return DIS_HP_SECTIONS;
	}

	public static function get_hp_section_list() {
		$result = [];
		foreach ( DIS_HP_SECTIONS as $key => $item ) {
				$result[$key] = $item['name'];
		}
		return $result;
	}

	public static function get_hp_section_options( $only_active= false ) {
		$sections = DIS_OptionsManager::dis_get_option( 'site_sections', 'dis_opt_hp_sections' );
		$results  = array();
		if ( $sections )  {
			foreach ( $sections as $section ) {
				if ( ( $only_active === 'false' ) || $section['enabled'] !== 'false' ) {
					array_push( $results, $section );
				}
			}
		}
		return $results;
	}

	public static function get_menu_tree_by_items( $menuitems ) {
		$menu_tree = array();
		foreach ( $menuitems As $item ) {
			if ( strpos( $item->url, 'how-to' ) !== false ) {
				$menu_tree[$item->ID] = array(
					'element'  => $item,
					'children' => self::get_how_to_posts(),
				);
			} else if ( $item->menu_item_parent === '0' ) {
				$menu_tree[$item->ID] = array(
					'element'  => $item,
					'children' => array(),
				);
			} else {
				if( array_key_exists( $item->menu_item_parent, $menu_tree ) && $menu_tree[$item->menu_item_parent] !== null ) {
					array_push( $menu_tree[$item->menu_item_parent]['children'], $item );
				}
			}
		}
		return $menu_tree;
	}


	/**
	 * Get all the service with the field how_to_title filled.
	 *
	 * @return array
	 */
	public static function get_how_to_posts() {
		$result = array();
		$args = array(
			'post_type'      => DIS_SERVICE_ITEM_POST_TYPE,
			'posts_per_page' => -1,
			'post_status'    => 'publish',
			'order'          => 'ASC',
			'orderby'        => 'title',
			'meta_query'     => array(
				array(
					'key'     => 'how_to_title',
					'value'   => '',
					'compare' => '!=',
				)
			)
		);
		$query = new WP_Query( $args );
		if ( $query->have_posts() ) {
			return $query->posts;
		}
		return $result;
	}

	public static function get_office_list(){
		$args = array(
			'post_type'      => DIS_OFFICE_POST_TYPE,
			'posts_per_page' => -1,
			'post_status'    => 'publish',
		);
		$query = new WP_Query( $args );
		if ( $query->have_posts() ) {
			return $query->posts;
		}
		return array();
	}

	public static function get_cluster_list( $hp = false, $order = 'title' ) {
			$args = array();
		if ( $order === 'title') {
			$args = array(
				'post_type'      => DIS_SERVICE_CLUSTER_POST_TYPE,
				'posts_per_page' => -1,
				'post_status'    => 'publish',
				'order'          => 'ASC',
				'orderby'        => 'title',
			);
		} else {
			$args = array(
				'post_type'      => DIS_SERVICE_CLUSTER_POST_TYPE,
				'posts_per_page' => -1,
				'post_status'    => 'publish',
				'meta_key'       => 'priority',
				'orderby'        => array(
					'meta_value_num' => 'ASC',
					'title'          => 'ASC',
				),
			);
		}
		if ( $hp ) {
			$args['meta_query'] = array(
				array(
					'key'     => 'show_in_home_page',
					'value'   => '1',
					'compare' => '=',
				)
			);
		}
		$query = new WP_Query( $args );
		if ( $query->have_posts() ) {
			return $query->posts;
		}
		return array();
	}

	/**
	 * Return ICT people.
	 *
	 * @param string $order
	 * @return array
	 */
	public static function get_person_list( $order='title' ) {
		$args = array(
			'post_type'      => DIS_PERSON_POST_TYPE,
			'posts_per_page' => -1,
			'post_status'    => 'publish',
			'order'          => 'ASC',
			'orderby'        => $order,
		);
		$query = new WP_Query( $args );
		if ( $query->have_posts() ) {
			return $query->posts;
		}
		return array();
	}

	/**
	 * Return generic post type list.
	 *
	 * @param string $post_type
	 * @param string $order
	 * @return array
	 */
	public static function get_generic_post_list( $post_type, $order = 'title', $params = array() ) {
		$args = array(
			'post_type'      => $post_type,
			'posts_per_page' => -1,
			'post_status'    => 'publish',
			'order'          => 'ASC',
			'orderby'        => $order,
		);
		// Add taxonomy filter, if selected.
		if ( array_key_exists( 'taxonomy', $params ) && $params['taxonomy'] !== '' ) {
			$args['tax_query'] = array(
				array(
					'taxonomy' => $params['taxonomy'],
					'field'    => 'slug',
					'terms'    => $params['terms'],
				),
			);
		}
		// Add text check, if present.
		if ( array_key_exists( 'search_string', $params ) && $params['search_string'] !=='' ) {
			$args['s'] = $params['search_string'];
		}
		// Execute the query.
		$query = new WP_Query( $args );
		if ( $query->have_posts() ) {
			return $query->posts;
		}
		return array();
	}


	/**
	 * Group posts by category name.
	 *
	 * @param WP_Post[] $items.
	 * @return array Array.
	 */
	public static function items_per_category( array $items, string $taxonomy ): array {
		$items_per_category = [];
		foreach ( $items as $item ) {
			$terms = get_the_terms( $item->ID, $taxonomy );
			if ( empty( $terms ) || is_wp_error( $terms ) ) {
				continue;
			}
			foreach ( $terms as $term ) {
				$items_per_category[ $term->name ][] = $item;
			}
		}
		ksort( $items_per_category );
		return $items_per_category;
	}



	public static function get_generic_post_query( $params ) {
		$args = array(
			'post_type'      => $params['post_type'],
			'post_status'    => $params['post_status'] ?? 'publish',
			'order'          => $params['order'] ?? 'ASC',
			'orderby'        => $params['orderby'] ?? 'title',
			'paged'          => $params['current_page'] ?? 1,
			'posts_per_page' => $params['posts_per_page'] ?? -1,
		);
		// Search for a string.
		if ( $params['search_string'] ) {
			$args['s'] = $params['search_string'];
		}
		// Filter by taxonomy.
		if ( ! empty( $params['taxonomy'] ) && ! empty( $params['terms'] ) ) {
			$args['tax_query'] = array(
				array(
					'taxonomy' => $params['taxonomy'],
					'field'    => 'slug',
					'terms'    => (array) $params['terms'],
				),
			);
		}
		return new WP_Query( $args );
	}

	/**
	 * Get service list order by title or by priority-title.
	 *
	 * @param string $order ( 'title' || 'priority' )
	 * @return array
	 */
	public static function get_service_list( $order='title', $cluster_id=null) {
		$args = array();
		if ( $order === 'title') {
			$args = array(
				'post_type'      => DIS_SERVICE_ITEM_POST_TYPE,
				'posts_per_page' => -1,
				'post_status'    => 'publish',
				'order'          => 'ASC',
				'orderby'        => 'title',
			);
		} else {
			$args = array(
				'post_type'      => DIS_SERVICE_ITEM_POST_TYPE,
				'posts_per_page' => -1,
				'post_status'    => 'publish',
				'meta_key'       => 'priority',
				'orderby'        => array(
					'meta_value_num' => 'ASC',
					'title'          => 'ASC'
				),
			);
		}
		if ( $cluster_id ) {
			$args['meta_query'] = array(
				array(
					'key'     => 'cluster',
					'compare' => 'LIKE',
					'value'   => '"' . $cluster_id . '"'
				)
			);
		}
		$query = new WP_Query( $args );
		if ( $query->have_posts() ) {
			return $query->posts;
		}
		return array();
	}


	public static function group_services_by_cluster( $services) {
		$serv_by_cat = array();
		// Group by category.
		foreach ( $services as $service ) {
			$clusters = DIS_CustomFieldsManager::get_field( 'cluster', $service->ID );
			foreach ( $clusters as $cluster ) {
				if ( array_key_exists( $cluster->post_title, $serv_by_cat ) ) {
					array_push( $serv_by_cat[ $cluster->post_title ]['children'], $service );
				} else {
					$item = array(
						'title'    => $cluster->post_title,
						'item'     => $cluster,
						'children' => array( $service ),
					);
					$serv_by_cat[ $cluster->post_title ] = $item;
				}
			}
		}
		return $serv_by_cat;
	}


	/**
	 * Get service list order by the status of the user.
	 *
	 * @param string $status
	 * @return array
	 */
	public static function get_service_list_by_user_status( $status ) {
		$args = [
			'post_type'      => DIS_SERVICE_ITEM_POST_TYPE,
			'post_status'    => 'publish',
			'posts_per_page' => -1,
			'orderby'        => 'title',
			'order'          => 'ASC',
			'tax_query'      => [
				[
				'taxonomy' => DIS_USER_STATUS_TAXONOMY,
				'field'    => 'slug',
				'terms'    => $status,
				]
			],
		];
		$query = new WP_Query( $args );
		if ( $query->have_posts() ) {
			return $query->posts;
		}
		return array();
	}

	/**
	 * Get Home Page items by post-type.
	 *
	 * @return array
	 */
	public static function get_hp_item_list( $type ){
		$args = array(
			'post_type'      => $type,
			'posts_per_page' => 4,
			'post_status'    => 'publish',
			'meta_query'     => array(
				array(
					'key'     => 'show_in_home_page',
					'value'   => '1',
					'compare' => '='
				)
			)
		);
		$query = new WP_Query( $args );
		if ( $query->have_posts() ) {
			return $query->posts;
		}
		return array();
	}

	/**
	 * Get Home Page banners.
	 *
	 * @return array
	 */
	public static function get_hp_banner_list(){
		$args = array(
			'post_type'      => DIS_BANNER_POST_TYPE,
			'posts_per_page' => -1,
			'post_status'    => 'publish',
			'orderby'        => 'meta_value_num',
			'meta_key'       => 'priority',
			'order'          => 'ASC',
		);
		$query = new WP_Query( $args );
		if ( $query->have_posts() ) {
			return $query->posts;
		}
		return array();
	}

	/**
	 * Get Home Page sponsors.
	 *
	 * @return array
	 */
	public static function get_hp_sponsor_list(){
		$args = array(
			'post_type'      => DIS_SPONSOR_POST_TYPE,
			'posts_per_page' => 4,
			'post_status'    => 'publish',
			'orderby'        => 'meta_value_num',
			'meta_key'       => 'priority',
			'order'          => 'ASC',
		);
		$query = new WP_Query( $args );
		if ( $query->have_posts() ) {
			return $query->posts;
		}
		return array();
	}

	public static function get_image_metadata( $item, $image_size = 'full', $default_img_url = '/assets/img/default-image.png' ) {
		$result = array(
			'image_url'     => '',
			'image_alt'     => '',
			'image_title'   => '',
			'image_caption' => '',
		);
		$image_id   = get_post_thumbnail_id( $item->ID );
		$post_title = $item->post_title;
		if ( $image_id !== 0 ) {
			$result['image_url']     = get_the_post_thumbnail_url( $item, $image_size );
			$image_title             = get_the_title( $image_id );
			$result['image_title']   = $image_title ? $image_title : $post_title;
			$image_alt               = get_post_meta( $image_id, '_wp_attachment_image_alt', TRUE );
			$result['image_alt']     = $image_alt ? $image_alt : $post_title;
			$image_caption           = wp_get_attachment_caption( $image_id );
			$result['image_caption'] = $image_caption ? $image_caption :  $post_title;
		} else {
			$result['image_url']     = DIS_THEME_URL . $default_img_url;
			$result['image_title']   = $post_title;
			$result['image_alt']     = $post_title;
			$result['image_caption'] = $post_title;
		}
		return $result;
	}

	/**
	 * Get page anchestor.
	 *
	 * @param WP_Post $page
	 * @return int
	 */
	public static function get_page_anchestor_id( $page ) {
		if ( $page->post_parent) {
			$ancestors = get_post_ancestors( $page->ID );
			$root      = count( $ancestors ) - 1;
			$parent    = $ancestors[ $root ];
		} else {
			$parent = $page->ID;
		}
		return $parent;
	}

	// RELATED ITEMS.

	public static function get_related_faq(  $post ) {
		$results = array();
		$args    = array(
			'post_type'      => DIS_FAQ_POST_TYPE,
			'posts_per_page' => -1,
			'meta_query'     => array(
				array(
					'key'     => 'service',
					'value'   => '"' . $post->ID . '"',
					'compare' => 'LIKE'
				)
				),
			'orderby' => 'title',
			'order'   => 'ASC',
		);
		$query = new WP_Query( $args );
		if ( $query->have_posts() ) {
			$results = $query->posts;
		}
		return $results;
	}

	public static function get_person_offices( $post ) {
		$results = array();
		$args    = array(
			'post_type'      => DIS_OFFICE_POST_TYPE,
			'posts_per_page' => -1,
			'meta_query'     => array(
				array(
					'key'     => 'members',
					'value'   => '"' . $post->ID . '"',
					'compare' => 'LIKE',
				),
			),
			'orderby' => 'title',
			'order'   => 'ASC',
		);
		$query = new WP_Query( $args );
		if ( $query->have_posts() ) {
			$results = $query->posts;
		}
		return $results;
	}

	public static function get_place_offices( $post ) {
		$results = array();
		$args    = array(
			'post_type'      => DIS_OFFICE_POST_TYPE,
			'posts_per_page' => -1,
			'meta_query'     => array(
				array(
					'key'     => 'places',
					'value'   => '"' . $post->ID . '"',
					'compare' => 'LIKE',
				)
				),
			'orderby' => 'title',
			'order'   => 'ASC',
		);
		$query = new WP_Query( $args );
		if ( $query->have_posts() ) {
			$results = $query->posts;
		}
		return $results;
	}

	public static function get_office_projects( $post ) {
		$results = array();
		$args    = array(
			'post_type'      => DIS_PROJECT_POST_TYPE,
			'posts_per_page' => -1,
			'meta_query'     => array(
				array(
					'key'     => 'office',
					'value'   => '"' . $post->ID . '"',
					'compare' => 'LIKE',
				)
			),
			'orderby' => 'title',
			'order'   => 'ASC',
		);
		$query = new WP_Query( $args );
		if ( $query->have_posts() ) {
			$results = $query->posts;
		}
		return $results;
	}

	// UTILITIES.

	/**
	 * Get the string of the objects.
	 *
	 * @param [object] $posts
	 * @param boolean $with_link
	 * @return string
	 */
	public static function get_string_list_from_posts( $posts, $with_link = false ): string {
		if ( ! empty( $posts ) && is_array( $posts ) ) {
			// Return list without links.
			if ( $with_link === false ) {
				return implode( ', ', wp_list_pluck( $posts, 'post_title' ) ) ;
			}
			// Return the list with the links.
			$links = array();
			foreach ( $posts as $item ) {
				$links[] = sprintf(
					'<a href="%1$s">%2$s</a>',
					esc_url( get_permalink( $item ) ),
					esc_html( get_the_title( $item ) )
				);
			}
			return implode( ', ', $links );
		};
		return '';
	}

	/**
	 * Get a string of topics with the link.
	 *
	 * @param [object] $terms
	 * @param boolean $with_link
	 * @return string
	 */
	public static function get_topic_string_from_terms( $terms, $with_link = false ): string {
		if ( ! empty( $terms ) && is_array( $terms ) ) {
			// Return list without links.
			if ( $with_link === false ) {
				return implode( ', ', wp_list_pluck( $terms, 'post_title' ) ) ;
			}
			// Return the list with the links.
			$links    = array();
			$faq_page = DIS_MultiLangManager::get_page_link( FAQ_PAGE_SLUG );
			foreach ( $terms as $item ) {
				$full_link = $faq_page . '#' . $item->slug;
				$links[] = sprintf(
					'<a href="%1$s">%2$s</a>',
					esc_url( $full_link ),
					esc_html( $item->name )
				);
			}
			return implode( ', ', $links );
		};
		return '';
	}

	public static function clean_and_truncate_text( $text, $size = 500, $split = false ) {
		// Remove HTML tags.
		$clean_text = wp_strip_all_tags( $text );
		// Truncate tags.
		if ( strlen( $clean_text ) > $size ) {
			if ( $split) {
				$truncated_text = substr( $clean_text, 0, $size ) . '...';
			} else {
				$truncated_text = mb_substr( $clean_text, 0, $size );
				$last_space     = mb_strrpos( $truncated_text, ' ' );
				if ( $last_space !== false ) {
					$truncated_text = mb_substr( $truncated_text, 0, $last_space ) . '...';
				}
			}
		} else {
			$truncated_text = $clean_text;
		}
		return $truncated_text;
	}

	public static function increment_visit_counter( $page_id ) {
		if ( DIS_OptionsManager::dis_get_option( 'service_page_counter_enabled', 'dis_opt_advanced_settings' ) === 'true' ) {
			// Ignore ADMIN visits.
			if ( current_user_can( 'manage_options' ) ) {
				return;
			}
			// Ignore AJAX calls.
			if ( wp_doing_ajax() ) {
				return;
			}
			if ( DIS_OptionsManager::dis_get_option( 'ignore_robots', 'dis_opt_advanced_settings' ) === 'true' ) {
				// Ignore some bots.
				$user_agent = $_SERVER['HTTP_USER_AGENT'] ? sanitize_text_field( $_SERVER['HTTP_USER_AGENT'] ) : '';
				$bots       = BOT_LABEL;
				foreach ( $bots as $bot ) {
					if ( stripos( $user_agent, $bot ) !== false ) {
						return;
					}
				}
			}
			// Get actual value.
			$visits = DIS_CustomFieldsManager::get_field( 'visit_counter', $page_id );
			if ( ! is_numeric( $visits ) ) {
				$visits = 0;
			}
			// Update the counter.
			$visits++;
			DIS_CustomFieldsManager::update_field( 'visit_counter', $visits, $page_id );
		}
	}

	/**
	 * Returns the list of post types that are searchable.
	 *
	 * @return array
	 */
	public static function searchable_post_types(): array {
		return array(
			array(
				'name' => dis_ct_data()[ DIS_EVENT_POST_TYPE ]['plural_name'],
				'slug' => DIS_EVENT_POST_TYPE,
			),
			array(
				'name' => dis_ct_data()[ DIS_NEWS_POST_TYPE ]['plural_name'],
				'slug' => DIS_NEWS_POST_TYPE,
			),
			array(
				'name' => dis_ct_data()[ DIS_PROJECT_POST_TYPE ]['plural_name'],
				'slug' => DIS_PROJECT_POST_TYPE,
			),
			array(
				'name' => dis_ct_data()[ DIS_SERVICE_CLUSTER_POST_TYPE ]['plural_name'],
				'slug' => DIS_SERVICE_CLUSTER_POST_TYPE,
			),
			array(
				'name' => dis_ct_data()[ DIS_SERVICE_ITEM_POST_TYPE ]['plural_name'],
				'slug' => DIS_SERVICE_ITEM_POST_TYPE,
			),
			array(
				'name' => dis_ct_data()[ DIS_DEFAULT_POST ]['plural_name'],
				'slug' => DIS_DEFAULT_POST,
			),
	);
	}

	private static function sort_by_name( array $items ) {
		usort(
			$items,
			function ( $a, $b ) {
				return strcmp( strtolower( $a['name'] ), strtolower( $b['name'] ) );
			}
		);
		return $items;
	}

	public static function get_content_types_with_results() {
		$content_types              = self::searchable_post_types();
		$content_types_with_results = array();
		foreach ( $content_types as $ct) {
			$the_query = new WP_Query(
				array(
					'post_type'   => $ct['slug'],
					'post_status' => 'publish',
				)
			);
			$num_results = $the_query->found_posts;
			if ( $num_results > 0 ) {
				array_push( $content_types_with_results, $ct );
			}
			wp_reset_postdata();
		}
		return self::sort_by_name( $content_types_with_results );
	}

	public static function get_site_search_query( $selected_contents, $search_string, $page_size) {
		$params = array(
			'paged'          => get_query_var( 'paged', 1 ),
			'post_status'    => 'publish',
			'posts_per_page' => $page_size,
			'orderby'        => 'title',
			'order'          => 'ASC',
		);
		if ( $search_string ) {
			$params['s'] = $search_string;
		}
		if ( count( $selected_contents ) > 0 ) {
			$params['post_type'] = $selected_contents;
		}
		$the_query = new WP_Query( $params );
		return $the_query;
	}


	public static function get_main_category( $post ){
		$categories = get_the_category();
		if ( ! empty( $categories ) ) {
			return $categories[0];
		}
		return null;
	}

	public static function format_long_date( string $date_str, bool $include_year = true ): string {
		if ( $date_str === '' ) {
			return '';
		}
		try {
			$tz   = new DateTimeZone( 'Europe/Rome' );
			$date = DateTime::createFromFormat( 'j/n/Y', $date_str, $tz );
			if ( ! $date ) {
				return '';
			}
			// Pattern based on the parameter.
			$pattern = $include_year ? 'd MMMM yyyy' : 'd MMMM';
			// Per performance, reuse IntlDateFormatter in static cache.
			static $formatters = [];
			if ( ! isset( $formatters[ $pattern ] ) ) {
				$formatters[ $pattern ] = new IntlDateFormatter(
					'it_IT',
					IntlDateFormatter::LONG,
					IntlDateFormatter::NONE,
					'Europe/Rome',
					IntlDateFormatter::GREGORIAN,
					$pattern
				);
			}
			return $formatters[ $pattern ]->format( $date );
		} catch ( Exception $e ) {
			return '';
		}
	}

	/**
	 * Wrap a specific content type into a generic Search Wrapper.
	 *
	 * @param mixed $post
	 * @return DIS_Search_Wrapper
	 */
	public static function wrap_search_result( $post ): DIS_Search_Wrapper {
		$item = null;
		switch ( $post->post_type ) {
			case DIS_EVENT_POST_TYPE:
				$item = self::wrap_event( $post );
				break;
			case DIS_OFFICE_POST_TYPE:
				$item = self::wrap_office( $post );
				break;
			case DIS_SERVICE_CLUSTER_POST_TYPE:
			case DIS_SERVICE_ITEM_POST_TYPE:
			case DIS_PROJECT_POST_TYPE:
			case DIS_NEWS_POST_TYPE:
			case DIS_PLACE_POST_TYPE:
				$item = self::wrap_service( $post );
				break;
			case DIS_DEFAULT_PAGE:
				$item = self::wrap_page( $post );
				break;
			default:
				$item = self::wrap_article( $post );
				break;
		}
		return $item;
	}

	/**
	 * Wrap a DIS-Event.
	 * @param mixed $post
	 * @return DIS_Search_Wrapper
	 */
	private static function wrap_event( $post ): DIS_Search_Wrapper {
		$result                = new DIS_Search_Wrapper();
		$result->id            = $post->ID;
		$result->title         = $post->post_title;
		$result->slug          = $post->post_name;
		$result->content_type  = $post->post_type;
		$result->link          = get_permalink( $post );
		$start_date            = DIS_CustomFieldsManager::get_field( 'start_date', $post->ID );
		$result->date          = $start_date ? $start_date : '';
		$result->long_date     = self::format_long_date( $result->date );
		$description           = DIS_CustomFieldsManager::get_field( 'short_description', $post->ID );
		$result->description   = $description ? $description : '';
		$result->type          = dis_ct_data()[ $post->post_type ]['plural_name'];
		$result->type_link     = DIS_MultiLangManager::get_archive_link( $post->post_type );
		$category              = self::get_main_category( $post );
		$result->category      = $category ? $category->name : '';
		$result->category_link = $category ? DIS_MultiLangManager::get_archive_link( $post->post_type ) . '?category=' .  $category->name : '';
		self::fill_image_data( $post, $result );
		return $result;
	}

	private static function wrap_office( $post ): DIS_Search_Wrapper {
		$result                = new DIS_Search_Wrapper();
		$result->id            = $post->ID;
		$result->title         = $post->post_title;
		$result->slug          = $post->post_name;
		$result->content_type  = $post->post_type;
		$result->link          = get_permalink( $post );
		$result->date          = get_the_date( 'j/n/Y' );
		$result->long_date     = get_the_date( 'j F Y' );
		$result->description   = wp_strip_all_tags( get_the_content( $post ) );
		$result->type          = dis_ct_data()[ $post->post_type ]['plural_name'];
		$result->type_link     = DIS_MultiLangManager::get_archive_link( $post->post_type );
		$category              = self::get_main_category( $post );
		$result->category      = $category ? $category->name : '';
		$result->category_link = $category ? DIS_MultiLangManager::get_archive_link( $post->post_type ) . '?category=' .  $category->name : '';
		self::fill_image_data( $post, $result );
		return $result;
	}

	private static function wrap_service( $post ): DIS_Search_Wrapper {
		$result                = new DIS_Search_Wrapper();
		$result->id            = $post->ID;
		$result->title         = $post->post_title;
		$result->slug          = $post->post_name;
		$result->content_type  = $post->post_type;
		$result->link          = get_permalink( $post );
		$result->date          = get_the_date( 'j/n/Y' );
		$result->long_date     = get_the_date( 'j F Y' );
		$description           = DIS_CustomFieldsManager::get_field( 'short_description', $post->ID );
		$result->description   = $description;
		$result->type          = dis_ct_data()[ $post->post_type ]['plural_name'];
		$result->type_link     = DIS_MultiLangManager::get_archive_link( $post->post_type );
		$category              = self::get_main_category( $post );
		$result->category      = $category ? $category->name : '';
		$result->category_link = $category ? DIS_MultiLangManager::get_archive_link( $post->post_type ) . '?category=' .  $category->name : '';
		self::fill_image_data( $post, $result );
		return $result;
	}

	private static function wrap_page( $post ): DIS_Search_Wrapper {
		$result                = new DIS_Search_Wrapper();
		$result->id            = $post->ID;
		$result->title         = $post->post_title;
		$result->slug          = $post->post_name;
		$result->content_type  = $post->post_type;
		$result->link          = get_permalink( $post );
		$result->date          = get_the_date( 'j/n/Y' );
		$result->long_date     = get_the_date( 'j F Y' );
		$description           = get_the_excerpt( $post->ID );
		if ( ! $description ) {
			$description = wp_strip_all_tags( get_the_content( $post ) );
		}
		$result->description   = $description;
		$result->type          = dis_ct_data()[ $post->post_type ]['plural_name'];
		$result->type_link     = DIS_MultiLangManager::get_archive_link( $post->post_type );
		$category              = self::get_main_category( $post );
		$result->category      = $category ? $category->name : '';
		$result->category_link = $category ? DIS_MultiLangManager::get_archive_link( $post->post_type ) . '?category=' .  $category->name : '';
		self::fill_image_data( $post, $result );
		return $result;
	}

	private static function wrap_article( $post ) {
		$result                = new DIS_Search_Wrapper();
		$result->id            = $post->ID;
		$result->title         = $post->post_title;
		$result->slug          = $post->post_name;
		$result->content_type  = $post->post_type;
		$result->link          = get_permalink( $post );
		$result->date          = get_the_date( 'j/n/Y' );
		$result->long_date     = get_the_date( 'j F Y' );
		$description           = DIS_CustomFieldsManager::get_field( 'short_description', $post->ID );
		$result->description   = $description ? $description : '';
		$result->type          = dis_ct_data()[ $post->post_type ]['plural_name'];
		$result->type_link     = DIS_MultiLangManager::get_archive_link( $post->post_type );
		$category              = self::get_main_category( $post );
		$result->category      = $category ? $category->name : '';
		$result->category_link = $category ? DIS_MultiLangManager::get_archive_link( $post->post_type ) . '?category=' .  $category->name : '';
		self::fill_image_data( $post, $result );
		return $result;
	}

	private static function fill_image_data( $post, &$result) {
		$image_data          = self::get_image_metadata( $post, 'thumbnail', '/assets/img/logo-default.png' );
		$result->image_url   = $image_data['image_url'];
		$result->image_alt   = $image_data['image_alt'];
		$result->image_title = $image_data['image_title'];
	}


	/**
	 * Return the list of the post of a certain type to show in the sitemap.
	 * 
	 * @param array $post_type
	 * @return array of slugs (strings)
	 */
	public static function get_sitemap_posts( $post_type ) {
		$query = new WP_Query(
			array(
				'posts_per_page' => -1,
				'post_type'      => $post_type,
				'post_status'    => 'publish',
				'orderby'        => 'post_date',
				'order'          => 'DESC',
			)
		);
		return $query->posts;
	}


}
