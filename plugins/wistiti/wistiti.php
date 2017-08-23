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
define('__WISTITI__', 'wistiti');
define('__MY_WISTITI__', 'my-wistiti');

global $scripts;
$scripts=array(
  'grid' => false,
  'button' => false,
  'disclosure' => false
);

add_action('plugins_loaded', 'wistiti_init');
function wistiti_init() {
    load_plugin_textdomain( 'wistiti', false, dirname(plugin_basename(__FILE__)).'/languages/' );
}

/**
 * Locate template.
 * From wp's shortcode_atts function!
 */
function wistiti_atts( $pairs, $atts) {
    $atts = (array)$atts;
    $out = array();
    foreach ($pairs as $name => $default) {
        if ( array_key_exists($name, $atts) )
            $out[$name] = $atts[$name];
        else
            $out[$name] = $default;
    }

    return $out;
}

/**
 * Locate template.
 *
 * Locate the called template.
 * Search Order:
 * 1. /themes/theme/$template_name/wistiti
 * 2. /plugins/my-wistiti/templates/$template_name.
 * 3. /plugins/wistiti/templates/$template_name.
 *
 * @since 1.0.0
 *
 * @param 	string 	$template_name			Template to load.
 * @param 	string 	$string $template_path	Path to templates.
 * @param 	string	$default_path			Default path to template files.
 * @return 	string 							Path to the template file.
 */
function wistiti_locate_template( $template_name, $template_path = '', $default_path = '', $default_child_path = '' ) {

	// Set variable to search in plugins template folder of theme.
	if ( ! $template_path ) :
		$template_path = __WISTITI__ . '/';
	endif;

	// Set default plugin templates pathes.
  if ( ! $default_child_path ) :
    $default_child_path = plugin_dir_path( __DIR__ ) . __MY_WISTITI__. '/templates/';
  endif;

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
    //Check child plugin named 'mywistiti' (mandatory)
    if (!file_exists($default_child_path . $template_name)) $template = $default_path . $template_name;
    else $template =  $default_child_path . $template_name;

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
function wistiti_get_template( $template_name, $atts = array(), $template_path = '', $default_path = '',  $default_child_path = '' ) {
	if ( is_array( $atts ) && isset( $atts ) ) :
		extract( $atts );
	endif;

	$template_file = wistiti_locate_template( $template_name, $template_path, $default_path,$default_child_path );
	if ( ! file_exists( $template_file ) ) :
		_doing_it_wrong( __FUNCTION__, sprintf( '<code>%s</code> does not exist.', $template_file ), '1.0.0' );
		return false;
	endif;

	include $template_file;

	return true;
}

/*
* Get Partial template
* 1  = partials/type-taxonomy_value-display.php (includes parents values)
* 2  = partials/type-display.php
* 3  = partials/type-classic.php (default display)
*/
function wistiti_get_partial($atts) {
  $foundit = false;
  if (!empty($atts['tax_key']) && !empty($atts['tax_value'])) {

      $foundit = wistiti_get_template('/partials/'.$atts['type'].'-'.$atts['tax_value'].'-'.$atts['display'].'.php', $atts);
      if (!$foundit) {
        //Search for ancestors partials
        $taxonomy = $atts['type'].'-'.$atts['tax_key'];
        $child = get_term_by('slug', $atts['tax_value'], $taxonomy);
        $ancestors = get_ancestors($child->term_id, $taxonomy, 'taxonomy');
        if (!empty($ancestors)) {
          foreach ($ancestors as $ancestor) {
            $term= get_term($ancestor, $taxonomy);
              if (wistiti_get_template('/partials/'.$atts['type'].'-'.$term->slug.'-'.$atts['display'].'.php', $atts)) {
                $foundit = true;
                break;
              }
          }
        }
      }
  }

  if (!$foundit) $foundit = wistiti_get_template('partials/'.$atts['type'].'-'.$atts['display'].'.php', $atts);
  if (!$foundit) $foundit = wistiti_get_template('partials/'.$atts['type'].'-media.php', $atts);

  return $foundit;
}

function wistiti_get_customizer($atts, $is_partial = false, $default_customizer_path = '') {

  $foundit=false;
  $pathes = array();

  // Set default plugin templates pathes.
  if ( ! $default_customizer_path ) {
    if (!$is_partial) $default_customizer_path = 'customizers/';
    else $default_customizer_path = 'partials/customizers/';
  }

  if (!$is_partial) {
    $pathes[]=$default_customizer_path.$atts['layout'].'-customizer.php';
    $pathes[] = $default_customizer_path . $atts['type'].'-'.$atts['layout'].'-customizer.php';
  }
  else {
    $pathes[]=$default_customizer_path . $atts['type'].'-'.$atts['display'].'-customizer.php';

    if (!empty($atts['tax_value']))
      $pathes[] = $default_customizer_path . $atts['type'].'-'.$atts['tax_value'].'-'.$atts['display'].'-customizer.php';
  }

  foreach ($pathes as $path) {
    if (wistiti_get_template($path)) $foundit=true;
  }

  return $foundit;
}

class wistiti_settings
{
    /**
     * Holds the values to be used in the fields callbacks
     */

    private $options;
    private $scripts;

    /**
     * Start up
     */
    public function __construct($scripts)
    {
        $this->scripts = $scripts;

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
        register_setting('wistiti_settings_group','wistiti_scripts_name', array( $this, 'sanitize' ));
        register_setting('wistiti_settings_group','wistiti_scripts_onpage', array( $this, 'sanitize' ));
        register_setting('wistiti_settings_group','wistiti_modules_name', array( $this, 'sanitize' ));
        register_setting('wistiti_settings_group','wistiti_tools', array( $this, 'sanitize' ));

        add_settings_section(
            'wistiti_section_general', // ID
            'Wistiti Settings', // Title
            array( $this, 'print_section_info' ), // Callback
            'wistiti-setting-admin' // Page
        );

        //Scripts management
        add_settings_field(
            'scripts', // ID
            'Scripts', // Title
            array( $this, 'scripts_callback' ), // Callback
            'wistiti-setting-admin', // Page
            'wistiti_section_general' // Section
        );

        //Modules management
        add_settings_field(
            'modules', // ID
            'Modules', // Title
            array( $this, 'modules_callback' ), // Callback
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

        //Scripts
        foreach ($this->scripts as $script => $script_value) {
          if( isset( $input[$script] ) )
              $new_input[$script] = true;
          if( isset( $input[$script.'_onpage'] ) )
              $new_input[$script.'_onpage'] = sanitize_text_field($input[$script.'_onpage']) ;
        }

        //Modules
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
    public function scripts_callback()
    {
        $includes = get_option( 'wistiti_scripts_name' );
        $onpages = get_option( 'wistiti_scripts_onpage' );

        $value = array("name" => "Scripts to include",
        	"desc" => "Select the scripts you want to include. All pages are excluded by default",
        	"scripts" => array( "button"=>"button.js",
                              "grid"=>"grid.js",
                              "disclosure"=>"disclosure.js")
        );

        $markup='<ul>'."\n";
        foreach ($value['scripts'] as $script_value => $script) {
          $checked = " ";
          if ($script_value) {
            $checked = checked( 1, $includes[$script_value], false );
          }
          $markup.="<li>\n";
          $markup.='<input type="checkbox" name="wistiti_scripts_name['.$script_value.']" value="true" '.$checked.' />'.$script."\n";

          $markup .= '<label>'.__('on page(s): ', 'wistiti').'</label>';
          $markup .= '<input type="text" name="wistiti_scripts_onpage['.$script_value.'_onpage]" value="'.$onpages[$script_value.'_onpage'].'"></input>';

          $markup.="</li>\n";
        }
        $markup.= "</ul>\n";

        echo $markup;
    }

    /**
     * Get the settings option array and print one of its values
     */
    public function modules_callback()
    {
        $modules = get_option( 'wistiti_modules_name' );
        $onpages = get_option( 'wistiti_modules_onpage' );

        $value = array("name" => "Modules to include",
          "desc" => "Select the modules you want to include. All pages are excluded by default",
          "modules" => array( "contactform"=>"Simple Contact form")
        );

        $markup='<ul>'."\n";
        foreach ($value['modules'] as $module_value => $module) {
          $checked = " ";
          if ($module_value) {
            $checked = checked( 1, $modules[$module_value], false );
          }
          $markup.="<li>\n";
          $markup.='<input type="checkbox" name="wistiti_include_name['.$module_value.']" value="true" '.$checked.' />'.$module."\n";

          $markup .= '<label>'.__('on page(s): ', 'wistiti').'</label>';
          $markup .= '<input type="text" name="wistiti_include_onpage['.$module_value.'_onpage]" value="'.$onpages[$module_value.'_onpage'].'"></input>';

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
      $tools = get_option( 'wistiti_tools' );

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
    $wistiti_settings_page = new wistiti_settings($scripts);

//General scripts
add_action('wp_enqueue_scripts','wistiti_enqueue_scripts');
function wistiti_enqueue_scripts() {

  //Set scripts configuration before...
  /*$scriptsperelement=array (
    'element' => 'utils', // + disclosure grid button ?
    //'news' => 'utils grid',
    //'team' => 'utils grid',
    'contactform' => 'button'
  );*/
  global $scripts;

  $includescripts = get_option('wistiti_scripts_name');
  $onpages = get_option('wistiti_scripts_onpage');

  foreach ($scripts as $script => $script_value) {
    $pages_list = $onpages[$script.'_onpage'];
    $pages_list = preg_replace('/\s+/', '', $pages_list);
    if (isset($includescripts[$script]) && $includescripts[$script]) {
      if (!empty($pages_list)) {
        $pages = explode(',', $pages_list);

        //Convert ids to int if necessary
        /*foreach ($pages as $index => $page) {
          if((string)(int)$page == $page) {
            $pages[$index] = intval($page);
          }
        }*/

        if (is_page($pages) || (is_front_page() && in_array('front', $pages)) ) {
          $scripts[$script] = true;

          /*if (!empty($jss_list)) {
            $jss = explode(' ', $jss_list);
            foreach ($jss as $js) {
               $scripts[$js]= true;
            }
          }*/
        }
      }
      else {
      //No pages list given...script is included on all pages ?
        $scripts[$script] = true;
      }
    }
  }

  if ($scripts['grid'])
    wp_enqueue_script( 'wistiti-utils', plugins_url( '/js/utils.js', __FILE__ ), array());
  if ($scripts['grid']) wp_enqueue_script( 'wistiti-grid', plugins_url( '/js/grid.js', __FILE__ ), array('wistiti-utils'));
  if ($scripts['button']) wp_enqueue_script( 'wistiti-button', plugins_url( '/js/button.js', __FILE__ ), array());
  if ($scripts['disclosure']) wp_enqueue_script( 'wistiti-disclosure', plugins_url( '/js/disclosure.js', __FILE__ ), array());
}

/* We add here php classes to be replaced before returning markup ! */
add_filter('next_posts_link_attributes', 'wistiti_posts_link_next_attributes');
add_filter('previous_posts_link_attributes', 'wistiti_posts_link_previous_attributes');
function wistiti_posts_link_previous_attributes() {
    return 'class="php-posts-navigation-previous"';
}
function wistiti_posts_link_next_attributes() {
    return 'class="php-posts-navigation-next"';
}

//Tools
function wistiti_split_string_inarray($string) {
  return preg_split('/\s+/', $string);
}

function wistiti_split_string_instrings($classes) {
  $classes_array = wistiti_split_string_inarray($classes);

  $list='';
  $index=1;
  foreach ($classes_array as $class) {

    $list.='"'.$class.'"';
    if ($index<count($classes_array)) $list.=' , ';

    $index++;
  }

  return $list;
}

//General requirements
require_once(__ROOT__.'/types/element.php');
require_once(__ROOT__.'/inc/template-tags.php');
require_once(__ROOT__.'/shortcodes/wistiti.php');

require_once(__ROOT__.'/widgets/text.php');

//Tools
$tools = get_option('wistiti_tool');
if ($tools['seo']) require_once(__ROOT__.'/tools/seo.php');
if ($tools['sitemap']) require_once(__ROOT__.'/tools/sitemap.php');
if ($tools['ga'])require_once(__ROOT__.'/tools/ga.php');

//Optional requirements
//$includes = get_option('wistiti_include_name');
//if ($includes['element']) require_once(__ROOT__.'/types/element.php');
//if ($includes['news']) require_once(__ROOT__.'/types/news.php');
//if ($includes['team']) require_once(__ROOT__.'/types/team.php');

//Optional modules
$modules = get_option('wistiti_module_name');
if ($modules['contactform']) require_once(__ROOT__.'/modules/contact-form.php');

//unset($scripts);
unset($tools);
unset($modules);
