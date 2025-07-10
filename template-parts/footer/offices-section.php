<?php
/**
 * Section with office list in the footer of the site.
 *
 * @package Design_ICT_Site
 */

$offices = DIS_ContentsManager::get_office_list();
if ( count( $offices ) > 0 ) {
?>

	<h4 class="customSpacing"><?php echo esc_attr( __( 'FooterOfficesLabel', 'design_ict_site' ) ); ?></h4>
	<div class="link-list-wrapper">
		<ul class="footer-list link-list clearfix">
			<?php
			foreach ( $offices as $office ) {
			?>
				<li>
					<a class="list-item"
						href="<?php echo esc_attr( get_permalink( $office ) ); ?>"
						title="<?php echo esc_attr( __( 'Go to the page', 'design_ict_site' ) ); ?> . ': ' . <?php echo esc_attr( $office->post_title ); ?>"><?php echo esc_attr( $office->post_title ); ?>
					</a>
				</li>
			<?php
			}
			?>
		</ul>
	</div>

<?php
}
?>
