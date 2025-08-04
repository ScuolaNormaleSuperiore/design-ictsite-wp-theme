<?php
/* Template Name: Privacy
*
* @package Design_ICT_Site
*/

global $post;
get_header();
?>

<!-- PRIVACY PAGE -->
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


				<!-- AUTO FILLED TEXT FOR COOKIES -->
				<div>
					<div class="text-image-cta d-flex mb-0">
						<div class="content w-100">
							<h5 class="mb-3"><?php echo __( 'Cookies management', 'design_ict_site' ); ?></h5>
						</div>
					</div>
					<div class="text-image-cta d-flex mb-5">
						<div class="content w-100">
							<div id="dli_no_accepted_cookies_msg">
								<p><?php echo __( 'You have not installed third-party cookies', 'design_ict_site' ); ?>.</p>
							</div>
							<div id="dli_deny_cookies_button">
								<p>
									<?php echo esc_html( __( 'You have installed the following third-party cookies:', 'design_ict_site' ) ); ?>
								</p>
								<p>
									<strong><?php echo esc_html( __( 'Youtube for video viewing', 'design_ict_site' ) ); ?></strong>
									&nbsp;&nbsp;&nbsp;
									<button type="submit" class="btn btn-primary" onclick="removeThirdPartiesCookies();">
										<?php echo esc_html( __( 'Revoke', 'design_ict_site' ) ); ?>
									</button>
								</p>
							</div>
						</div>
					</div>
				</div>
				<!-- AUTO FILLED TEXT FOR COOKIES-->


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
								<?php
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
