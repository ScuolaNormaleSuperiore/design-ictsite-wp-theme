<?php
/**
 * Definition of the Custom Fields Manager: wrapper for ACF.
 *
 * @package Design_ICT_Site
 */

/**
 * The manager that wraps ACF's libraries.
 *
 */
class DIS_CustomFieldsManager {
	/**
	 * Constructor of the Manager.
	 */
	public function __construct() {}

	public static function get_field( $selector, $post_id = false, $format_value = true ) {
		return get_field( $selector, $post_id, $format_value );
	}

	public static function update_field( $fieldname, $field_value, $post_id ) {
		update_field( $fieldname, $field_value, $post_id );
	}

	public function get_name(){
		return "Wrapper ACF";
	}

}
