<?php
/**
 * People list.
 *
 * @package Design_ICT_Site
 */

$dis_persons = is_array( $args['persons'] ?? null ) ? $args['persons'] : array();
$dis_col_lg  = ( ( $args['format'] ?? 'full' ) === 'full' ) ? 'col-lg-4' : 'col-lg-6';

if ( ! empty( $dis_persons ) ) {
	update_postmeta_cache( wp_list_pluck( $dis_persons, 'ID' ) );
}
?>

<ul class="it-card-list row" aria-label="<?php echo esc_attr__( 'People list', 'design_ict_site' ); ?>:">
	<?php foreach ( $dis_persons as $dis_person ) : ?>
		<?php
		$dis_name         = DIS_CustomFieldsManager::get_field( 'name', $dis_person->ID );
		$dis_surname      = DIS_CustomFieldsManager::get_field( 'surname', $dis_person->ID );
		$dis_honorific    = DIS_CustomFieldsManager::get_field( 'honorific', $dis_person->ID );
		$dis_detail_link  = DIS_CustomFieldsManager::get_field( 'detail_link', $dis_person->ID );
		$dis_website      = DIS_CustomFieldsManager::get_field( 'website', $dis_person->ID );
		$dis_roles        = get_the_terms( $dis_person->ID, DIS_PERSON_ROLE_TAXONOMY );
		$dis_photo        = DIS_ContentsManager::get_image_metadata( $dis_person, 'thumbnail', '/assets/img/person.png' );
		$dis_offices      = DIS_ContentsManager::get_person_offices( $dis_person );
		$dis_full_name    = trim( implode( ' ', array( $dis_honorific, $dis_name, $dis_surname ) ) );
		$dis_full_roles   = $dis_roles ? implode( ', ', wp_list_pluck( $dis_roles, 'name' ) ) : '';
		$dis_full_offices = DIS_ContentsManager::get_string_list_from_posts( $dis_offices, true );
		$dis_attachment   = DIS_CustomFieldsManager::get_field( 'attachment_1', $dis_person->ID );
		$dis_target       = ( 'detail_page' === $dis_detail_link ) ? '_self' : '_blank';

		if ( 'detail_page' === $dis_detail_link ) {
			$dis_full_link = get_permalink( $dis_person );
		} elseif ( 'attachment_1' === $dis_detail_link ) {
			$dis_full_link = $dis_attachment['url'] ?? '';
		} else {
			$dis_full_link = $dis_website ?? '';
		}
		?>
		<li class="col-12 col-md-6 <?php echo esc_attr( $dis_col_lg ); ?> mb-md-4">
			<article class="it-card it-card-profile it-card-height-full it-card-border-top it-card-border-top-secondary rounded shadow-sm border">
				<div class="it-card-profile-header">
					<div class="it-card-profile">
						<h4 class="it-card-profile-name ">
							<?php if ( 'no_link' !== $dis_detail_link ) : ?>
								<a target="<?php echo esc_attr( $dis_target ); ?>" href="<?php echo esc_url( $dis_full_link ); ?>">
							<?php endif; ?>
							<?php echo esc_html( $dis_full_name ); ?>
							<?php if ( 'no_link' !== $dis_detail_link ) : ?>
								</a>
							<?php endif; ?>
						</h4>
						<p class="it-card-profile-role">
							<?php echo esc_html( $dis_full_roles ); ?>
						</p>
					</div>
					<div class="avatar size-xl">
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
							<dd>
								<?php echo wp_kses_post( $dis_full_offices ); ?>
							</dd>
						</div>
					</dl>
				</div>
			</article>
		</li>
	<?php endforeach; ?>
</ul>
