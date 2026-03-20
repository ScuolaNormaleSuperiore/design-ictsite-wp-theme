<?php
/**
 * Detail page for the post-type: dis-event
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Design_ICT_Site
 */

global $post;
get_header();

$dsi_short_description = DIS_CustomFieldsManager::get_field( 'short_description', $post->ID );
$dsi_image_data        = DIS_ContentsManager::get_image_metadata( $post, 'full', '' );
$dsi_start_date        = DIS_CustomFieldsManager::get_field( 'start_date', $post->ID );
$dsi_end_date          = DIS_CustomFieldsManager::get_field( 'end_date', $post->ID );
$dsi_start_date_lng    = $dsi_start_date ? DIS_ContentsManager::format_long_date( $dsi_start_date, false ) : '';
$dsi_end_date_lng      = $dsi_end_date ? DIS_ContentsManager::format_long_date( $dsi_end_date, false ) : '';
$dsi_start_hour        = DIS_CustomFieldsManager::get_field( 'start_hour', $post->ID );
$dsi_end_hour          = DIS_CustomFieldsManager::get_field( 'end_hour', $post->ID );
$dsi_hour_string       = ( $dsi_start_hour && $dsi_end_hour ) ? $dsi_start_hour . ' - ' . $dsi_end_hour : ( $dsi_start_hour ?? '' );
$dsi_video             = DIS_CustomFieldsManager::get_field( 'video', $post->ID );
$dsi_location          = DIS_CustomFieldsManager::get_field( 'location', $post->ID );
$dsi_email             = DIS_CustomFieldsManager::get_field( 'email', $post->ID );
$dsi_telephone         = DIS_CustomFieldsManager::get_field( 'telephone', $post->ID );
$dsi_website           = DIS_CustomFieldsManager::get_field( 'website', $post->ID );
$dsi_attachment        = DIS_CustomFieldsManager::get_field( 'attachment_1', $post->ID );
$dsi_offices           = DIS_CustomFieldsManager::get_field( 'office', $post->ID );
$dsi_full_offices      = DIS_ContentsManager::get_string_list_from_posts( $dsi_offices, true );
?>


<!-- EVENT DETAIL -->
<div class="container shadow rounded p-5 mb-5 mt-2">
	<div class="row">
		<div class="col-12 col-md-10 offset-md-1 col-lg-8 offset-lg-1 m-auto">
			<div class="row">
				<!-- Title -->
				<h2>
					<?php echo esc_attr( $post->post_title ); ?>
				</h2>

				<!-- Subtitle with dates -->
				<p class="it-card-subtitle lead">
					<?php
					if ( $dsi_start_date_lng && $dsi_end_date_lng ) {
						/* translators: 1: event start date, 2: event end date. */
						$dsi_date_string = sprintf( __( 'From %1$s to %2$s', 'design_laboratori_italia' ), $dsi_start_date_lng, $dsi_end_date_lng );
						echo esc_html( $dsi_date_string );
					} elseif ( $dsi_start_date_lng ) {
						echo esc_html( $dsi_start_date_lng );
					}
					if ( $dsi_hour_string ) {
						echo ', ' . esc_html( $dsi_hour_string );
					}
					?>
				</p>

				<!-- Short description -->
				<p>
					<?php echo nl2br( esc_html( $dsi_short_description ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				</p>
			</div>

			<!-- Featured Image -->
			<?php if ( $dsi_image_data ) : ?>
			<section class="it-hero-wrapper it-hero-small-size mt-3" aria-label="<?php echo esc_attr__( 'In evidence', 'design_laboratori_italia' ); ?>">
				<div class="img-responsive-wrapper">
					<div class="img-responsive">
						<div class="img-wrapper">
							<img
								src="<?php echo esc_url( $dsi_image_data['image_url'] ); ?>"
								title="<?php echo esc_attr( $dsi_image_data['image_title'] ); ?>"
								alt="<?php echo esc_attr( $dsi_image_data['image_alt'] ); ?>"
							>
						</div>
					</div>
				</div>
			</section>
			<?php endif; ?>


			<!-- Body -->
			<div class="row mt-4">
				<?php the_content(); ?>
			</div>

			<?php if ( $dsi_video ) : ?>
				<div class="row">
					<!-- VIDEO -->
					<?php
						get_template_part(
							'template-parts/common/video-section',
							false,
							array( 'video' => $dsi_video )
						);
					?>
				</div>
			<?php endif; ?>

		</div> <!-- col -->

		<!-- SIDEBAR LIST -->
		<div class="col">
			<div class="sidebar-wrapper it-line-left-side ps-4">
				<div class="it-list-wrapper">
					<ul class="it-list">
						<?php if ( $dsi_location ) : ?>
							<li class="list-item">
								<div class="it-right-zone">
									<span class="text">
										<?php echo esc_html( $dsi_location ); ?>
									</span>
									<svg class="icon">
										<title>
											<?php echo esc_html__( 'Position', 'design_laboratori_italia' ); ?>
										</title>
										<use href="<?php echo esc_url( DIS_THEME_URL . '/assets/bootstrap-italia/svg/sprites.svg#it-map-marker' ); ?>"></use>
									</svg>
								</div>
						</li>
						<?php endif; ?>
						<?php if ( $dsi_telephone ) : ?>
							<li class="list-item">
								<div class="it-right-zone">
									<span class="text">
										<?php echo esc_html( $dsi_telephone ); ?>
									</span>
									<svg class="icon">
										<title>
											<?php echo esc_html__( 'Telephone', 'design_laboratori_italia' ); ?>
										</title>
										<use href="<?php echo esc_url( DIS_THEME_URL . '/assets/bootstrap-italia/svg/sprites.svg#it-telephone' ); ?>"></use>
									</svg>
								</div>
							</li>
						<?php endif; ?>
						<?php if ( $dsi_email ) : ?>
							<li class="list-item">
								<div class="it-right-zone">
									<span class="text">
										<?php echo esc_html( $dsi_email ); ?>
									</span>
									<svg class="icon">
										<title>
											<?php echo esc_html__( 'E-mail', 'design_laboratori_italia' ); ?>
										</title>
										<use href="<?php echo esc_url( DIS_THEME_URL . '/assets/bootstrap-italia/svg/sprites.svg#it-mail' ); ?>"></use>
									</svg>
								</div>
							</li>
						<?php endif; ?>
						<?php if ( $dsi_website ) : ?>
							<li>
								<a target="_blank" href="<?php echo esc_url( $dsi_website ); ?>" class="list-item" rel="noopener noreferrer">
									<div class="it-right-zone">
									<span class="text">
										<?php echo esc_html__( 'Website', 'design_laboratori_italia' ); ?>
									</span>
										<svg class="icon">
											<title>Link al sito web del progetto</title>
											<use href="<?php echo esc_url( DIS_THEME_URL . '/assets/bootstrap-italia/svg/sprites.svg#it-external-link' ); ?>"></use>
										</svg>
									</div>
								</a>
							</li>
						<?php endif; ?>
						<?php if ( $dsi_attachment ) : ?>
							<li>
								<a target="_blank" href="<?php echo esc_url( $dsi_attachment['url'] ); ?>" class="list-item" rel="noopener noreferrer">
									<div class="it-right-zone">
										<span class="text">
											<?php echo esc_html( $dsi_attachment['title'] ); ?>
										</span>
										<svg class="icon">
											<title>
												<?php echo esc_html__( 'Attachment', 'design_laboratori_italia' ); ?>
											</title>
											<use href="<?php echo esc_url( DIS_THEME_URL . '/assets/bootstrap-italia/svg/sprites.svg#it-clip' ); ?>"></use>
										</svg>
									</div>
								</a>
							</li>
						<?php endif; ?>
						<?php if ( $dsi_full_offices ) : ?>
							<li class="list-item">
								<div class="it-right-zone">
									<span class="text">
										<?php echo wp_kses_post( $dsi_full_offices ); ?>
									</span>
									<svg class="icon">
										<title>
											<?php echo esc_html__( 'Office', 'design_laboratori_italia' ); ?>
										</title>
										<use href="<?php echo esc_url( DIS_THEME_URL . '/assets/bootstrap-italia/svg/sprites.svg#it-pa' ); ?>"></use>
									</svg>
								</div>
							</li>
						<?php endif; ?>
					</ul>
				</div>
			</div>
		</div> <!-- col -->
	</div> <!-- row -->

	<!-- Last modification -->
	<?php get_template_part( 'template-parts/footer/last_modification' ); ?>

</div> <!-- container -->

<!-- Related contents -->
<?php
	$dsi_related = DIS_CustomFieldsManager::get_field( 'related_items', $post->ID );
	get_template_part(
		'template-parts/common/related-contents',
		false,
		array(
			'items'     => $dsi_related,
			'all_label' => __( 'All events', 'design_laboratori_italia' ),
			'all_link'  => DIS_MultiLangManager::get_archive_link( $post->post_type ),
		)
	);
	?>

<?php
get_footer();
