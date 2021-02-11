<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://www.comexposium.fr
 * @since      1.0.0
 *
 * @package    Catalogue_Comexposium
 * @subpackage Catalogue_Comexposium/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Catalogue_Comexposium
 * @subpackage Catalogue_Comexposium/admin
 * @author     Hassan Akaou <hassan.akaou@comexposium.com>
 */
class Catalogue_Comexposium_Admin
{

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct($plugin_name, $version)
	{

		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles()
	{

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Test_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Test_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/catalogue-comexposium-admin.css', array(), $this->version, 'all');
	}

	/**
	 * Add settings action link to the plugins page.
	 *
	 * @since    1.0.0
	 */
	public function add_action_links($links)
	{
		$settings_link = array(
			'<a href="' . admin_url('admin.php?page=' . $this->plugin_name) . '">' . __('Settings', 'catalogue-comexposium') . '</a>',
		);
		return array_merge($settings_link, $links);
	}

	/**
	 * Render the settings page for this plugin.
	 *
	 * @since    1.0.0
	 */

	public function display_catalogue_comexposium_setup_page()
	{
		include_once('partials/catalogue-comexposium-admin-display.php');
	}

	/**
	 * Register the admin menu area.
	 *
	 * @since    1.0.0
	 */
	public function catalogue_comexposium_menu()
	{
		//create new top-level menu
		add_menu_page('Catalogue Comexposium Settings', 'Catalogue Comexposium', 'manage_options', $this->plugin_name, array($this, 'display_catalogue_comexposium_setup_page'), 'data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pg0KPCEtLSBHZW5lcmF0b3I6IEFkb2JlIElsbHVzdHJhdG9yIDE5LjAuMCwgU1ZHIEV4cG9ydCBQbHVnLUluIC4gU1ZHIFZlcnNpb246IDYuMDAgQnVpbGQgMCkgIC0tPg0KPHN2ZyB2ZXJzaW9uPSIxLjEiIGlkPSJDYXBhXzEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4Ig0KCSB2aWV3Qm94PSIwIDAgNTEyIDUxMiIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgNTEyIDUxMjsiIHhtbDpzcGFjZT0icHJlc2VydmUiPg0KPGc+DQoJPGc+DQoJCTxwYXRoIGZpbGw9ImJsYWNrIiBkPSJNNDgyLDMxNmgtMTguMjZsMTUuODEzLTkuMTNjNi45MzktNC4wMDcsMTEuOTAzLTEwLjQ3NiwxMy45NzgtMTguMjE2YzIuMDc1LTcuNzQsMS4wMS0xNS44MjUtMi45OTctMjIuNzY1bC02OC0xMTcuNzc5DQoJCQljLTQuMDA2LTYuOTQtMTAuNDc2LTExLjkwNC0xOC4yMTYtMTMuOTc5Yy03Ljc0My0yLjA3NC0xNS44MjYtMS4wMS0yMi43NjUsMi45OTdsLTE1LjgxMyw5LjEzbDkuMTI5LTE1LjgxMg0KCQkJYzQuMDA3LTYuOTQsNS4wNzEtMTUuMDI1LDIuOTk4LTIyLjc2NWMtMi4wNzQtNy43NC03LjAzOS0xNC4yMS0xMy45NzktMTguMjE2bC0xMTcuNzc5LTY4Yy02Ljk0LTQuMDA3LTE1LjAyNC01LjA3Mi0yMi43NjUtMi45OTcNCgkJCWMtNy43NCwyLjA3NC0xNC4yMSw3LjAzOC0xOC4yMTYsMTMuOTc4TDE5Niw0OC4yNlYzMGMwLTE2LjU0Mi0xMy40NTgtMzAtMzAtMzBIMzBDMTMuNDU4LDAsMCwxMy40NTgsMCwzMHY0NTINCgkJCWMwLDE2LjU0MiwxMy40NTgsMzAsMzAsMzBoNjhoNjhoMzE2YzE2LjU0MiwwLDMwLTEzLjQ1OCwzMC0zMFYzNDZDNTEyLDMyOS40NTgsNDk4LjU0MiwzMTYsNDgyLDMxNnogTTE3Niw0ODINCgkJCWMwLDUuNTE0LTQuNDg2LDEwLTEwLDEwSDk4SDMwYy01LjUxNCwwLTEwLTQuNDg2LTEwLTEwVjMwYzAtNS41MTQsNC40ODYtMTAsMTAtMTBoMTM2YzUuNTE0LDAsMTAsNC40ODYsMTAsMTBWNDgyeg0KCQkJIE0zOTEuNTU0LDE1NC40NWMyLjMxMy0xLjMzNCw1LjAwNy0xLjY5Miw3LjU4OC0wLjk5OWMyLjU4LDAuNjkxLDQuNzM2LDIuMzQ2LDYuMDcyLDQuNjU5bDY4LDExNy43NzkNCgkJCWMxLjMzNiwyLjMxMywxLjY5LDUuMDA4LDAuOTk5LDcuNTg4Yy0wLjY5MSwyLjU4LTIuMzQ2LDQuNzM2LTQuNjU5LDYuMDcybC04Mi41NjIsNDcuNjY3bC02NS43NS0xMTMuODgzbDI0LjQ5OS00Mi40MzMNCgkJCUwzOTEuNTU0LDE1NC40NXogTTM2OS42NzEsMzQ3LjIxN2wtOTEuMjIsNTIuNjY2bC0yOS41NzEtNTEuMjE3bDYwLjgxNC0xMDUuMzMzTDM2OS42NzEsMzQ3LjIxN3ogTTE5Niw4OC4yNTlsMjYuNDUtNDUuODEzDQoJCQljMS4zMzYtMi4zMTMsMy40OTItMy45NjcsNi4wNzEtNC42NTljMi41ODQtMC42OTIsNS4yNzUtMC4zMzYsNy41ODksMC45OTlsMTE3Ljc3OSw2OGMyLjMxMywxLjMzNSwzLjk2OSwzLjQ5Miw0LjY1OSw2LjA3MQ0KCQkJYzAuNjkxLDIuNTgsMC4zMzcsNS4yNzUtMC45OTksNy41ODhsLTQ3LjY2Nyw4Mi41NjFMMTk2LDEzNy4yNTdWODguMjU5eiBNMTk2LDE2MC4zNTFsMTAzLjg4Myw1OS45NzdsLTUyLjY2Niw5MS4yMjFMMTk2LDI4MS45NzkNCgkJCVYxNjAuMzUxeiBNMTk2LDMwNS4wNzNsNDEuMjE3LDIzLjc5NkwxOTYsNDAwLjI1OVYzMDUuMDczeiBNMjQxLjMzMyw0OTJIMTk0LjI4YzEuMTEtMy4xMywxLjcyLTYuNDk0LDEuNzItMTB2LTExLjQyDQoJCQlsNDUuMzMzLTI2LjE3M1Y0OTJ6IE0xOTYsNDQ3LjQ4NnYtNy4yODdjMC4wNzktMC4xMjMsMC4xNjktMC4yMzQsMC4yNDMtMC4zNjJsNDEuMDkxLTcxLjE3MWwyMy43OTcsNDEuMjE3TDE5Niw0NDcuNDg2eiBNNDkyLDQ4Mg0KCQkJYzAsNS41MTQtNC40ODYsMTAtMTAsMTBIMjYxLjMzM3YtNTcuMTYzYzAtMC42NDEtMC4wNjYtMS4yNjUtMC4xODEtMS44NzJsMTA1LjUxNC02MC45MTl2NDUuMTg0YzAsNS41MjIsNC40NzgsMTAsMTAsMTANCgkJCWM1LjUyMiwwLDEwLTQuNDc4LDEwLTEwdi01Ni43MzFMNDI5LjA5OSwzMzZINDgyYzUuNTE0LDAsMTAsNC40ODYsMTAsMTBWNDgyeiIvPg0KCTwvZz4NCjwvZz4NCjxnPg0KCTxnPg0KCQk8cGF0aCBmaWxsPSJibGFjayIgZD0iTTk4LDM3NmMtMjAuOTUzLDAtMzgsMTcuMDQ3LTM4LDM4czE3LjA0NywzOCwzOCwzOHMzOC0xNy4wNDcsMzgtMzhTMTE4Ljk1MywzNzYsOTgsMzc2eiBNOTgsNDMyYy05LjkyNSwwLTE4LTguMDc1LTE4LTE4DQoJCQlzOC4wNzUtMTgsMTgtMThzMTgsOC4wNzUsMTgsMThTMTA3LjkyNSw0MzIsOTgsNDMyeiIvPg0KCTwvZz4NCjwvZz4NCjxnPg0KCTxnPg0KCQk8cGF0aCBmaWxsPSJibGFjayIgZD0iTTM4My43MjksNDQ5LjQzYy0xLjg1OS0xLjg2MS00LjQyOS0yLjkzLTcuMDY5LTIuOTNjLTIuNjMsMC01LjIsMS4wNjktNy4wNjEsMi45M2MtMS44NywxLjg2LTIuOTMsNC40NC0yLjkzLDcuMDcNCgkJCXMxLjA2LDUuMjEsMi45Myw3LjA2OWMxLjg2LDEuODYsNC40MzEsMi45MzEsNy4wNjEsMi45MzFjMi42NCwwLDUuMjEtMS4wNyw3LjA2OS0yLjkzMWMxLjg3LTEuODU5LDIuOTQtNC40MzksMi45NC03LjA2OQ0KCQkJUzM4NS41OTksNDUxLjI5LDM4My43MjksNDQ5LjQzeiIvPg0KCTwvZz4NCjwvZz4NCjxnPg0KCTxnPg0KCQk8cGF0aCBmaWxsPSJibGFjayIgZD0iTTU0LjMzMywxMDAuMzMzYy01LjUyMiwwLTEwLDQuNDc3LTEwLDEwdjEwOC41NTJjMCw1LjUyNCw0LjQ3OCwxMC4wMDEsMTAsMTAuMDAxYzUuNTIyLDAsMTAtNC40NzcsMTAtMTBWMTEwLjMzMw0KCQkJQzY0LjMzMywxMDQuODEsNTkuODU1LDEwMC4zMzMsNTQuMzMzLDEwMC4zMzN6Ii8+DQoJPC9nPg0KPC9nPg0KPGc+DQoJPGc+DQoJCTxwYXRoIGZpbGw9ImJsYWNrIiBkPSJNNTQuMzMzLDI0OC44NmMtNS41MjIsMC0xMCw0LjQ3Ny0xMCwxMHYwLjE5MWMwLDUuNTIyLDQuNDc4LDEwLDEwLDEwYzUuNTIyLDAsMTAtNC40NzgsMTAtMTB2LTAuMTkxDQoJCQlDNjQuMzMzLDI1My4zMzcsNTkuODU1LDI0OC44Niw1NC4zMzMsMjQ4Ljg2eiIvPg0KCTwvZz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjwvc3ZnPg0K');
	}

	/**
	 * Setting the admin menu options.
	 *
	 * @since    1.0.0
	 */
	public function register_catalogue_comexposium_settings()
	{
		//register our settings
		register_setting('catalogue-comexposium-settings-group', 'catalogue_comexposium_id_salon');
		register_setting('catalogue-comexposium-settings-group', 'catalogue_comexposium_route_name');
		register_setting('catalogue-comexposium-settings-group', 'catalogue_comexposium_lang');
		register_setting('catalogue-comexposium-settings-group', 'catalogue_comexposium_meta_desc');
		register_setting('catalogue-comexposium-settings-group', 'catalogue_comexposium_key_words');
	}

	/**
	 * Print the shortcode.
	 *
	 * @since    1.0.0
	 */
	public static function print_shortcode()
	{
		$id_salon = get_option('catalogue_comexposium_id_salon');
		$lang_salon = get_option('catalogue_comexposium_lang') ?? 'fr';
		$id_salon_name_dash = str_replace('_', '-', $id_salon);
		$shortcodeName = 'catalogue-comexposium-' . $id_salon_name_dash . '-' . $lang_salon;
		$shortcodeHtml = '<p class="shortcode-result">' . __('Paste this shortcode on the page corresponding to the page name you choose:', 'catalogue-comexposium') . '<span class="regular-text code">[' . $shortcodeName . ']</span></p>';
		echo $shortcodeHtml;
	}

}
