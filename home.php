<?php
/**
 * The template for displaying home
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Design_ICT_Site
 */

get_header();

?>

<main id="main-container" class="main-container redbrown" role="main">

<?php echo '*** ICT Site content ***'; ?>

<?php
	$languages = DIS_MultiLangManager::get_languages_list();
	echo 'Languages defined:' . count($languages);

	$tm  = DIS_ThemeManager::get_instance();
	$txt = $tm->cfm->get_name();
	echo '--->' . $txt;
?>
</main>

<?php
get_footer();