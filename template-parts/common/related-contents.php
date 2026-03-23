<?php
/**
 * Related contents section.
 *
 * @package Design_ICT_Site
 */

$dis_items     = ( isset( $args['items'] ) && is_array( $args['items'] ) ) ? $args['items'] : array();
$dis_all_label = $args['all_label'] ?? '';
$dis_all_link  = $args['all_link'] ?? '';

if ( count( $dis_items ) > 0 ) {
	?>
	<section id="blocco-events" class="section pt-5 pb-3">
		<div class="section-content">
			<div class="container">
				<h2 class="pb-4">
					<?php echo esc_html__( 'Related contents', 'design_ict_site' ); ?>
				</h2>
				<div class="row">
					<?php foreach ( $dis_items as $dis_item ) : ?>
						<?php
						$dis_wrapper    = DIS_ContentsManager::wrap_search_result( $dis_item );
						$dis_image_data = DIS_ContentsManager::get_image_metadata( $dis_item, 'full', '/assets/img/default-background.png' );
						?>
						<div class="col-12 col-lg-4">
							<article class="it-card it-card-image it-card-height-full">
								<h3 class="it-card-title ">
									<a href="<?php echo esc_url( get_permalink( $dis_item->ID ) ); ?>">
										<?php echo esc_html( $dis_wrapper->title ); ?>
									</a>
								</h3>
								<div class="it-card-image-wrapper">
									<div class="ratio ratio-16x9">
										<figure class="figure img-full">
											<img
												src="<?php echo esc_url( $dis_image_data['image_url'] ); ?>"
												title="<?php echo esc_attr( $dis_image_data['image_title'] ); ?>"
												alt="<?php echo esc_attr( $dis_image_data['image_alt'] ); ?>"
											>
										</figure>
									</div>
								</div>
								<div class="it-card-body">
									<p class="it-card-text">
										<?php echo esc_html( wp_trim_words( $dis_wrapper->description, DIS_ACF_SHORT_DESC_LENGTH ) ); ?>
									</p>
								</div>
								<footer class="it-card-related it-card-footer">
									<div class="it-card-taxonomy">
										<a href="<?php echo esc_url( $dis_wrapper->type_link ); ?>"
											class="it-card-category it-card-link link-secondary">
											<span class="visually-hidden">
												<?php echo esc_html__( 'Related contents', 'design_ict_site' ); ?>
											</span>
											<?php echo esc_html( $dis_wrapper->type ); ?>
										</a>
									</div>
									<time class="it-card-date" datetime="<?php echo esc_attr( $dis_wrapper->long_date ); ?>">
										<?php echo esc_html( $dis_wrapper->long_date ); ?>
									</time>
								</footer>
							</article>
						</div>
					<?php endforeach; ?>
				</div>

				<?php if ( $dis_all_link ) : ?>
					<div class="text-center pt-5 pb-5">
						<a href="<?php echo esc_url( $dis_all_link ); ?>" class="btn btn-secondary">
							<?php echo esc_html( $dis_all_label ); ?>
						</a>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</section>
	<?php
}
