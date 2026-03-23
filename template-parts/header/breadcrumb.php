<?php
/**
 * The breadcrumb of the site.
 *
 * @package Design_ICT_Site
 */

if ( ! is_home() ) {
	$dis_post  = get_post();
	$dis_steps = DIS_NavigationManager::build_content_path( $dis_post );
	?>

	<nav class="breadcrumb-container" aria-label="<?php echo esc_attr__( 'Navigation path', 'design_ict_site' ); ?>">
		<ol class="breadcrumb pb-0">
			<?php foreach ( $dis_steps as $dis_index => $dis_step ) : ?>
				<li class="<?php echo esc_attr( $dis_step->css_class ); ?>">
					<a href="<?php echo esc_url( $dis_step->url ); ?>"><?php echo esc_html( $dis_step->label ); ?></a>
					<?php if ( $dis_index < count( $dis_steps ) - 1 ) : ?>
						<span class="separator">&gt;</span>
					<?php endif; ?>
				</li>
			<?php endforeach; ?>
		</ol>
	</nav>

	<?php
}
?>
