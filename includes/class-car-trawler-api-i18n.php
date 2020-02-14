<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       http://planetwebzone.com
 * @since      1.0.0
 *
 * @package    Car_Trawler_Api
 * @subpackage Car_Trawler_Api/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Car_Trawler_Api
 * @subpackage Car_Trawler_Api/includes
 * @author     Rahul Thakur <info@planetwebzone.com>
 */
class Car_Trawler_Api_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'car-trawler-api',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
