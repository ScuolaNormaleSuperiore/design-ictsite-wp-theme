<?php
/* Template Name: dis-news
*
* @package Design_ICT_Site
*/

global $post;
get_header();

$items = DIS_ContentsManager::get_generic_post_list( DIS_NEWS_POST_TYPE );
?>

<div class="container shadow rounded  p-4 pt-3 pb-3 mb-5">
	<h2 class="pb-2"><?php echo get_the_title(); ?></h2>

		<ul>
		<?php
		foreach( $items as $item ) {
		?>
			<li>
				<a href="<?php echo get_permalink( $item ); ?>">
					<?php echo get_the_title( $item );?>
				</a>
			</li>
		<?php
		}
		?>
	</ul>

</div>

<?php
get_footer();
