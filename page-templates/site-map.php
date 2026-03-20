<?php
/**
 * Template Name: SiteMap
 *
 * @package Design_ICT_Site
 */

global $post;
get_header();
$dis_pt = DIS_NavigationManager::get_site_tree();

if ( ! function_exists( 'dis_render_sitemap_items' ) ) {
	/**
	 * Render the sitemap tree recursively.
	 *
	 * @param DIS_TreeItem[] $items The items to render.
	 * @return void
	 */
	function dis_render_sitemap_items( array $items ) {
		if ( empty( $items ) ) {
			return;
		}
		?>
		<ul>
			<?php foreach ( $items as $item ) : ?>
				<li>
					<?php if ( '' === $item->link ) : ?>
						<?php echo esc_html( $item->name ); ?>
					<?php else : ?>
						<a href="<?php echo esc_url( $item->link ); ?>">
							<?php echo esc_html( $item->name ); ?>
						</a>
					<?php endif; ?>

					<?php dis_render_sitemap_items( $item->children ); ?>
				</li>
			<?php endforeach; ?>
		</ul>
		<?php
	}
}
?>

<div class="container shadow rounded  p-4 pt-3 pb-3 mb-5">

	<!-- PAGE TITLE -->
	<h2 class="pb-2">
		<?php echo esc_attr( $post->post_title ); ?>
	</h2>

	<!-- PAGE BODY -->
	<div class="row">
		<div class="col">
			<div class="card-wrapper card-teaser-wrapper card-teaser-block-2">

				<!-- TREE -->
				<?php if ( count( $dis_pt ) > 0 ) : ?>
					<ul class="menutree">
						<li>
							<a href="<?php echo esc_url( $dis_pt[ DIS_HOMEPAGE_SLUG ]->link ); ?>">
								<?php echo esc_html( $dis_pt[ DIS_HOMEPAGE_SLUG ]->name ); ?>
							</a>
						</li>
						<?php dis_render_sitemap_items( $dis_pt[ DIS_HOMEPAGE_SLUG ]->children ); ?>
					</ul>
				<?php endif; ?>


			</div>
		</div>
	</div>

</div>

<?php
get_footer();
