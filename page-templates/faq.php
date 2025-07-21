<?php
/* Template Name: Faq
*
* @package Design_ICT_Site
*/

global $post;
get_header();

$items              = DIS_ContentsManager::get_generic_post_list( DIS_FAQ_POST_TYPE );
$items_per_category = DIS_ContentsManager::items_per_category( $items, DIS_FAQ_TOPIC_TAXONOMY );
?>

<!-- FAQ PAGE -->
<div class="container shadow rounded  p-4 pt-3 pb-3 mb-5">
	<div class="row">

		<div class="col">
			<!-- Title -->
			<h2 class="pb-2">
				<?php echo esc_attr( get_the_title() ); ?>
			</h2>

			<!-- FAQ Accordions -->
			<div class="accordion" id="FaqAccordion">

				<!-- ARGUMENT LIST -->
				<?php
				$arg_index = 0;
				foreach ( $items_per_category as $category => $faq_list ) {
					$sanitized_cat = sanitize_title( $category );
					// Loading the page open the first accordion.
					$arg_show      = ( $arg_index === 0 ) ? 'show' : ' ';
					$arg_collapsed = ( $arg_index === 0 ) ? ' ' : 'collapsed';
					$arg_expanded  = ( $arg_index === 0 ) ? 'true' : 'false';
				?>
				<div class="accordion-item">
					<h3 class="accordion-header " id="<?php echo 'heading' . $arg_index . 'a'; ?>">
						<button
							class="accordion-button <?php echo $arg_collapsed; ?>"
							type="button"
							data-bs-toggle="collapse"
							data-bs-target="<?php echo '#collapse' . $arg_index . 'a'; ?>"
							aria-expanded="<?php echo $arg_expanded; ?>"
							aria-controls="<?php echo 'collapse' . $arg_index . 'a'; ?>">
							<?php echo esc_attr( $category ); ?>
						</button>
					</h3>

					<!-- FAQ LIST -->
					<div id="<?php echo 'collapse' . $arg_index . 'a'; ?>"
						class="accordion-collapse collapse <?php echo $arg_show; ?>"
						data-bs-parent="#accordionExample2"
						role="region"
						aria-labelledby="<?php echo 'heading' . $arg_index . 'a'; ?>">
						<div class="accordion-body">
							<div class="accordion" id="accordionExample2N">

								<!-- FAQ ITEM -->
								<?
								$faq_index = 0;
								foreach ( $faq_list as $faq ) {
									$faq_show      = ( $faq_index === 0 ) ? 'show' : ' ';
									$faq_collapsed = ( $faq_index === 0 ) ? ' ' : 'collapsed';
									$faq_expanded  = ( $faq_index === 0 ) ? 'true' : 'false';
								?>
								<div class="accordion-item">
									<h4 class="accordion-header " id="<?php echo 'heading' . $faq_index . 'n'; ?>">
										<button class="accordion-button <?php echo $faq_collapsed; ?>"
											type="button"
											data-bs-toggle="collapse"
											data-bs-target="<?php echo '#collapse' . $faq_index . 'n'; ?>"
											aria-expanded="<?php echo $faq_expanded; ?>"
											aria-controls="<?php echo 'collapse' . $faq_index . 'n'; ?>"
										>
											<?php echo esc_attr( $faq->post_title ) ?>
										</button>
									</h4>
									<div id="<?php echo 'collapse' . $faq_index . 'n' ?>"
										class="accordion-collapse collapse <?php echo $faq_show; ?>"
										data-bs-parent="#accordionExample2N"
										role="region"
										aria-labelledby="<?php echo 'heading' . $faq_index . 'n'; ?>">
										<div class="accordion-body">
											<?php echo wp_kses_post( $faq->post_content ); ?>
										</div>
									</div>
								</div>
								<?php
								$faq_index++;
								}
								?>

							</div>
						</div>
					</div>

				</div>
				<?php
					$arg_index++;
				}
				?>

			</div>
		</div>

		<!-- SIDEBAR ELENCO -->
		<div class="col-12 col-lg-4 col-md-5">
			<div class="sidebar-wrapper it-line-left-side">
				<div class="form-group">
					<div class="input-group">
						<span class="input-group-text"><svg class="icon icon-sm" aria-hidden="true">
								<use href="/bootstrap-italia/svg/sprites.svg#it-search"></use>
							</svg></span>
						<label for="input-group-3">Cerca nelle FAQ</label>
						<input type="text" class="form-control" id="input-group-3" name="input-group-3">
						<div class="input-group-append">
							<button class="btn btn-primary" type="button" id="button-3"><a href="faq-risultati-ricerca.html" class="text-white">Cerca</a></button>
						</div>
					</div>
				</div>
				<div class="sidebar-linklist-wrapper">
					<div class="link-list-wrapper">
						<ul class="link-list">
							<li>
								<h3>Naviga per argomento</h3>
							</li>
							<li><a class="list-item medium active" href="#Argomento1"><span>Argomento 1</span></a>
							</li>
							<li><a class="list-item medium" href="#Argomento2"><span>Argomento 2</span></a>
							</li>
							<li><a class="list-item medium" href="#Argomento3"><span>Argomento 3</span></a>
							</li>
						</ul>
					</div>
				</div>


			</div>
		</div>

	</div>
</div>

<?php
get_footer();
