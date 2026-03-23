<?php
/**
 * Section with the social list.
 *
 * @package Design_ICT_Site
 */

$show_socials = DIS_OptionsManager::dis_get_option( 'show_socials', 'dis_opt_social_media' );
if ( $show_socials === 'true' ) {
?>
<div class="it-socials d-none d-md-flex">
	<span><?php echo esc_html( __( 'Follow us on', 'design_ict_site' ) ); ?></span>
	<ul>
		<?php
		$facebook = DIS_OptionsManager::dis_get_option( 'facebook', 'dis_opt_social_media' );
		if ( $facebook ) {
		?>
		<li>
			<a href="<?php echo esc_url( $facebook ); ?>" aria-label="Facebook" target="_blank" rel="noopener noreferrer">
				<svg class="icon" role="img" aria-labelledby="Facebook" aria-label="Facebook">
					<title>Facebook</title>
					<use href="<?php echo DIS_THEME_URL . '/assets/bootstrap-italia/svg/sprites.svg#it-facebook'; ?>"></use>
				</svg>
			</a>
		</li>
		<?php
		}
		$youtube = DIS_OptionsManager::dis_get_option( 'youtube', 'dis_opt_social_media' );
		if ( $youtube ) {
		?>
		<li>
			<a href="<?php echo esc_url( $youtube ); ?>" aria-label="Youtube" target="_blank" rel="noopener noreferrer">
				<svg class="icon" role="img" aria-labelledby="Youtube" aria-label="Youtube">
					<title>Youtube</title>
					<use href="<?php echo DIS_THEME_URL . '/assets/bootstrap-italia/svg/sprites.svg#it-youtube'; ?>"></use>
				</svg>
			</a>
		</li>
		<?php
		}
		$instagram = DIS_OptionsManager::dis_get_option( 'instagram', 'dis_opt_social_media' );
		if ( $instagram ) {
		?>
		<li>
			<a href="<?php echo esc_url( $instagram ); ?>" aria-label="Instagram" target="_blank" rel="noopener noreferrer">
				<svg class="icon" role="img" aria-labelledby="Instagram" aria-label="Instagram">
					<title>Instagram</title>
					<use href="<?php echo DIS_THEME_URL . '/assets/bootstrap-italia/svg/sprites.svg#it-instagram'; ?>"></use>
				</svg>
			</a>
		</li>
		<?php
		}
		$pinterest = DIS_OptionsManager::dis_get_option( 'pinterest', 'dis_opt_social_media' );
		if ( $pinterest ) {
			?>
			<li>
				<a href="<?php echo esc_url( $pinterest ); ?>" aria-label="Pinterest" target="_blank" rel="noopener noreferrer">
					<svg class="icon" role="img" aria-labelledby="Pinterest" aria-label="Pinterest">
						<title>Pinterest</title>
						<use href="<?php echo DIS_THEME_URL . '/assets/bootstrap-italia/svg/sprites.svg#it-pinterest'; ?>"></use>
					</svg>
				</a>
			</li>
			<?php
		}
		$twitter = DIS_OptionsManager::dis_get_option( 'twitter', 'dis_opt_social_media' );
		if ( $twitter ) {
		?>
		<li>
			<a href="<?php echo esc_url( $twitter ); ?>" aria-label="Twitter" target="_blank" rel="noopener noreferrer">
				<svg class="icon" role="img" aria-labelledby="Twitter" aria-label="Twitter">
					<title>Twitter</title>
					<use href="<?php echo DIS_THEME_URL . '/assets/bootstrap-italia/svg/sprites.svg#it-twitter'; ?>"></use>
				</svg>
			</a>
		</li>
		<?php
		}
		$bluesky = DIS_OptionsManager::dis_get_option( 'bluesky', 'dis_opt_social_media' );
		if ( $bluesky ) {
		?>
		<li>
			<a href="<?php echo esc_url( $bluesky ); ?>" aria-label="Blue Sky" target="_blank" rel="noopener noreferrer">
				<svg class="icon" role="img" aria-labelledby="Blue Sky" aria-label="Blue Sky">
					<title>Blue Sky</title>
					<use href="<?php echo DIS_THEME_URL . '/assets/bootstrap-italia/svg/sprites.svg#it-bluesky'; ?>"></use>
				</svg>
			</a>
		</li>
		<?php
		}
		$linkedin = DIS_OptionsManager::dis_get_option( 'linkedin', 'dis_opt_social_media' );
		if ( $linkedin ) {
		?>
		<li>
			<a href="<?php echo esc_url( $linkedin ); ?>" aria-label="Linkedin" target="_blank" rel="noopener noreferrer">
				<svg class="icon" role="img" aria-labelledby="Linkedin" aria-label="Linkedin">
					<title>Linkedin</title>
					<use href="<?php echo DIS_THEME_URL . '/assets/bootstrap-italia/svg/sprites.svg#it-linkedin'; ?>"></use>
				</svg>
			</a>
		</li>
		<?php
		}
		$tiktok = DIS_OptionsManager::dis_get_option( 'tiktok', 'dis_opt_social_media' );
		if ( $tiktok ) {
			?>
			<li>
				<a href="<?php echo esc_url( $tiktok ); ?>" aria-label="TikTok" target="_blank" rel="noopener noreferrer">
					<svg class="icon" role="img" aria-labelledby="TikTok" aria-label="TikTok">
						<title>TikTok</title>
						<use href="<?php echo DIS_THEME_URL . '/assets/bootstrap-italia/svg/sprites.svg#it-tiktok'; ?>"></use>
					</svg>
				</a>
			</li>
			<?php
		}
		$snapchat = DIS_OptionsManager::dis_get_option( 'snapchat', 'dis_opt_social_media' );
		if ( $snapchat ) {
			?>
			<li>
				<a href="<?php echo esc_url( $snapchat ); ?>" aria-label="Snapchat" target="_blank" rel="noopener noreferrer">
					<svg class="icon" role="img" aria-labelledby="Snapchat" aria-label="Snapchat">
						<title>Snapchat</title>
						<use href="<?php echo DIS_THEME_URL . '/assets/bootstrap-italia/svg/sprites.svg#it-snapchat'; ?>"></use>
					</svg>
				</a>
			</li>
			<?php
		}
		$github = DIS_OptionsManager::dis_get_option( 'github', 'dis_opt_social_media' );
		if ( $github ) {
		?>
			<li>
				<a href="<?php echo esc_url( $github ); ?>" aria-label="GitHub" target="_blank" rel="noopener noreferrer">
					<svg class="icon" role="img" aria-labelledby="GitHub" aria-label="GitHub">
						<title>GitHub</title>
						<use href="<?php echo DIS_THEME_URL . '/assets/bootstrap-italia/svg/sprites.svg#it-github'; ?>"></use>
					</svg>
				</a>
			</li>
		<?php
		}
		$gitlab = DIS_OptionsManager::dis_get_option( 'gitlab', 'dis_opt_social_media' );
		if ( $gitlab ) {
		?>
			<li>
				<a href="<?php echo esc_url( $gitlab ); ?>" aria-label="GitLab" target="_blank" rel="noopener noreferrer">
					<svg class="icon" role="img" aria-labelledby="GitLab" aria-label="GitLab">
						<title>GitLab</title>
						<use href="<?php echo DIS_THEME_URL . '/assets/bootstrap-italia/svg/sprites.svg#it-star-outline'; ?>"></use>
					</svg>
				</a>
			</li>
		<?php
		}
		?>
	</ul>
</div>
<?php
}
?>
