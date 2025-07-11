<?php
/* Video section.
*
* @package Design_ICT_Site
*/

$video = $args['video'] ?? null;
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
						<use href="/bootstrap-italia/dist/svg/sprites.svg#it-video"></use>
					</svg>
				</div>
				<p>
					Accetta i cookie di YouTube per vedere il video. Puoi gestire le preferenze nella <a href="#"
					class="text-white">cookie policy</a>.
				</p>
				<div class="acceptoverlay-buttons bg-dark">
					<button type="button" class="btn btn-primary"
						data-bs-accept-from="youtube.com"
						onclick="loadYouTubeVideo('https://youtu.be/_0j7ZQ67KtY')">
						Accetta
					</button>
					<div class="form-check">
						<input id="chk-remember" type="checkbox" data-bs-accept-remember>
						<label for="chk-remember">
							Ricorda per tutti i video
						</label>
					</div>
				</div>
			</div>
		</div>
		<div>
			<video controls data-bs-video id="vid1" class="video-js" width="640" height="264">
			</video>
			<div class="vjs-transcription accordion">
				<div class="accordion-item">
					<h2 class="accordion-header " id="transcription-head9">
						<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
							data-bs-target="#transcription9" aria-expanded="true" aria-controls="transcription">
							Trascrizione
						</button>
					</h2>
					<div id="transcription9" class="accordion-collapse collapse" role="region"
						aria-labelledby="transcription-head9">
						<div class="accordion-body">
							Vestibulum hendrerit ultrices nibh, sed pharetra lacus ultrices eget. Morbi et ipsum et sapien
							dapibus facilisis. Integer eget semper nibh. Proin enim nulla, egestas ac rutrum eget,
							ullamcorper nec turpis.
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
