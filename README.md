# Cimbura-MU #

This Must-Use Plugin can facilitate automatic plugin installation/activation/deactivation based on environment (live, staging, local)

### Installation ###

* Create ```WPMU_PLUGIN_DIR``` if not created already, typically as ```wp-content/mu-plugins```
* Clone this project into that directory as a submodule: ```git submodule add -f git@github.com:cimburadotcom/mu-cimbura.git```
* Update submodules [(TGM-Plugin-Activation)](https://github.com/TGMPA/TGM-Plugin-Activation) by running ```git submodule update --init --recursive``` in the ```WPMU_PLUGIN_DIR/mu-cimbura``` directory.
* Copy ```10-mu-cimbura.php``` from plugin directory into ```WPMU_PLUGIN_DIR```
* Copy ```mu-cimbura-conf-example``` directory from the ```mu-cimbura``` directory into ```WPMU_PLUGIN_DIR``` as ```mu-cimbura-conf```
* Edit configurations files in ```WPMU_PLUGIN_DIR/mu-cimbura-conf``` to suit your site (```base-config.php```, ```local-config.php```, ```staging-config.php```, ```live-config.php```)
* Check the ```mu-cimbura-conf``` directory into your site repository
