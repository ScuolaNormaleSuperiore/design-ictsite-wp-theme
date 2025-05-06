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
			$item_desc    = is_home() ? $site_tagline: self::clean_and_truncate_text( $post->post_content, 256 );
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
			if ( $item->menu_item_parent === '0' ) {
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

	public static function get_page_link( $page_slug ){
		$slug_trans = DIS_MultiLangManager::get_dis_translation( $page_slug, 'DIS_ActivationItems', 'en' );
		$post       = get_page_by_path( $slug_trans, OBJECT, 'page' );
		if ( ! $post ) return null;
		$translated_id = DIS_MultiLangManager::get_post( $post->ID );
		return get_permalink( $translated_id );
	}

	public static function get_hp_office_list(){
		$args = array(
			'post_type'      => DIS_OFFICE_POST_TYPE,
			'posts_per_page' => -1,
			'status'         => 'publish',
			'meta_query'     => array(
				array(
					'key'     => 'show_in_home_page',
					'value'   => '1',
					'compare' => '='
				)
			)
		);
		$query = new WP_Query( $args );
		if ($query->have_posts()) {
			return $query->posts;
		}
		return array();
	}

	public static function get_hp_cluster_list(){
		$args = array(
			'post_type'      => DIS_CLUSTER_POST_TYPE,
			'posts_per_page' => -1,
			'status'         => 'publish',
			'meta_query'     => array(
				array(
					'key'     => 'show_in_home_page',
					'value'   => '1',
					'compare' => '='
				)
			)
		);
		$query = new WP_Query( $args );
		if ($query->have_posts()) {
			return $query->posts;
		}
		return array();
	}

	public static function get_hp_events_list(){
		$args = array(
			'post_type'      => DIS_EVENT_POST_TYPE,
			'posts_per_page' => -1,
			'status'         => 'publish',
			'meta_query'     => array(
				array(
					'key'     => 'show_in_home_page',
					'value'   => '1',
					'compare' => '='
				)
			)
		);
		$query = new WP_Query( $args );
		if ($query->have_posts()) {
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
		$post_title = get_the_title( $item ); 
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


	// UTILITIES.

	public static function clean_and_truncate_text( $text, $size=500, $split=false ) {
		// Remove HTML tags.
		$clean_text = wp_strip_all_tags( $text );
		// Truncate tags.
		if ( strlen( $clean_text ) > $size ) {
			if ( $split ){
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

}
