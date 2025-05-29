<?php
/* Template Name: dis-person
*
* @package Design_ICT_Site
*/

global $post;
get_header();
$value= 'slug';

$current   = pll_current_language($value);
$default   = pll_default_language($value);
$languages = pll_languages_list();
$string = 'Event';

$current_locale = get_locale();

$result   = switch_to_locale( 'it_IT' );
$tradotto = _x( 'Event', 'DIS_PostTypeLabels', 'design_ict_site' );
echo $tradotto;
$result = restore_previous_locale();

$result   =  switch_to_locale( 'en_US' );
$tradotto = _x( 'Event', 'DIS_PostTypeLabels', 'design_ict_site' );
echo $tradotto;
$result = restore_previous_locale();

$result   =  switch_to_locale( 'es_ES' );
$tradotto = _x( 'Event', 'DIS_PostTypeLabels', 'design_ict_site' );
echo $tradotto;
$result = restore_previous_locale();


?>

*** Content of the page: PEOPLE ***

<?php
get_footer();
