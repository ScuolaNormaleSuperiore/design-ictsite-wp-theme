<?php
/* Template Name: dis-person
*
* @package Design_ICT_Site
*/

global $post;
get_header();

$persons = DIS_ContentsManager::get_person_list();
?>

<div class="container shadow rounded  p-4 pt-3 pb-3 mb-5">
	<h2 class="pb-2">
		<?php echo esc_attr( get_the_title() ); ?>
	</h2>
	<div class="row">

		<!-- People -->
		<?php
			get_template_part(
				'template-parts/common/people-section',
				false,
				array(
					'persons' => $persons,
					'format'  => 'full',
				)
			);
		?>

	</div>
</div>

<?php
get_footer();
