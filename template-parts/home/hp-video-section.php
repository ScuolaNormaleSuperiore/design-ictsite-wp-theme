<?php
/**
 * The HP video section.
 *
 * @package Design_ICT_Site
 */

$dis_enabled_par     = $args['enabled'] ?? '';
$dis_show_title_par  = $args['show_title'] ?? '';
$dis_show_title      = ( 'true' === $dis_show_title_par );
$dis_section_enabled = ( 'true' === $dis_enabled_par );
$dis_video           = DIS_OptionsManager::dis_get_option( 'home_page_video_url', 'dis_opt_hp_layout' );
$dis_video           = $dis_video ?? null;

if ( $dis_section_enabled && $dis_video ) {
	$dis_page_label = __( 'Privacy Policy', 'design_ict_site' );
	$dis_page_link  = DIS_MultiLangManager::get_page_link( PRIVACY_PAGE_SLUG );
	$dis_msg_text   = sprintf(
		/* translators: 1: privacy page URL, 2: privacy page label. */
		__( 'Accept the Youtube cookies to watch the video. You can manage the preferences into the <a target="_blank" href="%1$s" class="text-white">%2$s</a>.', 'design_ict_site' ),
		$dis_page_link,
		$dis_page_label
	);
	?>

	<div class="container-banner-home">
		<?php if ( $dis_show_title ) : ?>
			<h2 class="pb-4">
				<?php echo esc_html__( 'Video', 'design_ict_site' ); ?>
			</h2>
		<?php endif; ?>

		<section class="section section-muted p-5">
			<div class="row">
				<div class="mx-auto col-12 col-sm-10 col-md-8 col-lg-6">
					<script>
						const loadYouTubeVideo = function (videoUrl) {
							const videoEl = document.getElementById('vid1');
							const video = bootstrap.VideoPlayer.getOrCreateInstance(videoEl);
							video.setYouTubeVideo(videoUrl);
						};
					</script>
					<div class="acceptoverlayable">
						<div class="acceptoverlay acceptoverlay-primary fade show">
							<div class="acceptoverlay-inner">
								<div class="acceptoverlay-icon">
									<svg class="icon icon-xl">
										<use href="<?php echo esc_url( DIS_THEME_URL . '/assets/bootstrap-italia/svg/sprites.svg#it-video' ); ?>"></use>
									</svg>
								</div>
								<p>
									<?php echo wp_kses_post( $dis_msg_text ); ?>
								</p>
								<div class="acceptoverlay-buttons bg-dark">
									<button type="button" class="btn btn-primary" data-bs-accept-from="youtube.com"
										onclick="loadYouTubeVideo('<?php echo esc_url( $dis_video ); ?>')">
										<?php echo esc_html__( 'Accept', 'design_ict_site' ); ?>
									</button>
									<div class="form-check">
										<input id="chk-remember" type="checkbox" data-bs-accept-remember>
										<label for="chk-remember">
											<?php echo esc_html__( 'Remember for all videos', 'design_ict_site' ); ?>
										</label>
									</div>
								</div>
							</div>
						</div>
						<div>
							<video controls data-bs-video id="vid1" class="video-js" width="640" height="264">
							</video>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>

	<?php
}
