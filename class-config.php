<?php

define( 'CIMBURALIB_DIR', WPMU_PLUGIN_DIR . '/cimburalib/' );
define( 'CIMBURACONF_DIR', WPMU_PLUGIN_DIR . '/cimburaconf/' );

class Cimbura_Lib_Config {

	public static $environment = 'local';
	public static $tgmpa_plugins = array();
	public static $tgmpa_config = array();

	public static function load() {
		self::load_environment();

		self::load_config();

		self::load_plugin_requirements();
	}

	private static function load_environment() {
		if ( file_exists( CIMBURACONF_DIR . 'base-config.php' ) ) {
			require_once CIMBURACONF_DIR . 'base-config.php';

			foreach ( $environments as $env => $url ) {
				if ( $url && $url == wp_site_url() ) {
					self::$environment = $env;
					//first to match wins
					return;
				}
			}
		}
	}

	private static function load_config() {
		if ( file_exists( CIMBURACONF_DIR . self::$environment . '-config.php' ) ) {
			require_once CIMBURACONF_DIR . self::$environment . '-config.php';
			if ( isset( $tgmpa_plugins ) ) {
				self::$tgmpa_plugins = $tgmpa_plugins;
			}

			if ( isset( $tgmpa_config ) ) {
				self::$tgmpa_config = $tgmpa_config;
			}
		}
	}

	private static function load_plugin_requirements() {
		require_once CIMBURALIB_DIR . 'TGM-Plugin-Activation/class-tgm-plugin-activation.php';
		add_action( 'tgmpa_register', array( __CLASS__, 'register_required_plugins' ) );
	}

	public static function register_required_plugins() {
		tgmpa( self::$tgmpa_plugins, self::$tgmpa_config );
	}
}

Cimbura_Lib_Config::load();