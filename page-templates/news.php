<?php
/* Template Name: dis-news
*
* @package Design_ICT_Site
*/

global $post;
get_header();

// Get default values.
$all_categories   = get_categories( array( 'hide_empty' => true ) );
$default_cat_list = array_column( $all_categories, 'slug' );

// Check and sanitize parameters.
if ( isset( $_GET['selected_categories'] ) && is_array( $_GET['selected_categories'] ) ) {
	$selected_categories = array_map( 'sanitize_text_field', wp_unslash( $_GET['selected_categories'] ) );
} else {
	$selected_categories = array();
}

// Prepare the query.
$params = array(
	'post_type'      => DIS_NEWS_POST_TYPE,
	'search_string'  => '',
	'posts_per_page' => $posts_per_page,
	'paged'          => $paged,
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
			
			<!-- Title -->
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
						$image_data = DIS_ContentsManager::get_image_metadata( $post, 'full' );
						$short_desc = DIS_CustomFieldsManager::get_field( 'short_description', $post->ID );
						$categories = get_the_category( $post->ID );
						$category   = null;
						if ( $categories ) {
							$category = ( count( $categories ) > 0 ) ? $categories[0] : $categories;
						}
					?>
						<li class="col-12 col-md-6 col-lg-4 mb-3 mb-md-4">
							<article class="it-card it-card-image it-card-height-full rounded shadow-sm">
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
									<p class="it-card-text">
										<?php echo esc_attr( $short_desc ); ?>
									</p>
								</div>
								<!-- Footer -->
								<footer class="it-card-related it-card-footer">
									<div class="it-card-taxonomy">
										<?php
										if ( $category ) {
											$list_page = DIS_MultiLangManager::get_page_by_label( NEWS_PAGE_SLUG );
										?>
										<a href="<?php echo esc_url( get_permalink( $list_page ) ) . '?category=' . $category->slug; ?>"
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


			<!-- @TODO: Results pagination-->
		</div>

		<!-- SIDEBAR FILTERS -->
		<div class="col-12 col-lg-4 col-md-5">
			<div class="sidebar-wrapper it-line-left-side">
				<FORM action="." id="search_site_form" method="GET">

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
