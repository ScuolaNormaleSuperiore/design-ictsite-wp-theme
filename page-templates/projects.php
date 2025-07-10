<?php
/* Template Name: dis-project
*
* @package Design_ICT_Site
*/

global $post;
get_header();

$items = DIS_ContentsManager::get_generic_post_list( DIS_PROJECT_POST_TYPE );
if ( count( $items ) > 0 ){
?>

	<!-- ARCHIVE PAGE -->
	<div class="container shadow rounded  p-4 pt-3 pb-3 mb-5">
		<div class="row">
			<div class="col">
				<h2 class="pb-2">
					<?php echo esc_attr( get_the_title() ); ?>
				</h2>

				<!-- RESULT LIST  -->
				<ul class="it-card-list row" aria-label="Lista delle news">
					<?php
					foreach ( $items as $item ) {
						$image_data = DIS_ContentsManager::get_image_metadata( $item, 'full' );
						$short_desc = DIS_CustomFieldsManager::get_field( 'short_description' , $item->ID );
					?>
					<li class="col-12 col-md-6 col-lg-4 mb-3 mb-md-4">
						<article class="it-card it-card-image it-card-height-full">
							<!-- Title -->
							<h3 class="it-card-title ">
								<a
									href="<?php echo esc_url( get_permalink( $item->ID ) ); ?>"
									title="<?php echo esc_attr( $item->post_title ); ?>"
									alt="<?php echo esc_attr( $item->post_title ); ?>"
								>
									<?php echo esc_attr( $item->post_title ); ?>
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
					?>
				</ul>


			<!-- paginazione risultati
			<?php
				get_template_part(
					'template-parts/common/pagination',
					null,
					array(
						'query'           => $the_query,
						'per_page'        => $per_page,
						'per_page_values' => $per_page_values,
						'num_results'     => $num_results,
					)
				);
			?>
 -->
 
			</div> <!-- col -->
		</div>
	</div>


<?php
}
get_footer();
