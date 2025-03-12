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

<div>
	<div class="py-1">
	<div class="btn-example">
		<button type="button" class="btn btn-primary">Primary</button>
		<button type="button" class="btn btn-outline-primary">Primary outline</button>
		<button type="button" class="btn btn-primary disabled">Primary disabled</button>
		<button type="button" class="btn btn-outline-primary disabled">Primary outline disabled</button>
	</div>
	<div class="btn-example">
		<button type="button" class="btn btn-secondary">Secondary</button>
		<button type="button" class="btn btn-outline-secondary">Secondary outline</button>
		<button type="button" class="btn btn-secondary disabled">Secondary disabled</button>
		<button type="button" class="btn btn-outline-secondary disabled">Secondary outline disabled</button>
	</div>
	<div class="btn-example">
		<button type="button" class="btn btn-success">Success</button>
		<button type="button" class="btn btn-outline-success">Success outline</button>
		<button type="button" class="btn btn-success disabled">Success disabled</button>
		<button type="button" class="btn btn-outline-success disabled">Success outline disabled</button>
	</div>
	<div class="btn-example">
		<button type="button" class="btn btn-danger">Danger</button>
		<button type="button" class="btn btn-outline-danger">Danger outline</button>
		<button type="button" class="btn btn-danger disabled">Danger disabled</button>
		<button type="button" class="btn btn-outline-danger disabled">Danger outline disabled</button>
	</div>
	<div class="btn-example">
		<button type="button" class="btn btn-warning">Warning</button>
		<button type="button" class="btn btn-outline-warning">Warning outline</button>
		<button type="button" class="btn btn-warning disabled">Warning disabled</button>
		<button type="button" class="btn btn-outline-warning disabled">Warning outline disabled</button>
	</div>
	</div>
</div>

<div>
	<button class="btn btn-success btn-lg btn-icon btn-me">
		<span class="rounded-icon">
			<svg class="icon icon-success">
				<use href="<?php echo DIS_THEME_URL . '/assets/bootstrap-italia/svg/sprites.svg#it-user' ?>"></use>
			</svg>
		</span>
		<span>Round Icon Lg</span>
	</button>
</div>

<div>
	<div class="alert alert-primary" role="alert">
		This is a <b>primary</b> Alert".
	</div>
</div>

</main>

<?php
get_footer();
