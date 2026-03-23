<?php
/**
 * Language selector section.
 *
 * @package Design_ICT_Site
 */

$dis_language_selector_enabled = DIS_OptionsManager::dis_get_option( 'language_selector_visible', 'dis_opt_advanced_settings' );

if ( 'true' === $dis_language_selector_enabled ) {
	$dis_current_lang   = DIS_MultiLangManager::get_current_language();
	$dis_selectors_lang = DIS_MultiLangManager::get_page_selectors();
	?>

	<div class="nav-item dropdown">
		<a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">
			<span class="visually-hidden"><?php echo esc_html__( 'Language selection: selected language', 'design_ict_site' ); ?></span>
			<span><?php echo esc_html( strtoupper( $dis_current_lang ) ); ?></span>
			<svg class="icon d-none d-lg-block">
				<use href="<?php echo esc_url( DIS_THEME_URL . '/assets/bootstrap-italia/svg/sprites.svg#it-expand' ); ?>"></use>
			</svg>
		</a>
		<div class="dropdown-menu">
			<div class="row">
				<div class="col-12">
					<div class="link-list-wrapper">
						<ul class="link-list">
							<?php foreach ( $dis_selectors_lang as $dis_selector ) : ?>
								<li>
									<a class="dropdown-item list-item" href="<?php echo esc_url( $dis_selector['url'] ); ?>">
										<span>
											<?php echo esc_html( strtoupper( $dis_selector['slug'] ) ); ?>
											<?php if ( $dis_current_lang === $dis_selector['slug'] ) : ?>
												<span class="visually-hidden"><?php echo esc_html__( 'selected', 'design_ict_site' ); ?></span>
											<?php endif; ?>
										</span>
									</a>
								</li>
							<?php endforeach; ?>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
}
