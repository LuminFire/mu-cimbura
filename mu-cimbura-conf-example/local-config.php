<?php

add_filter( 'cimbura_mu_tgmpa_plugins', 'cimbura_mu_tgmpa_plugins_local' );
function cimbura_mu_tgmpa_plugins_local( $tgmpa_plugins ) {
	$local_plugins = array(
		array(
			'name'      => 'Log Emails',
			'slug'      => 'log-emails',
			'force_activation'  => true,
		),
		array(
			'name'      => 'Disable Emails',
			'slug'      => 'disable-emails',
			'force_activation'  => true,
		),
	);
	return array_merge( $tgmpa_plugins, $local_plugins );
}

/*
add_filter( 'cimbura_mu_tgmpa_config', 'cimbura_mu_tgmpa_config_local' );
function cimbura_mu_tgmpa_config_local( $tgmpa_config ) {
	$tgmpa_config['strings']['page_title'] = __( 'Install Cimbura.com Plugins', 'cimbura-mu' );
	return $tgmpa_config;
}
*/

// Other things you can do:
// - override a function from pluggable.php
// - set a define
define( 'JETPACK_DEV_DEBUG', true );
