<?php
/**
 * The alert section.
 *
 * @package Design_ICT_Site
 */

$messages = DIS_OptionsManager::dis_get_option( 'messages', 'dis_opt_site_alerts' );
if ( $messages && ! empty( $messages ) && array_key_exists( 'message_text', $messages[0] ) ) {
	foreach ( $messages as $msg ) {
		$message_link = array_key_exists( 'message_link', $msg ) ? $msg['message_link'] : '';
		if ( isset( $msg['message_text'] ) ) {
?>

		<div class="alert alert-<?php echo esc_attr( $msg['message_color'] ); ?> alert-dismissible fade show mb-0"
			role="alert"
			aria-label="<?php echo esc_attr__( 'Alert', 'design_ict_site' ); ?>"
		>
			<?php
			if ( $message_link ) {
			?>
				<a target="_blank" href="<?php echo esc_url( $message_link ); ?>" rel="noopener noreferrer">
			<?php
			}
			echo esc_attr( $msg['message_text'] );
			if ( $message_link ) {
			?>
			</a>
			<?php
				}
			?>
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="<?php echo esc_attr__( 'Close alert', 'design_ict_site' ); ?>">
					<svg class="icon" role="img" aria-labelledby="Close" aria-label="<?php echo esc_attr__( 'Close alert', 'design_ict_site' ); ?>">
						<title><?php echo esc_html__( 'Close alert', 'design_ict_site' ); ?></title>
						<use href="<?php echo esc_url( DIS_THEME_URL . '/assets/bootstrap-italia/svg/sprites.svg#it-close' ); ?>"></use>
					</svg>
				</button>
		</div>

<?php
		}
	}
}
