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
$name         = DIS_CustomFieldsManager::get_field( 'name', $post->ID );
$surname      = DIS_CustomFieldsManager::get_field( 'surname', $post->ID );
$honorific    = DIS_CustomFieldsManager::get_field( 'honorific', $post->ID );
$website      = DIS_CustomFieldsManager::get_field( 'website', $post->ID );
$email        = DIS_CustomFieldsManager::get_field( 'email', $post->ID );
$phone        = DIS_CustomFieldsManager::get_field( 'telephone', $post->ID );
$roles        = get_the_terms( $post->ID, DIS_PERSON_ROLE_TAXONOMY );
$photo        = DIS_ContentsManager::get_image_metadata( $post, 'full', '/assets/img/person.png' );
$offices      = DIS_ContentsManager::get_person_offices( $post );
$full_name    = trim( join( ' ', array( $honorific, $name, $surname ) ) );
$full_roles   = $roles ? implode( ', ', wp_list_pluck( $roles, 'name' ) ) : '';
$full_offices = DIS_ContentsManager::get_string_list_from_posts( $offices, true );
$attachment   = DIS_CustomFieldsManager::get_field( 'attachment_1', $post->ID );
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
								<?php echo esc_attr( $full_name ); ?>
							</a>
						</h2>
						<p class="it-card-profile-role">
							<?php echo esc_attr( $full_roles ); ?>
						</p>
					</div>
					<div class="avatar size-xxl">
						<img
							src="<?php echo esc_url( $photo['image_url'] ); ?>"
							title="<?php echo $full_name; ?>"
							alt="<?php echo $full_name; ?>"
						>
					</div>
				</div>
				<div class="it-card-body">
					<dl class="it-card-description-list">
						<div>
							<dt>
								<?php echo __( 'Area/Service', 'design_ict_site' ); ?>:
							</dt>
							<dd>
								<?php echo wp_kses_post( $full_offices ); ?>
							</dd>
						</div>
						<div>
							<dt>
								<?php echo __( 'E-mail', 'design_ict_site' ); ?>:
							</dt>
							<dd>
								<a href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo esc_attr( $email ); ?></a>
							</dd>
						</div>
						<div>
							<dt>
								<?php echo __( 'Telephone', 'design_ict_site' ); ?>:
							</dt>
							<dd><?php echo esc_attr( $phone ); ?></dd>
						</div>
						<div>
							<dt>
								<?php echo __( 'Web site', 'design_ict_site' ); ?>:
							</dt>
							<dd>
								<a href="<?php echo esc_url( $website ); ?>"><?php echo esc_url( $website ); ?></a>
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
		 if ( $attachment ) {
		?>
			<div class="row">
				<div class="col-12 col-md-12 col-lg-12 mb-3 mb-md-4">
					<article class="it-card rounded border shadow-sm mb-3">
						<h4 class="it-card-title it-card-title-icon ">
							<a href="<?php echo esc_attr( $attachment['url'] ); ?>">
								<?php echo esc_attr( $attachment['title'] ); ?>
								<div class="it-card-title-icon-wrapper">
									<svg class="icon icon-primary" aria-hidden="true">
										<use href="<?php echo DIS_THEME_URL . '/assets/bootstrap-italia/svg/sprites.svg#it-file'; ?>"></use>
									</svg>
								</div>
							</a>
						</h4>
						<!--div class="it-card-body">
							<p class="it-card-text">???</p>
						</div -->
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
