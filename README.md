# Cimbura-MU #

This Must-Use Plugin can facilitate automatic plugin installation/activation/deactivation based on environment (live, staging, local)

### Installation ###

* Create WPMU_PLUGIN_DIR if not created already, typically as wp-content/mu-plugins
* Clone this project into that directory: ```git clone git@bitbucket.org:cimburacom/mu-cimbura.git```
* Update submodules (TGMPluginActivation) by ```git submodule update --init --recursive```
* Copy ```10-mu-cimbura.php``` from plugin folder into WPMU_PLUGIN_DIR
* Copy ```mu-cimbura-conf-example``` folder from plugin folder into WPMU_PLUGIN_DIR as ```mu-cimbura-conf```
* Edit configurations files in WPMU_PLUGIN_DIR/mu-cimbura-conf to suit your site (base-config.php, local-config.php, staging-config.php, live-config.php)
* Check mu-cimbura-conf into your site repository
* Optionally check in mu-cimbura into your site respository as a submodule