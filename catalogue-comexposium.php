<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://www.comexposium.fr
 * @since             1.0.0
 * @package           Catalogue_Comexposium
 *
 * @wordpress-plugin
 * Plugin Name:       Catalogue Comexposium
 * Plugin URI:        https://www.comexposium.fr
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Hassan Akaou
 * Author URI:        https://www.comexposium.fr
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       catalogue-comexposium
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define('CATALOGUE_COMEXPOSIUM_VERSION', '1.0.0');

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-catalogue-comexposium-activator.php
 */
function activate_catalogue_comexposium()
{
	require_once plugin_dir_path(__FILE__) . 'includes/class-catalogue-comexposium-activator.php';
	Catalogue_Comexposium_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-catalogue-comexposium-deactivator.php
 */
function deactivate_catalogue_comexposium()
{
	require_once plugin_dir_path(__FILE__) . 'includes/class-catalogue-comexposium-deactivator.php';
	Catalogue_Comexposium_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_catalogue_comexposium');
register_deactivation_hook(__FILE__, 'deactivate_catalogue_comexposium');

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path(__FILE__) . 'includes/class-catalogue-comexposium.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_catalogue_comexposium()
{

	$plugin = new Catalogue_Comexposium();
	$plugin->run();
}
run_catalogue_comexposium();
