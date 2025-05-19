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

$short_description = DIS_CustomFieldsManager::get_field( 'short_description' , $post->ID );
$image_data        = DIS_ContentsManager::get_image_metadata( $post, 'full', '/assets/img/default-background.png' );
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
				<p class="lead">
					<?php echo get_the_content() ?>
				</p>


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
