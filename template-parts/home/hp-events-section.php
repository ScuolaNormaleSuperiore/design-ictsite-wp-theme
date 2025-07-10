<?php
/**
 * The HP Events list section.
 *
 * @package Design_ICT_Site
 */

$enabled_par     = $args['enabled'] ?? '';
$id_par          = $args['id'] ?? '';
$show_title_par  = $args['show_title'] ?? '';
$show_title      = ( $show_title_par === 'true' ) ? true : false;
$section_enabled = ( $enabled_par === 'true' ) ? true : false;

if ( $section_enabled ) {
	$items          = DIS_ContentsManager::get_hp_item_list( DIS_EVENT_POST_TYPE );
	$all_items_link = DIS_MultiLangManager::get_archive_link( DIS_EVENT_POST_TYPE );
	if ( count( $items ) ) {
?>

	<!-- EVENTS SECTION-->
	<section id="blocco-news" class="section pt-5 pb-3">
		<div class="section-content">
			<div class="container">
				<h2 class="pb-4">
				<?php
				if ( $show_title ) {
					echo esc_attr( dis_ct_data()[ DIS_EVENT_POST_TYPE ]['plural_name'] );
				}
				?>
				</h2>
				<div class="row">
					<?php
					foreach ( $items as $item ) {
						$image_data = DIS_ContentsManager::get_image_metadata( $item, 'medium' );
						$short_desc = DIS_CustomFieldsManager::get_field( 'short_description' , $item->ID );
						$start_date = DIS_CustomFieldsManager::get_field( 'start_date' , $item->ID );
						if ( $start_date ) {
							$timestamp   = strtotime( $start_date );
							$string_date = date_i18n( 'j F Y', $timestamp );
						} else {
							$string_date = '';
						}

						$categories = get_the_category( $item->ID );
						$category   = null;
						if ( $categories ) {
							$category = ( count( $categories ) > 0 ) ? $categories[0] : $categories;
						}
					?>
						<div class="col-12 col-lg-4">
							<article class="it-card it-card-image it-card-height-full">
								<h3 class="it-card-title ">
									<a
										href="<?php echo esc_url( get_permalink( $item->ID ) ); ?>"
										title="<?php echo esc_attr( $item->post_title ); ?>"
										alt="<?php echo esc_attr( $item->post_title ); ?>"
									>
										<?php echo esc_attr( $item->post_title ); ?>
									</a>
								</h3>
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
								<div class="it-card-body">
									<p class="it-card-text">
										<?php echo esc_attr( $short_desc ); ?>
									</p>
								</div>
								<footer class="it-card-related it-card-footer">
									<div class="it-card-taxonomy">
										<?php
										if ( $category ) {
											$event_list = DIS_MultiLangManager::get_page_by_label( EVENTS_PAGE_SLUG );
										?>
										<a href="<?php echo esc_url( get_permalink( $event_list ) ) . '?category=' . $category->slug; ?>"
											class="it-card-category it-card-link link-secondary">
											<span class="visually-hidden">
												<?php echo __( 'Related category', 'design_ict_site' ); ?>:&nbsp;
											</span>
											<?php echo esc_attr( $category->name ); ?>
										</a>
										<?php
										}
										?>
									</div>
									<time class="it-card-date" datetime="<?php echo $string_date; ?>">
										<?php echo $string_date; ?>
									</time>
								</footer>
							</article>
						</div>
					<?php
					}
					?>
				</div>
				<div class="text-center pt-5 pb-5">
					<a href="<?php echo esc_url( $all_items_link ); ?>" class="btn btn-secondary">
						<?php echo __( 'All events', 'design_ict_site' ); ?>
					</a>
				</div>
			</div>
		</div>
	</section>

<?php
	}
}
?>
