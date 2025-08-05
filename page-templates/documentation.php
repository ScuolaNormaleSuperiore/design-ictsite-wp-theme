<?php
/** Template Name: Documentation
 *
 * @package Design_ICT_Site
 */

global $post;
get_header();

// Check pagination parameters.
$posts_per_page  = strval( DIS_ITEMS_PER_PAGE_ODD );
$per_page_values = DIS_ITEMS_PER_PAGE_VALUES_ODD;
if ( isset( $_GET['posts_per_page'] ) && is_numeric( $_GET['posts_per_page'] ) ) {
	$posts_per_page = sanitize_text_field( wp_unslash( $_GET['posts_per_page'] ) );}
$current_page = isset( $_GET['num_page'] ) ? max( 1, intval( sanitize_text_field( wp_unslash( $_GET['num_page'] ) ) ) ) : 1;

// Prepare the query.
$params = array(
	'post_type'      => DIS_ATTACHMENT_POST_TYPE,
	'search_string'  => '',
	'posts_per_page' => $posts_per_page,
	'current_page'   => $current_page,
	'orderby'        => 'title',
	'order'          => 'DESC',
);

// Add search string, if present.
if ( isset( $_GET['search_string'] ) ) {
	$params['search_string'] = sanitize_text_field( wp_unslash( $_GET['search_string'] ) );
	$search_string           = $params['search_string'];
	$is_submission = true;
} else {
	$search_string = '';
	$is_submission = false;
}

// Execute the query.
$the_query      = DIS_ContentsManager::get_generic_post_query( $params );
$num_results    = $the_query->found_posts;
$current_url    = get_permalink();
$result_message = sprintf( __( 'Found %s results.', 'design_ict_site' ), $num_results );
?>

<!-- ATTACHMENTS -->
<div class="container shadow rounded  p-4 pt-3 pb-3 mb-5">
	<div class="row">

		<div class="col">
			<!-- Title -->
			<h2 class="pb-2">
				<?php echo esc_attr( get_the_title() ); ?>
			</h2>

			<!-- Number of results found -->
			<?php if ( $is_submission ) : ?>
				<p><small><?php echo esc_attr( $result_message ); ?></small></p> 
			<?php endif ?>

			<!-- RESULT LIST -->
			<div class="link-list-wrapper multiline">
				<ul class="link-list">
					<?php
					while ( $the_query->have_posts() ) {
						$the_query->the_post();
						$attachment_file    = DIS_CustomFieldsManager::get_field( 'file', $post->ID );
						$attachment_link    = DIS_CustomFieldsManager::get_field( 'link', $post->ID );
						$documentation_link = $attachment_file ? $attachment_file['url'] : $attachment_link;
						$description        = DIS_ContentsManager::clean_and_truncate_text( $post->post_content, DIS_ACF_SHORT_TEXT_LENGTH );
					?>
					<!-- SINGLE ITEM -->
					<li>
						<a class="list-item active icon-right" target="_blank"
							href="<?php echo esc_url( $documentation_link ); ?>">
							<span class="list-item-title-icon-wrapper">
								<h4 class="list-item-title">
									<?php echo esc_attr( $post->post_title ); ?>
								</h4>
								<svg class="icon icon-primary">
									<title>
										<?php echo esc_attr( $post->post_title ); ?>
									</title>
									<use href="<?php echo DIS_THEME_URL . '/assets/bootstrap-italia/svg/sprites.svg#it-file'; ?>"></use>
								</svg>
							</span>
							<p>
								<?php echo esc_attr( $description ); ?>
							</p>
						</a>
					</li>
					<li>
						<span class="divider" role="separator"></span>
					</li>
					<?php
					}
					wp_reset_postdata();
					?>
				</ul>

			</div>

			<!-- Pagination results-->
			<?php
			get_template_part(
				'template-parts/common/pagination',
				null,
				array(
					'query'           => $the_query,
					'posts_per_page'  => $posts_per_page,
					'per_page_values' => $per_page_values,
					'num_results'     => $num_results,
					'current_page'    => $current_page,
				)
			);
			?>

		</div>
		<!-- SIDEBAR ELENCO -->
		<div class="col-12 col-lg-4 col-md-5">
			<div class="sidebar-wrapper it-line-left-side">

				<div class="form-group">
					<FORM action="." id="search_faq_form" method="GET">
						<div class="input-group">
							<span class="input-group-text">
								<svg class="icon icon-sm" aria-hidden="true">
									<use href=<?php echo DIS_THEME_URL . '/assets/bootstrap-italia/svg/sprites.svg#it-search'; ?>"></use>
								</svg>
							</span>
							<label for="search_string">
								<?php echo esc_attr( __( 'Search the documentation', 'design_ict_site' ) ); ?>
							</label>
							<input type="text"
								id="search_string"
								name="search_string"
								class="form-control"
								value="<?php echo esc_attr( $search_string ?? '' ); ?>"
								placeholder="<?php echo esc_html( __( 'Search the documentation', 'design_ict_site' ) ); ?>"
							>
							<div class="input-group-append">
								<button class="btn btn-primary" type="submit" value="submit">
									<?php echo esc_attr( __( 'Search', 'design_ict_site' ) ); ?>
								</button>
							</div>
						</div>
					</FORM>
				</div> <!-- form-group -->

				<!-- RESET FORM -->
				<?php if ( $is_submission ) : ?>
					<div class="link-list-wrapper">
						<ul class="link-list">
							<li>
								<h3 class="visually-hidden">
									<?php echo esc_attr( __( 'Back to the full list', 'design_ict_site' ) ); ?>
								</h3>
							</li>
							<li>
								<a class="list-item medium active" href="<?php echo esc_url ( $current_url ); ?>">
									<span>
										<?php echo esc_attr( __( 'Back to the full list', 'design_ict_site' ) ); ?>
									</span>
								</a>
							</li>
						</ul>
					</div>
				<?php endif ?>

			</div>
		</div>

	</div>
</div>

<?php
get_footer();
