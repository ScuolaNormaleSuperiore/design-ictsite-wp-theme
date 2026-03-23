<?php
/**
 * Template Name: Post
 *
 * @package Design_ICT_Site
 */

get_header();

// Check pagination parameters.
$dis_posts_per_page  = strval( DIS_ITEMS_PER_PAGE_EVEN );
$dis_per_page_values = DIS_ITEMS_PER_PAGE_VALUES_EVEN;
// phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Read-only archive filter parameter.
if ( isset( $_GET['posts_per_page'] ) && is_numeric( $_GET['posts_per_page'] ) ) {
	// phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Read-only archive filter parameter.
	$dis_posts_per_page = sanitize_text_field( wp_unslash( $_GET['posts_per_page'] ) );
}
// phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Read-only archive filter parameter.
$dis_current_page = isset( $_GET['num_page'] ) ? max( 1, intval( sanitize_text_field( wp_unslash( $_GET['num_page'] ) ) ) ) : 1;

// Get default values.
$dis_all_categories = get_categories( array( 'hide_empty' => true ) );

// Check and sanitize parameters.
// phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Read-only archive filter parameter.
if ( isset( $_GET['selected_categories'] ) && is_array( $_GET['selected_categories'] ) ) {
	// phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Read-only archive filter parameter.
	$dis_selected_categories = array_map( 'sanitize_text_field', wp_unslash( $_GET['selected_categories'] ) );
} else {
	$dis_selected_categories = array();
}

// Prepare the query.
$dis_params = array(
	'post_type'      => DIS_DEFAULT_POST,
	'search_string'  => '',
	'posts_per_page' => $dis_posts_per_page,
	'current_page'   => $dis_current_page,
	'orderby'        => 'post_date',
	'order'          => 'DESC',
);

// Add category filter, if selected.
if ( count( $dis_selected_categories ) > 0 ) {
	$dis_params['taxonomy'] = DIS_DEFAULT_CATEGORY;
	$dis_params['terms']    = $dis_selected_categories;
}

// Execute the query.
$dis_query       = DIS_ContentsManager::get_generic_post_query( $dis_params );
$dis_num_results = $dis_query->found_posts;
?>

<!-- ARCHIVE PAGE -->
<div class="container shadow rounded  p-4 pt-3 pb-3 mb-5">
	<div class="row">

		<div class="col">

			<!-- Title -->
			<h2 class="pb-2">
				<?php echo esc_attr( get_the_title() ); ?>
			</h2>

			<?php
			if ( $dis_num_results ) {
				?>
				<!-- RESULT LIST  -->
				<ul class="it-card-list row" aria-label="Lista delle news">
					<?php
					while ( $dis_query->have_posts() ) {
						$dis_query->the_post();
						$dis_post       = get_post();
						$dis_image_data = DIS_ContentsManager::get_image_metadata( $dis_post, 'full' );
						$dis_short_desc = DIS_CustomFieldsManager::get_field( 'short_description', $dis_post->ID );
						$dis_categories = get_the_category( $dis_post->ID );
						$dis_category   = null;
						if ( $dis_categories ) {
							$dis_category = ( count( $dis_categories ) > 0 ) ? $dis_categories[0] : $dis_categories;
						}
						?>
						<!-- SINGLE ITEM -->
						<li class="col-12 col-md-6 col-lg-4 mb-3 mb-md-4">
							<article class="it-card it-card-image it-card-height-full rounded shadow-sm">
								<!-- Title -->
								<h3 class="it-card-title ">
									<a
										href="<?php echo esc_url( get_permalink( $dis_post->ID ) ); ?>"
										title="<?php echo esc_attr( $dis_post->post_title ); ?>"
									>
										<?php echo esc_html( $dis_post->post_title ); ?>
									</a>
								</h3>
								<!-- Image -->
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
								<!-- Body -->
								<div class="it-card-body">
									<p class="it-card-text">
										<?php echo esc_html( $dis_short_desc ); ?>
									</p>
								</div>
								<!-- Footer -->
								<footer class="it-card-related it-card-footer">
									<div class="it-card-taxonomy">
										<?php
										if ( $dis_category ) {
											$dis_list_page = DIS_MultiLangManager::get_page_by_label( NEWS_PAGE_SLUG );
										}
										if ( $dis_category && $dis_list_page ) {
											?>
										<a href="<?php echo esc_url( add_query_arg( 'category', $dis_category->slug, get_permalink( $dis_list_page ) ) ); ?>"
											class="it-card-category it-card-link link-secondary">
											<span class="visually-hidden">
												<?php echo esc_html__( 'Related category', 'design_ict_site' ); ?>:&nbsp;
											</span>
											<?php echo esc_html( $dis_category->name ); ?>
										</a>
											<?php
										}
										?>
									</div>
									<time class="it-card-date" datetime="<?php echo get_the_date( 'j/n/Y' ); ?>">
										<?php echo get_the_date( 'j/n/Y' ); ?>
									</time>
								</footer>
							</article>
						</li>
						<?php
					}
					wp_reset_postdata();
					?>
				</ul>
				<?php
			} else {
				?>
				<div class="col-12 col-lg-8">
					<div clas="row pt-2">
						<em><?php echo esc_attr( __( 'No results found', 'design_ict_site' ) ); ?></em>
					</div>
				</div>
				<?php
			}
			?>


			<!-- Results pagination-->
			<?php
			get_template_part(
				'template-parts/common/pagination',
				null,
				array(
					'query'           => $dis_query,
					'posts_per_page'  => $dis_posts_per_page,
					'per_page_values' => $dis_per_page_values,
					'num_results'     => $dis_num_results,
					'current_page'    => $dis_current_page,
				)
			);
			?>
		</div>

		<!-- SIDEBAR FILTERS -->
		<div class="col-12 col-lg-4 col-md-5">
			<div class="sidebar-wrapper it-line-left-side">
				<form action="." id="search_news_form" method="get">

					<div class="p-4 pt-lg-0">
						<h3 class="p-0">
							<?php echo esc_attr( __( 'Filter by category', 'design_ict_site' ) ); ?>
						</h3>
						<fieldset>
							<legend class="visually-hidden">
								<?php echo esc_attr( __( 'Filter by category', 'design_ict_site' ) ); ?>
							</legend>

							<?php
							foreach ( $dis_all_categories as $dis_category_term ) {
								?>
							<div class="form-check">
								<input type="checkbox" name="selected_categories[]" id="<?php echo esc_attr( $dis_category_term->slug ); ?>"
									value="<?php echo esc_attr( $dis_category_term->slug ); ?>"
									<?php
									if ( count( $dis_selected_categories ) > 0 && in_array( $dis_category_term->slug, $dis_selected_categories, true ) ) {
										echo "checked='checked'";
									}
									?>
								>
								<label for="<?php echo esc_attr( $dis_category_term->slug ); ?>">
									<?php echo esc_html( $dis_category_term->name ); ?>
								</label>
							</div>
								<?php
							}
							?>

						</fieldset>
					</div>
					<!-- Submit the form -->
					<div class="p-4 pt-lg-0">
						<button type="submit" value="submit" class="btn btn-primary">
							<?php echo esc_attr( __( 'Apply filters', 'design_ict_site' ) ); ?>
						</button>
					</div>
				</form>
			</div>
		</div>

	</div> <!-- row -->
</div> <!-- container -->


<?php
get_footer();
