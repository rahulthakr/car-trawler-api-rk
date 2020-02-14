<?php

/**

 *
 * @link              http://planetwebzone.com
 * @since             1.0.0
 * @package           Car_Trawler_Api
 *
 * @wordpress-plugin
 * Plugin Name:       Car Trawler API
 * Plugin URI:        http://planetwebzone.com
 * Description:       A booking engine in the form of a widget that makes it possible for your visitors to rent a car at over 30,000 locations worldwide.
 * Version:           1.0.0
 * Author:            Rahul Thakur
 * Author URI:        http://planetwebzone.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       car-trawler-api
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
define( 'CAR_TRAWLER_API_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-car-trawler-api-activator.php
 */
function activate_car_trawler_api() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-car-trawler-api-activator.php';
	Car_Trawler_Api_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-car-trawler-api-deactivator.php
 */
function deactivate_car_trawler_api() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-car-trawler-api-deactivator.php';
	Car_Trawler_Api_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_car_trawler_api' );
register_deactivation_hook( __FILE__, 'deactivate_car_trawler_api' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-car-trawler-api.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_car_trawler_api() {

	$plugin = new Car_Trawler_Api();
	$plugin->run();

}
run_car_trawler_api();
// Add Shortcode
function cartrawler_searchfrom( $atts ) {
    // Attributes
	$pre_atts =array(
			'redirect' => false,
			'redirect-deeplinkurl' => '',
			'color-primary' => get_option('cartrawler_primary'),
			'color-secondary' => get_option('cartrawler_secondary'),
			'color-complimentary' =>get_option('cartrawler_complimentary'), 
			'version' =>get_option('cartrawler_version'), 
			'clientid' =>get_option('cartrawler_clientid'), 
		);
		$atts_merge= 	array_merge($atts,$pre_atts); 
			$atts = shortcode_atts($atts_merge
		, $atts ,'cartrawler-form');
	
 $bttoncolor =get_option('cartrawler_primary');
 $formbgcolor =get_option('cartrawler_secondary');
 $labelcolor =get_option('cartrawler_complimentary');
 $formtitle =get_option('cartrawler_title');
 $mainColor =get_option('cartrawler_theme');
	?>
	<style>
 
  .ct-modal-container  ,.ct-navigation-arrows li, .ct-navigation-arrows .ct-navigation-arrows_item {
	   color: <?=$mainColor;?> !important;
  }
 .ct-navigation-arrows li.ct-active, .ct-navigation-arrows .ct-navigation-arrows_item.ct-active {
    background: <?=$mainColor;?>;
    color: white !important;
}
  .ct-navigation-arrows li.ct-active:after, .ct-navigation-arrows .ct-navigation-arrows_item.ct-active:after {
    border-left: 15px solid <?=$mainColor;?>;
} 
.ct-palette-p-bg-color ,.ct-btn-p  {
    background-color: <?=$mainColor;?> !important;
}
[data-step-name*="searchcars"] .ct-palette-p-bg-color , [data-step-name*="searchcars"] .ct-btn-p  {
    background-color: <?=$bttoncolor;?> !important;
}
[data-step-name*="searchcars"] .ct-grid {
	 background-color: <?=$formbgcolor;?> !important;
}
 .ct-grid label    {
	 color: <?=$labelcolor;?> !important;
}
 .ct-grid h2{
	color: <?=$formtitle;?> !important;
}
[data-step-name="details-with-payment"] .ct-grid label  {
	 color: black !important;
}
.ct-grid-unit-12-16.ct-body-content ,.ct-grid-unit-4-16.ct-context-content.ct-grid-unit-alpha.ct-context-content__filter-bar-feature {
    background: white !important;
}
  </style>
<div ct-app><noscript>YOUR BROWSER DOES NOT SUPPORT JAVASCRIPT</noscript></div>
	<script>
	var redirect =  <?=$atts['redirect'];?> ;
	/*console.log(redirect);*/
	 var CT ='';
	if(redirect){
     CT = {
		ABE: {
			Settings: {
			  clientID: '<?=$atts['clientid'];?>',   
				 step1: {
				deeplinkURL: "<?=$atts['redirect-deeplinkurl'];?>",
			 		strings: {
headingText: 'Best Car Rental Deals', labelSearch: 'airport, city, hotel name, address', labelPickup: 'Pick-up location', labelDropoff: 'Return location', labelPickupDate: 'Pick-up date', labelDropoffDate: 'Return date', placeholderPickup: 'airport, city, hotel name, address', placeholderDropoff: 'airport, city, hotel name, address',
}
			 },
				templateLayout: {
        breadcrumbs: true
      }
	
			},
			theme:  {
		    primary: '<?=$atts['color-primary'];?>',
			secondary: '<?=$atts['color-secondary'];?>',
			complimentary: '<?=$atts['color-complimentary'];?>'		
			}
		  }
		};
	}
	else {
		   CT = {
		ABE: {
			Settings: {
			  clientID: '<?=$atts['clientid'];?>',  
			},
			theme:  {
		     primary: '<?=$atts['color-primary'];?>',
			secondary: '<?=$atts['color-secondary'];?>',
			complimentary: '<?=$atts['color-complimentary'];?>'		
			}
		  }
		};
	}
   (function() {
		CT.ABE.Settings.version = '<?=$atts['version'];?>';
		var cts = document.createElement('script'); cts.type = 'text/javascript'; cts.async = true;
		cts.src = '//ajaxgeo.cartrawler.com/abe' + CT.ABE.Settings.version + '/ct_loader.js?' + new Date().getTime();
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(cts, s);
		//$(".ct-banner-red.ct-banner-no-fade-out").text("Hello world!");
	})();
 	
</script>
<?php

}
add_shortcode( 'cartrawler-form', 'cartrawler_searchfrom' );

function my_settings_page() {
    add_submenu_page(
        'options-general.php', // top level menu page
        'Cartrawler Settings', // title of the settings page
        'Cartrawler Settings', // title of the submenu
        'manage_options', // capability of the user to see this page
        'cartrawler-settings', // slug of the settings page
        'my_cartrawler_page_html' // callback function when rendering the page
    );
    add_action('admin_init', 'my_settings_init');
}
add_action('admin_menu', 'my_settings_page');

function my_settings_init() {
    add_settings_section(
        'my-settings-section', // id of the section
        'Cartrawler Settings', // title to be displayed
        '', // callback function to be called when opening section
        'my-settings-page' // page on which to display the section, this should be the same as the slug used in add_submenu_page()
    );

  
 register_setting(
    'my-settings-page', // option group
	
    'cartrawler_title_text'
);
add_settings_field(
    'titletxt', // id of the settings field
    'Form Title Text', // title
    'title_text_settings_field', // callback function
    'my-settings-page', // page on which settings display
    'my-settings-section' // section on which to show settings
); 
 register_setting(
    'my-settings-page', // option group
    'cartrawler_clientid'
);
add_settings_field(
    'clientid', // id of the settings field
    'Client Id', // title
    'clientid_settings_field', // callback function
    'my-settings-page', // page on which settings display
    'my-settings-section' // section on which to show settings
);
register_setting(
    'my-settings-page', // option group
    'cartrawler_version'
);	 add_settings_field(
    'version', // id of the settings field
    'Version', // title
    'version_settings_field', // callback function
    'my-settings-page', // page on which settings display
    'my-settings-section' // section on which to show settings
);
register_setting(
    'my-settings-page', // option group
    'cartrawler_theme'
);	 
add_settings_field(
    'theme', // id of the settings field
    'Theme Color', // title
    'bg_theme_settings_field', // callback function
    'my-settings-page', // page on which settings display
    'my-settings-section' // section on which to show settings
);
register_setting(
    'my-settings-page', // option group
    'cartrawler_primary'
);	 
add_settings_field(
    'primary', // id of the settings field
    'Form Button Color', // title
    'bg_primary_settings_field', // callback function
    'my-settings-page', // page on which settings display
    'my-settings-section' // section on which to show settings
);
register_setting(
    'my-settings-page', // option group
    'cartrawler_secondary'
);	 
	add_settings_field(
    'secondary', // id of the settings field
    'Form Background Color', // title
    'bg_secondary_settings_field', // callback function
    'my-settings-page', // page on which settings display
    'my-settings-section' // section on which to show settings
);
register_setting(
    'my-settings-page', // option group
    'cartrawler_complimentary'
);
add_settings_field(
    'complimentary', // id of the settings field
    'Label Color', // title
    'bg_complimentary_settings_field', // callback function
    'my-settings-page', // page on which settings display
    'my-settings-section' // section on which to show settings
);
register_setting(
    'my-settings-page', // option group
    'cartrawler_title'
);
add_settings_field(
    'title', // id of the settings field
    'From title Color', // title
    'title_settings_field', // callback function
    'my-settings-page', // page on which settings display
    'my-settings-section' // section on which to show settings
);
}
function my_render_text() {
    $first_text = esc_attr(get_option('my_first_text', ''));

 echo '<h1>' . $first_text . '</h1>';
 

}
add_shortcode('my-settings', 'my_render_text');
 

	
function title_text_settings_field() { 
		 
		$val = esc_attr(get_option('cartrawler_title_text'));
		echo '<input type="text" name="cartrawler_title_text" value="' . $val . '" />';
	}
	
function clientid_settings_field() { 
		 
		$val = esc_attr(get_option('cartrawler_clientid'));
		echo '<input type="text" name="cartrawler_clientid" value="' . $val . '" />';
	}

 

	  function version_settings_field() { 
		 
		$val =esc_attr(get_option('cartrawler_version'));
		echo '<input type="text" name="cartrawler_version" value="' . $val . '" />';
	}  

 function bg_theme_settings_field() { 
		 
		$val = esc_attr(get_option('cartrawler_theme'));
		echo '<input type="text" name="cartrawler_theme" value="' . $val . '" class="cartrawler-color-picker" >';
		 
	}
 function bg_primary_settings_field() { 
		 
		$val = esc_attr(get_option('cartrawler_primary'));
		echo '<input type="text" name="cartrawler_primary" value="' . $val . '" class="cartrawler-color-picker" >';
		 
	}


 function bg_secondary_settings_field() { 
		 
		$val = esc_attr(get_option('cartrawler_secondary'));
		echo '<input type="text" name="cartrawler_secondary" value="' . $val . '" class="cartrawler-color-picker" >';
		 
	}

 

	  function bg_complimentary_settings_field() { 
		 
		$val = esc_attr(get_option('cartrawler_complimentary'));
		echo '<input type="text" name="cartrawler_complimentary" value="' . $val . '" class="cartrawler-color-picker" >';
	
	  }

	  function title_settings_field() { 
		 
		$val = esc_attr(get_option('cartrawler_title'));
		echo '<input type="text" name="cartrawler_title" value="' . $val . '" class="cartrawler-color-picker" >';
	
	  }
function my_cartrawler_page_html() {
    // check user capabilities
    if (!current_user_can('manage_options')) {
        return;
    }
    ?>

 <div class="wrap">
    <?php settings_errors();?>
    <form method="POST" action="options.php">
        <?php settings_fields('my-settings-page');?>
        <?php do_settings_sections('my-settings-page')?>
        <?php submit_button();?>
    </form>
</div>
<?php
 

}
 