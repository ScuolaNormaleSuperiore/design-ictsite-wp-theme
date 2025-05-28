<?php
/* The pagination section.
*
* @package Design_ICT_Site
*/

$the_query       = $args['query'];
$per_page        = $args['per_page'];
$per_page_values = $args['per_page_values'];
$num_results     = $args['num_results'];
$pagination_on   = ( $num_results > intval ( $per_page) )  ? true : false;

?>

<nav class="pagination-wrapper justify-content-center mt-3" aria-label="Centered navigation">
	<div class="row w-100" id='pagination_links'>

		<!-- Filters column -->
		<div class="col-md-4 pt-2"></div>

		<!-- Navigazione pagine -->
		<div class="col-md-3 pt-2">
			<?php
			if ( $the_query && $pagination_on ) {
				$prev_label =
				'<svg class="icon icon-primary" role="img" aria-labelledby="Chevron Left"><title>Chevron Left</title><use href="' .
					DIS_THEME_URL .
					'/assets/bootstrap-italia/svg/sprites.svg#it-chevron-left"></use></svg>';
				$next_label =
					'<svg class="icon icon-primary" role="img" aria-labelledby="Chevron Right"><title>Chevron Right</title><use href="' .
					DIS_THEME_URL .
					'/assets/bootstrap-italia/svg/sprites.svg#it-chevron-right"></use></svg>';
				echo paginate_links(
					array(
						'total'     => $the_query->max_num_pages,
						'prev_text' => $prev_label,
						'next_text' => $next_label,
						'type'      => 'list',
						'add_args'  => array( 'per_page' => $per_page ),
					)
				);
			}
			?>
		</div>

		<!-- Scelta numero elementi per pagina -->
		<div class="col-md-3 dli-dropdown-container">
			<?php
			if ( $pagination_on || isset( $_GET['per_page'] ) ) {
			?>
				<div class="dropdown">
					<button class="btn btn-dropdown dropdown-toggle" type="button" id="pagerChanger"
						data-bs-toggle="dropdown" aria-haspopup="true"
						aria-expanded="false" aria-label="Salta alla pagina">
						<?php echo $per_page; ?>/<?php echo __( 'pagina', 'design_ict_site' ); ?>
						<svg class="icon icon-primary icon-sm">
							<use href="<?php echo DIS_THEME_URL . '/assets/bootstrap-italia/svg/sprites.svg#it-expand'; ?>"></use>
						</svg>
					</button>
					<div class="dropdown-menu dli-pagination-dropdown" aria-labelledby="pagerChanger">
						<div class="link-list-wrapper">
							<ul class="link-list">
								<?php foreach( $per_page_values as $pvalue ) {
									$is_active = ( $pvalue === $per_page );
								?>
								<li>
									<a class="dropdown-item list-item <?php if( $is_active ) { echo 'active'; } ?>"
										href="#" data-perpage="<?php echo $pvalue; ?>"><span><?php echo $pvalue; ?>/<?php echo __( 'pagina', 'design_ict_site' ); ?></span>
									</a>
									</li>
								<?php
								}
								?>
							</ul>
						</div>
					</div>
				</div>
			<?php
			}
			?>
		</div>

		<!-- Right empty column -->
		<div class="col-md-2 pt-2"></div>

	</div>
</nav>
