<?php

/**
 * Fired during plugin activation
 *
 * @link       https://www.comexposium.fr
 * @since      1.0.0
 *
 * @package    Catalogue_Comexposium
 * @subpackage Catalogue_Comexposium/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Catalogue_Comexposium
 * @subpackage Catalogue_Comexposium/includes
 * @author     Hassan Akaou <hassan.akaou@comexposium.com>
 */
class Catalogue_Comexposium_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		flush_rewrite_rules(true);
	}

}
