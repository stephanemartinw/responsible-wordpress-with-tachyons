<?php
/*Plugin Name: Wistiti
Plugin URI: http://www.stephanemartinw.com
Description: This plugin registers all necessary custom post types, shortcodes and overridable templates for the Wistiti prototype theme.
Version: 1.0
Author: Stéphane Martin
Author URI: http://www.stephanemartinw.com
License: GPLv2
*/

define('__ROOT__', dirname(__FILE__));

add_action('plugins_loaded', 'wistiti_init');
function wistiti_init() {
    load_plugin_textdomain( 'wistiti', false, dirname(plugin_basename(__FILE__)).'/languages/' );
}

/**
 * Locate template.
 *
 * Locate the called template.
 * Search Order:
 * 1. /themes/theme/plugins/$template_name
 * 2. /themes/theme/$template_name
 * 3. /plugins/wistiti/templates/$template_name.
 *
 * @since 1.0.0
 *
 * @param 	string 	$template_name			Template to load.
 * @param 	string 	$string $template_path	Path to templates.
 * @param 	string	$default_path			Default path to template files.
 * @return 	string 							Path to the template file.
 */
function wistiti_locate_template( $template_name, $template_path = '', $default_path = '' ) {

	// Set variable to search in plugins template folder of theme.
	if ( ! $template_path ) :
		$template_path = 'plugins/wistiti/';
	endif;

	// Set default plugin templates path.
	if ( ! $default_path ) :
		$default_path = plugin_dir_path( __FILE__ ) . 'templates/';
	endif;

	// Search template file in theme folder.
	$template = locate_template( array(
		$template_path . $template_name,
		$template_name
	) );

	// Get plugins template file.
	if ( ! $template ) :
		$template = $default_path . $template_name;
	endif;

	return apply_filters( 'wistiti_locate_template', $template, $template_name, $template_path, $default_path );
}

/**
 * Get template.
 *
 * Search for the template and include the file.
 *
 * @since 1.0.0
 *
 * @see wcpt_locate_template()
 *
 * @param string 	$template_name			Template to load.
 * @param array 	$args					Args passed for the template file.
 * @param string 	$string $template_path	Path to templates.
 * @param string	$default_path			Default path to template files.
 */
function wistiti_get_template( $template_name, $atts = array(), $tempate_path = '', $default_path = '' ) {
	if ( is_array( $atts ) && isset( $atts ) ) :
		extract( $atts );
	endif;

	$template_file = wistiti_locate_template( $template_name, $tempate_path, $default_path );
	if ( ! file_exists( $template_file ) ) :
		_doing_it_wrong( __FUNCTION__, sprintf( '<code>%s</code> does not exist.', $template_file ), '1.0.0' );
		return false;
	endif;

	include $template_file;

	return true;
}

class wistiti_settings
{
    /**
     * Holds the values to be used in the fields callbacks
     */

    private $options;

    /**
     * Start up
     */
    public function __construct()
    {
        add_action( 'admin_menu', array( $this, 'add_plugin_page' ) );
        add_action( 'admin_init', array( $this, 'page_init' ) );
    }

    /**
     * Add options page
     */
    public function add_plugin_page()
    {
        // This page will be under "Settings"
        add_options_page(
            'Settings Admin',
            'Wistiti Settings',
            'manage_options',
            'wistiti-setting-admin',
            array( $this, 'create_admin_page' )
        );
    }

    /**
     * Options page callback
     */
    public function create_admin_page()
    {
        // Set class property
        $this->options = get_option( 'wistiti_option_name' );
        ?>
        <div class="wrap">
            <h1>Custom Post Types Settings</h1>
            <form method="post" action="options.php">
            <?php
                // This prints out all hidden setting fields
                settings_fields( 'wistiti_option_group' );
                do_settings_sections( 'wistiti-setting-admin' );
                submit_button();
            ?>
            </form>
        </div>
        <?php
    }

    /**
     * Register and add settings
     */
    public function page_init()
    {
        register_setting(
            'wistiti_option_group', // Option group
            'wistiti_option_name', // Option name
            array( $this, 'sanitize' ) // Sanitize
        );

        add_settings_section(
            'setting_section_id', // ID
            'Custom Post Types Settings', // Title
            array( $this, 'print_section_info' ), // Callback
            'wistiti-setting-admin' // Page
        );

        add_settings_field(
            'includes', // ID
            'Include', // Title
            array( $this, 'includes_callback' ), // Callback
            'wistiti-setting-admin', // Page
            'setting_section_id' // Section
        );

    }

    /**
     * Sanitize each setting field as needed
     *
     * @param array $input Contains all settings fields as array keys
     */
    public function sanitize( $input )
    {
        $new_input = array();

        if( isset( $input['jumbotron'] ) )
            $new_input['jumbotron'] = true;

        if( isset( $input['service'] ) )
            $new_input['service'] = true ;

        if( isset( $input['team'] ) )
            $new_input['team'] = true ;

        if( isset( $input['faq'] ) )
            $new_input['faq'] = true ;

        if( isset( $input['contactform'] ) )
            $new_input['contactform'] = true ;

        return $new_input;
    }

    /**
     * Print the Section text
     */
    public function print_section_info()
    {
        print 'Enter your settings below:';
    }

    /**
     * Get the settings option array and print one of its values
     */
    public function includes_callback()
    {
        $options = get_option( 'wistiti_option_name' );

        $value = array("name" => "Post Types to include",
        	"desc" => "Select the pages you want to include. All pages are excluded by default",
        	"options" => array( "jumbotron"=>"Jumbotron",
                              "service"=>"Services",
                              "team"=>"Team",
                              "faq"=>"FAQs",
                              "contactform"=>"Simple Contact Form")
        );

        $markup='<ul>'."\n";
        foreach ($value['options'] as $option_value => $option) {
          $checked = " ";
          if ($option_value) {
            $checked = checked( 1, $options[$option_value], false );
          }
          $markup.="<li>\n";
          $markup.='<input type="checkbox" name="wistiti_option_name['.$option_value.']" value="true" '.$checked.' />'.$option."\n";
          $markup.="</li>\n";
        }
        $markup.= "</ul>\n";

        echo $markup;

    }

}

if( is_admin() )
    $wistiti_settings_page = new wistiti_settings();

$options = get_option('wistiti_option_name');
if ($options['jumbotron']) require_once(__ROOT__.'/types/jumbotron.php');
if ($options['service']) require_once(__ROOT__.'/types/service.php');
if ($options['team']) require_once(__ROOT__.'/types/team.php');
if ($options['faq']) {

	add_action('wp_enqueue_scripts','wistiti_enqueue_scripts');
	function wistiti_enqueue_scripts() {
	    wp_enqueue_script( 'wistiti-accordion', plugins_url( '/js/accordion.js', __FILE__ ), array());
	}

	require_once(__ROOT__.'/types/faq.php');

}
if ($options['contactform']) require_once(__ROOT__.'/modules/contact-form.php');
