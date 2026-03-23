<?php
/**
 * The code to enable analytics.
 *
 * @package Design_ICT_Site
 */

$analytics_text = DIS_OptionsManager::dis_get_option( 'analytics_code', 'dis_opt_advanced_settings' );
// Raw echo is intentional: this option stores trusted HTML/JS analytics code (e.g. Google Tag Manager snippet)
// entered by administrators only. Escaping would break the script tags.
// Access to this option is restricted to users with the 'manage_options' capability via CMB2 settings.
echo $analytics_text; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
