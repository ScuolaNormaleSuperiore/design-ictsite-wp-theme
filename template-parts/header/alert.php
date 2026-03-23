<?php
/**
 * Alert section.
 *
 * @package Design_ICT_Site
 */

$dis_messages = DIS_OptionsManager::dis_get_option( 'messages', 'dis_opt_site_alerts' );

if ( $dis_messages && ! empty( $dis_messages ) && array_key_exists( 'message_text', $dis_messages[0] ) ) {
	foreach ( $dis_messages as $dis_message ) {
		$dis_message_link = array_key_exists( 'message_link', $dis_message ) ? $dis_message['message_link'] : '';
		if ( isset( $dis_message['message_text'] ) ) {
			?>

			<div class="alert alert-<?php echo esc_attr( $dis_message['message_color'] ); ?> alert-dismissible fade show mb-0"
				role="alert"
				aria-label="<?php echo esc_attr__( 'Alert', 'design_ict_site' ); ?>"
			>
				<?php if ( $dis_message_link ) : ?>
					<a target="_blank" href="<?php echo esc_url( $dis_message_link ); ?>" rel="noopener noreferrer">
				<?php endif; ?>
				<?php echo esc_html( $dis_message['message_text'] ); ?>
				<?php if ( $dis_message_link ) : ?>
					</a>
				<?php endif; ?>
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="<?php echo esc_attr__( 'Close alert', 'design_ict_site' ); ?>">
					<svg class="icon" role="img" aria-labelledby="close-alert-label" aria-label="<?php echo esc_attr__( 'Close alert', 'design_ict_site' ); ?>">
						<title id="close-alert-label"><?php echo esc_html__( 'Close alert', 'design_ict_site' ); ?></title>
						<use href="<?php echo esc_url( DIS_THEME_URL . '/assets/bootstrap-italia/svg/sprites.svg#it-close' ); ?>"></use>
					</svg>
				</button>
			</div>

			<?php
		}
	}
}
