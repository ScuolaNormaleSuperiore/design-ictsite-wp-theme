<?php
/** Template Name: Help-desk
 *
 * @package Design_ICT_Site
 */

global $post;
get_header();
$faq_page_link = DIS_MultiLangManager::get_page_link( FAQ_PAGE_SLUG );
$doc_page_link = DIS_MultiLangManager::get_page_link( DOCUMENTATION_PAGE_SLUG );
?>

<div class="container shadow rounded  p-4 pt-3 pb-3 mb-5">
	<div class="row">

		<!-- Body -->
		<div class="col">
			<!-- Title -->
			<h2 class="pb-2">
				<?php echo esc_attr( get_the_title() ); ?>
			</h2>

			<!-- TEMPLATE CONTENT -->
			<div class="p-5">
				<?php the_content(); ?>
			</div>

		</div> <!-- col -->

		<!-- SIDEBAR LIST -->
		<div class="col-12 col-lg-4 col-md-5">
			<div class="sidebar-wrapper it-line-left-side">
				<div class="sidebar-linklist-wrapper">
					<div class="link-list-wrapper">
						<ul class="link-list">
							<li>
								<h3>
									<?php echo esc_attr( __( 'Linked pages', 'design_ict_site' ) ); ?>
								</h3>
							</li>
							<li>
								<a class="list-item medium" href="<?php echo esc_url( $faq_page_link ); ?>">
									<span>
										<?php echo esc_attr( __( 'FAQ', 'design_ict_site' ) ); ?>
									</span>
								</a>
							</li>
							<li>
								<a class="list-item medium" href="<?php echo esc_url( $doc_page_link ); ?>">
									<span>
										<?php echo esc_attr( __( 'Documentation', 'design_ict_site' ) ); ?>
									</span>
								</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>

	</div> <!-- row -->
</div> <!-- container -->


<?php
get_footer();
