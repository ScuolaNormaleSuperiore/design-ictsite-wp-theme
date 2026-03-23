<?php
/**
 * Pagination section.
 *
 * @package Design_ICT_Site
 */

$dis_query           = $args['query'] ?? null;
$dis_posts_per_page  = $args['posts_per_page'] ?? 0;
$dis_per_page_values = $args['per_page_values'] ?? array();
$dis_num_results     = $args['num_results'] ?? 0;
$dis_current_page    = $args['current_page'] ?? 1;
$dis_pagination_on   = $dis_num_results > intval( $dis_posts_per_page );
?>

<nav class="pagination-wrapper justify-content-center mt-3" aria-label="Centered navigation">
	<div class="row w-100" id="pagination_links">

		<!-- Pages navigation -->
		<div class="col-md-9 pt-2">
			<?php
			if ( $dis_query && $dis_pagination_on ) {
				$dis_prev_label = '<svg class="icon icon-primary" role="img" aria-labelledby="chevron-left"><title>Chevron Left</title><use href="' . esc_url( DIS_THEME_URL . '/assets/bootstrap-italia/svg/sprites.svg#it-chevron-left' ) . '"></use></svg>';
				$dis_next_label = '<svg class="icon icon-primary" role="img" aria-labelledby="chevron-right"><title>Chevron Right</title><use href="' . esc_url( DIS_THEME_URL . '/assets/bootstrap-italia/svg/sprites.svg#it-chevron-right' ) . '"></use></svg>';

				// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- paginate_links() returns safe HTML.
				echo paginate_links(
					array(
						'base'      => add_query_arg( 'num_page', '%#%' ),
						'format'    => '',
						'current'   => $dis_current_page,
						'total'     => $dis_query->max_num_pages,
						'prev_text' => $dis_prev_label,
						'next_text' => $dis_next_label,
						'type'      => 'list',
						'add_args'  => array( 'posts_per_page' => $dis_posts_per_page ),
					)
				);
			}
			?>
		</div>

		<!-- Choose number of results per page -->
		<div class="col-md-3 dli-dropdown-container">
			<?php
			// phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Read-only archive filter parameter.
			if ( $dis_pagination_on || isset( $_GET['posts_per_page'] ) ) {
				?>
				<div class="dropdown">
					<button class="btn btn-dropdown dropdown-toggle" type="button" id="pagerChanger"
						data-bs-toggle="dropdown" aria-haspopup="true"
						aria-expanded="false" aria-label="Jump to the page">
						<?php echo esc_html( $dis_posts_per_page ); ?>/<?php echo esc_html__( 'page', 'design_ict_site' ); ?>
						<svg class="icon icon-primary icon-sm">
							<use href="<?php echo esc_url( DIS_THEME_URL . '/assets/bootstrap-italia/svg/sprites.svg#it-expand' ); ?>"></use>
						</svg>
					</button>
					<div class="dropdown-menu dli-pagination-dropdown" aria-labelledby="pagerChanger">
						<div class="link-list-wrapper">
							<ul class="link-list">
								<?php foreach ( $dis_per_page_values as $dis_page_value ) : ?>
									<?php $dis_is_active = (string) $dis_page_value === (string) $dis_posts_per_page; ?>
									<li>
										<a class="dropdown-item list-item <?php echo $dis_is_active ? 'active' : ''; ?>"
											href="#" data-perpage="<?php echo esc_attr( $dis_page_value ); ?>">
											<span>
												<?php echo esc_html( $dis_page_value ); ?>/<?php echo esc_html__( 'page', 'design_ict_site' ); ?>
											</span>
										</a>
									</li>
								<?php endforeach; ?>
							</ul>
						</div>
					</div>
				</div>
				<?php
			}
			?>
		</div>

	</div>
</nav>
