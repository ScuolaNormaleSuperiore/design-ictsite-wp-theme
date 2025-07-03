<?php
/* Template Name: ServiceItems
*
* @package Design_ICT_Site
*/

global $post;
get_header();

$services = DIS_ContentsManager::get_service_list();
?>

<div class="container shadow rounded  p-4 pt-3 pb-3 mb-5">
	<h2 class="pb-2"><?php echo get_the_title(); ?></h2>

	<ul>
		<?php
		foreach( $services as $service ) {
		?>
			<li>
				<a href="<?php echo get_permalink( $service ); ?>">
					<?php echo get_the_title( $service );?>
				</a>
			</li>
		<?php
		}
		?>
	</ul>

</div>

<?php
get_footer();
