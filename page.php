<?php
/**
 * Page template
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Design_ICT_Site
 */

global $post;
get_header();
?>

<!-- BASIC PAGE -->
<div class="container shadow rounded  p-4 pt-3 pb-3 mb-5">
	<div class="row">

		<div class="col">
			<!-- Title -->
			<h2 class="pb-2">
				<?php echo esc_attr( get_the_title() ); ?>
			</h2>
			<!-- Body -->
			<div class="p-5">
				<?php the_content(); ?>
			</div>
		</div> <!-- col -->

		<!-- SIDEBAR LIST (Menu-related pages)-->
		<?php
			$page_parent_id = DIS_ContentsManager::get_page_anchestor_id( $post );
			$page_ancestors = get_post_ancestors( $post->ID );
			$page_children  = get_pages(
				array(
					'child_of'    => $page_parent_id,
					'offset'      => 0,
					'parent'      => $page_parent_id,
					'sort_order'  => 'ASC',
					'sort_column' => 'menu_order',
				)
			);
			$parent_item = ( $page_parent_id === $post->ID ) ? null : get_post( $page_parent_id );
		?>
		<div class="col-12 col-lg-4 col-md-5">
			<div class="sidebar-wrapper it-line-left-side">

				<!-- Back to the parent -->
				<?php if ( $parent_item ) : ?>
					<a href="<?php echo get_permalink( $parent_item ); ?>"
						class="btn btn-primary btn-xs btn-me m-4 " role="button" data-focus-mouse="false">
						<svg class="icon icon-sm icon-white me-2"
							role="img"
							aria-labelledby="<?php echo esc_attr( __( 'Go back', 'design_ict_site' ) ); ?>"
						>
							<title>
								<?php echo esc_attr( __( 'Go back', 'design_ict_site' ) ); ?>
							</title>
							<use href="<?php echo DIS_THEME_URL . '/assets/bootstrap-italia/svg/sprites.svg#it-arrow-left'; ?>"></use>
						</svg>
						<span>
							<?php echo esc_attr( __( 'Go back', 'design_ict_site' ) ); ?>
						</span>
					</a>
				<?php endif ?>

				<!-- Children list-->
				<?php if ( $page_children && count( $page_children ) > 0 ) : ?>
					<div class="sidebar-linklist-wrapper">
						<div class="link-list-wrapper">
							<ul class="link-list">
								<li>
									<h3>
										<?php echo esc_attr( __( 'Related pages', 'design_ict_site' ) ); ?>
									</h3>
								</li>
								<?php
									foreach ( $page_children as $p ) {
										$active = ( get_permalink() === get_permalink( $p ) ) ? 'active' : '';
								?>
									<li>
										<a class="list-item medium <?php echo $active ?>"
											href="<?php echo get_permalink( $p ); ?>">
											<span>
												<?php echo esc_attr( $p->post_title ); ?>
											</span>
										</a>
									</li>
								<?
									}
								?>
							</ul>
						</div>
					</div>
				<?php endif ?>

			</div>
		</div> <!-- sidebar -->

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
			'all_label' => '',
			'all_link'  => '',
		)
	);
	?>

<?php
get_footer();
