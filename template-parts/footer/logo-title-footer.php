<?php
/**
 * Section with the logo and the site title.
 *
 * @package Design_ICT_Site
 */

$dis_logo_visible = DIS_OptionsManager::dis_get_option( 'footer_logo_visible', 'dis_opt_options' );

if ( 'true' === $dis_logo_visible ) {
	$dis_site_title = $args['site_title'] ?? '';
	$dis_tagline    = $args['site_tagline'] ?? '';
	$dis_logo_url   = DIS_OptionsManager::dis_get_option( 'footer_logo', 'dis_opt_options' );
	$dis_site_url   = DIS_MultiLangManager::get_home_url();
	?>
	<div class="it-brand-wrapper">
		<?php if ( $dis_logo_url ) : ?>
			<?php if ( 'svg' !== pathinfo( $dis_logo_url, PATHINFO_EXTENSION ) ) : ?>
				<a href="<?php echo esc_url( $dis_site_url ); ?>">
					<img src="<?php echo esc_url( $dis_logo_url ); ?>"
						height="80"
						class="color-invert"
						alt="<?php echo esc_attr__( 'Logo of the site', 'design_ict_site' ); ?>"
					/>
					<div class="it-brand-text">
						<div class="it-brand-title"><?php echo esc_html( $dis_site_title ); ?></div>
						<div class="it-brand-tagline d-none d-md-block"><?php echo esc_html( $dis_tagline ); ?></div>
					</div>
				</a>
			<?php else : ?>
				<a href="<?php echo esc_url( $dis_site_url ); ?>">
					<svg xmlns="http://www.w3.org/2000/svg"
						xmlns:xlink="http://www.w3.org/1999/xlink"
						width="82"
						height="82"
						title="<?php echo esc_attr( $dis_site_title ); ?>">
						<?php echo wp_remote_retrieve_body( wp_remote_get( $dis_logo_url ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					</svg>
				</a>
			<?php endif; ?>
		<?php else : ?>
			<a href="<?php echo esc_url( $dis_site_url ); ?>">
				<img src="<?php echo esc_url( DIS_THEME_URL . '/assets/img/logo-default.png' ); ?>"
					height="80"
					class="color-invert"
					alt="<?php echo esc_attr__( 'Logo of the site', 'design_ict_site' ); ?>"
				/>
				<div class="it-brand-text">
					<div class="it-brand-title"><?php echo esc_html( $dis_site_title ); ?></div>
					<div class="it-brand-tagline d-none d-md-block"><?php echo esc_html( $dis_tagline ); ?></div>
				</div>
			</a>
		<?php endif; ?>
	</div>
	<?php
}
