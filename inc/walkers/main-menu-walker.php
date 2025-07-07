<?php
/**
 * Nav Menu API: Main_Menu_Walker class
 *
 * @package WordPress
 * @subpackage Nav_Menus
 * @since 4.6.0
 */

/**
 * Custom class used to implement an HTML list of nav menu items.
 *
 * @since 3.0.0
 *
 * @see Walker
 */


class Main_Menu_Walker extends Walker_Nav_Menu {

	private static function menu_tree_by_items( $menuitems ) {
		$menu_tree = array();
		foreach ( $menuitems As $item ) {
			if ( $item->menu_item_parent === '0' ) {
				$menu_tree[$item->ID] = array(
					'element'  => $item,
					'children' => array(),
				);
			} else {
				if( array_key_exists( $item->menu_item_parent, $menu_tree ) && $menu_tree[ $item->menu_item_parent ] !== null ) {
					array_push( $menu_tree[ $item->menu_item_parent ]['children'], $item );
				}
			}
		}
		return $menu_tree;
	}

	public function start_el( &$output, $item, $depth=0, $args=[], $id=0 ) {
		$active_class = '';
		// if ( $item->url == get_permalink() ) {
		if ( strpos( get_permalink(), $item->url ) !== false ) {
			$active_class = 'active';
		}

		// set data-element for crawler
		$data_element = '';
		if ( $item->url && $item->url != '#' ) {
			if ( $args->walker->has_children && $depth === 0 && $item->menu_item_parent === '0' ) {
				$output .= '<li class="nav-item dropdown">';
				$output .= '<a class="nav-link ' . $active_class. ' dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false" id="mainNavDropdown1">
				<span>';
				$output .= esc_attr( $item->title );
				$output .= '</span><svg class="icon icon-xs" role="img" aria-labelledby="Expand">
					<title>Expand</title>
					<use href="';
				$output .= DIS_THEME_URL . '/assets/bootstrap-italia/svg/sprites.svg#it-expand';
				$output .= '"></use></svg></a>';
				$output .= '<div class="dropdown-menu" role="region" aria-labelledby="mainNavDropdown1">
						<div class="link-list-wrapper">
							<ul class="link-list">
								<li><a class="dropdown-item list-item" href="';
				$output .= esc_attr( $item->url );
				$output .= '"><span>';
				$output .= esc_attr( $item->title );
				$output .= '</span></a></li>
								<li><span class="divider"></span></li>';
				// Show sub pages.
				if ( $args->menu ) {
					$menuitems = $args->menu ? wp_get_nav_menu_items( $args->menu->term_id, array( 'order' => 'DESC' ) ) : array();
					$menuitems = $menuitems ? self::menu_tree_by_items( $menuitems ) : array();
				}
				foreach ( $menuitems[ $item->ID ]['children'] as $subitem ) {
					$output .= '<li><a class="dropdown-item list-item" href="';
					$output .= esc_attr( $subitem->url );
					$output .= '"><span>';
					$output .= esc_attr( $subitem->title );
					$output .= '</span></a></li>';
				}
				$output .= '</ul></div></div>';
			}

			else if ( ! $args->walker->has_children && $item->menu_item_parent === '0' ) {
				$output .= "<li class='nav-item'>";
				$output .= '<a class="nav-link '. $active_class .'" href="' . $item->url . '" data-element="'.$data_element.'">';
			}
		}

		if ( ! $args->walker->has_children && $item->menu_item_parent === '0' ) {
			$output .= '<span>' . $item->title . '</span>';
		}

		if ( $item->url && $item->url != '#' ) {
			if ( ! $args->walker->has_children && $item->menu_item_parent === '0' ) {
				$output .= "</a>";
			}
		}

	}
}