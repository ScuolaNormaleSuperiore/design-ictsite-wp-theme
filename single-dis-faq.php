<?php
/**
 * Detail page for the post-type: dis-faq
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Design_ICT_Site
 */

global $post;
get_header();

$topics        = wp_get_post_terms( $post->ID, DIS_FAQ_TOPIC_TAXONOMY );
$topics_string = DIS_ContentsManager::get_topic_string_from_terms( $topics, true );
// Increment the counter of the visits.
DIS_ContentsManager::increment_visit_counter( 'faq_page_counter_enabled', $post->ID );
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
	<?php get_template_part( 'template-parts/footer/last_modification' ); ?>

</div>


<?php
get_footer();
