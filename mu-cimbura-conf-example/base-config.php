<?php

// set defines
// default site plugin list
// default site configurations

$environments = array(
			'local' => null,
			'staging' => null,
			'live' => null,
		);

function cimbura_mu_tgmpa_plugins_base( $tgmpa_plugins ) {
	$base_plugins = array(
		array(
			'name'      => 'Simply Show Hooks',
			'slug'      => 'simply-show-hooks',
			'required'  => false,
		),
	);
	return array_merge( $tgmpa_plugins, $base_plugins );
}
add_filter( 'cimbura_mu_tgmpa_plugins', 'cimbura_mu_tgmpa_plugins_base' );

function cimbura_mu_tgmpa_config_base( $tgmpa_config ) {
	$tgmpa_config['dismissable']  = false;
	$tgmpa_config['dismiss_msg']  = '';
	return $tgmpa_config;
}
add_filter( 'cimbura_mu_tgmpa_config', 'cimbura_mu_tgmpa_config_base' );
