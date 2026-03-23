<?php
/**
 * Analytics snippet.
 *
 * @package Design_ICT_Site
 */

$dis_analytics_text = DIS_OptionsManager::dis_get_option( 'analytics_code', 'dis_opt_advanced_settings' );

// Raw echo is intentional: this option stores trusted HTML/JS analytics code entered by administrators only.
echo $dis_analytics_text; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
