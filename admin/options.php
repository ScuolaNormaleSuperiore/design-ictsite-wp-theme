<?php
/**
	* A CMB2 options-page display callback override which adds tab navigation among
	* CMB2 options pages which share this same display callback.
	*
	* @param CMB2_Options_Hookup $cmb_options The CMB2_Options_Hookup object.
	*/
function dis_options_display_with_tabs( $cmb_options ) {
	$tabs = dis_options_page_tabs( $cmb_options );
	?>
	<div class="wrap cmb2-options-page option-<?php echo $cmb_options->option_key; ?>">
		<?php if ( get_admin_page_title() ) : ?>
			<h2><?php echo wp_kses_post( get_admin_page_title() ); ?></h2>
		<?php endif; ?>
				<div class="cmb2-options-box">
						<div class="nav-tab-wrapper">
								<?php foreach ( $tabs as $option_key => $tab_title ) : ?>
										<a class="nav-tab<?php if ( isset( $_GET['page'] ) && $option_key === $_GET['page'] ) : ?> nav-tab-active<?php endif; ?>" href="<?php menu_page_url( $option_key ); ?>"><?php echo wp_kses_post( $tab_title ); ?></a>
								<?php endforeach; ?>
						</div>

						<form class="cmb-form" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="POST" id="<?php echo $cmb_options->cmb->cmb_id; ?>" enctype="multipart/form-data" encoding="multipart/form-data">
								<fieldset class="form-content">
										<input type="hidden" name="action" value="<?php echo esc_attr( $cmb_options->option_key ); ?>">
										<?php $cmb_options->options_page_metabox(); ?>
								</fieldset>

								<fieldset class="form-footer">
										<div class="submit-box"><?php submit_button( esc_attr( $cmb_options->cmb->prop( 'save_button' ) ), 'primary', 'submit-cmb', false ); ?></div>
								</fieldset>
						</form>
						<div class="clear-form"></div>
				</div>
	</div>
	<?php
}

/**
	* Gets navigation tabs array for CMB2 options pages which share the given
	* display_cb param.
	*
	* @param CMB2_Options_Hookup $cmb_options The CMB2_Options_Hookup object.
	*
	* @return array Array of tab information.
	*/
function dis_options_page_tabs( $cmb_options ) {
	$tab_group = $cmb_options->cmb->prop( 'tab_group' );
	$tabs      = array();

	foreach ( CMB2_Boxes::get_all() as $cmb_id => $cmb ) {
		if ( $tab_group === $cmb->prop( 'tab_group' ) ) {
			$tabs[ $cmb->options_page_keys()[0] ] = $cmb->prop( 'tab_title' )
				? $cmb->prop( 'tab_title' )
				: $cmb->prop( 'title' );
		}
	}

	return $tabs;
}

