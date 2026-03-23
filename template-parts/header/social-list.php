<?php
/**
 * Section with the social list.
 *
 * @package Design_ICT_Site
 */

$dis_show_socials = DIS_OptionsManager::dis_get_option( 'show_socials', 'dis_opt_social_media' );

if ( 'true' === $dis_show_socials ) {
	$dis_socials = array(
		'facebook'  => array(
			'label' => 'Facebook',
			'icon'  => 'it-facebook',
		),
		'youtube'   => array(
			'label' => 'Youtube',
			'icon'  => 'it-youtube',
		),
		'instagram' => array(
			'label' => 'Instagram',
			'icon'  => 'it-instagram',
		),
		'pinterest' => array(
			'label' => 'Pinterest',
			'icon'  => 'it-pinterest',
		),
		'twitter'   => array(
			'label' => 'Twitter',
			'icon'  => 'it-twitter',
		),
		'bluesky'   => array(
			'label' => 'Blue Sky',
			'icon'  => 'it-bluesky',
		),
		'linkedin'  => array(
			'label' => 'Linkedin',
			'icon'  => 'it-linkedin',
		),
		'tiktok'    => array(
			'label' => 'TikTok',
			'icon'  => 'it-tiktok',
		),
		'snapchat'  => array(
			'label' => 'Snapchat',
			'icon'  => 'it-snapchat',
		),
		'github'    => array(
			'label' => 'GitHub',
			'icon'  => 'it-github',
		),
		'gitlab'    => array(
			'label' => 'GitLab',
			'icon'  => 'it-star-outline',
		),
	);
	?>
	<div class="it-socials d-none d-md-flex">
		<span><?php echo esc_html__( 'Follow us on', 'design_ict_site' ); ?></span>
		<ul>
			<?php foreach ( $dis_socials as $dis_option_key => $dis_social_config ) : ?>
				<?php $dis_social_url = DIS_OptionsManager::dis_get_option( $dis_option_key, 'dis_opt_social_media' ); ?>
				<?php if ( $dis_social_url ) : ?>
					<li>
						<a href="<?php echo esc_url( $dis_social_url ); ?>" aria-label="<?php echo esc_attr( $dis_social_config['label'] ); ?>" target="_blank" rel="noopener noreferrer">
							<svg class="icon" role="img" aria-labelledby="<?php echo esc_attr( strtolower( str_replace( ' ', '-', $dis_social_config['label'] ) ) ); ?>" aria-label="<?php echo esc_attr( $dis_social_config['label'] ); ?>">
								<title><?php echo esc_html( $dis_social_config['label'] ); ?></title>
								<use href="<?php echo esc_url( DIS_THEME_URL . '/assets/bootstrap-italia/svg/sprites.svg#' . $dis_social_config['icon'] ); ?>"></use>
							</svg>
						</a>
					</li>
				<?php endif; ?>
			<?php endforeach; ?>
		</ul>
	</div>
	<?php
}
