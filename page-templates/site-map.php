<?php
/**
 * Template Name: SiteMap
 *
 * @package Design_ICT_Site
 */

get_header();
$dis_post         = get_post();
$dis_sitemap_tree = DIS_NavigationManager::get_sitemap_tree();
?>

<div class="container shadow rounded  p-4 pt-3 pb-3 mb-5">

	<!-- PAGE TITLE -->
	<h2 class="pb-2">
		<?php echo esc_html( $dis_post->post_title ); ?>
	</h2>

	<!-- PAGE BODY -->
	<div class="row">
		<div class="col">
			<div class="card-wrapper card-teaser-wrapper card-teaser-block-2">

				<!-- TREE -->
				<?php if ( count( $dis_sitemap_tree ) > 0 ) : ?>
					<?php echo dis_render_sitemap_html( $dis_sitemap_tree ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				<?php endif; ?>

			</div>
		</div>
	</div>

</div>

<?php
get_footer();
