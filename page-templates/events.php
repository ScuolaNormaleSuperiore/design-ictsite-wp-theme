<?php
/** Template Name: dis-event
 *
 * @package Design_ICT_Site
 */

global $post;
get_header();

// Check pagination parameters.
$posts_per_page  = strval( DIS_ITEMS_PER_PAGE_EVEN );
$per_page_values = DIS_ITEMS_PER_PAGE_VALUES_EVEN;
if ( isset( $_GET['posts_per_page'] ) && is_numeric( $_GET['posts_per_page'] ) ) {
	$posts_per_page = sanitize_text_field( wp_unslash( $_GET['posts_per_page'] ) );}
$current_page = isset( $_GET['num_page'] ) ? max( 1, intval( sanitize_text_field( wp_unslash( $_GET['num_page'] ) ) ) ) : 1;

// Parameters: get default values.
$all_categories   = get_categories( array( 'hide_empty' => true ) );
$default_cat_list = array_column( $all_categories, 'slug' );

// Parameters: check and sanitize values.
if ( isset( $_GET['selected_categories'] ) && is_array( $_GET['selected_categories'] ) ) {
	$selected_categories = array_map( 'sanitize_text_field', wp_unslash( $_GET['selected_categories'] ) );
} else {
	$selected_categories = array();
}

// Prepare the query.
$params = array(
	'post_type'      => DIS_EVENT_POST_TYPE,
	'search_string'  => '',
	'posts_per_page' => $posts_per_page,
	'current_page'   => $current_page,
	'orderby'        => 'post_date',
	'order'          => 'DESC',
);

// Add category filter, if selected.
if ( count( $selected_categories ) > 0 ) {
	$params['taxonomy'] = DIS_DEFAULT_CATEGORY;
	$params['terms']    = $selected_categories;
}

// Execute the query.
$the_query   = DIS_ContentsManager::get_generic_post_query( $params );
$num_results = $the_query->found_posts;
?>

<!-- ARCHIVE PAGE -->
<div class="container shadow rounded  p-4 pt-3 pb-3 mb-5">
	<div class="row">

		<div class="col">
			<h2 class="pb-2">
				<?php echo esc_attr( get_the_title() ); ?>
			</h2>

			<?php
			if ( $num_results ) {
			?>
			<!-- RESULT LIST  -->
			<ul class="it-card-list row" aria-label="Lista delle news">
				<?php
				while ( $the_query->have_posts() ) {
					$the_query->the_post();
					$image_data     = DIS_ContentsManager::get_image_metadata( $post, 'full' );
					$short_desc     = DIS_CustomFieldsManager::get_field( 'short_description', $post->ID );
					$categories     = get_the_category( $post->ID );
					$start_date     = DIS_CustomFieldsManager::get_field( 'start_date', $post->ID );
					$end_date       = DIS_CustomFieldsManager::get_field( 'end_date', $post->ID );
					$start_date_lng = $start_date ? DIS_ContentsManager::format_long_date( $start_date, false ) : '';
					$end_date_lng   = $end_date ? DIS_ContentsManager::format_long_date( $end_date, false ) : '';
					$category       = null;
					if ( $categories ) {
						$category = ( count( $categories ) > 0 ) ? $categories[0] : $categories;
					}
				?>
					<li class="col-12 col-md-6 col-lg-6 mb-3 mb-md-4">
						<article class="it-card it-card-image it-card-height-full rounded border shadow-sm mb-3">
							<!-- Title -->
							<h3 class="it-card-title ">
								<a
									href="<?php echo esc_url( get_permalink( $post->ID ) ); ?>"
									title="<?php echo esc_attr( $post->post_title ); ?>"
									alt="<?php echo esc_attr( $post->post_title ); ?>"
								>
									<?php echo esc_attr( $post->post_title ); ?>
								</a>
							</h3>
							<!-- Image -->
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
								<p class="it-card-subtitle">
									<?php
									if ( $start_date_lng && $end_date_lng ) {
										$date_string = sprintf( __( 'From %s to %s', 'design_ict_site' ), $start_date_lng, $end_date_lng );
										echo esc_attr( $date_string );
									} else if ( $start_date_lng ) {
										echo esc_attr( $start_date_lng );
									}
									?>
								</p>
								<p class="it-card-text">
									<?php echo esc_attr( $short_desc ); ?>
								</p>
								<!-- Footer -->
								<footer class="it-card-related">
									<div class="it-card-taxonomy">
										<?php
										if ( $category ) {
											$list_page = DIS_MultiLangManager::get_page_by_label( EVENTS_PAGE_SLUG );
										?>
										<a href="<?php echo esc_url( get_permalink( $list_page ) ) . '?category=' . esc_attr( $category->slug ); ?>"
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
									<time class="it-card-date" datetime="<?php echo get_the_date( 'j/n/Y' ); ?>">
										<?php echo get_the_date( 'j/n/Y' ); ?>
									</time>
								</footer>
							</div>
							<!-- Subscribe the event -->
						</article>
					</li>
				<?php
				}
				wp_reset_postdata();
				?>

			</ul>
			<?php
			}
			?>

			<!-- Results pagination-->
			<?php
			get_template_part(
				'template-parts/common/pagination',
				null,
				array(
					'query'           => $the_query,
					'posts_per_page'  => $posts_per_page,
					'per_page_values' => $per_page_values,
					'num_results'     => $num_results,
					'current_page'    => $current_page,
				)
			);
			?>

		</div>

		<!-- SIDEBAR FILTERS -->
		<div class="col-12 col-lg-4 col-md-5">
			<div class="sidebar-wrapper it-line-left-side">
				<FORM action="." id="search_items_form" method="GET">

					<div class="p-4 pt-lg-0">
						<h3 class="p-0">
							<?php echo esc_attr( __( 'Filter by category', 'design_ict_site' ) ); ?>
						</h3>
						<fieldset>
							<legend class="visually-hidden">
								<?php echo esc_attr( __( 'Filter by category', 'design_ict_site' ) ); ?>
							</legend>

							<?php
							foreach ( $all_categories as $ctg ) {
							?>
							<div class="form-check">
								<input type="checkbox"  name="selected_categories[]" id="<?php echo esc_attr( $ctg->slug ); ?>" 
									value="<?php echo esc_attr( $ctg->slug ); ?>"
									<?php
									if ( count( $selected_categories ) > 0 && in_array( $ctg->slug, $selected_categories ) ) {
										echo "checked='checked'";
									}
									?>
									>
								<label for="<?php echo esc_attr( $ctg->slug ); ?>">
									<?php echo esc_attr( $ctg->name ); ?>
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
				</FORM>
			</div>
		</div>

	</div> <!-- row -->
</div> <!-- container -->

<?php
get_footer();
