<?php
/* Related contents section.
*
* @package Design_ICT_Site
*/

$items     = isset( $args['items'] ) && is_array( $args['items'] ) ? $args['items'] : array();
$all_label = $args['all_label'] ?? '';
$all_link  = $args['all_link'] ?? '';

if ( count ( $items ) > 0 ) {
?>
<section id="blocco-events" class="section pt-5 pb-3">
	<div class="section-content">
		<div class="container">
			<h2 class="pb-4">
				<?php echo esc_attr( __( 'Related contents', 'design_ict_site' ) ); ?>
			</h2>
			<!-- Item list -->
			<div class="row">

				<?php
				foreach ( $items as $item ){
					$wrapper    = DIS_ContentsManager::wrap_search_result( $item );
					$image_data = DIS_ContentsManager::get_image_metadata( $item, 'full', '/assets/img/default-background.png' );
				?>
				<!-- Item -->
				<div class="col-12 col-lg-4">
					<article class="it-card it-card-image it-card-height-full">
						<!-- Title -->
						<h3 class="it-card-title ">
							<a href="scheda-news.html">
								<?php echo esc_attr( $wrapper->title ); ?>
							</a>
						</h3>
						<!--Image -->
						<div class="it-card-image-wrapper">
							<div class="ratio ratio-16x9">
								<figure class="figure img-full">
									<img
										src="<?php echo esc_url( $image_data['image_url'] ); ?>"
										title="<?php echo esc_attr( $image_data['image_title'] ); ?>"
										alt="<?php echo esc_attr( $image_data['image_alt'] ); ?>"
									>
								</figure>
							</div>
						</div>
						<!-- Body -->
						<div class="it-card-body">
							<p class="it-card-text">
								<?php echo esc_attr( wp_trim_words( $wrapper->description , DIS_ACF_SHORT_DESC_LENGTH ) ); ?>
							</p>
						</div>
						<!-- Footer -->
						<footer class="it-card-related it-card-footer">
							<div class="it-card-taxonomy">
								<a href="<?php echo esc_url( $wrapper->type_link ); ?>"
									class="it-card-category it-card-link link-secondary">
									<span class="visually-hidden">
										<?php echo __( 'Related contents', 'design_ict_site' ); ?>
									</span>
									<?php echo esc_attr( $wrapper->type ); ?>
								</a>
							</div>
							<time class="it-card-date" datetime="<?php echo esc_attr( $wrapper->long_date ); ?>">
								<?php echo esc_attr( $wrapper->long_date ); ?>
							</time>
						</footer>
					</article>
				</div>
				<?php
				}
				?>
			</div>

			<!--Button -->
			<?php if ( $all_link ) : ?>
				<div class="text-center pt-5 pb-5">
					<a href="<?php echo esc_url( $all_link ); ?>" class="btn btn-secondary">
						<?php echo esc_attr( $all_label ); ?>
					</a>
				</div>
			<?php endif ?>
		</div>
	</div>
</section>

<?php
}
?>
