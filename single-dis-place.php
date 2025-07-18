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

$short_description = DIS_CustomFieldsManager::get_field( 'short_description', $post->ID );
$image_data        = DIS_ContentsManager::get_image_metadata( $post, 'full', '/assets/img/default-background.png' );
$getting_here      = DIS_CustomFieldsManager::get_field( 'getting_here', $post->ID );
$telephone         = DIS_CustomFieldsManager::get_field( 'telephone', $post->ID );
$email             = DIS_CustomFieldsManager::get_field( 'email', $post->ID );
$opening_hours     = DIS_CustomFieldsManager::get_field( 'opening_hours', $post->ID );
$gps_position      = DIS_CustomFieldsManager::get_field( 'gps_position', $post->ID );
// Manage Address.
$address      = DIS_CustomFieldsManager::get_field( 'address', $post->ID );
$city         = DIS_CustomFieldsManager::get_field( 'city', $post->ID );
$zip_code     = DIS_CustomFieldsManager::get_field( 'zip_code', $post->ID );
$full_address = array_filter( array( $address, $city, $zip_code ) );
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
					<?php echo esc_attr( __( 'Description', 'design_ict_site' ) ); ?>
				</h3>
				<p>
					<?php echo esc_html( $short_description ); ?>
				</p>
			</div>

			<!-- How to reach us -->	
			<div class="row pb-3">
				<h3 class="it-page-section h4" id="how_to_reach_us">
					<?php echo esc_attr( __( 'How to reach us', 'design_ict_site' ) ); ?>
				</h3>
				<p>
					<?php echo wp_kses_post( $getting_here ); ?>
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
								if ( ! empty( $full_address ) ) :
									echo esc_html( implode( ', ', $full_address ) );
								endif
								?>
								</span>
									<svg class="icon">
										<title><?php echo esc_attr( __( 'Address', 'design_ict_site' ) ); ?></title>
										<use href="<?php echo DIS_THEME_URL . '/assets/bootstrap-italia/svg/sprites.svg#it-map-marker'; ?>"></use>
									</svg>
							</div>
						</li>
						<li class="list-item">
							<div class="it-right-zone">
								<span class="text">
									<?php echo wp_kses_post( $opening_hours ); ?>
								</span>
								<svg class="icon">
									<title><?php echo esc_attr( __( 'Hours', 'design_ict_site' ) ); ?></title>
									<use href="<?php echo DIS_THEME_URL . '/assets/bootstrap-italia/svg/sprites.svg#it-clock'; ?>"></use>
								</svg>
							</div>
						</li>  
						<li class="list-item">
							<div class="it-right-zone">
								<span class="text"><?php echo esc_attr( $telephone ); ?></span>
									<svg class="icon">
										<title><?php echo esc_attr( __( 'Telephone', 'design_ict_site' ) ); ?></title>
										<use href="<?php echo DIS_THEME_URL . '/assets/bootstrap-italia/svg/sprites.svg#it-telephone'; ?>"></use>
									</svg>
							</div>
						</li>      
						<li class="list-item">
							<div class="it-right-zone">
								<span class="text"><?php echo esc_attr( $email ); ?></span>
									<svg class="icon">
										<title><?php echo esc_attr( __( 'E-mail', 'design_ict_site' ) ); ?></title>
										<use href="<?php echo DIS_THEME_URL . '/assets/bootstrap-italia/svg/sprites.svg#it-mail'; ?>"></use>
									</svg>
							</div>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div> <!-- sidebar row -->

	<!-- MAP  -->
	<div class="row mb-5">
		<h3 id="posizione" class="it-page-section h4 visually-hidden">
			<?php echo esc_attr( __( 'Position', 'design_ict_site' ) ); ?>
		</h3>  
		<div class="card-wrapper">
			<div class="card card-img no-after">
				<div class="img-responsive-wrapper">
					<div class="img-responsive">
						<figure class="img-wrapper">
							<?php if ( ! str_contains( $gps_position, 'data-map-markers="[]">' ) ) : ?>
								<div class="img-responsive-wrapper">
									<?php
									echo $gps_position;
									?>
								</div>
							<?php endif ?>
						</figure>
					</div>
				</div>
			</div>
		</div>
	</div> <!-- map row-->

</div>  <!-- container -->



<?php
get_footer();
