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

$dsi_service_link     = DIS_CustomFieldsManager::get_field( 'service_link', $post->ID );
$dsi_features         = DIS_CustomFieldsManager::get_field( 'features', $post->ID );
$dsi_requirements     = DIS_CustomFieldsManager::get_field( 'requirements', $post->ID );
$dsi_rates            = DIS_CustomFieldsManager::get_field( 'rates', $post->ID );
$dsi_get_started      = DIS_CustomFieldsManager::get_field( 'get_started', $post->ID );
$dsi_related_doc      = DIS_CustomFieldsManager::get_field( 'related_documents', $post->ID );
$dsi_related_services = DIS_CustomFieldsManager::get_field( 'related_services', $post->ID );
$dsi_designed_for     = get_the_terms( $post->ID, DIS_USER_STATUS_TAXONOMY );
$dsi_offices          = DIS_CustomFieldsManager::get_field( 'office', $post->ID );
$dsi_full_offices     = DIS_ContentsManager::get_string_list_from_posts( $dsi_offices, false );

// Increment the counter of the visits.
DIS_ContentsManager::increment_visit_counter( 'service_page_counter_enabled', $post->ID );

// Related items.
$dsi_related_faqs = DIS_ContentsManager::get_related_faq( $post );
?>

<!-- SERVICE DETAIL -->
<div class="container shadow rounded p-5 mb-5 mt-2">
	<div class="row">
		<div class="col-12 col-md-10 offset-md-1 col-lg-8 offset-lg-1 m-auto">

			<!-- Title -->
			<h2>
				<?php echo esc_html( $post->post_title ); ?>
			</h2>

			<!-- Description -->
			<?php echo wp_kses_post( get_the_content() ); ?>

			<!-- Button to access the service -->
			<?php if ( $dsi_service_link ) : ?>
				<div class="mb-4">
					<a target="_blank" href="<?php echo esc_url( $dsi_service_link ); ?>" rel="noopener noreferrer" class="btn btn-primary">
						<?php echo esc_html__( 'Access the service', 'design_laboratori_italia' ); ?>
					</a>
				</div>
			<?php endif; ?>

			<!-- Features -->
			<?php if ( $dsi_features ) : ?>
				<h3 class="h4 service-paragraph">
					<i class="bi bi-check-circle" style="font-size: 1.75rem;"></i>
					<?php echo esc_html__( 'Features', 'design_laboratori_italia' ); ?>
				</h3>
				<?php echo wp_kses_post( $dsi_features ); ?>
			<?php endif; ?>

			<!-- Requirements -->
			<?php if ( $dsi_requirements ) : ?>
				<h3 class="h4 service-paragraph">
					<i class="bi bi-list-check" style="font-size: 1.75rem;"></i>
					<?php echo esc_html__( 'Requirements', 'design_laboratori_italia' ); ?>
				</h3>
				<?php echo wp_kses_post( $dsi_requirements ); ?>
			<?php endif; ?>

			<!-- Designed for -->
			<?php if ( $dsi_designed_for ) : ?>
				<?php $dsi_designed_for_string = implode( ', ', wp_list_pluck( $dsi_designed_for, 'name' ) ); ?>
				<h3 class="h4 service-paragraph">
					<i class="bi bi-people" style="font-size: 1.75rem;"></i>
					<?php echo esc_html__( 'Designed for', 'design_laboratori_italia' ); ?>
				</h3>
				<p>
					<?php echo esc_html( $dsi_designed_for_string ); ?>
				</p>
			<?php endif; ?>

			<!-- Get started -->
			<?php if ( $dsi_get_started ) : ?>
				<h3 class="h4 service-paragraph">
					<i class="bi bi-rocket" style="font-size: 1.75rem;"></i>
					<?php echo esc_html__( 'Get started', 'design_laboratori_italia' ); ?>
				</h3>
				<p>
					<?php echo wp_kses_post( $dsi_get_started ); ?>
				</p>
			<?php endif; ?>

			<!-- Rates -->
			<?php if ( $dsi_rates ) : ?>
				<h3 class="h4 service-paragraph">
					<i class="bi bi-credit-card" style="font-size: 1.75rem;"></i>
					<?php echo esc_html__( 'Rates', 'design_laboratori_italia' ); ?>
				</h3>
				<p>
					<?php echo wp_kses_post( $dsi_rates ); ?>
				</p>
			<?php endif; ?>

			<!-- FAQ -->
			<?php if ( $dsi_related_faqs ) : ?>
				<h3 class="h4 service-paragraph">
					<i class="bi bi-question-circle" style="font-size: 1.75rem;"></i>
					<?php echo esc_html__( 'FAQ', 'design_laboratori_italia' ); ?>
				</h3>
				<div class="accordion accordion-left-icon" id="accordionExampleLft">
					<?php foreach ( $dsi_related_faqs as $dsi_index => $dsi_faq ) : ?>
						<?php $dsi_item_id = (string) $dsi_index . 'l'; ?>
						<div class="accordion-item">
							<h4 class="accordion-header" id="<?php echo esc_attr( 'heading' . $dsi_item_id ); ?>">
								<button
									class="accordion-button collapsed"
									type="button"
									data-bs-toggle="collapse"
									data-bs-target="<?php echo esc_attr( '#collapse' . $dsi_item_id ); ?>"
									aria-expanded="false"
									aria-controls="<?php echo esc_attr( 'collapse' . $dsi_item_id ); ?>"
								>
									<?php echo esc_html( $dsi_faq->post_title ); ?>
								</button>
							</h4>
							<div
								id="<?php echo esc_attr( 'collapse' . $dsi_item_id ); ?>"
								class="accordion-collapse collapse"
								data-bs-parent="#accordionExampleLft"
								role="region"
								aria-labelledby="<?php echo esc_attr( 'heading' . $dsi_item_id ); ?>"
							>
								<div class="accordion-body">
									<?php echo wpautop( wp_kses_post( $dsi_faq->post_content ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
								</div>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>

		</div> <!-- col-->

		<!-- SIDEBAR -->
		<div class="col">
			<div class="sidebar-wrapper it-line-left-side ps-4">

				<!-- Learn more -->
				<?php if ( $dsi_related_doc ) : ?>
					<h3 class="h4">
						<i class="bi bi-info-circle" style="font-size: 1.75rem;"></i>&nbsp;
						<?php echo esc_html__( 'Documentation', 'design_laboratori_italia' ); ?>
					</h3>
					<ul class="link-list">
						<?php foreach ( $dsi_related_doc as $dsi_doc ) : ?>
							<?php
							$dsi_attachment_file    = DIS_CustomFieldsManager::get_field( 'file', $dsi_doc->ID );
							$dsi_attachment_link    = DIS_CustomFieldsManager::get_field( 'link', $dsi_doc->ID );
							$dsi_documentation_link = $dsi_attachment_file ? $dsi_attachment_file['url'] : $dsi_attachment_link;
							?>
							<li>
								<a target="_blank" href="<?php echo esc_url( $dsi_documentation_link ); ?>" rel="noopener noreferrer">
									<?php echo esc_html( $dsi_doc->post_title ); ?>
								</a>
							</li>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>

				<!-- Related services -->
				<?php if ( $dsi_related_services ) : ?>
					<h3 class="h4">
						<i class="bi bi-arrow-right-circle" style="font-size: 1.75rem;"></i>&nbsp;
						<?php echo esc_html__( 'Related services', 'design_laboratori_italia' ); ?>
					</h3>
					<ul>
						<?php foreach ( $dsi_related_services as $dsi_service ) : ?>
							<li>
								<a href="<?php echo esc_url( get_permalink( $dsi_service ) ); ?>">
									<?php echo esc_html( $dsi_service->post_title ); ?>
								</a>
							</li>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>

				<!-- Get help -->
				<h3 class="h4">
					<i class="bi bi-question-circle" style="font-size: 1.75rem;"></i>&nbsp;
					<?php echo esc_html__( 'Get Help', 'design_laboratori_italia' ); ?>
				</h3>
				<?php if ( $dsi_offices ) : ?>
					<?php
					/* translators: %s: linked office list. */
					$dsi_get_help_string = sprintf( __( 'The competent office is %s', 'design_laboratori_italia' ), $dsi_full_offices );
					?>
					<p class="ps-4">
						<?php echo wp_kses_post( $dsi_get_help_string ); ?>.
					</p>
				<?php endif; ?>
				<?php
				$dsi_support_page_link = DIS_MultiLangManager::get_page_link( HELP_DESK_PAGE_SLUG );
				$dsi_support_link      = '<a href="' . esc_url( $dsi_support_page_link ) . '">Help Desk</a>';
				/* translators: %s: help desk link. */
				$dsi_support_string = sprintf( __( 'For support contact the %s', 'design_laboratori_italia' ), $dsi_support_link );
				?>
				<p class="ps-4">
					<?php echo wp_kses_post( $dsi_support_string ); ?>
				</p>

			</div>

		</div> <!-- col-->

	</div> <!-- row-->

	<!-- Last modification -->
	<?php get_template_part( 'template-parts/footer/last_modification' ); ?>

</div>

<?php
get_footer();
