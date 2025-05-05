<?php
/**
 * Section with contacts data in the footer.
 *
 * @package Design_ICT_Site
 */

$email     = DIS_OptionsManager::dis_get_option( 'site_email', 'dis_opt_site_contacts' );
$telephone = DIS_OptionsManager::dis_get_option( 'site_telephone', 'dis_opt_site_contacts' );
?>

<h4 class="customSpacing">
	<?php echo esc_attr( __( 'FooterContactsLabel', 'design_ict_site' ) ); ?>
</h4>
<p>
	<?php echo esc_attr( __( 'FooterContactsDescription', 'design_ict_site' ) ); ?>
</p>
<div class="link-list-wrapper">
	<ul class="footer-list link-list clearfix">
		<li>
			<a class="list-item" href="mailto:<?php echo esc_attr( $email ); ?>"
				title="<?php echo esc_attr( __( 'Contact email address', 'design_ict_site' ) ); ?>">
				<?php echo esc_attr( $email ); ?>
			</a>
		</li>
		<li>
			<?php echo esc_attr( $telephone ); ?>
		</li>
	</ul>
</div>
