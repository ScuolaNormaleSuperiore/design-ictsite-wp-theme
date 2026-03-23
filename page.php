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
			$dis_page_parent_id = DIS_ContentsManager::get_page_anchestor_id( $post );
			$dis_page_children  = get_pages(
				array(
					'child_of'    => $dis_page_parent_id,
					'offset'      => 0,
					'parent'      => $dis_page_parent_id,
					'sort_order'  => 'ASC',
					'sort_column' => 'menu_order',
				)
			);
			$dis_parent_item    = ( $dis_page_parent_id === $post->ID ) ? null : get_post( $dis_page_parent_id );
			?>
		<div class="col-12 col-lg-4 col-md-5">
			<div class="sidebar-wrapper it-line-left-side">

				<!-- Back to the parent -->
				<?php if ( $dis_parent_item ) : ?>
					<a href="<?php echo esc_url( get_permalink( $dis_parent_item ) ); ?>"
						class="btn btn-primary btn-xs btn-me m-4 " role="button" data-focus-mouse="false">
						<svg class="icon icon-sm icon-white me-2"
							role="img"
							aria-labelledby="<?php echo esc_attr__( 'Go back', 'design_ict_site' ); ?>"
						>
							<title>
								<?php echo esc_html__( 'Go back', 'design_ict_site' ); ?>
							</title>
							<use href="<?php echo esc_url( DIS_THEME_URL . '/assets/bootstrap-italia/svg/sprites.svg#it-arrow-left' ); ?>"></use>
						</svg>
						<span>
							<?php echo esc_html__( 'Go back', 'design_ict_site' ); ?>
						</span>
					</a>
				<?php endif; ?>

				<!-- Children list-->
				<?php if ( $dis_page_children && count( $dis_page_children ) > 0 ) : ?>
					<div class="sidebar-linklist-wrapper">
						<div class="link-list-wrapper">
							<ul class="link-list">
								<li>
									<h3>
										<?php echo esc_html__( 'Related pages', 'design_ict_site' ); ?>
									</h3>
								</li>
								<?php foreach ( $dis_page_children as $dis_page_item ) : ?>
									<?php $dis_active = ( get_permalink() === get_permalink( $dis_page_item ) ) ? 'active' : ''; ?>
									<li>
										<a class="list-item medium <?php echo esc_attr( $dis_active ); ?>"
											href="<?php echo esc_url( get_permalink( $dis_page_item ) ); ?>">
											<span>
												<?php echo esc_html( $dis_page_item->post_title ); ?>
											</span>
										</a>
									</li>
								<?php endforeach; ?>
							</ul>
						</div>
					</div>
				<?php endif; ?>

			</div>
		</div> <!-- sidebar -->

	</div> <!-- row -->
</div> <!-- container -->

<!-- Related contents -->
<?php
	$dis_related = DIS_CustomFieldsManager::get_field( 'related_items', $post->ID );
	get_template_part(
		'template-parts/common/related-contents',
		false,
		array(
			'items'     => $dis_related,
			'all_label' => '',
			'all_link'  => '',
		)
	);
	?>

<?php
get_footer();
?>
