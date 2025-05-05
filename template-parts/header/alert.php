<?php
/**
 * The alert section.
 *
 * @package Design_ICT_Site
 */

$messages = DIS_OptionsManager::dis_get_option( 'messages', 'dis_opt_site_alerts' );
if ( $messages && ! empty( $messages ) ) {
	foreach ( $messages as $msg ) {
		if ( isset( $msg['message_text'] ) ) {
?>
	<div class="container my-12 p-2">
		<div class="alert alert-<?php echo esc_attr( $msg['message_color'] ); ?> alert-dismissible fade show mb-0" role="alert">
			<?php
			if ( $msg['message_link'] ) {
			?>
				<a target="_blank" href="<?php echo esc_attr( $msg['message_link'] ); ?>">
			<?php
			}
			echo esc_attr( $msg['message_text'] );
			if ( $msg['message_link'] ) {
			?>
			</a>
			<?php
				}
			?>

				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="<?php echo __( 'Close alert', 'design_ict_site' ); ?>">
					<svg class="icon" role="img" aria-labelledby="Close" aria-label="<?php echo __( 'Close alert', 'design_ict_site' ); ?>">
						<title>Chiudi avviso</title>
						<use href="<?php echo DIS_THEME_URL . '/assets/bootstrap-italia/svg/sprites.svg#it-close'; ?>"></use>
					</svg>
				</button>

		</div>
	</div>
<?php
		}
	}
}
