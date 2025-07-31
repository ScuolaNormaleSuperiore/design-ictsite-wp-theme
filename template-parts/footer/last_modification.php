<?php
/**
 * Last modification section.
 *
 * @package Design_ICT_Site
 */

global $post;
?>

<div class="row">
	<div class="col-12 pt-3">
		<p class="small text-center">
			<?php echo esc_attr( __( 'Last modification', 'design_ict_site' ) ); ?>:&nbsp;
			<?php the_modified_date( 'd/m/Y' ); ?>
		</p>
	</div>
</div>
