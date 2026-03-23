<?php
/**
 * Services by category.
 *
 * @package Design_ICT_Site
 */

$dis_services_by_category = $args['serv_by_cat'] ?? array();

if ( $dis_services_by_category ) {
	?>
	<div class="link-list-wrapper">
		<ul class="link-list">
			<?php foreach ( $dis_services_by_category as $dis_category ) : ?>
				<?php $dis_icon_code = DIS_CustomFieldsManager::get_field( 'icon_code', $dis_category['item']->ID ); ?>
				<li>
					<a class="list-item large medium icon-right"
						href="<?php echo esc_url( get_permalink( $dis_category['item']->ID ) ); ?>">
						<span class="list-item-title-icon-wrapper">
							<span class="list-item-title">
								<?php echo esc_html( $dis_category['title'] ); ?>
							</span>
							<span class="icon icon-primary">
								<title><?php echo esc_html( $dis_category['title'] ); ?></title>
								<i class="bi <?php echo esc_attr( $dis_icon_code ); ?> me-3" style="font-size: 2em;"></i>
							</span>
						</span>
					</a>
					<ul class="link-sublist">
						<?php foreach ( $dis_category['children'] as $dis_service ) : ?>
							<li>
								<a class="list-item" href="<?php echo esc_url( get_permalink( $dis_service->ID ) ); ?>">
									<span><?php echo esc_html( $dis_service->post_title ); ?></span>
								</a>
							</li>
						<?php endforeach; ?>
					</ul>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
	<?php
}
