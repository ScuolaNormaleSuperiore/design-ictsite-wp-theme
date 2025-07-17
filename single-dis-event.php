<?php
/**
 * Detail page for the post-type: dis-event.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Design_ICT_Site
 */
global $post;
get_header();

$short_description = DIS_CustomFieldsManager::get_field( 'short_description' , $post->ID );
$image_data        = DIS_ContentsManager::get_image_metadata( $post, 'full', '/assets/img/default-background.png' );
$start_date        = DIS_CustomFieldsManager::get_field( 'start_date', $post->ID );
$end_date          = DIS_CustomFieldsManager::get_field( 'end_date', $post->ID );
$start_date_lng    = $start_date ? DIS_ContentsManager::format_long_date( $start_date, false ) : '';
$end_date_lng      = $end_date ? DIS_ContentsManager::format_long_date( $end_date, false ) : '';
$start_hour        = DIS_CustomFieldsManager::get_field( 'start_hour', $post->ID );
$end_hour          = DIS_CustomFieldsManager::get_field( 'end_hour', $post->ID );
$hour_string       = ( $start_hour && $end_hour ) ? $start_hour . ' - ' . $end_hour :	( $start_hour ?? '' );
$video             = DIS_CustomFieldsManager::get_field( 'video' , $post->ID );
$location          = DIS_CustomFieldsManager::get_field( 'location' , $post->ID );
$email             = DIS_CustomFieldsManager::get_field( 'email' , $post->ID );
$telephone         = DIS_CustomFieldsManager::get_field( 'telephone' , $post->ID );
$website           = DIS_CustomFieldsManager::get_field( 'website' , $post->ID );
$attachment1       = DIS_CustomFieldsManager::get_field( 'attachment_1' , $post->ID );
$offices           = DIS_CustomFieldsManager::get_field( 'office' , $post->ID );
$full_offices      = $offices ? implode( ', ', wp_list_pluck( $offices, 'post_title' ) ) : '';
?>


<!-- EVENT DETAIL -->
<div class="container shadow rounded p-5 mb-5 mt-2">
	<div class="row">
		<div class="col-12 col-md-10 offset-md-1 col-lg-8 offset-lg-1 m-auto">
			<div class="row">
				<!-- Titolo -->
				<h2>
					<?php echo esc_attr( $post->post_title ); ?>
				</h2>

				<!-- Subtitle with dates -->
				<p class="it-card-subtitle lead">
					<?php
					if ( $start_date_lng && $end_date_lng ) {
						$date_string = sprintf( __( 'From %s to %s', 'design_ict_site' ), $start_date_lng, $end_date_lng );
						echo esc_attr( $date_string );
					} else if ( $start_date_lng ) {
						echo esc_attr( $start_date_lng );
					}
					if ( $hour_string ) echo ', ' . $hour_string;
					?>
				</p>

				<!-- Short description -->
				<p>
					<?php echo esc_attr( $short_description ); ?>
				</p>
			</div>

			<!-- Featured Image -->
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


			<!-- Body -->
			<div class="row mt-4">
				<?php the_content(); ?>
			</div>

			<?php
			if ( $video ){
			?>
			<div class="row">
				<!-- VIDEO -->
				<?php
					get_template_part(
						'template-parts/common/video-section',
						false,
						array( 'video' => $video )
					);
				?>
			</div>
			<?php
			}
			?>

		</div> <!-- col -->

		<!-- SIDEBAR servizio -->
		<div class="col">
			<div class="sidebar-wrapper it-line-left-side ps-4">
				<div class="it-list-wrapper">
					<ul class="it-list">
						<?php
						if ( $location ) {
						?>
						<li class="list-item">
							<div class="it-right-zone">
								<span class="text">
									<?php echo esc_attr( $location ); ?>
								</span>
								<svg class="icon">
									<title>
										<?php __( 'Position', 'design_ict_site' ); ?>
									</title>
									<use href="<?php echo DIS_THEME_URL . '/assets/bootstrap-italia/svg/sprites.svg#it-map-marker'; ?>"></use>
								</svg>
							</div>
					</li>
						<?php
						} 
						if ( $telephone ) {
						?>
						<li class="list-item">
							<div class="it-right-zone">
								<span class="text">
									<?php echo esc_attr( $telephone ); ?>
								</span>
								<svg class="icon">
									<title>
										<?php echo esc_attr( __( 'Telephone', 'design_ict_site' ) ); ?>
									</title>
									<use href="<?php echo DIS_THEME_URL . '/assets/bootstrap-italia/svg/sprites.svg#it-telephone'; ?>"></use>
								</svg>
							</div>
						</li>
						<?php
						}
						if ( $email ) {
						?>
						<li class="list-item">
							<div class="it-right-zone">
								<span class="text">
									<?php echo esc_attr( $email ); ?>
								</span>
								<svg class="icon">
									<title>
										<?php echo esc_attr( __( 'E-mail', 'design_ict_site' ) ); ?>
									</title>
									<use href="<?php echo DIS_THEME_URL . '/assets/bootstrap-italia/svg/sprites.svg#it-mail'; ?>"></use>
								</svg>
							</div>
						</li>
						<?php
						}
						if ( $website ) {
						?>
						<li>
							<a target="_blank" href="<?php echo esc_url( $website ); ?>" class="list-item">
								<div class="it-right-zone">
								<span class="text">
									<?php echo esc_attr( __( 'Website', 'design_ict_site' ) ); ?>
								</span>
									<svg class="icon">
										<title>Link al sito web del progetto</title>
										<use href="<?php echo DIS_THEME_URL . '/assets/bootstrap-italia/svg/sprites.svg#it-external-link'; ?>"></use>
									</svg>
								</div>
							</a>
						</li>
						<?php
						}
						if ( $attachment1 ) {
						?>
						<li>
							<a target="_blank" href="<?php echo esc_url( $attachment1['url'] ); ?>" class="list-item">
								<div class="it-right-zone">
									<span class="text">
										<?php echo esc_attr( $attachment1['title'] ); ?>
									</span>
									<svg class="icon">
										<title>
											<?php echo esc_attr( __( 'Attachment', 'design_ict_site' ) ); ?>
										</title>
										<use href="<?php echo DIS_THEME_URL . '/assets/bootstrap-italia/svg/sprites.svg#it-clip'; ?>"></use>
									</svg>
								</div>
							</a>
						</li>
						<?php
						}
						if ( $attachment1 ) {
						?>
						<li class="list-item">
							<div class="it-right-zone">
								<span class="text">
									<?php echo esc_attr( $full_offices ); ?>
								</span>
								<svg class="icon">
									<title>
										<?php __( 'Office', 'design_ict_site' ); ?>
									</title>
									<use href="<?php echo DIS_THEME_URL . '/assets/bootstrap-italia/svg/sprites.svg#it-pa'; ?>"></use>
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

	<!-- Last modification -->
	<div class="row">
		<div class="col-12 pt-3">
			<p class="small text-center">
				<?php echo __( 'Last modification', 'design_ict_site' ); ?>:&nbsp;<?php the_modified_date('d/m/Y'); ?>
			</p>
		</div>
	</div>

</div> <!-- container -->

<!-- Related contents -->
<?php
	$related = DIS_CustomFieldsManager::get_field( 'related_items' , $post->ID );
	get_template_part(
		'template-parts/common/related-contents',
		false,
		array(
			'items'     => $related,
			'all_label' => __( 'All events', 'design_ict_site' ),
			'all_link'  => DIS_MultiLangManager::get_archive_link( $post->post_type ),
		)
	);
?>

<?php
get_footer();
