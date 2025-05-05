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
$all_sections = DIS_ContentsManager::get_hp_sections();
$sections     = DIS_ContentsManager::get_hp_section_options( true );
?>

<main id="main-container" class="main-container redbrown" role="main">

	<?php
	foreach ( $sections as $section ) {
		$sec_id   = $section['id'];
		$sec_data = ( $sec_id && array_key_exists( $sec_id, $all_sections ) ) ? $all_sections[$sec_id] : null;
		echo $sec_id. '<BR>' ;
		if ( $sec_data ){
			get_template_part(
				$sec_data['template'],
				null,
				array(
					'id'         => $section['id'],
					'show_title' => $section['show_title'],
					'enabled'    => $section['enabled'],
				)
			);
		}
	}
	?>

</main>

<?php
get_footer();
