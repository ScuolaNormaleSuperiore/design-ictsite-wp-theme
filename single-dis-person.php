<?php
/**
 * Detail page for the post-type: dis-person
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Design_ICT_Site
 */

global $post;
get_header();
$dis_name         = DIS_CustomFieldsManager::get_field( 'name', $post->ID );
$dis_surname      = DIS_CustomFieldsManager::get_field( 'surname', $post->ID );
$dis_honorific    = DIS_CustomFieldsManager::get_field( 'honorific', $post->ID );
$dis_website      = DIS_CustomFieldsManager::get_field( 'website', $post->ID );
$dis_email        = DIS_CustomFieldsManager::get_field( 'email', $post->ID );
$dis_phone        = DIS_CustomFieldsManager::get_field( 'telephone', $post->ID );
$dis_roles        = get_the_terms( $post->ID, DIS_PERSON_ROLE_TAXONOMY );
$dis_photo        = DIS_ContentsManager::get_image_metadata( $post, 'full', '/assets/img/person.png' );
$dis_offices      = DIS_ContentsManager::get_person_offices( $post );
$dis_full_name    = trim( implode( ' ', array_filter( array( $dis_honorific, $dis_name, $dis_surname ) ) ) );
$dis_full_roles   = $dis_roles ? implode( ', ', wp_list_pluck( $dis_roles, 'name' ) ) : '';
$dis_full_offices = DIS_ContentsManager::get_string_list_from_posts( $dis_offices, true );
$dis_attachment   = DIS_CustomFieldsManager::get_field( 'attachment_1', $post->ID );
?>


<div class="container shadow rounded  p-4 pt-3 pb-3 mb-5">
	<div class="row">
		<div class="col-12 col-md-12 col-lg-12 mb-3 mb-md-4">
			<article
				class="it-card it-card-profile it-card-height-full it-card-border-top it-card-border-top-secondary rounded shadow-sm border">
				<div class="it-card-profile-header">
					<div class="it-card-profile">
						<h2 class="it-card-profile-name ">
							<a href="#">
								<?php echo esc_html( $dis_full_name ); ?>
							</a>
						</h2>
						<p class="it-card-profile-role">
							<?php echo esc_html( $dis_full_roles ); ?>
						</p>
					</div>
					<div class="avatar size-xxl">
						<img
							src="<?php echo esc_url( $dis_photo['image_url'] ); ?>"
							title="<?php echo esc_attr( $dis_full_name ); ?>"
							alt="<?php echo esc_attr( $dis_full_name ); ?>"
						>
					</div>
				</div>
				<div class="it-card-body">
					<dl class="it-card-description-list">
						<div>
							<dt>
								<?php echo esc_html__( 'Area/Service', 'design_laboratori_italia' ); ?>:
							</dt>
							<dd>
								<?php echo wp_kses_post( $dis_full_offices ); ?>
							</dd>
						</div>
						<div>
							<dt>
								<?php echo esc_html__( 'E-mail', 'design_laboratori_italia' ); ?>:
							</dt>
							<dd>
								<a href="mailto:<?php echo esc_attr( $dis_email ); ?>"><?php echo esc_html( $dis_email ); ?></a>
							</dd>
						</div>
						<div>
							<dt>
								<?php echo esc_html__( 'Telephone', 'design_laboratori_italia' ); ?>:
							</dt>
							<dd><?php echo esc_html( $dis_phone ); ?></dd>
						</div>
						<div>
							<dt>
								<?php echo esc_html__( 'Web site', 'design_laboratori_italia' ); ?>:
							</dt>
							<dd>
								<a href="<?php echo esc_url( $dis_website ); ?>"><?php echo esc_html( $dis_website ); ?></a>
							</dd>
						</div>

					</dl>
				</div>
			</article>
		</div>

		<!-- body -->
		<div class="row">
			<?php the_content(); ?>
		</div>

		<!-- attachments -->
		<?php
		if ( $dis_attachment ) {
			?>
			<div class="row">
				<div class="col-12 col-md-12 col-lg-12 mb-3 mb-md-4">
					<article class="it-card rounded border shadow-sm mb-3">
						<h4 class="it-card-title it-card-title-icon ">
							<a href="<?php echo esc_url( $dis_attachment['url'] ); ?>">
								<?php echo esc_html( $dis_attachment['title'] ); ?>
								<div class="it-card-title-icon-wrapper">
									<svg class="icon icon-primary" aria-hidden="true">
										<use href="<?php echo esc_url( DIS_THEME_URL . '/assets/bootstrap-italia/svg/sprites.svg#it-file' ); ?>"></use>
									</svg>
								</div>
							</a>
						</h4>
					</article>
				</div>
			</div>
			<?php
		}
		?>

	</div>
</div>

<?php
get_footer();
