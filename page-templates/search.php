<?php
/* Template Name: Search in the site.
*
* @package Design_ICT_Site
*/

global $post;
get_header();

$search_string     = '';
$all_content_types = DIS_ContentsManager::get_content_types_with_results();
$default_ct_list   = array_column( $all_content_types, 'slug' );
$all_clusters      = DIS_ContentsManager::get_cluster_list();
$default_cl_list = array_map( function( $cluster ) { return $cluster->post_name; }, $all_clusters ); 

$num_results       = 0;
$the_query         = null;
$per_page          =
	isset( $_GET['per_page'] ) && is_numeric( $_GET['per_page'] ) ?
	$_GET['per_page'] :
	DIS_ITEMS_PER_PAGE;
$per_page_values  = DIS_ITEMS_PER_PAGE_VALUES;

// Set and format the filters for the query.
if ( isset( $_GET['isreset'] ) && ( sanitize_text_field( $_GET['isreset'] ) === 'yes' ) ) {
	$selected_contents = $default_ct_list;
	$selected_clusters = $default_cl_list;
	$search_string     = '';
} else {
	if ( isset( $_GET['selected_contents'] ) ) {
		$selected_contents = $_GET['selected_contents'];
	} else {
		$selected_contents = $default_ct_list;
	}
	if ( isset( $_GET['selected_clusters'] ) ) {
		$selected_clusters = $_GET['selected_clusters'];
	} else {
		$selected_clusters = $default_cl_list;
	}
	if ( ! is_array( $selected_contents ) ) {
		$selected_contents = $default_ct_list;
	}
	if ( isset( $_GET['search_string'] ) ) {
		$search_string = sanitize_text_field( $_GET['search_string'] );
	} else {
		$search_string = '';
	}
}

// Execute the query if the NONCE is valid.
if ( '' !== $search_string ) {
	// NONCE CHECK.
	if (
		isset( $_GET['site_search_nonce_field'] ) &&
		wp_verify_nonce( sanitize_text_field( $_GET['site_search_nonce_field'] ), 'sf_site_search_nonce' )
	) {
		$the_query = DIS_ContentsManager::get_site_search_query(
			$selected_contents,
			$search_string,
			$per_page
		);
		$num_results = $the_query->found_posts;
	}
} else {
	$num_results = 0;
}
$result_message = sprintf( __( "Found %s results.", 'design_ict_site' ), $num_results );
?>

<div class="container shadow rounded  p-4 pt-3 pb-3 mb-5">
	<div class="row">

		<!-- RESULTS -->
		<div class="col">

			<h2 class="pb-2">
				<?php echo __( 'Search results', 'design_ict_site' ); ?>
			</h2>

			<!-- SEARCH RESULTS NUMBER -->
			<p>
				<small><?php echo esc_attr( $result_message ); ?></small>
			</p>

			<!-- SEARCH RESULTS LIST -->
			<ul class="it-card-list row" aria-label="<?php echo __( 'Search results', 'design_ict_site' ); ?>">
				<li class="col-12 col-md-6 col-lg-4 mb-3 mb-md-4">
					<!--start it-card-->
					<article class="it-card it-card-height-full rounded shadow-sm border">
						<!--card first child is the title (link)-->
						<h3 class="it-card-title ">
							<a href="#">Primo risultato</a>
						</h3>
						<!--card body content-->
						<div class="it-card-body">
							<p class="it-card-text">Questo è un testo breve che riassume il contenuto della pagina di destinazione
								in massimo tre o quattro righe, senza troncamento.</p>
						</div>
						<!--finally the card footer metadata-->
						<footer class="it-card-related it-card-footer">
							<div class="it-card-taxonomy">
								<a href="#" class="it-card-category it-card-link link-secondary"><span
										class="visually-hidden">Categoria correlata: </span>TIPOLOGIA</a>
							</div>
						</footer>
					</article>
					<!--end it-card-->
				</li>
				<li class="col-12 col-md-6 col-lg-4 mb-3 mb-md-4">
					<!--start it-card-->
					<article class="it-card rounded shadow-sm border">
						<!--card first child is the title (link)-->
						<h3 class="it-card-title ">
							<a href="#">Secondo risultato</a>
						</h3>
						<!--card body content-->
						<div class="it-card-body">
							<p class="it-card-text">Questo è un testo breve che riassume il contenuto della pagina di destinazione
								in massimo tre o quattro righe, senza troncamento.</p>
						</div>
						<!--finally the card footer metadata-->
						<footer class="it-card-related it-card-footer">
							<div class="it-card-taxonomy">
								<a href="#" class="it-card-category it-card-link link-secondary"><span
										class="visually-hidden">Categoria correlata: </span>TIPOLOGIA</a>
							</div>
						</footer>
					</article>
					<!--end it-card-->
				</li>
				<li class="col-12 col-md-6 col-lg-4 mb-3 mb-md-4">
					<!--start it-card-->
					<article class="it-card it-card-height-full rounded shadow-sm border">
						<!--card first child is the title (link)-->
						<h3 class="it-card-title ">
							<a href="#">Terzo risultato</a>
						</h3>
						<!--card body content-->
						<div class="it-card-body">
							<p class="it-card-text">Questo è un testo breve che riassume il contenuto della pagina di destinazione
								in massimo tre o quattro righe, senza troncamento.</p>
						</div>
						<!--finally the card footer metadata-->
						<footer class="it-card-related it-card-footer">
							<div class="it-card-taxonomy">
								<a href="#" class="it-card-category it-card-link link-secondary"><span
										class="visually-hidden">Categoria correlata: </span>TIPOLOGIA</a>
							</div>
						</footer>
					</article>
					<!--end it-card-->
				</li>
				<li class="col-12 col-md-6 col-lg-4 mb-3 mb-md-4">
					<!--start it-card-->
					<article class="it-card rounded shadow-sm border">
						<!--card first child is the title (link)-->
						<h3 class="it-card-title ">
							<a href="#">Quarto risultato</a>
						</h3>
						<!--card body content-->
						<div class="it-card-body">
							<p class="it-card-text">Questo è un testo breve che riassume il contenuto della pagina di destinazione
								in massimo tre o quattro righe, senza troncamento.</p>
						</div>
						<!--finally the card footer metadata-->
						<footer class="it-card-related it-card-footer">
							<div class="it-card-taxonomy">
								<a href="#" class="it-card-category it-card-link link-secondary"><span
										class="visually-hidden">Categoria correlata: </span>TIPOLOGIA</a>
							</div>
						</footer>
					</article>
					<!--end it-card-->
				</li>
				<li class="col-12 col-md-6 col-lg-4 mb-3 mb-md-4">
					<!--start it-card-->
					<article class="it-card it-card-height-full rounded shadow-sm border">
						<!--card first child is the title (link)-->
						<h3 class="it-card-title ">
							<a href="#">Quinto risultato</a>
						</h3>
						<!--card body content-->
						<div class="it-card-body">
							<p class="it-card-text">Questo è un testo breve che riassume il contenuto della pagina di destinazione
								in massimo tre o quattro righe, senza troncamento.</p>
						</div>
						<!--finally the card footer metadata-->
						<footer class="it-card-related it-card-footer">
							<div class="it-card-taxonomy">
								<a href="#" class="it-card-category it-card-link link-secondary"><span
										class="visually-hidden">Categoria correlata: </span>TIPOLOGIA</a>
							</div>
						</footer>
					</article>
					<!--end it-card-->
				</li>
				<li class="col-12 col-md-6 col-lg-4 mb-3 mb-md-4">
					<!--start it-card-->
					<article class="it-card rounded shadow-sm border">
						<!--card first child is the title (link)-->
						<h3 class="it-card-title ">
							<a href="#">Sesto risultato</a>
						</h3>
						<!--card body content-->
						<div class="it-card-body">
							<p class="it-card-text">Questo è un testo breve che riassume il contenuto della pagina di destinazione
								in massimo tre o quattro righe, senza troncamento.</p>
						</div>
						<!--finally the card footer metadata-->
						<footer class="it-card-related it-card-footer">
							<div class="it-card-taxonomy">
								<a href="#" class="it-card-category it-card-link link-secondary"><span
										class="visually-hidden">Categoria correlata: </span>TIPOLOGIA</a>
							</div>
						</footer>
					</article>
					<!--end it-card-->
				</li>
			</ul>

			<!-- Results pagination-->
			<nav class="pagination-wrapper justify-content-center" aria-label="Esempio di navigazione con page changer">
				<ul class="pagination text-center">
					<li class="page-item">
						<a class="page-link" href="#">
							<svg class="icon icon-primary">
								<use href="/bootstrap-italia/svg/sprites.svg#it-chevron-left"></use>
							</svg>
							<span class="visually-hidden">Pagina precedente</span>
						</a>
					</li>
					<li class="page-item"><a class="page-link" href="#">1</a></li>

					<li class="page-item active">
						<a class="page-link" href="#" aria-current="page">
							<span class="d-inline-block d-sm-none">Pagina </span>26
						</a>
					</li>
					<li class="page-item"><a class="page-link" href="#">27</a></li>
					<li class="page-item"><a class="page-link" href="#">28</a></li>
					<li class="page-item"><span class="page-link">...</span></li>
					<li class="page-item"><a class="page-link" href="#">50</a></li>
					<li class="page-item">
						<a class="page-link" href="#">
							<span class="visually-hidden">Pagina successiva</span>
							<svg class="icon icon-primary">
								<use href="/bootstrap-italia/svg/sprites.svg#it-chevron-right"></use>
							</svg>
						</a>
					</li>
				</ul>
				<div class="dropdown">
					<button class="btn btn-dropdown dropdown-toggle" type="button" id="pagerChanger" data-bs-toggle="dropdown"
						aria-haspopup="true" aria-expanded="false" aria-label="Salta alla pagina">
						10/pagina
						<svg class="icon icon-primary icon-sm">
							<use href="/bootstrap-italia/svg/sprites.svg#it-expand"></use>
						</svg>
					</button>
					<div class="dropdown-menu" aria-labelledby="pagerChanger">
						<div class="link-list-wrapper">
							<ul class="link-list">
								<li><a class="list-item active" href="#" aria-current="page"><span>20/pagina</span></a></li>
								<li><a class="dropdown-item list-item" href="#"><span>50/pagina</span></a></li>
								<li><a class="dropdown-item list-item" href="#"><span>100/pagina</span></a></li>
							</ul>
						</div>
					</div>
				</div>
			</nav>

		</div>


		<!-- SEARCH SIDEBAR -->
		<div class="col-12 col-lg-4 col-md-5">
			<div class="sidebar-wrapper it-line-left-side">
				<FORM action="." id="search_site_form" method="GET">
					<?php wp_nonce_field( 'sf_site_search_nonce', 'site_search_nonce_field' ); ?>

					<!-- Filter by TEXT -->
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-text"><svg class="icon icon-sm" aria-hidden="true">
									<use href="/bootstrap-italia/svg/sprites.svg#it-search"></use>
								</svg></span>
							<label for="search_string">
								<?php echo esc_html( __( 'Search the site', 'design_ict_site' ) ); ?>
							</label>
							<input type="text" id="search_string" name="search_string" class="form-control" 
									value="<?php echo esc_attr( $search_string ? $search_string : '' );  ?>"
									placeholder="<?php echo esc_html( __( 'Digit the text to search', 'design_ict_site' ) ); ?>">
							<!--
							<div class="input-group-append">
								<button type="submit" value="submit" class="btn btn-primary">
									<?php echo esc_html( __( 'Search', 'design_ict_site' ) ); ?>
								</button>
							</div>
							-->
						</div>
					</div>

					<!-- Filter by CLUSTER -->
					<div class="p-4 pt-lg-0">
						<h3 class="p-0">
							<?php echo __( 'Service clusters', 'design_ict_site' ); ?>
						</h3>
						<fieldset>
							<legend class="visually-hidden">
								<?php echo __( 'Filters for selecting search results', 'design_ict_site' ); ?>
							</legend>
							<?php
							foreach( $all_clusters as $cl ) {
							?>
							<div class="form-check">
								<input type="checkbox" name="selected_clusters[]" id="<?php echo esc_attr( $cl->post_name ); ?>" 
									value="<?php echo esc_attr( $cl->post_name ); ?>"
									<?php if (count( $selected_clusters ) > 0 && in_array( $cl->post_name, $selected_clusters ) ) {
										echo "checked='checked'";
									} ?>
								>
								<label for="<?php echo esc_attr( $cl->post_name ) ; ?>">
									<?php echo esc_attr( $cl->post_title ); ?>
								</label>
							</div>
							<?php
							}
							?>
						</fieldset>
					</div>

					<!-- Filter by POST TYPE -->
					<div class="p-4 pt-lg-0">
						<h3 class="p-0">
							<?php echo __( 'Content types', 'design_ict_site' ); ?>
						</h3>
						<fieldset>
							<legend class="visually-hidden">
								<?php echo __( 'Filters for selecting search results', 'design_ict_site' ); ?>
							</legend>
							<?php
							foreach( $all_content_types as $ct ) {
							?>
							<div class="form-check">
								<input type="checkbox" name="selected_contents[]" id="<?php echo esc_attr( $ct['slug'] ); ?>" 
									value="<?php echo esc_attr( $ct['slug'] ); ?>"
									<?php if (count( $selected_contents ) > 0 && in_array( $ct['slug'], $selected_contents ) ) {
										echo "checked='checked'";
									} ?>
								>
								<label for="<?php echo esc_attr( $ct['slug'] ) ; ?>">
									<?php echo esc_attr( $ct['name'] ); ?>
								</label>
							</div>
							<?php
							}
							?>
						</fieldset>
					</div>
					<div class="p-4 pt-lg-0">

					<!-- <button type="button" class="btn btn-primary">Applica filtri</button>-->
					<button type="submit" value="submit" class="btn btn-primary">
						<?php echo esc_html( __( 'Search', 'design_ict_site' ) ); ?>
					</button>

					</div>
				</FORM>
			</div>
		</div>
		<!-- END SEARCH SIDEBAR -->
		
	</div>
</div>




<?php
get_footer();
