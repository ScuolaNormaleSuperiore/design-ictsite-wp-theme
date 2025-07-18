<?php
/**
 * Detail page for the post-type: dis-news.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Design_ICT_Site
 */
global $post;
get_header();

$short_description = DIS_CustomFieldsManager::get_field( 'short_description', $post->ID );
$image_data        = DIS_ContentsManager::get_image_metadata( $post, 'full', '/assets/img/default-background.png' );
?>

<!-- NEWS DETAIL -->
<div class="container shadow rounded pt-3 p-5  pb-3 mb-5">
	<div class="row news">
		<div class="col-12 col-md-12 col-lg-12 mb-3 mb-md-4">

			<!-- Titolo -->
			<h2>
				<?php echo esc_attr( $post->post_title ); ?>
			</h2>

			<!-- Short description -->
			<p class="lead">
				<?php echo esc_attr( $short_description ); ?>
			</p>
			<p class="data">
				<?php echo esc_attr( get_the_date( 'j F Y' ) ); ?>
			</p>

			<!-- Featured Image -->
			<section class="it-hero-wrapper it-hero-small-size"  aria-label="In evidenza">
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
			<div class="p-5">
				<?php the_content(); ?>
			</div>

		</div> <!-- col -->
	</div> <!-- row -->
</div> <!-- container -->

<!-- Related contents -->
<?php
	$related = DIS_CustomFieldsManager::get_field( 'related_items', $post->ID );
	get_template_part(
		'template-parts/common/related-contents',
		false,
		array(
			'items'     => $related,
			'all_label' => __( 'All news', 'design_ict_site' ),
			'all_link'  => DIS_MultiLangManager::get_archive_link( $post->post_type ),
		)
	);
?>


<?php
get_footer();
