<?php
// phpcs:ignoreFile WordPress.Files.FileName.InvalidClassFileName
/**
 * Definition of the Custom Fields Manager: wrapper for ACF.
 *
 * @package Design_ICT_Site
 */

/**
 * The manager that wraps ACF's libraries.
 */
class DIS_CustomFieldsManager {
	/**
	 * Constructor of the Manager.
	 */
	public function __construct() {}

	/**
	 * Wrapper around ACF get_field().
	 *
	 * @param string     $selector Field selector.
	 * @param int|bool   $post_id Post ID or false.
	 * @param bool       $format_value Whether to format the value.
	 * @return mixed
	 */
	public static function get_field( $selector, $post_id = false, $format_value = true ) {
		return get_field( $selector, $post_id, $format_value );
	}

	/**
	 * Wrapper around ACF update_field().
	 *
	 * @param string $fieldname Field name.
	 * @param mixed  $field_value Field value.
	 * @param int    $post_id Post ID.
	 * @return void
	 */
	public static function update_field( $fieldname, $field_value, $post_id ) {
		update_field( $fieldname, $field_value, $post_id );
	}

	/**
	 * Returns the wrapper label.
	 *
	 * @return string
	 */
	public function get_name() {
		return 'Wrapper ACF';
	}
}
