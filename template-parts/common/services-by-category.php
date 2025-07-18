<?php
/* Services by category.
*
* @package Design_ICT_Site
*/

$serv_by_cat = $args['serv_by_cat'] ?? array();
if ( $serv_by_cat ) {
?>

	<div class="link-list-wrapper">
		<ul class="link-list">
			<?php
			foreach( $serv_by_cat as $cat ) {
				$icon_code = DIS_CustomFieldsManager::get_field( 'icon_code', $cat['item']->ID );
			?>
			<li>
				<a class="list-item large medium icon-right"
					href="<?php echo get_permalink( $cat['item']->ID ); ?>">
					<span class="list-item-title-icon-wrapper">
						<span class="list-item-title">
							<?php echo esc_attr( $cat['title'] ); ?>
						</span>
						<span class="icon icon-primary">
							<title><?php echo esc_attr( $cat['title'] ); ?></title>
							<i class="bi <?php echo esc_attr( $icon_code ); ?> me-3" style="font-size: 2em;"></i>
						</span>
					</span>
				</a>
				<ul class="link-sublist">
					<?php
					foreach ( $cat['children'] as $srv ) {
					?>
					<li>
						<a class="list-item"
							href="<?php echo esc_url( get_permalink( $srv->ID ) ); ?>">
							<span><?php echo esc_attr( $srv->post_title ); ?></span>
						</a>
					</li>
					<?php
					}
					?>
				</ul>
			</li>
			<?php
			}
			?>
		</ul>
	</div>

<?php
}
?>
