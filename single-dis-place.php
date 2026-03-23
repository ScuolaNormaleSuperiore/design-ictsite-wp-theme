<?php
/**
 * Detail page for the post-type: dis-place.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Design_ICT_Site
 */

global $post;
get_header();

$dis_short_description = DIS_CustomFieldsManager::get_field( 'short_description', $post->ID );
$dis_image_data        = DIS_ContentsManager::get_image_metadata( $post, 'full', '/assets/img/default-background.png' );
$dis_getting_here      = DIS_CustomFieldsManager::get_field( 'getting_here', $post->ID );
$dis_telephone         = DIS_CustomFieldsManager::get_field( 'telephone', $post->ID );
$dis_email             = DIS_CustomFieldsManager::get_field( 'email', $post->ID );
$dis_opening_hours     = DIS_CustomFieldsManager::get_field( 'opening_hours', $post->ID );
$dis_gps_position      = DIS_CustomFieldsManager::get_field( 'gps_position', $post->ID );
// Manage Address.
$dis_address      = DIS_CustomFieldsManager::get_field( 'address', $post->ID );
$dis_city         = DIS_CustomFieldsManager::get_field( 'city', $post->ID );
$dis_zip_code     = DIS_CustomFieldsManager::get_field( 'zip_code', $post->ID );
$dis_full_address = array_filter( array( $dis_address, $dis_city, $dis_zip_code ) );
?>

<!-- PLACE DETAIL -->
<div class="container shadow rounded  p-4 pt-3 pb-3 mb-5">
	<div class="row">
		<div class="col">
			<!-- Title -->
			<h2>
				<?php echo esc_attr( $post->post_title ); ?>
			</h2>

			<!-- Short description -->	
			<div class="row pb-3">
				<h3 class="it-page-section h4 visually-hidden" id="description">
					<?php echo esc_html__( 'Description', 'design_ict_site' ); ?>
				</h3>
				<p>
					<?php echo nl2br( esc_html( $dis_short_description ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				</p>
			</div>

			<!-- How to reach us -->	
			<div class="row pb-3">
				<h3 class="it-page-section h4" id="how_to_reach_us">
					<?php echo esc_html__( 'How to reach us', 'design_ict_site' ); ?>
				</h3>
				<p>
					<?php echo wp_kses_post( $dis_getting_here ); ?>
				</p>
			</div> 
		</div>

		<!-- SIDEBAR LIST -->
		<div class="col-12 col-lg-4 col-md-5">
			<div class="sidebar-wrapper it-line-left-side ps-4">
				<div class="it-list-wrapper">
					<ul class="it-list">
						<li class="list-item">
							<div class="it-right-zone">
								<span class="text">
								<?php
								if ( ! empty( $dis_full_address ) ) {
									echo esc_html( implode( ', ', $dis_full_address ) );
								}
								?>
								</span>
									<svg class="icon">
										<title><?php echo esc_html__( 'Address', 'design_ict_site' ); ?></title>
										<use href="<?php echo esc_url( DIS_THEME_URL . '/assets/bootstrap-italia/svg/sprites.svg#it-map-marker' ); ?>"></use>
									</svg>
							</div>
						</li>
						<?php
						if ( $dis_opening_hours ) {
							?>
						<li class="list-item">
							<div class="it-right-zone">
								<span class="text">
									<?php echo wp_kses_post( $dis_opening_hours ); ?>
								</span>
								<svg class="icon">
									<title><?php echo esc_html__( 'Hours', 'design_ict_site' ); ?></title>
									<use href="<?php echo esc_url( DIS_THEME_URL . '/assets/bootstrap-italia/svg/sprites.svg#it-clock' ); ?>"></use>
								</svg>
							</div>
						</li>
							<?php
						}
						if ( $dis_telephone ) {
							?>
						<li class="list-item">
							<div class="it-right-zone">
								<span class="text"><?php echo esc_html( $dis_telephone ); ?></span>
									<svg class="icon">
										<title><?php echo esc_html__( 'Telephone', 'design_ict_site' ); ?></title>
										<use href="<?php echo esc_url( DIS_THEME_URL . '/assets/bootstrap-italia/svg/sprites.svg#it-telephone' ); ?>"></use>
									</svg>
							</div>
						</li>
							<?php
						}
						if ( $dis_email ) {
							?>
						<li class="list-item">
							<div class="it-right-zone">
								<span class="text"><?php echo esc_html( $dis_email ); ?></span>
									<svg class="icon">
										<title><?php echo esc_html__( 'E-mail', 'design_ict_site' ); ?></title>
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
	</div> <!-- sidebar row -->

	<!-- MAP  -->
	<div class="row mb-5">
		<h3 id="posizione" class="it-page-section h4 visually-hidden">
			<?php echo esc_html__( 'Position', 'design_ict_site' ); ?>
		</h3>  
		<div class="card-wrapper">
			<div class="card card-img no-after">
				<div class="img-responsive-wrapper">
					<div class="img-responsive">
						<figure class="img-wrapper">
							<?php if ( ! str_contains( (string) $dis_gps_position, 'data-map-markers="[]">' ) ) : ?>
								<div class="img-responsive-wrapper">
									<?php echo wp_kses_post( $dis_gps_position ); ?>
								</div>
							<?php endif; ?>
						</figure>
					</div>
				</div>
			</div>
		</div>
	</div> <!-- map row-->

</div>  <!-- container -->



<?php
get_footer();
