<?php

/*
* Constants.
*/
define( 'DIS_THEMA_PATH', plugin_dir_path( __FILE__ ) );
define( 'DIS_THEMA_URL', get_template_directory_uri() );



define(
	'REQUIRED_PLUGINS',
	array(
		array(
			'name'     => 'Polylang - Multilanguage support',
			'slug'     => 'polylang',
			'required' => true,
		),
		array(
			'name'     => 'Advanced Custom Fields',
			'slug'     => 'advanced-custom-fields',
			'required' => true,
		),
		// array(
		// 	'name'     => 'ACF OpenStreetMap Field',
		// 	'slug'     => 'acf-openstreetmap-field',
		// 	'required' => true,
		// ),
		// array(
		// 	'name'     => 'Better aria label support',
		// 	'slug'     => 'better-aria-label-support',
		// 	'required' => true,
		// ),
		// array(
		// 	'name'     => 'WP Mail SMTP',
		// 	'slug'     => 'wp-mail-smtp',
		// 	'required' => true,
		// ),
		// array(
		// 	'name'     => 'Really Simple CAPTCHA',
		// 	'slug'     => 'really-simple-captcha',
		// 	'required' => true,
		// ),
	)
);
