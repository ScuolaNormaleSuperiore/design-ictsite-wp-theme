<?php
/**
 * Page template
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Design_ICT_Site
 */

global $post;
get_header();
?>

<!-- BASIC PAGE -->
<div class="container shadow rounded  p-4 pt-3 pb-3 mb-5">
	<div class="row">

		<div class="col">
			<h2 class="pb-2">Titolo pagina base di primo livello</h2>
			<div class="p-5">
				...
			</div>
		</div> <!-- col -->

		<!-- SIDEBAR LIST (Menu-related pages)-->
		<div class="col-12 col-lg-4 col-md-5">
			<div class="sidebar-wrapper it-line-left-side">
				<div class="sidebar-linklist-wrapper">
					<div class="link-list-wrapper">
						<ul class="link-list">
							<li>
								<h3>Pagine collegate</h3>
							</li>
							<li>
								<a class="list-item medium" href="paginabase-secondolivello.html">
									<span>Pagina secondo livello</span>
								</a>
							</li>
							<li>
								<a class="list-item medium" href="paginabase-secondolivello.html">
									<span>Pagina secondo livello</span>
								</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div> <!-- sidebar -->

	</div> <!-- row -->
</div> <!-- container -->

<!-- Related contents -->
<?php
	$related = DIS_CustomFieldsManager::get_field( 'related_items', $post->ID );
	get_template_part(
		'template-parts/common/related-contents',
		false,
		array(
			'items'     => $related,
			'all_label' => '',
			'all_link'  => '',
		)
	);
	?>

<?php
get_footer();
