<?php
/* Template Name: Search in the site.
*
* @package Design_ICT_Site
*/

global $post;
get_header();

$search_string  = '';
$allcontentypes = DIS_ContentsManager::get_content_types_with_results();
$num_results    = 0;
$the_query      = null;

// Set and format the filters for the query.
if ( isset( $_GET['isreset'] ) && ( sanitize_text_field( $_GET['isreset'] ) === 'yes' ) ) {
	$selected_contents = array();
	$search_string      = '';
} else {
	if ( isset( $_GET['selected_contents'] ) ) {
		$selected_contents = $_GET['selected_contents'];
	} else {
		$selected_contents = array();
	}
	if ( ! is_array( $selected_contents ) ) {
		$selected_contents = array();
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
			DIS_SITE_SEARCH_CELLS_PER_PAGE
		);
		$num_results = $the_query->found_posts;
	}
} else {
	$num_results = 0;
}
?>

<FORM action="." id="search_site_form" method="GET">
	<?php wp_nonce_field( 'sf_site_search_nonce', 'site_search_nonce_field' ); ?>

	<!-- SEZIONE BANNER -->
	<div class="container">
		<section id="banner-cerca"  class="bg-banner-cerca">
			<div class="section-muted p-3 primary-bg-c1">
				<div class="container">
					<div class="hero-title text-left ms-4 pb-3 pt-3">
						<h2 class="pt-0 pb-0">
							<?php echo esc_html( __( 'Search the site', 'design_ict_site' ) ); ?>
						</h2>
						<div class="row m-0">
							<div class="form-group col-md-12 mb-4 text-left">
								<label class="active visually-hidden" for="search_string">
									<?php echo esc_html( __( 'Search the site', 'design_ict_site' ) ); ?>
								</label>
								<input type="text" id="search_string" name="search_string" class="form-control" 
									value="<?php echo esc_attr( $search_string ? $search_string : '' );  ?>"
									placeholder="<?php echo esc_html( __( 'Digit the text to search', 'design_ict_site' ) ); ?>">
								<input type="hidden" name="isreset" id="isreset" value=""/>
							</div>
						</div>
						<div class="row">
							<div class="form-group col text-left ps-4 mb-2">
								<button type="reset" value="reset" onclick="resetForm('search_site_form', 'isreset');" class="btn btn-outline-primary">
									<?php echo esc_html( __( 'Cancel', 'design_ict_site' ) ); ?>
								</button>
								<button type="submit" value="submit" class="btn btn-primary">
									<?php echo esc_html( __( 'Search', 'design_ict_site' ) ); ?>
								</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>

	<!-- RESULTS SECTION -->
	<div class="container">
		<section id="search_results" class="p-4">
			<div class="container my-4">
				<div class="row pt-0">

					<!-- BEGIN FILTER COLUMN -->
					<div class="col-12 col-lg-3 border-end">
						<div class="row pt-4">
						<?php
							if( count( $allcontentypes ) > 0 ) {
						?>
							<h3 class="h6 text-uppercase border-bottom">
								<?php echo esc_html( __( 'Content type filter', 'design_ict_site' ) ); ?>
							</h3>
							<div>
									<?php
										foreach( $allcontentypes as $ct ) {
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
							</div>
						<?php
						}
						?>
						</div>
					</div>
					<!-- END FILTER COLUMN -->

					<!-- BEGIN RESULT LIST -->
					<div class="col-12 col-lg-8">
						<div class="row ps-4">
							<p>
								<em>
									<span><?php echo esc_html( __( 'Results', 'design_ict_site' ) ); ?>:</span>
									<span><?php echo esc_attr( $num_results ); ?></span>
								</em>
							</p>
						</div>

						<?php
						// The main loop of the page.
						$pindex = 0;
						if ( ( $num_results > 0 ) && ( $search_string !== '' ) ) {
						?>
						<?php
							while ( $the_query->have_posts() ) {
								$the_query->the_post();
							?>

							<!-- Print a result for each row -->
							<div class="row">
								<?php
									$result = DIS_ContentsManager::wrap_search_result( $post );
								?>
								<!-- start card-->
								<div class="col-12 col-lg-12">
									<div class="card-wrapper ">
										<div class="card">
											<div class="card-body mb-0">
												<?php
												if ( $result->image_url ) {
												?>
												<img src="<?php echo esc_url( $result->image_url ); ?>"
													height="100"
													width="100"
													class="img-thumbnail float-sm-start me-2 text-nowrap"
													title="<?php echo esc_attr( $result->image_title ); ?>"
													alt="<?php echo esc_attr( $result->image_alt ); ?>" />
												<?php
												}
												?>
												<span class="text" style="text-transform: uppercase;">
													<a class="text-decoration-none" href="<?php echo esc_url( $result->category_link ); ?>">
														<?php echo esc_attr( $result->type ); ?>
													</a>
												</span>
												<span>&nbsp;-&nbsp;</span>
												<a class="text-decoration-none" href="<?php echo esc_url( $result->link ); ?>">
													<h3 class="card-title h5"><?php echo esc_attr( $result->title ); ?></h3>
												</a>
												<p class="card-text">
													<?php echo esc_attr( wp_trim_words( $result->description , DIS_ACF_SHORT_DESC_LENGTH ) ); ?>
												</p>
											</div>
										</div>
									</div>
								</div>
								<!--end card-->
							</div>

							<?php
							$pindex++;
							}
							wp_reset_postdata();
						}
						?>
					</div>
					<!-- END RESULT LIST -->

					<!-- RESULTS PAGINATION -->

				</div>
			</div>
		</section>
	</div>

</FORM>

<?php
get_footer();
