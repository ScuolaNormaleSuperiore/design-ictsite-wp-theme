<?php
/**
 * The HP news list section.
 *
 * @package Design_ICT_Site
 */

$dis_enabled_par     = $args['enabled'] ?? '';
$dis_show_title_par  = $args['show_title'] ?? '';
$dis_show_title      = ( 'true' === $dis_show_title_par );
$dis_section_enabled = ( 'true' === $dis_enabled_par );

if ( $dis_section_enabled ) {
	$dis_items          = DIS_ContentsManager::get_hp_item_list( DIS_NEWS_POST_TYPE );
	$dis_all_items_link = DIS_MultiLangManager::get_archive_link( DIS_NEWS_POST_TYPE );

	if ( count( $dis_items ) ) {
		?>
		<section id="blocco-news" class="section pt-5 pb-3">
			<div class="section-content">
				<div class="container">
					<h2 class="pb-4">
						<?php
						if ( $dis_show_title ) {
							echo esc_html( dis_ct_data()[ DIS_NEWS_POST_TYPE ]['plural_name'] );
						}
						?>
					</h2>
					<div class="row">
						<?php foreach ( $dis_items as $dis_item ) : ?>
							<?php
							$dis_image_data = DIS_ContentsManager::get_image_metadata( $dis_item, 'medium' );
							$dis_short_desc = DIS_CustomFieldsManager::get_field( 'short_description', $dis_item->ID );
							$dis_post_date  = get_the_date( 'j F Y', $dis_item->ID );
							$dis_categories = get_the_category( $dis_item->ID );
							$dis_category   = null;

							if ( $dis_categories ) {
								$dis_category = ( count( $dis_categories ) > 0 ) ? $dis_categories[0] : $dis_categories;
							}
							?>
							<div class="col-12 col-lg-4">
								<article class="it-card it-card-image it-card-height-full">
									<h3 class="it-card-title ">
										<a href="<?php echo esc_url( get_permalink( $dis_item->ID ) ); ?>" title="<?php echo esc_attr( $dis_item->post_title ); ?>">
											<?php echo esc_html( $dis_item->post_title ); ?>
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
											<?php echo esc_html( $dis_short_desc ); ?>
										</p>
									</div>
									<footer class="it-card-related it-card-footer">
										<div class="it-card-taxonomy">
											<?php
											$dis_news_list = null;
											if ( $dis_category ) {
												$dis_news_list = DIS_MultiLangManager::get_page_by_label( NEWS_PAGE_SLUG );
											}
											?>
											<?php if ( $dis_category && $dis_news_list ) : ?>
												<a href="<?php echo esc_url( add_query_arg( 'category', $dis_category->slug, get_permalink( $dis_news_list ) ) ); ?>"
													class="it-card-category it-card-link link-secondary">
													<span class="visually-hidden">
														<?php echo esc_html__( 'Related category', 'design_ict_site' ); ?>:&nbsp;
													</span>
													<?php echo esc_html( $dis_category->name ); ?>
												</a>
											<?php endif; ?>
										</div>
										<time class="it-card-date" datetime="<?php echo esc_attr( $dis_post_date ); ?>">
											<?php echo esc_html( $dis_post_date ); ?>
										</time>
									</footer>
								</article>
							</div>
						<?php endforeach; ?>
					</div>
					<div class="text-center pt-5 pb-5">
						<a href="<?php echo esc_url( $dis_all_items_link ); ?>" class="btn btn-secondary">
							<?php echo esc_html__( 'All news', 'design_ict_site' ); ?>
						</a>
					</div>
				</div>
			</div>
		</section>

		<?php
	}
}
