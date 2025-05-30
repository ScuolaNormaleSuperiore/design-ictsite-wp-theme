<?php
/* Template Name: SiteMap
*
* @package Design_ICT_Site
*/

global $post;
get_header();
$pt = DIS_NavigationManager::get_site_tree();
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
				<?php
					if ( count( $pt ) > 0 ) {
				?>
				<ul class="menutree">
					<li>
						<a href="<?php echo $pt[DIS_HOMEPAGE_SLUG]->link; ?>">
							<?php echo $pt[DIS_HOMEPAGE_SLUG]->name; ?>
						</a>
					</li>
					<ul>
						<?php
						// I level.
						foreach ( $pt[DIS_HOMEPAGE_SLUG]->children as $item ) {
							$item_name = $item->name;
							if ( str_contains( strtolower( $item_name ), 'menu' ) ) {
								$item_name = __ ( $item_name, 'kk_writer_theme' );
							}
							if ( $item->link === '' ) {
								echo '<li>' . $item_name . '</li>';
							} else if ( $item->external ) {
								echo '<li><a target="_blank" href="' . $item->link . '">' . $item_name . '</a></li>';
							} else {
								echo '<li><a href="' . $item->link . '">' . $item_name . '</a></li>';
							}
							// II level.
							echo '<ul>';
							foreach ( $item->children as $childitem ) {
								if ( $childitem->link === '' ) {
									echo '<li>' . $childitem->name . '</li>';
								} else if ( $childitem->external ) {
									echo '<li><a target="_blank" href="' . $childitem->link . '">' . $childitem->name . '</a></li>';
								} else {
									echo '<li><a href="' . $childitem->link . '">' . $childitem->name . '</a></li>';
								}
								// III level.
								echo '<ul>';
								foreach ( $childitem->children as $grandchilditem ) {
									if ( $grandchilditem->link === '' ) {
										echo '<li>' . $grandchilditem->name . '</li>';
									} else if ( $grandchilditem->external ) {
										echo '<li><a target="_blank" href="' . $grandchilditem->link . '">' . $grandchilditem->name . '</a></li>';
									} else {
										echo '<li><a href="' . $grandchilditem->link . '">' . $grandchilditem->name . '</a></li>';
									}
								}
								echo '</ul>';
							}
							echo '</ul>';
						}
						?>
					</ul>
				</ul>
				<?php
					}
				?>


			</div>
		</div>
	</div>

</div>

<?php
get_footer();
