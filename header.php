<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Design_ICT_Site
 */
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<!-- HEADER -->
<header class="it-header-wrapper" data-bs-target="#header-nav-wrapper" role="navigation">
	<div class="it-header-slim-wrapper">
		<div class="container">
			<div class="row">

				<?php echo 'ICT Site HEADER'; ?>

			</div>
		</div>
	</div>
</header>
<!-- END HEADER -->


