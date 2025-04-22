<?php
/**
 * The code to enable analytics.
 *
 * @package Design_ICT_Site
 */

$analytics_text = DIS_OptionsManager::dis_get_option( 'analytics_code', 'dis_opt_advanced_settings' );
echo esc_html( $analytics_text );
