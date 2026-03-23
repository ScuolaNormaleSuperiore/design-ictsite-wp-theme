<?php
/**
 * Project list.
 *
 * @package Design_ICT_Site
 */

$dis_projects = is_array( $args['projects'] ?? null ) ? $args['projects'] : array();
$dis_col_lg   = ( ( $args['format'] ?? 'full' ) === 'full' ) ? 'col-lg-4' : 'col-lg-6';
?>

<ul class="it-card-list row" aria-label="Risultati della ricerca: ">
	<?php foreach ( $dis_projects as $dis_project ) : ?>
		<?php $dis_short_description = DIS_CustomFieldsManager::get_field( 'short_description', $dis_project->ID ); ?>
		<li class="col-12 col-md-6 <?php echo esc_attr( $dis_col_lg ); ?> mb-3 mb-md-4">
			<article class="it-card it-card-height-full rounded shadow-sm border">
				<h3 class="it-card-title ">
					<a href="<?php echo esc_url( get_permalink( $dis_project ) ); ?>">
						<?php echo esc_html( $dis_project->post_title ); ?>
					</a>
				</h3>
				<div class="it-card-body">
					<p class="it-card-text">
						<?php echo nl2br( esc_html( $dis_short_description ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					</p>
				</div>
			</article>
		</li>
	<?php endforeach; ?>
</ul>
