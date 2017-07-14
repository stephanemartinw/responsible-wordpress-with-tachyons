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
        ?>
        <div class="wrap">
            <h1>Wititi Settings</h1>
            <form method="post" action="options.php">
            <?php
                // This prints out all hidden setting fields
                settings_fields( 'wistiti_settings_group' );
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
        register_setting('wistiti_settings_group','wistiti_include_name', array( $this, 'sanitize' ));
        register_setting('wistiti_settings_group','wistiti_tool', array( $this, 'sanitize' ));

        add_settings_section(
            'wistiti_section_general', // ID
            'Wistiti Settings', // Title
            array( $this, 'print_section_info' ), // Callback
            'wistiti-setting-admin' // Page
        );

        //Includes management
        add_settings_field(
            'includes', // ID
            'Includes', // Title
            array( $this, 'includes_callback' ), // Callback
            'wistiti-setting-admin', // Page
            'wistiti_section_general' // Section
        );

        //Tools management
        add_settings_field(
            'tools', // ID
            'Tools', // Title
            array( $this, 'tools_callback' ), // Callback
            'wistiti-setting-admin', // Page
            'wistiti_section_general' // Section
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

        //Includes
        if( isset( $input['block'] ) )
            $new_input['block'] = true;

        if( isset( $input['service'] ) )
            $new_input['service'] = true ;

        if( isset( $input['news'] ) )
            $new_input['news'] = true ;

        if( isset( $input['team'] ) )
            $new_input['team'] = true ;

        /*if( isset( $input['faq'] ) )
            $new_input['faq'] = true ;*/

        if( isset( $input['contactform'] ) )
            $new_input['contactform'] = true ;

        //Tools
        if( isset( $input['ga'] ) )
            $new_input['ga'] = true ;

        if( isset( $input['seo'] ) )
            $new_input['seo'] = true ;

        if( isset( $input['sitemap'] ) )
            $new_input['sitemap'] = true ;

        if( isset( $input['ga_code'] ) )
            $new_input['ga_code'] = sanitize_text_field($input['ga_code']) ;

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
        $includes = get_option( 'wistiti_include_name' );

        $value = array("name" => "Post Types to include",
        	"desc" => "Select the pages you want to include. All pages are excluded by default",
        	"includes" => array( "block"=>"Block",
                              "service"=>"Services",
                              "news"=>"News",
                              "team"=>"Team",
                              //"faq"=>"FAQs",
                              "contactform"=>"Contact Form")
        );

        $markup='<ul>'."\n";
        foreach ($value['includes'] as $include_value => $include) {
          $checked = " ";
          if ($include_value) {
            $checked = checked( 1, $includes[$include_value], false );
          }
          $markup.="<li>\n";
          $markup.='<input type="checkbox" name="wistiti_include_name['.$include_value.']" value="true" '.$checked.' />'.$include."\n";
          $markup.="</li>\n";
        }
        $markup.= "</ul>\n";

        echo $markup;

    }

    /**
     * Get the settings option array and print one of its values
     */
    public function tools_callback()
    {
      $tools = get_option( 'wistiti_tool' );

      $value = array("name" => "Tools to activate",
        "desc" => "Select the tools you want to include. All tools are excluded by default",
        "tools" => array( "ga"=>"Google Analytics",
                          "seo"=>"SEO",
                          "sitemap"=>"Sitemap")
      );

      $markup='<ul>'."\n";
      foreach ($value['tools'] as $tool_value => $tool) {
        $checked = " ";
        if ($tool_value) {
          $checked = checked( 1, $tools[$tool_value], false );
        }
        $markup.="<li>\n";
        $markup.='<input type="checkbox" name="wistiti_tool['.$tool_value.']" value="true" '.$checked.' />'.$tool."\n";
        $markup.="</li>\n";
      }
      $markup.= "</ul>\n";

      $markup .= '<label>'.__('GA code: ', 'wistiti').'</label>';
      $markup .= '<input type="text" name="wistiti_tool[ga_code]" value="'.$tools['ga_code'].'"></input>';

      echo $markup;
    }

}

if( is_admin() )
    $wistiti_settings_page = new wistiti_settings();

//General scripts
add_action('wp_enqueue_scripts','wistiti_enqueue_scripts');
function wistiti_enqueue_scripts() {
    wp_enqueue_script( 'wistiti-utils', plugins_url( '/js/utils.js', __FILE__ ), array());
    wp_enqueue_script( 'wistiti-grid', plugins_url( '/js/grid.js', __FILE__ ), array());
    wp_enqueue_script( 'wistiti-button', plugins_url( '/js/button.js', __FILE__ ), array());
}

//General requirements
$tools = get_option('wistiti_tool');
if ($tools['seo']) require_once(__ROOT__.'/tools/seo.php');
if ($tools['sitemap']) require_once(__ROOT__.'/tools/sitemap.php');
if ($tools['ga'])require_once(__ROOT__.'/tools/ga.php');

//Optional requirements
$includes = get_option('wistiti_include_name');
if ($includes['block']) {
  add_action('wp_enqueue_scripts','wistiti_disclosure_enqueue_scripts');
	function wistiti_disclosure_enqueue_scripts() {
      wp_enqueue_script( 'wistiti-disclosure', plugins_url( '/js/disclosure.js', __FILE__ ), array());
	}
  require_once(__ROOT__.'/types/block.php');
}
if ($includes['service']) require_once(__ROOT__.'/types/service.php');
if ($includes['news']) require_once(__ROOT__.'/types/news.php');
if ($includes['team']) require_once(__ROOT__.'/types/team.php');
/*if ($includes['faq']) {

	add_action('wp_enqueue_scripts','wistiti_faq_enqueue_scripts');
	function wistiti_faq_enqueue_scripts() {
      wp_enqueue_script( 'wistiti-disclosure', plugins_url( '/js/disclosure.js', __FILE__ ), array());
	}

	require_once(__ROOT__.'/types/faq.php');

}*/
if ($includes['contactform']) require_once(__ROOT__.'/modules/contact-form.php');

require_once(__ROOT__.'/shortcodes/wistiti.php');
require_once(__ROOT__.'/widgets/text.php');
