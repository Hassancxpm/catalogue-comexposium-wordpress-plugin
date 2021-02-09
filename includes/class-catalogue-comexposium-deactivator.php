<?php

/**
 * Fired during plugin deactivation
 *
 * @link       https://www.comexposium.fr
 * @since      1.0.0
 *
 * @package    Catalogue_Comexposium
 * @subpackage Catalogue_Comexposium/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Catalogue_Comexposium
 * @subpackage Catalogue_Comexposium/includes
 * @author     Hassan Akaou <hassan.akaou@comexposium.com>
 */
class Catalogue_Comexposium_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {
		flush_rewrite_rules(true);
	}

}
