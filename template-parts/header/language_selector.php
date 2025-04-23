<?php
/**
 * The language selector section.
 *
 * @package Design_ICT_Site
 */


$language_selector_enabled = DIS_OptionsManager::dis_get_option( 'language_selector_visible', 'dis_opt_advanced_settings' );
if ( $language_selector_enabled === 'true' ) {
	$current_lang   = DIS_MultiLangManager::get_current_language();
	$selectors_lang = DIS_MultiLangManager::get_page_selectors();
?>

	<div class="nav-item dropdown">
		<a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">
			<span class="visually-hidden"><?php echo __( 'Language selection: selected language', 'design_ict_site' ); ?></span>
			<span><?php echo strtoupper($current_lang); ?></span>
			<svg class="icon d-none d-lg-block">
				<use href="<?php echo DIS_THEME_URL . '/assets/bootstrap-italia/svg/sprites.svg#it-expand'; ?>"></use>
			</svg>
		</a>
		<div class="dropdown-menu">
			<div class="row">
				<div class="col-12">
					<div class="link-list-wrapper">
						<ul class="link-list">
							<?php
								foreach ( $selectors_lang as $selector ) {
							?>
								<li>
									<a class="dropdown-item list-item" href="<?php echo $selector['url'] ?>">
										<span>
											<?php echo strtoupper( $selector['slug'] ); ?>
											<?php if ( $current_lang === $selector['slug'] ){
											?>
												<span class="visually-hidden"><?php echo __( 'selected', 'design_ict_site' ); ?></span>
											<?php
											}
											?>
										</span>
									</a>
								</li>
							<?php
								}
							?>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php
}
?>