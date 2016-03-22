<?php

// set define
// default plugin list
// default configurations

$environments = array(
			'local' => NULL,
			'staging' => NULL,
			'live' => NULL,
		);

function cimbura_mu_tgmpa_plugins_base( $tgmpa_plugins ) {
	$tgmpa_plugins[] = 
		array(
			'name'      => 'BuddyPress',
			'slug'      => 'buddypress',
			'required'  => true,
		);
	return $tgmpa_plugins;
}
add_filter( 'cimbura_mu_tgmpa_plugins', 'cimbura_mu_tgmpa_plugins_base' );
