<?php
/**
 * Login button.
 *
 * @package Design_ICT_Site
 */

$dis_login_enabled = DIS_OptionsManager::dis_get_option( 'login_button_visible', 'dis_opt_advanced_settings' );

if ( 'true' === $dis_login_enabled ) {
	?>
	<div class="it-access-top-wrapper">
		<a class="btn btn-primary btn-sm" href="<?php echo esc_url( get_site_url() . '/wp-admin' ); ?>">
			<?php echo esc_html__( 'Login', 'design_ict_site' ); ?>
		</a>
	</div>
	<?php
}
