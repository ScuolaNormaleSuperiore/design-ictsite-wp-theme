<?php
/**
 * Template Name: Privacy
 *
 * @package Design_ICT_Site
 */

get_header();
$dis_post = get_post();
?>

<!-- PRIVACY PAGE -->
<div class="container shadow rounded  p-4 pt-3 pb-3 mb-5">
	<div class="row">

		<div class="col">
			<!-- Title -->
			<h2 class="pb-2">
				<?php echo esc_html( get_the_title() ); ?>
			</h2>
			<!-- Body -->
			<div class="p-5">
				<?php the_content(); ?>


				<!-- AUTO FILLED TEXT FOR COOKIES -->
				<div>
					<div class="text-image-cta d-flex mb-0">
						<div class="content w-100">
							<h5 class="mb-3"><?php echo esc_html__( 'Cookies management', 'design_ict_site' ); ?></h5>
						</div>
					</div>
					<div class="text-image-cta d-flex mb-5">
						<div class="content w-100">
							<div id="dis_no_accepted_cookies_msg">
								<p><?php echo esc_html__( 'You have not installed third-party cookies', 'design_ict_site' ); ?>.</p>
							</div>
							<div id="dis_deny_cookies_button">
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
			$dis_page_parent_id = DIS_ContentsManager::get_page_anchestor_id( $dis_post );
			$dis_page_children  = get_pages(
				array(
					'child_of'    => $dis_page_parent_id,
					'offset'      => 0,
					'parent'      => $dis_page_parent_id,
					'sort_order'  => 'ASC',
					'sort_column' => 'menu_order',
				)
			);
			$dis_parent_item    = ( $dis_page_parent_id === $dis_post->ID ) ? null : get_post( $dis_page_parent_id );
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
								<?php
								foreach ( $dis_page_children as $dis_page_child ) {
									$dis_active = ( get_permalink() === get_permalink( $dis_page_child ) ) ? 'active' : '';
									?>
									<li>
										<a class="list-item medium <?php echo esc_attr( $dis_active ); ?>"
											href="<?php echo esc_url( get_permalink( $dis_page_child ) ); ?>">
											<span>
											<?php echo esc_html( $dis_page_child->post_title ); ?>
											</span>
										</a>
									</li>
									<?php
								}
								?>
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
	$dis_related = DIS_CustomFieldsManager::get_field( 'related_items', $dis_post->ID );
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
