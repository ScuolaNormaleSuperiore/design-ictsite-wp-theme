<?php
/**
 * The HP Banners section.
 *
 * @package Design_ICT_Site
 */

$enabled_par     = $args['enabled'] ?? '';
$id_par          = $args['id'] ?? '';
$show_title_par  = $args['show_title'] ?? '';
$show_title      = ( $show_title_par === 'true' ) ? true : false;
$section_enabled = ( $enabled_par === 'true' ) ? true : false;

if ( $section_enabled ) {
	$items = DIS_ContentsManager::get_hp_banner_list();
	foreach ( $items as $item ) {
		$image_data = DIS_ContentsManager::get_image_metadata( $item, 'full', '/assets/img/default-background.png' );
		$section      = DIS_CustomFieldsManager::get_field( 'section' , $item->ID );
		$button_label = DIS_CustomFieldsManager::get_field( 'button_label' , $item->ID );
		$button_link  = DIS_CustomFieldsManager::get_field( 'button_link' , $item->ID );
		$new_window   = DIS_CustomFieldsManager::get_field( 'new_window' , $item->ID );
?>

	<div class="container-banner-home">
		<?php
			if ( $show_title ) {
		?>
		<h2 class="pb-4"><?php echo __( 'Banner' , 'design_ict_site' );?></h2>
		<?php
			} else {
		?>
		<h2 class="visually-hidden"><?php echo __( 'Activity banner' , 'design_ict_site' );?></h2>
		<?php
			}
		?>
		<section class="it-hero-wrapper it-hero-small-size it-primary it-overlay ">
			<div class="img-responsive-wrapper">
				<div class="img-responsive">
					<div class="img-wrapper">
						<img
							src="<?php echo esc_url( $image_data['image_url'] ); ?>"
							title="<?php echo esc_attr( $image_data['image_title'] ); ?>"
							alt="<?php echo esc_attr( $image_data['image_alt'] ); ?>">
						</div>
				</div>
			</div>
			<div class="container">
				<div class="row">
					<div class="col-12">
						<div class="it-hero-text-wrapper ">
							<span class="it-Categoria"><?php echo esc_attr( $section); ?></span>
							<h2><?php echo esc_attr( $item->post_title ); ?></h2>
							<p class="d-none d-lg-block">
								<?php  echo apply_filters('the_content', $item->post_content); ?>
							</p>
							<div class="it-btn-container">
								<a 
									<?php
									if ( $new_window ) {
										echo 'target="_blank"';
									}
									?>
									class="btn btn-sm btn-secondary"
									href="<?php echo esc_url( $button_link ); ?>"
								>
									<?php echo esc_attr( $button_label ); ?>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>

<?php
	}
}
?>
