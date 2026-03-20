<?php
/**
 * The template for displaying home
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Design_ICT_Site
 */

get_header();

// Retrieve all the sections of this site.
$dis_all_sections = DIS_ContentsManager::get_hp_sections();
$dis_sections     = DIS_ContentsManager::get_hp_section_options( true );
?>

<div id="main-container" class="main-container redbrown" role="main">

	<?php
	foreach ( $dis_sections as $dis_section ) {
		$dis_section_id   = $dis_section['id'];
		$dis_section_data = ( $dis_section_id && array_key_exists( $dis_section_id, $dis_all_sections ) ) ? $dis_all_sections[ $dis_section_id ] : null;
		if ( $dis_section_data ) {
			get_template_part(
				$dis_section_data['template'],
				null,
				array(
					'id'         => $dis_section['id'],
					'show_title' => $dis_section['show_title'],
					'enabled'    => $dis_section['enabled'],
				)
			);
		}
	}
	?>

</div>

<?php
get_footer();
