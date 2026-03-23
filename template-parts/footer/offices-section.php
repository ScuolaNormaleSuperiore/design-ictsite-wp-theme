<?php
/**
 * Section with office list in the footer of the site.
 *
 * @package Design_ICT_Site
 */

$dis_offices = DIS_ContentsManager::get_office_list();

if ( count( $dis_offices ) > 0 ) {
	?>
	<h4 class="customSpacing"><?php echo esc_html__( 'FooterOfficesLabel', 'design_ict_site' ); ?></h4>
	<div class="link-list-wrapper">
		<ul class="footer-list link-list clearfix">
			<?php foreach ( $dis_offices as $dis_office ) : ?>
				<li>
					<a class="list-item"
						href="<?php echo esc_url( get_permalink( $dis_office ) ); ?>"
						title="<?php echo esc_attr( __( 'Go to the page', 'design_ict_site' ) . ': ' . $dis_office->post_title ); ?>">
						<?php echo esc_html( $dis_office->post_title ); ?>
					</a>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
	<?php
}
