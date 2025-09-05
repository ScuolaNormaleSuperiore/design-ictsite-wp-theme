<?php
/**
 * Help Desk Call To action section.
 * 
 * @package Design_ICT_Site
 */

$help_link = DIS_MultiLangManager::get_page_link( HELP_DESK_PAGE_SLUG );
?>
<section class="section pt-5 pb-5">
	<div class="container p-4">
		<div class="row">
			<div class="col-12">
				<article class="it-card it-card-banner rounded shadow-sm border">
						<h3 class="it-card-title ">
							<?php echo esc_attr( __( "Didn't find the answers you were looking for?", 'design_ict_site' ) ); ?>
						</h3>
						<div class="it-card-banner-icon-wrapper">
							<svg class="icon icon-secondary icon-xl" aria-hidden="true">
								<use href="<?php echo esc_url( DIS_THEME_URL . '/assets/bootstrap-italia/svg/sprites.svg#it-help-circle' ); ?>"></use>
							</svg>
						</div>
						<div class="it-card-body">
							<p class="it-card-subtitle">
								<?php echo esc_attr( __( 'Contact the help desk for technical assistance.', 'design_ict_site' ) ); ?>
							</p>
						</div>
						<div class="it-card-footer" aria-label="<?php echo esc_attr( __( 'Request support', 'design_ict_site' ) ); ?>">
							<a class="btn btn-sm btn-primary ms-3" href="<?php echo esc_url( $help_link ); ?>">
								<?php echo esc_attr( __( 'Request support', 'design_ict_site' ) ); ?>
								<svg class="icon icon-white ms-2">
									<use href="<?php echo esc_url( DIS_THEME_URL . '/assets/bootstrap-italia/svg/sprites.svg#it-arrow-right' ); ?>"></use>
								</svg>
							</a>
						</div>
				</article>
			</div>
		</div>
	</div>
</section>
