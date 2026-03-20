<?php
/**
 * Detail page for the post-type: dis-office.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Design_ICT_Site
 */

global $post;
get_header();

$dis_image_data  = DIS_ContentsManager::get_image_metadata( $post, 'full', '/assets/img/default-background.png' );
$dis_persons     = DIS_CustomFieldsManager::get_field( 'members', $post->ID );
$dis_email       = DIS_CustomFieldsManager::get_field( 'email', $post->ID );
$dis_telephone   = DIS_CustomFieldsManager::get_field( 'telephone', $post->ID );
$dis_places      = DIS_CustomFieldsManager::get_field( 'places', $post->ID );
$dis_full_places = DIS_ContentsManager::get_string_list_from_posts( $dis_places, true );
$dis_projects    = DIS_ContentsManager::get_office_projects( $post );
?>


<div class="container shadow rounded  p-4 pt-3 pb-3 mb-5">
	<div class="row">
		<div class="col">
			<h2 class="pb-2">
				<?php echo esc_attr( get_the_title() ); ?>
			</h2>

			<!-- Body -->
			<div class="row pb-3">
				<h3 class="it-page-section h4 visually-hidden" id="description">
					<?php echo esc_html__( 'Description', 'design_laboratori_italia' ); ?>
				</h3>
				<?php echo wp_kses_post( get_the_content() ); ?>
			</div>

			<!-- Members -->
			<?php if ( $dis_persons ) : ?>
				<div class="row">
					<h3 class="h4 service-paragraph mt-3">
						<i class="bi bi-person" style="font-size: 1.75rem;"></i>&nbsp;
						<?php echo esc_html__( 'People', 'design_laboratori_italia' ); ?>
					</h3>

					<!-- People -->
					<?php
						get_template_part(
							'template-parts/common/people-section',
							false,
							array(
								'persons' => $dis_persons,
								'format'  => 'small',
							)
						);
					?>
				</div> <!-- row -->
			<?php endif; ?>

			<!-- Projects -->
			<?php if ( $dis_projects ) : ?>
				<div class="row">
					<h3 class="h4 service-paragraph mt-3">
						<i class="bi bi-clipboard-data" style="font-size: 1.75rem;"></i>&nbsp;
						<?php echo esc_html__( 'Projects', 'design_laboratori_italia' ); ?>
					</h3>
					<!-- Projects section -->
					<?php
						get_template_part(
							'template-parts/common/projects-section',
							false,
							array(
								'projects' => $dis_projects,
								'format'   => 'small',
							)
						);
					?>
				</div> <!-- row -->
			<?php endif; ?>

		</div>

		<!-- SIDEBAR LIST -->
		<div class="col-12 col-lg-4 col-md-5">
			<div class="sidebar-wrapper it-line-left-side ps-4">
				<div class="it-list-wrapper">
					<ul class="it-list">
						<?php
						if ( $dis_full_places ) {
							?>
							<!-- Place -->
							<li class="list-item">
								<div class="it-right-zone">
									<span class="text">
										<a href="scheda-luogo.html">
											<?php echo wp_kses_post( $dis_full_places ); ?>
										</a>
									</span>
									<svg class="icon">
										<title><?php echo esc_html__( 'Address', 'design_laboratori_italia' ); ?></title>
										<use href="<?php echo esc_url( DIS_THEME_URL . '/assets/bootstrap-italia/svg/sprites.svg#it-map-marker' ); ?>"></use>
									</svg>
								</div>
							</li>
							<?php
						}
						if ( $dis_telephone ) {
							?>
							<!-- Telephone -->
							<li class="list-item">
								<div class="it-right-zone">
									<span class="text">
										<?php echo esc_html( $dis_telephone ); ?>
									</span>
									<svg class="icon">
										<title><?php echo esc_html__( 'Telephone', 'design_laboratori_italia' ); ?></title>
										<use href="<?php echo esc_url( DIS_THEME_URL . '/assets/bootstrap-italia/svg/sprites.svg#it-telephone' ); ?>"></use>
									</svg>
								</div>
							</li>
							<?php
						}
						if ( $dis_email ) {
							?>
						<!-- E-mail -->
						<li class="list-item">
							<div class="it-right-zone">
								<span class="text">
									<?php echo esc_html( $dis_email ); ?>
								</span>
								<svg class="icon">
									<title><?php echo esc_html__( 'E-mail', 'design_laboratori_italia' ); ?></title>
									<use href="<?php echo esc_url( DIS_THEME_URL . '/assets/bootstrap-italia/svg/sprites.svg#it-mail' ); ?>"></use>
								</svg>
							</div>
						</li>
							<?php
						}
						?>
					</ul>
				</div>
			</div>
		</div>

	</div> <!-- row -->

</div> <!-- container -->

<?php
get_footer();
