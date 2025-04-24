<?php
/**
 * Section with the Logo and the title of the site.
 *
 * @package Design_ICT_Site
 */

$logo_visible = DIS_OptionsManager::dis_get_option( 'header_logo_visible', 'dis_opt_options' );
if ( $logo_visible === 'true' ) {
	$current_lang  = $args['current_lang'] ?? '';
	$site_title    = $args['site_title'] ?? '';
	$tagline       = $args['site_tagline'] ?? '';
	$logo_url      = DIS_OptionsManager::dis_get_option( 'site_logo', 'dis_opt_options' );
?>

	<!-- The logo is visible -->
	<div class="it-brand-wrapper">
		<?php
		if ( $logo_url ) {
			if( pathinfo( $logo_url, PATHINFO_EXTENSION ) !== 'svg' ) {
		?>
				<!-- Logo non SVG -->
				<a href="<?php echo esc_url( site_url() ); ?>">
					<img src="<?php echo esc_url( $logo_url ); ?>"
						height="80"
						alt="<?php echo __( 'Logo of the site', 'design_ict_site' ); ?>" />
					<div class="it-brand-text">
						<div class="it-brand-title"><?php echo esc_attr( $site_title ); ?></div>
						<div class="it-brand-tagline d-none d-md-block"><?php echo esc_attr( $tagline ); ?></div>
					</div>
				</a>
		<?php
			} else {
		?>
				<!-- Logo SVG -->
				<a href="<?php echo esc_url( site_url() ); ?>">
					<svg xmlns="http://www.w3.org/2000/svg"
						xmlns:xlink="http://www.w3.org/1999/xlink" width="82" height="82"
						alt="<?php echo __( 'Logo of the site', 'design_ict_site' ); ?>"
						title="<?php echo esc_attr( $site_title ); ?>">
						<?php echo wp_remote_get( $logo_url ); ?>
					</svg>
				</a>
		<?php
			}
		} else {
		?>
			<!-- DEfault Logo -->
			<a href="<?php echo esc_url( site_url() ); ?>">
				<img src="<?php echo DIS_THEME_URL . '/assets/img/logo-default.png' ; ?>"
					height="80"
					alt="<?php echo __( 'Logo of the site', 'design_ict_site' ); ?>" />
				<div class="it-brand-text">
					<div class="it-brand-title"><?php echo esc_attr( $site_title ); ?></div>
					<div class="it-brand-tagline d-none d-md-block"><?php echo esc_attr( $tagline ); ?></div>
				</div>
			</a>
		<?php
		}
		?>
	</div>

<?php
}
?>
