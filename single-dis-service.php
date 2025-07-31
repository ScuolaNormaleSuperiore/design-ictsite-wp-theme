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

$short_description = DIS_CustomFieldsManager::get_field( 'short_description', $post->ID );
$service_link      = DIS_CustomFieldsManager::get_field( 'service_link', $post->ID );
$features          = DIS_CustomFieldsManager::get_field( 'features', $post->ID );
$requirements      = DIS_CustomFieldsManager::get_field( 'requirements', $post->ID );
$rates             = DIS_CustomFieldsManager::get_field( 'rates', $post->ID );
$get_started       = DIS_CustomFieldsManager::get_field( 'get_started', $post->ID );
$related_doc       = DIS_CustomFieldsManager::get_field( 'related_documents', $post->ID );
$related_services  = DIS_CustomFieldsManager::get_field( 'related_services', $post->ID );
$designed_for      = get_the_terms( $post->ID, DIS_USER_STATUS_TAXONOMY );
$offices           = DIS_CustomFieldsManager::get_field( 'office', $post->ID );
$full_offices      = DIS_ContentsManager::get_string_list_from_posts( $offices, false );
// Increment the counter of the visits.
DIS_ContentsManager::increment_visit_counter( $post->ID );
$related_faqs      = DIS_ContentsManager::get_related_faq( $post );
?>

<!-- SERVICE DETAIL -->
<div class="container shadow rounded p-5 mb-5 mt-2">
	<div class="row">
		<div class="col-12 col-md-10 offset-md-1 col-lg-8 offset-lg-1 m-auto">

			<!-- Title -->
			<h2>
				<?php echo esc_attr( $post->post_title ); ?>
			</h2>

			<!-- DESCRIZIONE -->
			<?php echo wp_kses_post( get_the_content() ); ?>

			<!-- Button to access the service -->
			<?php if ( $service_link ) : ?>
		<div class="mb-4">
			<a target="_blank" href="<?php echo esc_url( $service_link ) ?>">
				<button class="btn btn-primary" type="button">
					<?php echo esc_attr( __( 'Access the service', 'design_ict_site' ) ); ?>
				</button>
			</a>
		</div>
			<?php endif ?>

			<!-- FEATURES-->
			<?php
			if ( $features ) {
			?>
				<h3 class="h4 service-paragraph">
					<i class="bi bi-check-circle" style="font-size: 1.75rem;"></i>
					<?php echo esc_attr( __( 'Features', 'design_ict_site' ) ); ?>
				</h3>
				<?php echo wp_kses_post( $features ); ?>
				<?php
				}
				?>

			<!-- REQUIREMENTS-->
			<?php
			if ( $requirements ) {
			?>
				<h3 class="h4 service-paragraph">
					<i class="bi bi-list-check" style="font-size: 1.75rem;"></i>
					<?php echo esc_attr( __( 'Requirements', 'design_ict_site' ) ); ?>
				</h3>
				<?php echo wp_kses_post( $requirements ); ?>
			<?php
			}
			?>

			<!-- DESIGNED FOR -->
			<?php
			if ( $designed_for ) {
				$df_array = array();
				foreach ( $designed_for as $df ) {
					array_push( $df_array, $df->name );
				}
				$df_string = join( ', ', $df_array );
			?>
				<h3 class="h4 service-paragraph">
					<i class="bi bi-people" style="font-size: 1.75rem;"></i>
					<?php echo esc_attr( __( 'Designed for', 'design_ict_site' ) ); ?>
				</h3>
				<p class="">
					<?php echo $df_string; ?>
				</p>
			<?php
			}
			?>

			<!-- GET STARTED-->
			<?php
			if ( $get_started ) {
			?>
				<h3 class="h4 service-paragraph">
					<i class="bi bi-rocket" style="font-size: 1.75rem;"></i>
					<?php echo esc_attr( __( 'Get started', 'design_ict_site' ) ); ?>
				</h3>
				<p class="">
					<?php echo wp_kses_post( $get_started ); ?>
				</p>
				<?php
			}
			?>

			<!-- RATES -->
			<?php
			if ( $rates ) {
			?>
				<h3 class="h4 service-paragraph">
					<i class="bi bi-credit-card" style="font-size: 1.75rem;"></i>
					<?php echo esc_attr( __( 'Rates', 'design_ict_site' ) ); ?>
				</h3>
				<p class="">
					<?php echo wp_kses_post( $get_started ); ?>
					<?php echo ( $rates ); ?>
				</p>
			<?php
			}
			?>



			<!-- FAQ -->
			<?php
			if ( $related_faqs ) {
			?>
				<h3 class="h4 service-paragraph">
					<i class="bi bi-question-circle" style="font-size: 1.75rem;"></i>
					<?php echo esc_attr( __( 'FAQ', 'design_ict_site' ) ); ?>
				</h3>
				<div class="accordion accordion-left-icon" id="accordionExampleLft">
					<?php
					foreach ( $related_faqs as $i => $faq ) {
						?>
						<div class="accordion-item">
							<h4 class="accordion-header " id="<?php echo 'heading' . $i . 'l'; ?>">
								<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
									data-bs-target="<?php echo '#collapse' . $i . 'l'; ?>"
									aria-expanded="false"
									aria-controls="collapse2l">
									<?php echo esc_attr( $faq->post_title ); ?>
								</button>
							</h4>
							<div id="<?php echo 'collapse' . $i . 'l'; ?>"
								class="accordion-collapse collapse"
								data-bs-parent="#accordionExampleLft"
								role="region"
								aria-labelledby="<?php echo 'heading' . $i . 'l'; ?>"
							>
								<div class="accordion-body">
									<?php echo apply_filters( 'the_content', $faq->post_content ); ?>
								</div>
							</div>
						</div>
					<?php
					}
					?>
				</div>
			<?php
			}
			?>

		</div> <!-- col-->

		<!-- SIDEBAR -->
		<div class="col">
			<div class="sidebar-wrapper it-line-left-side ps-4">

				<!-- LEARN MORE -->
				<?php
				if ( $related_doc ) {
				?>
				<h3 class="h4 ">
					<i class="bi bi-info-circle" style="font-size: 1.75rem;"></i>&nbsp;
					<?php echo esc_attr( __( 'Documentation', 'design_ict_site' ) ); ?>
				</h3>
				<ul class="link-list">
					<?php
					foreach ( $related_doc as $doc ) {
						$attachment_file    = DIS_CustomFieldsManager::get_field( 'file', $doc->ID );
						$attachment_link    = DIS_CustomFieldsManager::get_field( 'link', $doc->ID );
						$documentation_link = $attachment_file ? $attachment_file['url'] : $attachment_link;
					?>
						<li>
							<a target="_blank"
								href="<?php echo( esc_url( $documentation_link ) ); ?>">
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

				<!-- Related services -->
				<?php
				if ( $related_services ) {
				?>
				<h3 class="h4 ">
					<i class="bi bi-arrow-right-circle" style="font-size: 1.75rem;"></i>&nbsp;
					<?php echo esc_attr( __( 'Related services', 'design_ict_site' ) ); ?>
				</h3>
				<ul>
					<?php foreach ( $related_services as $serv ) : ?>
						<li>
							<a href="<?php echo esc_url( get_permalink( $serv ) ); ?>">
								<?php echo esc_attr( $serv->post_title ); ?>
							</a>
						</li>
					<?php endforeach ?>
				</ul>
				<?php
				}
				?>

				<!-- GET HELP -->
				<h3 class="h4 ">
					<i class="bi bi-question-circle" style="font-size: 1.75rem;"></i>&nbsp;
					<?php echo esc_attr( __( 'Get Help', 'design_ict_site' ) ); ?>
				</h3>
				<?php
				if ( $offices ) {
					$get_help_string = sprintf( __( 'The competent office is %s', 'design_ict_site' ), $full_offices );

				?>
					<p class="ps-4">
						<?php echo esc_attr( $get_help_string ); ?>.
					</p>
				<?php
				}
				$support_page_link = DIS_MultiLangManager::get_page_link( HELP_DESK_PAGE_SLUG );
				$support_link      = '<a href="' . $support_page_link . '">Help Desk</a>';
				$support_string    = sprintf( __( 'For support contact the %s', 'design_ict_site' ), $support_link );
				?>
				<p class="ps-4">
					<?php echo wp_kses_post( $support_string ); ?>
				</p>

			</div>

		</div> <!-- col-->

	</div> <!-- row-->

	<!-- Last modification -->
	<div class="row">
		<div class="col-12 pt-3">
			<p class="small text-center">
				<?php echo esc_attr( __( 'Last modification', 'design_ict_site' ) ); ?>:&nbsp;
				<?php the_modified_date( 'd/m/Y' ); ?>
			</p>
		</div>
	</div>

</div>

<?php
get_footer();
