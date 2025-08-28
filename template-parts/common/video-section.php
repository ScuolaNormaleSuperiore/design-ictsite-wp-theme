<?php
/* Video section.
*
* @package Design_ICT_Site
*/

$video      = $args['video'] ?? null;
$page_label = __( 'Privacy Policy', 'design_ict_site' );
$page_link  = DIS_MultiLangManager::get_page_link( PRIVACY_PAGE_SLUG );
$msg_text   = sprintf( __( 'Accept the Youtube cookies to watch the video. You can manage the preferences into the <a target="_blank" href="%s" class="text-white">%s</a>.', 'design_ict_site' ), 
	$page_link, 
	$page_label
);
?>

<div class="mt-3">
	<script>
		const loadYouTubeVideo = function (videoUrl) {
			const videoEl = document.getElementById("vid1");
			const video = bootstrap.VideoPlayer.getOrCreateInstance(videoEl);
			video.setYouTubeVideo(videoUrl);
		}
	</script>
	<div class="acceptoverlayable">
		<div class="acceptoverlay acceptoverlay-primary fade show">
			<div class="acceptoverlay-inner">
				<div class="acceptoverlay-icon">
					<svg class="icon icon-xl">
						<use href="<?php echo DIS_THEME_URL . '/assets/bootstrap-italia/dist/svg/sprites.svg#it-video'; ?>"></use>
					</svg>
				</div>
				<p>
					<?php echo $msg_text; ?>
				</p>
				<div class="acceptoverlay-buttons bg-dark">
					<button type="button" class="btn btn-primary"
						data-bs-accept-from="youtube.com"
						onclick="loadYouTubeVideo('<?php echo esc_url( $video ); ?>')">
						<?php echo __( 'Accept', 'design_ict_site' ); ?>
					</button>
					<div class="form-check">
						<input id="chk-remember" type="checkbox" data-bs-accept-remember>
						<label for="chk-remember">
							<?php echo __( 'Remember for all videos', 'design_ict_site' ); ?>
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
