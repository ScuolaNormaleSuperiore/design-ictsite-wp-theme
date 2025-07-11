<?php
/**
 * Detail page for the post-type: dis-office.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Design_ICT_Site
 */
global $post;
get_header();

$image_data  = DIS_ContentsManager::get_image_metadata( $post, 'full', '/assets/img/default-background.png' );
$persons     = DIS_CustomFieldsManager::get_field( 'members', $post->ID );
$email       = DIS_CustomFieldsManager::get_field( 'email', $post->ID );
$phone       = DIS_CustomFieldsManager::get_field( 'telephone', $post->ID );
$places      = DIS_CustomFieldsManager::get_field( 'places', $post->ID );
$full_places = $places ? implode( ', ', wp_list_pluck( $places, 'post_title' ) ) : '';
?>

<div class="container shadow rounded  p-4 pt-3 pb-3 mb-5">
	<h2 class="pb-2"><?php echo get_the_title(); ?></h2>

	<!-- BODY -->
	<div class="container shadow rounded p-4 mb-5 mt-2">
		<div class="row">
			<div class="col-12 col-md-10 offset-md-1 col-lg-7 offset-lg-1 m-auto">
				<p class="lead">
					<?php echo get_the_content() ?>
				</p>
			</div>
		</div>
	</div>

	<!-- CONTACTS -->
	<div class="col-12 col-md-12 col-lg-12 mb-3 mb-md-4">
		<h3 class="pb-2">
			<?php echo __( 'Contacts' , 'design_ict_site' ); ?>
		</h3>
		<article
			class="it-card it-card-profile it-card-height-full it-card-border-top it-card-border-top-secondary rounded shadow-sm border">
			<div class="it-card-body">
				<dl class="it-card-description-list">
					<div>
						<dt>
							<?php echo __( 'E-mail' , 'design_ict_site' ); ?>:
						</dt>
						<dd>
							<a href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo esc_attr( $email ); ?></a>
						</dd>
					</div>
					<div>
						<dt>
							<?php echo __( 'Telephone' , 'design_ict_site' ); ?>:
						</dt>
						<dd>
							<?php echo esc_attr( $phone ); ?>
						</dd>
					</div>
						<div>
						<dt>
							<?php echo __( 'Site' , 'design_ict_site' ); ?>:
						</dt>
						<dd>
							<?php echo esc_attr( $full_places ); ?>
						</dd>
					</div>
				</dl>
			</div>
		</article>
	</div>
	
	<!-- PEOPLE-->
	<div class="row">
		<h3 class="pb-2">
			<?php echo __( 'People' , 'design_ict_site' ); ?>
		</h3>
		<ul class="it-card-list row" aria-label="<?php echo __( 'Search results' , 'design_ict_site' ); ?>:">
			<?php
			foreach ( $persons as $p ) {
				$name         = DIS_CustomFieldsManager::get_field( 'name' , $p->ID );
				$surname      = DIS_CustomFieldsManager::get_field( 'surname' , $p->ID );
				$honorific    = DIS_CustomFieldsManager::get_field( 'honorific' , $p->ID );
				$detail_link  = DIS_CustomFieldsManager::get_field( 'detail_link' , $p->ID );
				$website      = DIS_CustomFieldsManager::get_field( 'website' , $p->ID );
				$roles        = get_the_terms( $p->ID, DIS_PERSON_ROLE_TAXONOMY );
				$photo        = DIS_ContentsManager::get_image_metadata( $p, 'thumbnail', '/assets/img/person.png' );
				$offices      = DIS_ContentsManager::get_related_offices( $p );
				$full_name    = trim( join ( ' ', array( $honorific, $name, $surname ) ) );
				$full_roles   = $roles ? implode(', ', wp_list_pluck( $roles, 'name' ) ) : '';
				$full_offices = $offices ? implode(', ', wp_list_pluck( $offices, 'post_title') ) : '';
				$attachment   = DIS_CustomFieldsManager::get_field( 'attachment_1' , $p->ID );
				$target       = ( $detail_link === 'detail_page' ) ? '_self' : '_blank';
				if ( $detail_link === 'detail_page' ) {
					$full_link = get_permalink( $p );
				} else if ( $detail_link === 'attachment_1' ){
					$full_link = $attachment['url'] ?? '';
				} else {
					$full_link = $website ?? '';
				}
			?>
				<li class="col-12 col-md-6 col-lg-4 mb-3 mb-md-4">
					<article class="it-card it-card-profile it-card-height-full it-card-border-top it-card-border-top-secondary rounded shadow-sm border">
						<div class="it-card-profile-header">
							<div class="it-card-profile">
								<h4 class="it-card-profile-name ">
									<?php
									if ( $detail_link !== 'no_link' ) {
									?>
									<a
										target="<?php echo $target; ?>"
										href="<?php echo $full_link; ?>"
									>
									<?php
									}
									?>
										<?php echo $full_name; ?>
									<?php
									if ( $detail_link !== 'no_link' ) {
									?>
									</a>
									<?php
									}
									?>
								</h4>
								<p class="it-card-profile-role">
									<?php echo $full_roles; ?>
								</p>
							</div>
							<div class="avatar size-xl">
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
									<dd>
										<?php echo $full_offices; ?>
									</dd>
								</div>
							</dl>
						</div>
					</article>
				</li>
			<?php
			}
			?>

		</ul>
	</div>
</div>


<?php
get_footer();
