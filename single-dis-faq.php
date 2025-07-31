<?php
/**
 * Detail page for the post-type: dis-faq.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Design_ICT_Site
 */

global $post;
get_header();

$topics        = wp_get_post_terms( $post->ID, DIS_FAQ_TOPIC_TAXONOMY );
$topics_string = DIS_ContentsManager::get_topic_string_from_terms( $topics, true );
?>

<div class="container shadow rounded  p-4 pt-3 pb-3 mb-5">
	<div class="row">
		<!-- FAQ -->
		<div class="col-12 mt-2">

			<!-- Title -->
			<h2>
				<?php echo esc_attr( $post->post_title ); ?>
			</h2>

			<!-- Answer -->
			<h3 class="it-page-section h4 visually-hidden" id="descrizione">
				<?php echo esc_attr( __( 'Description', 'design_ict_site' ) ); ?>
			</h3>
			<p>
				<?php echo esc_attr( __( 'Topics', 'design_ict_site' ) ); ?>:&nbsp;
				<?php echo wp_kses_post( $topics_string ); ?>
			</p>

			<?php the_content(); ?>

		</div> <!-- col -->
	</div> <!-- row -->

	<!-- Last modification -->
	<div class="row">
		<div class="col-12 pt-3">
			<p class="small text-center">
				<?php echo esc_attr( __( 'Last modification', 'design_ict_site' ) ); ?>:&nbsp;
				<?php the_modified_date( 'd/m/Y' ); ?>
			</p>
		</div>
	</div>

</div>


<?php
get_footer();
