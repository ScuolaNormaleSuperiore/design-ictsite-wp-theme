<!-- blocco newsletter -->
<?php
$newsletter_enabled = DIS_OptionsManager::dis_get_option( 'newsletter_enabled', 'dis_opt_newsletter_settings' );
if ( $newsletter_enabled === 'true' ) {
	$current_lang = $args['current_lang'] ?? '';
	$site_title   = $args['site_title'] ?? '';
	$tagline      = $args['site_tagline'] ?? '';
	$page_url     = DIS_MultiLangManager::get_page_link( NEWSLETTER_PAGE_SLUG );
?>
	<h4>
		<a href="#" title="<?php echo __( 'Vai alla pagina: Newsletter', 'design_ict_site' ); ?>">
			<?php echo __( 'Newsletter', 'design_ict_site' ); ?>
		</a>
	</h4>
	<FORM action="<?php echo esc_url( $page_url ); ?>" id="boxnewsletter" name="boxnewsletter" method="POST">
		<div class="form-group">
			<div class="input-group border">
				<div class="input-group-prepend">
						<div class="input-group-text bg-transparent border-white">
							<svg class="icon icon-sm icon-white" role="img" aria-labelledby="Mail">
								<title><?php echo __( 'E-mail address', 'design_ict_site' ); ?></title>
								<use xlink:href="<?php echo DIS_THEME_URL . '/assets/bootstrap-italia/svg/sprites.svg#it-mail'; ?>">
								</use>
							</svg>
						</div>
				</div>
					<input type="text" title="<?php echo __( 'Enter your email address to receive updates', 'design_ict_site' ); ?>"
						class="form-control bg-transparent text-white border-white"
						id="user_mail" name="user_mail"
						placeholder="<?php echo __( 'E-mail address', 'design_ict_site' ); ?>">
					<?php wp_nonce_field( 'sf_newsletter_nonce', 'newsletter_nonce_field' ); ?>
					<input type="hidden" name="redirection" id="redirection" value="yes" />
					<div class="input-group-append">
						<button class="btn btn-primary bg-transparent text-white text-light border-white border" type="submit" id="button-newsletter-iscriviti">
						<?php echo __( 'Sign me up', 'design_ict_site' ); ?>...
						</button>
					</div>
			</div>
		</div>
</FORM>
<?php
}
?>
<!-- fine blocco newsletter -->
