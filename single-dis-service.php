<?php
/**
 * Detail page for the post-type: dis-service.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Design_ICT_Site
 */
global $post;
get_header();

$short_description = DIS_CustomFieldsManager::get_field( 'short_description' , $post->ID );
$service_link      = DIS_CustomFieldsManager::get_field( 'service_link' , $post->ID );
$features          = DIS_CustomFieldsManager::get_field( 'features' , $post->ID );
$requirements      = DIS_CustomFieldsManager::get_field( 'requirements' , $post->ID );
$rates             = DIS_CustomFieldsManager::get_field( 'rates' , $post->ID );
$get_started       = DIS_CustomFieldsManager::get_field( 'get_started' , $post->ID );
$related_doc       = DIS_CustomFieldsManager::get_field( 'related_documents' , $post->ID );
$related_services  = DIS_CustomFieldsManager::get_field( 'related_services' , $post->ID );
$designed_for      = DIS_CustomFieldsManager::get_field( 'related_user_status' , $post->ID );
$get_help          = DIS_CustomFieldsManager::get_field( 'office' , $post->ID );
$image_data        = DIS_ContentsManager::get_image_metadata( $post, 'full', '/assets/img/default-background.png' );
// Increment the counter of the visits.
DIS_ContentsManager::increment_visit_counter( $post->ID );
?>

	<!-- CONTENT HERO -->
	<div class="container">
		<section class="it-hero-wrapper it-dark it-overlay it-text-centered">
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
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="it-hero-text-wrapper bg-dark it-text-centered">
						<h2><?php echo esc_html( $post->post_title ); ?></h2>
						<p class="d-none d-lg-block">
							<?php echo esc_html( $short_description ); ?>
						</p>
						<?php
						if ( $service_link ) {
						?>
						<div class="it-btn-container">
							<a class="btn btn-sm btn-secondary" href="<?php echo esc_url( $service_link ); ?>">
								<?php echo __( 'Access the service', 'design_ict_site' ); ?>
							</a>
						</div>
						<?php
						}
						?>
					</div>
				</div>
			</div>
		</div>
		</section>
	</div>

	<!-- CONTENT BODY -->
	<div class="container shadow rounded p-4 mb-5 mt-2">
		<div class="row">
			<!-- Description of the service -->
			<div class="col-12 col-md-10 offset-md-1 col-lg-7 offset-lg-1 m-auto">

				<!-- DESCRIPTION -->
				<p class="lead">
					<?php echo get_the_content() ?>
				</p>

				<?php
				if ( $features ) {
				?>
					<!-- FEATURES-->
					<h3 class="h4 service-paragraph">
						<i class="bi bi-check-circle" style="font-size: 1.75rem;"></i>
						<?php echo __( 'Features', 'design_ict_site' ); ?>
					</h3>
					<p class="">
						<?php echo $features; ?>
					</p>
				<?php
				}
				?>

				<?php
				if ( $requirements ) {
				?>
					<!-- REQUIREMENTS-->
					<h3 class="h4 service-paragraph">
						<i class="bi bi-list-check" style="font-size: 1.75rem;"></i>
						<?php echo __( 'Requirements', 'design_ict_site' ); ?>
					</h3>
					<p class="">
						<?php echo $requirements; ?>
					</p>
				<?php
				}
				?>

				<?php
				if ( $designed_for ) {
					$df_array = array();
					foreach ( $designed_for as $df ) {
						array_push( $df_array, $df->post_title );
					}
					$df_string = join( ', ', $df_array );
				?>
					<!-- DESIGNED FOR -->
					<h3 class="h4 service-paragraph">
						<i class="bi bi-people" style="font-size: 1.75rem;"></i>
						<?php echo __( 'Designed for', 'design_ict_site' ); ?>
					</h3>
					<p class="">
						<?php echo $df_string; ?>
					</p>
				<?php
				}
				?>

				<?php
				if ( $get_started ) {
				?>
					<!-- GET STARTED-->
					<h3 class="h4 service-paragraph">
						<i class="bi bi-rocket" style="font-size: 1.75rem;"></i>
						<?php echo __( 'Get started', 'design_ict_site' ); ?>
					</h3>
					<p class="">
						<?php echo $get_started; ?>
					</p>
					<?php
				}
				?>

				<?php
				if ( $rates ) {
				?>
					<!-- RATES -->
					<h3 class="h4 service-paragraph">
						<i class="bi bi-credit-card" style="font-size: 1.75rem;"></i>
						<?php echo __( 'Rates', 'design_ict_site' ); ?>
					</h3>
					<p class="">
						<?php echo $rates; ?>
					</p>
				<?php
				}
				?>

				<?php
				if ( $get_help ) {
					$gh_array = array();
					foreach ( $get_help as $gh ) {
						// $email = DIS_CustomFieldsManager::get_field( 'email' , $gh->ID );
						$txt  = '<a href="' . get_permalink( $gh ) . '">' . $gh->post_title . '</a>';
						array_push( $gh_array, $txt );
					}
					$gh_string = join( ', ', $gh_array );
				?>
					<!-- GET HELP -->
					<h3 class="h4 service-paragraph">
						<i class="bi bi-question-circle" style="font-size: 1.75rem;"></i>
						<?php echo __( 'Get help', 'design_ict_site' ); ?>
					</h3>
					<p class="">
						<?php echo $gh_string; ?>
					</p>
				<?php
				}
				?>

				<?php
				if ( $related_doc ) {
				?>
					<!-- Related Documents -->
					<h3 class="h4 service-paragraph">
						<i class="bi bi-info-circle" style="font-size: 1.75rem;"></i>
						<?php echo __( 'Documentation', 'design_ict_site' ); ?>
					</h3>
					<?php
					foreach ( $related_doc as $doc ) {
						$link = DIS_CustomFieldsManager::get_field( 'link' , $doc->ID );
					?>
						<ul>
							<?php
							if ( $link ){
							?>
							<li>
								<a target="_blank" href="<?php echo esc_url( $link ); ?>">
									<?php echo esc_attr( $doc->post_title ); ?>
								</a>
							</li>
							<?php
							} else {
							?>
							<li>
								<a href="<?php echo get_permalink( $doc ); ?>">
									<?php echo esc_attr( $doc->post_title ); ?>
								</a>
							</li>
							<?php
							}
							?>
						</ul>
					<?php
					}
					?>
				<?php
				}
				?>

				<?php
				if ( $related_services ) {
				?>
					<!-- Related Services -->
					<h3 class="h4 service-paragraph">
						<i class="bi bi-arrow-right-circle" style="font-size: 1.75rem;"></i>
						<?php echo __( 'Related services', 'design_ict_site' ); ?>
					</h3>
					<ul>
					<?php
					foreach ( $related_services as $service ) {
					?>
						<li>
							<a href="<?php echo get_permalink( $service ); ?>">
								<?php echo esc_attr( $service->post_title ); ?>
							</a>
						</li>
					<?php
					}
					?>
					</ul>
				<?php
				}
				?>

				<!-- Last modification -->
				<div class="pt-4">
					<p class="it-text-centered">
						<?php echo __( 'Last modification', 'design_ict_site' ); ?>: <?php the_modified_date('d/m/Y'); ?>
					</p>
				</div>

			</div>
		</div>
	</div>

<?php
get_footer();
