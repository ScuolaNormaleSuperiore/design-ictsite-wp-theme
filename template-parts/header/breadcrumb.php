<?php
/**
 * The breadcrumb of the site.
 *
 * @package Design_ICT_Site
 */

	global $post;
	if ( is_home() ) {
		$steps = array();
	} else {
		// $steps = DLI_ContentsManager::build_content_path( $post );
		$steps = array();
	}
	$index = 0;
?>

	<nav class="breadcrumb-container" aria-label="<?php echo __( 'Navigation path', 'design_ict_site' ); ?>">
	<ol class="breadcrumb pb-0">
		<?php
			foreach( $steps as $step ){
		?>
		<li class="<?php echo esc_attr( $step['class'] ); ?>">
			<a href="<?php echo esc_url( $step['url'] ); ?>"><?php echo esc_attr( $step['label'] ); ?></a>
			<?php
				if ( $index < count( $steps) -1 ) {
			?>
			<span class="separator">&gt;</span>
			<?php
				}
			?>
		</li>
		<?php
			$index++;
			}
		?>
		<li class="breadcrumb-item"><a href="#">Home</a><span class="separator">&gt;</span></li>
	</ol>
</nav>
