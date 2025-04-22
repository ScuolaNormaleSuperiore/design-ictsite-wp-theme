<?php
/**
 * The template for displaying home
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Design_ICT_Site
 */

get_header();

$site_title = DIS_OptionsManager::dis_get_option( 'site_title', 'dis_opt_options' );

$current_lang = DIS_MultiLangManager::get_current_language();
$home         = DIS_MultiLangManager::get_home_url();
$all          = DIS_MultiLangManager::get_all_languages();
$list         = DIS_MultiLangManager::get_languages_list();

$sections = DIS_ContentsManager::get_hp_section_options( true );
foreach ( $sections as $section ) {
	echo esc_attr( $section['id'] ) . '<br>';
}
?>

<main id="main-container" class="main-container redbrown" role="main">

<?php echo '*** ICT Site content ***'; ?>
<?php echo '<H1>' . esc_attr( $site_title ) . '</H1>'; ?>

<?php
	$languages = DIS_MultiLangManager::get_languages_list();
	echo 'Languages defined:' . esc_attr( count( $languages ) );

	// $tm  = DIS_ThemeManager::get_instance();
	// $txt = $tm->cfm->get_name();
	// echo '--->' . $txt;
?>


<div>
	<button class="btn btn-success btn-lg btn-icon btn-me">
		<span class="rounded-icon">
			<svg class="icon icon-success">
				<use href="<?php echo DIS_THEME_URL . '/assets/bootstrap-italia/svg/sprites.svg#it-user'; ?>"></use>
			</svg>
		</span>
		<span>Round Icon Lg</span>
	</button>
</div>


</main>

<?php
get_footer();
