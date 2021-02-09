<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://www.comexposium.fr
 * @since      1.0.0
 *
 * @package    Catalogue_Comexposium
 * @subpackage Catalogue_Comexposium/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Catalogue_Comexposium
 * @subpackage Catalogue_Comexposium/public
 * @author     Hassan Akaou <hassan.akaou@comexposium.com>
 */
class Catalogue_Comexposium_Public
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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct($plugin_name, $version)
	{

		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles()
	{
		$route_name = get_option('catalogue_comexposium_route_name') ?? 'catalogue';
		if (strpos($_SERVER['REQUEST_URI'], $route_name) !== false) {
			wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/catalogue-comexposium-public.css', array(), $this->version, 'all');
		}
	}

	/**
	 * Inject the Comexposium Catalogue javascript widget.
	 *
	 * @since    1.0.0
	 */
	public function injectComexposiumCatalogueLoader()
	{
		$route_name = get_option('catalogue_comexposium_route_name') ?? 'catalogue';
		if (strpos($_SERVER['REQUEST_URI'], $route_name) !== false) {
			wp_register_script('Catalogue_comexposium_js', 'https://connect2.prod.comexposium-webservices.com/connect2Loader.js', null, null, false);
			wp_enqueue_script('Catalogue_comexposium_js');
		}
	}

	/**
	 * Register the shortcode for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function register_shortcodes()
	{
		$id_salon = get_option('catalogue_comexposium_id_salon');
		$id_salon_name_dash = str_replace('_', '-', $id_salon);
		$lang_salon = get_option('catalogue_comexposium_lang');
		$shortcodeName = 'catalogue-comexposium-' . $id_salon_name_dash . '-' . $lang_salon;
		add_shortcode($shortcodeName, array($this, 'generateComexposiumCatalogue'));
	}

	/**
	 * Register Comexposium Catalogue routes.
	 *
	 * @since    1.0.0
	 */
	public function catalogue_comexposium_rewrite_rules()
	{
		$route_name = get_option('catalogue_comexposium_route_name') ?? 'catalogue';

		add_rewrite_tag('%comexposiumtypepage%', '([^/]+)');
		add_rewrite_tag('%comexposiumitemname%', '([^/]+)');

		add_rewrite_rule(
			'^' . $route_name . '/([^/]+)/([^/]+)',
			'index.php?pagename=' . $route_name . '&comexposiumtypepage=$matches[1]&comexposiumitemname=$matches[2]',
			'top'
		);

		flush_rewrite_rules(true);
	}

	/**
	 * Comexposium Catalogue Context Getter.
	 *
	 * @since    1.0.0
	 */
	public function getSSRContext()
	{
		$id_salon = get_option('catalogue_comexposium_id_salon');
		$route_name = get_option('catalogue_comexposium_route_name') ?? 'catalogue';
		$lang = get_option('catalogue_comexposium_lang') ?? 'fr';
		$id_salon_name = str_replace('_', ' ', $id_salon);

		$ssrContext = '{"lang":"' . $lang . '","urlMap":{"catalog":"/' . $route_name . '/:defaultSelectedTab?","catalog-exhibitor-full":"/' . $route_name . '/Exposant/:slug","catalog-product-full":"/' . $route_name . '/Produit/:slug","catalog-search-result":"/' . $route_name . '/Recherche/:defaultSelectedTab?"},"baseUrl":"' . get_site_url() . '","desktopBaseUrl":"","mobileBaseUrl":"","canonicalBaseUrl":"","404":"/404.html","exhibition":{"id":"' . $id_salon . '","metaData":{"title":"' . $id_salon_name . '","description":" La sortie familiale : nouveaut\u00e9s, innovations, d\u00e9couvertes pendant 12 jours. ","keywords":"Foire de Paris Maison, gastronomie et shopping. "},"catalog":{"metaData":{"title":"Catalogue ' . $id_salon_name . '"}}}}';

		return $ssrContext;
	}

	/**
	 * Inject Comexposium Catalogue javascript on pages.
	 *
	 * @since    1.0.0
	 */
	public function injectContextJS()
	{
		$ssrContext = $this->getSSRContext();
		$route_name = get_option('catalogue_comexposium_route_name') ?? 'catalogue';
		if (strpos($_SERVER['REQUEST_URI'], $route_name) !== false) {
			echo '<script type="text/javascript">window.comexposiumConnectContext = JSON.parse(' . '\'' . $ssrContext . '\'' . ')</script>';
		}
	}

	/**
	 * Execute Curl Call to SSR Server.
	 *
	 * @since    1.0.0
	 */
	public function curlLauncher(string $url, string $ssrContext)
	{

		$responseElements = array();

		$ch = curl_init($url);
		$queryBuilt = http_build_query([
			'ssrContext' => $ssrContext,
		]);

		$curlOptions = array(
			CURLOPT_SSL_VERIFYPEER => false,
			CURLOPT_FRESH_CONNECT => true,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_POST => 1,
			CURLOPT_VERBOSE => true,
			CURLOPT_POSTFIELDS => $queryBuilt
		);
		curl_setopt_array($ch, $curlOptions);
		$ssrResponse = curl_exec($ch);

		// Get some infos
		$curlStatusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		$curlEffectiveUrl = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
		$curlRedirectUrl = curl_getinfo($ch, CURLINFO_REDIRECT_URL);

		$responseElements['curlStatusCode'] = $curlStatusCode;
		$responseElements['curlEffectiveUrl'] = $curlEffectiveUrl;
		$responseElements['curlRedirectUrl'] = $curlRedirectUrl;
		$responseElements['ssrResponse'] = $ssrResponse;

		// Close curl
		curl_close($ch);

		return $responseElements;
	}

	/**
	 * Display Comexposium Catalogue html on pages.
	 *
	 * @since    1.0.0
	 */
	public function displaySSR($ssrResponse = NULL)
	{

		$html = '<div id="catalogue-comexposium-wrapper" data-external-content-wrapper="true">SSR is not running</div>';

		if (isset($ssrResponse)) {
			$html = '<div id="catalogue-comexposium-wrapper" data-external-content-wrapper="true">' . $ssrResponse . '</div>';
			$decodedResponse = json_decode($ssrResponse, true);
			if (isset($decodedResponse)) {
				$html = '<div id="catalogue-comexposium-wrapper" data-external-content-wrapper="true">' . $decodedResponse['html'] . '</div>';
			}
			echo $html;
		}
	}

	/**
	 * Execute Comexposium Catalogue Shortcode.
	 *
	 * @since    1.0.0
	 */
	public function generateComexposiumCatalogue()
	{

		$ssrContext = $this->getSSRContext();

		$url = 'https://ssr.prod.comexposium-webservices.com';
		$url .= $_SERVER['REQUEST_URI'];
		$url = rtrim($url, '/');
		$route_name = get_option('catalogue_comexposium_route_name') ?? 'catalogue';

		if (strpos($url, $route_name) !== false) {

			parse_str($_SERVER['QUERY_STRING'], $params);
			$params['ssr'] = 'true';
			$url .= '?' . http_build_query($params);

			$curlCall = $this->curlLauncher($url, $ssrContext);

			$curlStatusCode = $curlCall['curlStatusCode'];
			$curlRedirectUrl = $curlCall['curlRedirectUrl'];
			$ssrResponse = $curlCall['ssrResponse'];

			// Display response
			if ($curlStatusCode === 200) {
				return $this->displaySSR($ssrResponse);
			} else if ($curlStatusCode === 301) {
				$ssrReponseFrom301 = $this->curlLauncher($curlRedirectUrl, $ssrContext);
				return $this->displaySSR($ssrReponseFrom301);
			} else if ($curlStatusCode === 404) {
				return $this->displaySSR($ssrResponse);
			}

			return $this->displaySSR($ssrResponse);

		}
	}
}
