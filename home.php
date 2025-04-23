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
$sections = DIS_ContentsManager::get_hp_section_options( true );
foreach ( $sections as $section ) {
	echo esc_attr( $section['id'] ) . '<br>';
}
?>

<main id="main-container" class="main-container redbrown" role="main">

			<?php
				$languages = DIS_MultiLangManager::get_languages_list();
				echo 'Languages defined:' . esc_attr( count( $languages ) );
			?>



</main>

<?php
get_footer();
