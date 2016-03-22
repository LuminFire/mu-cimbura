<?php

function cimbura_mu_tgmpa_plugins_local( $tgmpa_plugins ) {
	$tgmpa_plugins[] = 
		array(
			'name'      => 'Check Email',
			'slug'      => 'check-email',
			'force_deactivation'  => true,
		);
	return $tgmpa_plugins;
}
add_filter( 'cimbura_mu_tgmpa_plugins', 'cimbura_mu_tgmpa_plugins_local' );


function cimbura_mu_tgmpa_config_local( $tgmpa_config ) {
	$tgmpa_config['strings']['page_title'] = __( 'Install BBQ Plugins', 'theme-slug' );
	return $tgmpa_config;
}
add_filter( 'cimbura_mu_tgmpa_config', 'cimbura_mu_tgmpa_config_local' );


// Other things you can do:
// * override a function from pluggable.php
