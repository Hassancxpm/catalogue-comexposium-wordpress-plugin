<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://www.comexposium.fr
 * @since      1.0.0
 *
 * @package    Catalogue_Comexposium
 * @subpackage Catalogue_Comexposium/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Catalogue_Comexposium
 * @subpackage Catalogue_Comexposium/includes
 * @author     Hassan Akaou <hassan.akaou@comexposium.com>
 */
class Catalogue_Comexposium_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'catalogue-comexposium',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
