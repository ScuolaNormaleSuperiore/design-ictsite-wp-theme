<?php
/**
 * Template Name: Offices
 *
 * @package Design_ICT_Site
 */

get_header();

$dis_items = DIS_ContentsManager::get_generic_post_list( DIS_OFFICE_POST_TYPE );
?>

<div class="container shadow rounded  p-4 pt-3 pb-3 mb-5">
	<h2 class="pb-2"><?php echo esc_attr( get_the_title() ); ?></h2>
	<ul>
		<?php foreach ( $dis_items as $dis_item ) : ?>
			<li>
				<a href="<?php echo esc_url( get_permalink( $dis_item ) ); ?>">
					<?php echo esc_attr( get_the_title( $dis_item ) ); ?>
				</a>
			</li>
		<?php endforeach; ?>
	</ul>
</div>

<?php
get_footer();
