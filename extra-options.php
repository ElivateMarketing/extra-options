<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://elivate.net
 * @since             1.0.0
 * @package           Extra_Options
 *
 * @wordpress-plugin
 * Plugin Name:       Extra Options by Elivate
 * Plugin URI:        https://elivate.net
 * Description:       This plugin adds extra options commonly used by the Elivate team. 
 * Version:           1.0.0
 * Author:            Alex Trusler
 * Author URI:        https://elivate.net/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       extra-options
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'EXTRA_OPTIONS_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-extra-options-activator.php
 */
function activate_extra_options() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-extra-options-activator.php';
	Extra_Options_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-extra-options-deactivator.php
 */
function deactivate_extra_options() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-extra-options-deactivator.php';
	Extra_Options_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_extra_options' );
register_deactivation_hook( __FILE__, 'deactivate_extra_options' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-extra-options.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_extra_options() {

	$plugin = new Extra_Options();
	$plugin->run();

}
run_extra_options();
