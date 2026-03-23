<?php
/**
 * Newsletter block.
 *
 * @package Design_ICT_Site
 */

$dis_newsletter_enabled = DIS_OptionsManager::dis_get_option( 'newsletter_enabled', 'dis_opt_newsletter_settings' );

if ( 'true' === $dis_newsletter_enabled ) {
	$dis_page_url = DIS_MultiLangManager::get_page_link( NEWSLETTER_PAGE_SLUG );
	?>
	<h4>
		<a href="#" title="<?php echo esc_attr__( 'Go to page: Newsletter', 'design_ict_site' ); ?>">
			<?php echo esc_html__( 'Newsletter', 'design_ict_site' ); ?>
		</a>
	</h4>
	<form action="<?php echo esc_url( $dis_page_url ); ?>" id="boxnewsletter" name="boxnewsletter" method="post">
		<div class="form-group">
			<div class="input-group border">
				<div class="input-group-prepend">
					<div class="input-group-text bg-transparent border-white">
						<svg class="icon icon-sm icon-white" role="img" aria-labelledby="newsletter-mail-label">
							<title id="newsletter-mail-label"><?php echo esc_html__( 'E-mail address', 'design_ict_site' ); ?></title>
							<use xlink:href="<?php echo esc_url( DIS_THEME_URL . '/assets/bootstrap-italia/svg/sprites.svg#it-mail' ); ?>">
							</use>
						</svg>
					</div>
				</div>
				<input type="text"
					title="<?php echo esc_attr__( 'Enter your email address to receive updates', 'design_ict_site' ); ?>"
					class="form-control bg-transparent text-white border-white"
					id="user_mail"
					name="user_mail"
					placeholder="<?php echo esc_attr__( 'E-mail address', 'design_ict_site' ); ?>"
				>
				<?php wp_nonce_field( 'sf_newsletter_nonce', 'newsletter_nonce_field' ); ?>
				<input type="hidden" name="redirection" id="redirection" value="yes" />
				<div class="input-group-append">
					<button class="btn btn-primary bg-transparent text-white text-light border-white border" type="submit" id="button-newsletter-iscriviti">
						<?php echo esc_html__( 'Sign me up', 'design_ict_site' ); ?>...
					</button>
				</div>
			</div>
		</div>
	</form>
	<?php
}
