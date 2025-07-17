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
$video             = DIS_CustomFieldsManager::get_field( 'video' , $post->ID );
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
						<li>
							<a href="#" class="list-item">
								<div class="it-right-zone">
									<span class="text">Sala Azzurra, Piazza del Castelletto</span>
									<svg class="icon">
										<title>Posizione</title>
										<use href="/bootstrap-italia/svg/sprites.svg#it-map-marker"></use>
									</svg>
								</div>
							</a>
						</li>
						<li class="list-item">
							<div class="it-right-zone">
								<span class="text">050 509662</span>
								<svg class="icon">
									<title>Telefono</title>
									<use href="/bootstrap-italia/svg/sprites.svg#it-telephone"></use>
								</svg>
							</div>
						</li>
						<li class="list-item">
							<div class="it-right-zone">
								<span class="text">mail@sns.it</span>
								<svg class="icon">
									<title>E-mail</title>
									<use href="/bootstrap-italia/svg/sprites.svg#it-mail"></use>
								</svg>
							</div>
						</li>
						<li>
							<a href="#" class="list-item">
								<div class="it-right-zone">
									<span class="text">Website</span>
									<svg class="icon">
										<title>Link al sito web del progetto</title>
										<use href="/bootstrap-italia/svg/sprites.svg#it-external-link"></use>
									</svg>
								</div>
							</a>
						</li>
						<li>
							<a href="#" class="list-item">
								<div class="it-right-zone">
									<span class="text">Allegato: paper 123 (PDF)</span>
									<svg class="icon">
										<title>Allegato</title>
										<use href="/bootstrap-italia/svg/sprites.svg#it-clip"></use>
									</svg>
								</div>
							</a>
						</li>
						<li>
							<a href="#" class="list-item">
								<div class="it-right-zone">
									<span class="text">Allegato 2: manuael (docx)</span>
									<svg class="icon">
										<title>Allegato</title>
										<use href="/bootstrap-italia/svg/sprites.svg#it-clip"></use>
									</svg>
								</div>
							</a>
						</li>
					</ul>
				</div>

			</div>

		</div>
	</div> <!-- row -->

	<!-- Last modification -->
	<div class="row">
		<div class="col-12 pt-3">
			<p class="small text-center">
				<?php echo __( 'Last modification', 'design_ict_site' ); ?>: <?php the_modified_date('d/m/Y'); ?>
			</p>
		</div>
	</div>

</div> <!-- container -->

<?php
get_footer();
