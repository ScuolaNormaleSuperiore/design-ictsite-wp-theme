<?php
/** Project list.
 *
 * @package Design_ICT_Site
 */

$projects = ( is_array( $args['projects'] ?? null ) ) ? $args['projects'] : array();
$format   = $args['format'] ?? 'full';
$col_lg   = ( $args['format'] === 'full' ) ? 'col-lg-4' : 'col-lg-6';
?>

<ul class="it-card-list row" aria-label="Risultati della ricerca: ">
	<?php
	foreach ( $projects as $p ) :
		$short_description = DIS_CustomFieldsManager::get_field( 'short_description', $p->ID );
		?>
		<li class="col-12 col-md-6 <?php echo esc_attr( $col_lg ); ?> mb-3 mb-md-4">
			<article class="it-card it-card-height-full rounded shadow-sm border">
				<h3 class="it-card-title ">
					<a href="<?php echo esc_url( get_permalink( $p ) ); ?>">
						<?php echo esc_attr( $p->post_title ); ?>
					</a>
				</h3>
				<div class="it-card-body">
					<p class="it-card-text">
						<?php echo esc_html( $short_description ); ?>
					</p>
				</div>
			</article>
		</li>
	<?php endforeach ?>
</ul>
