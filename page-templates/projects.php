<?php
/* Template Name: Projects
*
* @package Design_ICT_Site
*/

global $post;
get_header();

// Check pagination parameters.
$posts_per_page  = strval( DIS_ITEMS_PER_PAGE_ODD );
$per_page_values = DIS_ITEMS_PER_PAGE_VALUES_ODD;
if ( isset( $_GET['posts_per_page'] ) && is_numeric( $_GET['posts_per_page'] ) ) {
	$posts_per_page = sanitize_text_field( wp_unslash( $_GET['posts_per_page'] ) );}
$current_page = isset( $_GET['num_page'] ) ? max( 1, intval( sanitize_text_field( wp_unslash( $_GET['num_page'] ) ) ) ) : 1;

// Prepare the query.
$params = array(
	'post_type'      => DIS_PROJECT_POST_TYPE,
	'search_string'  => '',
	'posts_per_page' => $posts_per_page,
	'current_page'   => $current_page,
	'orderby'        => 'title',
	'order'          => 'ASC',
);

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
						$image_data = DIS_ContentsManager::get_image_metadata( $post, 'full' );
						$short_desc = DIS_CustomFieldsManager::get_field( 'short_description', $post->ID );
					?>
					<li class="col-12 col-md-6 col-lg-4 mb-3 mb-md-4">
						<article class="it-card it-card-image it-card-height-full">
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


			<!-- Pagination results-->
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

		</div> <!-- col -->
	</div>
</div>


<?php
get_footer();
