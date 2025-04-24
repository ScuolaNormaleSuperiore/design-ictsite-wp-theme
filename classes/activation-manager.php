<?php
/**
 * Definition of the Activation Manager.
 *
 * @package Design_ICT_Site
 */


/**
 * The Menu manager.
 *
 */
class DIS_ActivationManager {

	private $result = array(
		'status' => null,  // 1: success, 0: error.
		'data'   => null, // Array of string to write.
	);

	/**
	 * Constructor of the Manager.
	 */
	public function __construct() {}

	public function reload_data(){
		error_log( '*** ACTION RELOAD DATA ***' );

		$this->pages_creation();
		// $this->taxonomies_creation();
		// $this->menu_creation();

		// global $wp_rewrite;
		// $wp_rewrite->init(); // important...
		// $wp_rewrite->set_tag_base( 'argomento' );
		// $wp_rewrite->flush_rules();

		$this->result['status'] = 1;
		$this->result['data']   = 'List of all the modifications';
		return $this->result;
	}

	private function pages_creation() {
		return true;
	}

	private function taxonomies_creation() {
		return true;
	}

	private function menu_creation() {
		return true;
	}

}
