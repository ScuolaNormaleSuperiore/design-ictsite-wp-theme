<?php
/**
 * Definition of the Contents Manager.
 *
 * @package Design_ICT_Site
 */


/**
 * The manager for the site contents.
 *
 */
class DIS_ContentsManager {
	/**
	 * Constructor of the Manager.
	 */
	public function __construct() {}

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
				if ( ( $only_active === 'false' ) || $section['enabled']==='true' ) {
					array_push( $results, $section );
				}
			}
		}
		return $results;
	}

}
