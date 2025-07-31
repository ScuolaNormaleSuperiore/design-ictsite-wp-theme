<?php
/**
 * Detail page for the post-type: dis-project.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Design_ICT_Site
 */
global $post;
get_header();

$image_data = DIS_ContentsManager::get_image_metadata( $post, 'full', '/assets/img/default-background.png' );
$website    = DIS_CustomFieldsManager::get_field( 'website', $post->ID );
$repository = DIS_CustomFieldsManager::get_field( 'repository', $post->ID );
$video      = DIS_CustomFieldsManager::get_field( 'video', $post->ID );
$persons    = DIS_CustomFieldsManager::get_field( 'participants', $post->ID ) ?? array();
?>

<!-- CONTENT BODY -->
<div class="container shadow rounded p-5 mb-5 mt-2">
	<div class="row">
		<!-- BODY PROGETTO -->
		<div class="col-12 col-md-10 offset-md-1 col-lg-8 offset-lg-1 m-auto">
			<h2>
				<?php echo esc_attr( $post->post_title ); ?>
			</h2>

			<!-- DESCRIZIONE -->
			<?php the_content(); ?>

			<!-- Featured image-->
			<section class="it-hero-wrapper it-hero-small-size mt-3" aria-label="In evidenza">
				<div class="img-responsive-wrapper">
					<div class="img-responsive">
						<div class="img-wrapper">
							<img
								src="<?php echo esc_url( $image_data['image_url'] ); ?>"
								title="<?php echo esc_attr( $image_data['image_title'] ); ?>"
								alt="<?php echo esc_attr( $image_data['image_alt'] ); ?>"
							>
							</div>
					</div>
				</div>
			</section>

			<!-- CONTRIBUTORS -->
			<div class="row">
				<!-- People -->
				<?php
				if ( $persons ) {
				?>
				<h3 class="h4 service-paragraph mt-3">
					<i class="bi bi-person" style="font-size: 1.75rem;"></i>&nbsp;
					<?php echo esc_attr( __( 'Contributors', 'design_ict_site' ) ); ?>
				</h3>
				<?php
					get_template_part(
						'template-parts/common/people-section',
						false,
						array(
							'persons' => $persons,
							'format'  => 'small',
						)
					);
				?>
				<?php
				}
				?>

				<!-- VIDEO -->
				<?php
				if ( $video ){
				?>
				<?php
					get_template_part(
						'template-parts/common/video-section',
						false,
						array( 'video' => $video )
					);
				?>
				<?php
				}
				?>

			</div> <!-- row -->

		</div> <!-- col-->

		<!-- SIDEBAR -->
		<div class="col">
			<div class="sidebar-wrapper it-line-left-side ps-4">
				<div class="it-list-wrapper">
					<ul class="it-list">
						<!-- Website -->
						<?php
						if ( $website ) {
						?>
						<li>
							<a href="<?php echo esc_url( $website ); ?>" target="_blank" class="list-item">
								<div class="it-right-zone">
									<span class="text">
										<?php echo esc_attr( __( 'Website', 'design_ict_site' ) ); ?>
									</span>
									<svg class="icon">
										<title>
											<?php echo esc_attr( __( 'Link to the websiste of the project', 'design_ict_site' ) ); ?>
										</title>
										<use href="<?php echo DIS_THEME_URL . '/assets/bootstrap-italia/svg/sprites.svg#it-external-link'; ?>"></use>
									</svg>
								</div>
							</a>
						</li>
						<?php
						}
						if ( $repository ) {
						?>
						<!-- Repository-->
						<li>
							<a href="<?php echo esc_url( $repository ); ?>" target="_blank" class="list-item">
								<div class="it-right-zone">
									<span class="text">
										<?php echo esc_attr( __( 'Repository', 'design_ict_site' ) ); ?>
									</span>
									<svg class="icon">
										<title>
											<?php echo esc_attr( __( 'Link to the repository of the project', 'design_ict_site' ) ); ?>
										</title>
										<use href="<?php echo DIS_THEME_URL . '/assets/bootstrap-italia/svg/sprites.svg#it-code-circle'; ?>"></use>
									</svg>
								</div>
							</a>
						</li>
						<?php
						}
						?>
					</ul>
				</div>
			</div>
		</div>

	</div> <!-- row-->

	<!-- Last modification -->
	<?php get_template_part( 'template-parts/footer/last_modification' ); ?>

</div>


<?php
get_footer();
