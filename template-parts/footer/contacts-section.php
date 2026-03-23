<?php
/**
 * Section with contacts data in the footer.
 *
 * @package Design_ICT_Site
 */

$dis_email     = DIS_OptionsManager::dis_get_option( 'site_email', 'dis_opt_site_contacts' );
$dis_telephone = DIS_OptionsManager::dis_get_option( 'site_telephone', 'dis_opt_site_contacts' );
?>

<h4 class="customSpacing">
	<?php echo esc_html__( 'FooterContactsLabel', 'design_ict_site' ); ?>
</h4>
<p>
	<?php echo esc_html__( 'FooterContactsDescription', 'design_ict_site' ); ?>
</p>
<div class="link-list-wrapper">
	<ul class="footer-list link-list clearfix">
		<li>
			<a class="list-item" href="mailto:<?php echo esc_attr( $dis_email ); ?>"
				title="<?php echo esc_attr__( 'Contact email address', 'design_ict_site' ); ?>">
				<?php echo esc_html( $dis_email ); ?>
			</a>
		</li>
		<li>
			<?php echo esc_html( $dis_telephone ); ?>
		</li>
	</ul>
</div>
