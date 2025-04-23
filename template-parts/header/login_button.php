<?php
/**
 * The login button.
 *
 * @package Design_ICT_Site
 */


$login_enabled = DIS_OptionsManager::dis_get_option( 'login_button_visible', 'dis_opt_advanced_settings' );
if ( $login_enabled === 'true' ) {
?>
	<div class="it-access-top-wrapper">
		<a class="btn btn-primary btn-sm" href="<?php echo get_site_url();?>/wp-admin">
			<?php echo __( 'Login', 'design_ict_site' ); ?>
		</a>
	</div>
<?php
}
?>