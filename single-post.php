<?php
/**
 * Detail page for the post-type: post
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Design_ICT_Site
 */

global $post;
get_header();

$dsi_short_description = DIS_CustomFieldsManager::get_field( 'short_description', $post->ID );
$dsi_image_data        = DIS_ContentsManager::get_image_metadata( $post, 'full', '' );
?>

	<!-- CONTENT HERO -->
	<div class="container">
		<section class="it-hero-wrapper it-dark it-overlay it-text-centered" id="it-hero-wrapper">
			
			<?php if ( $dsi_image_data ) : ?>
			<div class="img-responsive-wrapper" aria-label="<?php echo esc_attr__( 'In evidence', 'design_laboratori_italia' ); ?>">
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
			<?php endif; ?>

			<div class="container">
				<div class="row">
					<div class="col-12">
						<div class="it-hero-text-wrapper bg-dark it-text-centered">
							<h2><?php echo esc_html( $post->post_title ); ?></h2>
							<p class="d-none d-lg-block">
								<?php echo nl2br( esc_html( $dsi_short_description ) ); ?>
							</p>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>

	<!-- CONTENT BODY -->
	<div class="container shadow rounded p-4 mb-5 mt-2">
		<div class="row">
			<div class="col-12 col-md-10 offset-md-1 col-lg-7 offset-lg-1 m-auto">
				<!-- DESCRIPTION -->
				<div class="lead">
					<?php the_content(); ?>
				</div>
			</div>
		</div> <!-- row -->


		<!-- Last modification -->
		<?php get_template_part( 'template-parts/footer/last_modification' ); ?>
	</div>


<?php
get_footer();
