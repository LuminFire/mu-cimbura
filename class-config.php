<?php

define( 'CIMBURA_MU_DIR', WPMU_PLUGIN_DIR . '/mu-cimbura/' );
define( 'CIMBURA_CONF_DIR', WPMU_PLUGIN_DIR . '/mu-cimbura-conf/' );

class Cimbura_MU_Config {

	private static $instance = null;

	public $environment = 'local';
	public $tgmpa_plugins = null;
	public $tgmpa_config = null;


	private function __construct() {
		$this->load_environment();
		$this->load_config();
		$this->load_plugin_requirements();
	}

	public static function get_instance() {
		if ( ! self::$instance ) {
			$class = __CLASS__;
			self::$instance = new $class();
		}
		return self::$instance;
	}

	private function load_environment() {
		if ( file_exists( CIMBURA_CONF_DIR . 'base-config.php' ) ) {
			require_once CIMBURA_CONF_DIR . 'base-config.php';

			foreach ( $environments as $env => $url ) {
				if ( $url && $url == site_url() || ( is_multisite() && strpos( site_url(), $url ) !== false ) ) {
					$this->environment = $env;
					//first to match wins
					return;
				}
			}
		}
	}

	private function load_config() {
		if ( file_exists( CIMBURA_CONF_DIR . $this->environment . '-config.php' ) ) {
			require_once CIMBURA_CONF_DIR . $this->environment . '-config.php';
		}

		// Plugin defaults
		$this->tgmpa_plugins = array(
			array(
				'name'      => 'Sucuri Security',
				'slug'      => 'sucuri-scanner',
				'required'  => true,
			),
			array(
				'name' => 'WordFence',
				'slug' => 'wordfence',
				'required' => true,
			),
		);

		// Plugin options.
		$this->tgmpa_plugins = apply_filters( 'cimbura_mu_tgmpa_plugins', $this->tgmpa_plugins );

		// Configuration defaults.
		$this->tgmpa_config = array(
			'parent_slug' => 'plugins.php',
			'strings' => array(
				'menu_title' => __( 'Required Plugins', 'cimbura-mu' ),
				'notice_can_install_required' => _n_noop(
					'This site requires the following plugin: %1$s.',
					'This site requires the following plugins: %1$s.',
					'cimbura-mu'
				), // %1$s = plugin name(s).
				'notice_can_install_recommended' => _n_noop(
					'This site recommends the following plugin: %1$s.',
					'This site recommends the following plugins: %1$s.',
					'cimbura-mu'
				),
				'notice_ask_to_update' => _n_noop(
					'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this site: %1$s.',
					'The following plugins need to be updated to their latest version to ensure maximum compatibility with this site: %1$s.',
					'cimbura-mu'
				),
			)
		);

		// Configuration options.
		$this->tgmpa_config = apply_filters( 'cimbura_mu_tgmpa_config', $this->tgmpa_config );
	}

	private function load_plugin_requirements() {
		require_once CIMBURA_MU_DIR . 'TGM-Plugin-Activation/class-tgm-plugin-activation.php';
		add_action( 'tgmpa_register', array( $this, 'register_required_plugins' ) );
		add_action( 'init', array( $this, 'sane_plugin_defaults' ) );
	}

	public function register_required_plugins() {
		global $tgmpa;
		tgmpa( $this->tgmpa_plugins, $this->tgmpa_config );
		// Run deactivation on admin init (not just on theme activation).
		add_action( 'admin_init', array( $tgmpa, 'force_deactivation' ) );
	}

	public function sane_plugin_defaults() {
		/**
		 * Persistently disable log_emails_log records from sucuri alerts because...
		 * User logs in, sucuri tries to send email, email gets logged as a post type,
		 * sucuri tries to send an email about a post update, email gets logged...
		 * ad nauseum until <out of memory> :(
		 */
		if ( class_exists( 'SucuriScanOption' ) ) {
			$post_types = get_post_types();
			if ( array_key_exists( 'log_emails_log', $post_types ) ) {
				if( method_exists( SucuriScanOption, 'add_ignored_event' ) ){
					SucuriScanOption::add_ignored_event( 'log_emails_log' );
				}
			}
		}
	}
}

Cimbura_MU_Config::get_instance();
