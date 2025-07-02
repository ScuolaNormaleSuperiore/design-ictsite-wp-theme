<?php
/**
 * Definition of the EXport Manager: useful to export site data.
 *
 * @package Design_ICT_Site
 */


/**
 * The Export manager.
 *
 */
class DIS_ExportManager {

	private static string $main_page = 'dis-export-data-options';

	/**
	 * Constructor of the Manager.
	 */
	public function __construct() {

	}

	/**
	 * Setup of this manager.
	 *
	 * @return void
	 */
	public function setup() {
		// Register 'Export data' menu.
		add_action( 'admin_menu', array( $this, 'register_export_data_link' ) );

		// Register 'Export data' actions.
		add_action( 'admin_init', array( $this, 'manage_submit_action' ) );
	}

	/**
	 * Set the link to the main page.
	 *
	 * @return void
	 */
	public function register_export_data_link() {
		add_theme_page(
			esc_html__( 'Export data', 'design_ict_site'),
			esc_html__( 'Export data', 'design_ict_site'),
			DIS_EDIT_THEME_PERMISSION,
			self::$main_page,
			[self::class, 'get_export_data_page'],
		);
	}

	/**
	 * Return the HTML of the main page.
	 * @return string
	 */
	public static function get_export_data_page() {
	?>
		<div class="wrap">
			<h1><?php echo __( 'Export ICT data', 'design_ict_site' ); ?></h1>
			<p><?php echo __( 'Export in JSON format', 'design_ict_site' ); ?>:</p>
			<form method="post">
				<?php wp_nonce_field('export_ict_nonce_action', 'export_ict_nonce'); ?>
				<input type="submit" name="export_faq" class="button button-primary"
					value="<?php echo __( 'Export FAQ', 'design_ict_site' ); ?>" />
				<input type="submit" name="export_services" class="button button-secondary"
					value="<?php echo __( 'Export Services', 'design_ict_site' ); ?>" />
			</form>
		</div>
	<?php
	}
	
	/**
	 * Export FAQ post types in JSON.
	 * 
	 * @return bool|string
	 */
	public static function export_faq() {
		$args = array(
			'post_type'   => DIS_FAQ_POST_TYPE,
			'post_status' => 'publish',
			'numberposts' => -1
		);
		$faqs   = get_posts( $args );
		$result = array();
		foreach ( $faqs as $post ) {
			// $text = apply_filters('the_content', $post->post_content),
			$text     = wp_strip_all_tags( apply_filters( 'the_content', $post->post_content ) );
			$related  = array();
			$services = DIS_CustomFieldsManager::get_field( 'service' , $post->ID );
			if ( $services ){
				foreach( $services as $s ) {
					array_push(
						$related,
						array(
							'service_name' => get_the_title( $s ),
							'service_link' => get_permalink( $s ),
						),
					);
				}
			}
			array_push(
				$result,
				array(
					'question'         => get_the_title($post),
					'answer'           => $text,
					'related_services' => $related,
				)
			);
		}
		self::send_json($result, 'faq-export');
	}


	/**
	 * Export service post types in JSON.
	 * @return bool|string
	 */
	public static function export_services() {
		$args = array(
			'post_type'   => DIS_SERVICE_ITEM_POST_TYPE,
			'post_status' => 'publish',
			'numberposts' => -1
		);
		$services   = get_posts( $args );
		$result = array();
		foreach ( $services as $post ) {
			$text     = wp_strip_all_tags( apply_filters( 'the_content', $post->post_content ) );
			// $related  = array();
			// $services = DIS_CustomFieldsManager::get_field( 'service' , $post->ID );
			// if ( $services ){
			// 	foreach( $services as $s ) {
			// 		array_push(
			// 			$related,
			// 			array(
			// 				'service_name' => get_the_title( $s ),
			// 				'service_link' => get_permalink( $s ),
			// 			),
			// 		);
			// 	}
			// }
			array_push(
				$result,
				array(
					'service'     => get_the_title($post),
					'description' => $text,
				)
			);
		}
		self::send_json($result, 'services-export');
	}

	public static function manage_submit_action(){
		if ( ! current_user_can( 'edit_pages' ) ) return;

		if (
			isset( $_POST['export_faq'] ) &&
			check_admin_referer('export_ict_nonce_action', 'export_ict_nonce')
		) {
			self::export_faq();
			exit;
		}

		if (
			isset( $_POST['export_services'] ) &&
			check_admin_referer( 'export_ict_nonce_action', 'export_ict_nonce' )
		) {
			self::export_services();
			exit;
		}
	}


	/** UTILITIES  */

	/**
	 * Send the JSON as download.
	 */
	private static function send_json( $data, $filename_base ) {
		$filename = $filename_base . '-' . date('Y-m-d') . '.json';
		header('Content-Type: application/json');
		header('Content-Disposition: attachment; filename="' . $filename . '"');
		header('Pragma: no-cache');
		header('Expires: 0');
		echo json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
		exit;
	}

}
