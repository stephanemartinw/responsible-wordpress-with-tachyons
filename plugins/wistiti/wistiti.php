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
        register_setting('wistiti_settings_group','wistiti_include_onpage', array( $this, 'sanitize' ));
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
        if( isset( $input['block_onpage'] ) )
            $new_input['block_onpage'] = sanitize_text_field($input['block_onpage']) ;

        if( isset( $input['service'] ) )
            $new_input['service'] = true ;
        if( isset( $input['service_onpage'] ) )
            $new_input['service_onpage'] = sanitize_text_field($input['service_onpage']) ;

        if( isset( $input['news'] ) )
            $new_input['news'] = true ;
        if( isset( $input['news_onpage'] ) )
            $new_input['news_onpage'] = sanitize_text_field($input['news_onpage']) ;

        if( isset( $input['team'] ) )
            $new_input['team'] = true ;
        if( isset( $input['team_onpage'] ) )
            $new_input['team_onpage'] = sanitize_text_field($input['team_onpage']) ;

        if( isset( $input['contactform'] ) )
            $new_input['contactform'] = true ;
        if( isset( $input['contactform_onpage'] ) )
            $new_input['contactform_onpage'] = sanitize_text_field($input['contactform_onpage']) ;


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
        $onpages = get_option( 'wistiti_include_onpage' );

        $value = array("name" => "Post Types to include",
        	"desc" => "Select the pages you want to include. All pages are excluded by default",
        	"includes" => array( "block"=>"Block",
                              "service"=>"Services",
                              "news"=>"News",
                              "team"=>"Team",
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

          $markup .= '<label>'.__('on page(s): ', 'wistiti').'</label>';
          $markup .= '<input type="text" name="wistiti_include_onpage['.$include_value.'_onpage]" value="'.$onpages[$include_value.'_onpage'].'"></input>';

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

  //Set scripts configuration before...
  $scriptsperelement=array (
    'block' => 'disclosure button',
    'service' => 'utils grid',
    'news' => 'utils grid',
    'team' => 'utils grid',
    'contactform' => 'button'
  );
  $scripts=array(
    'utils' => false,
    'grid' => false,
    'button' => false,
    'disclosure' => false
  );
  $onpages = get_option('wistiti_include_onpage');

  foreach ($scriptsperelement as $element => $jss_list) {
    $pages_list = $onpages[$element.'_onpage'];
    $pages_list = preg_replace('/\s+/', '', $pages_list);
    if (!empty($pages_list)) {
      $pages = explode(',', $pages_list);

      //Convert ids to int if necessary
      /*foreach ($pages as $index => $page) {
        if((string)(int)$page == $page) {
          $pages[$index] = intval($page);
        }
      }*/

      if (is_page($pages) || (is_front_page() && in_array('front', $pages)) ) {
        if (!empty($jss_list)) {
          $jss = explode(' ', $jss_list);
          foreach ($jss as $js) {
             $scripts[$js]= true;
          }
        }
      }
    }
  }

  if ($scripts['utils']) wp_enqueue_script( 'wistiti-utils', plugins_url( '/js/utils.js', __FILE__ ), array());
  if ($scripts['grid']) wp_enqueue_script( 'wistiti-grid', plugins_url( '/js/grid.js', __FILE__ ), array('wistiti-utils'));
  if ($scripts['button']) wp_enqueue_script( 'wistiti-button', plugins_url( '/js/button.js', __FILE__ ), array());
  if ($scripts['disclosure']) wp_enqueue_script( 'wistiti-disclosure', plugins_url( '/js/disclosure.js', __FILE__ ), array());
}

//For pagination :
//Solution 1: use a filter here
add_filter('next_posts_link_attributes', 'posts_link_attributes');
add_filter('previous_posts_link_attributes', 'posts_link_attributes');

function posts_link_attributes() {
    return 'class="link underline"';
}
//Solution 2: override the function to pass arguments...
function wistiti_get_previous_posts_link( $label = null, $args = null ) {
    global $paged;

    if ( null === $label )
        $label = __( '&laquo; Previous Page' );

    if ( !is_single() && $paged > 1 ) {
        $attr = apply_filters( 'previous_posts_link_attributes', '' );

        $classes='';
        if (isset($args['classes'])) $classes = $args['classes'];
        return '<a class="'.$classes.'" href="' . previous_posts( false ) . "\" $attr>". preg_replace( '/&([^#])(?![a-z]{1,8};)/i', '&#038;$1', $label ) .'</a>';
    }
}

function wistiti_get_next_posts_link( $label = null, $max_page = 0, $args = null ) {
    global $paged, $wp_query;

    if ( !$max_page )
        $max_page = $wp_query->max_num_pages;

    if ( !$paged )
        $paged = 1;

    $nextpage = intval($paged) + 1;

    if ( null === $label )
        $label = __( 'Next Page &raquo;' );

    if ( !is_single() && ( $nextpage <= $max_page ) ) {
        $attr = apply_filters( 'next_posts_link_attributes', '' );

        $classes='';
        if (isset($args['classes'])) $classes = $args['classes'];

        return '<a class="'.$classes.'" href="' . next_posts( $max_page, false ) . "\" $attr>" . preg_replace('/&([^#])(?![a-z]{1,8};)/i', '&#038;$1', $label) . '</a>';
    }
}

//General requirements
$tools = get_option('wistiti_tool');
if ($tools['seo']) require_once(__ROOT__.'/tools/seo.php');
if ($tools['sitemap']) require_once(__ROOT__.'/tools/sitemap.php');
if ($tools['ga'])require_once(__ROOT__.'/tools/ga.php');

//Optional requirements
$includes = get_option('wistiti_include_name');
if ($includes['block']) require_once(__ROOT__.'/types/block.php');
if ($includes['service']) require_once(__ROOT__.'/types/service.php');
if ($includes['news']) require_once(__ROOT__.'/types/news.php');
if ($includes['team']) require_once(__ROOT__.'/types/team.php');

if ($includes['contactform']) require_once(__ROOT__.'/modules/contact-form.php');

require_once(__ROOT__.'/shortcodes/wistiti.php');
require_once(__ROOT__.'/widgets/text.php');

unset($onpages);
unset($scriptsperelement);
unset($jss);
unset($tools);
unset($includes);
