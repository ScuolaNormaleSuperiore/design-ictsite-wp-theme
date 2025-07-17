<?php
/* People list.
*
* @package Design_ICT_Site
*/

$persons = ( is_array( $args['persons'] ?? null ) ) ? $args['persons'] : array();
$format  = $args['format'] ?? 'full';
$col_lg  = ( $args['format'] === 'full' ) ? 'col-lg-4' : 'col-lg-6';
?>

<!-- Card list -->
<ul class="it-card-list row" aria-label="<?php echo __( 'People list', 'design_ict_site' ); ?>:">
	<?php
	foreach ( $persons as $p ) {
		$name         = DIS_CustomFieldsManager::get_field( 'name', $p->ID );
		$surname      = DIS_CustomFieldsManager::get_field( 'surname', $p->ID );
		$honorific    = DIS_CustomFieldsManager::get_field( 'honorific', $p->ID );
		$detail_link  = DIS_CustomFieldsManager::get_field( 'detail_link', $p->ID );
		$website      = DIS_CustomFieldsManager::get_field( 'website', $p->ID );
		$roles        = get_the_terms( $p->ID, DIS_PERSON_ROLE_TAXONOMY );
		$photo        = DIS_ContentsManager::get_image_metadata( $p, 'thumbnail', '/assets/img/person.png' );
		$offices      = DIS_ContentsManager::get_related_offices( $p );
		$full_name    = trim( join( ' ', array( $honorific, $name, $surname ) ) );
		$full_roles   = $roles ? implode( ', ', wp_list_pluck( $roles, 'name' ) ) : '';
		$full_offices = $offices ? implode( ', ', wp_list_pluck( $offices, 'post_title' ) ) : '';
		$attachment   = DIS_CustomFieldsManager::get_field( 'attachment_1', $p->ID );
		$target       = ( $detail_link === 'detail_page' ) ? '_self' : '_blank';
		if ( $detail_link === 'detail_page' ) {
			$full_link = get_permalink( $p );
		} else if ( $detail_link === 'attachment_1' ) {
			$full_link = $attachment['url'] ?? '';
		} else {
			$full_link = $website ?? '';
		}
	?>
		<!-- Card item -->
		<li class="col-12 col-md-6 <?php echo esc_attr( $col_lg ); ?> mb-md-4">
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
								<?php echo esc_attr( $full_name ); ?>
							<?php
							if ( $detail_link !== 'no_link' ) {
							?>
							</a>
							<?php
							}
							?>
						</h4>
						<p class="it-card-profile-role">
							<?php echo esc_attr( $full_roles ); ?>
						</p>
					</div>
					<div class="avatar size-xl">
						<img
							src="<?php echo esc_url( $photo['image_url'] ); ?>"
							title="<?php echo esc_attr( $full_name ); ?>"
							alt="<?php echo esc_attr( $full_name ); ?>"
						>
					</div>
				</div>
				<div class="it-card-body">
					<dl class="it-card-description-list">
						<div>
							<dd>
								<?php echo esc_attr( $full_offices ); ?>
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
