<?php

/**
  ReduxFramework Sample Config File
  For full documentation, please visit: https://docs.reduxframework.com
 * */

if (!class_exists('mmenulite_Redux_Framework_config')) {

    class mmenulite_Redux_Framework_config {


        public $args        = array();
        public $sections    = array();
        public $theme;
        public $ReduxFramework;

        public function __construct() {

            if (!class_exists('ReduxFramework')) {
                return;
            }


            // This is needed. Bah WordPress bugs.  ;)
            if ( true == Redux_Helpers::isTheme( __FILE__ ) ) {
                $this->initSettings();
            } else {
                add_action('plugins_loaded', array($this, 'initSettings'), 10);
            }


        }


        public function initSettings() {


            // Just for demo purposes. Not needed per say.
            //$this->theme = wp_get_theme();


            // Set the default arguments
            $this->setArguments();

            // Set a few help tabs so you can see how it's done
            $this->setHelpTabs();

            // Create the sections and fields
            $this->setSections();


            if (!isset($this->args['opt_name'])) { // No errors please
                return;
            }


            // If Redux is running as a plugin, this will remove the demo notice and links
            add_action( 'redux/loaded', array( $this, 'remove_demo' ) );

            
            // Function to test the compiler hook and demo CSS output.
            // Above 10 is a priority, but 2 in necessary to include the dynamically generated CSS to be sent to the function.
            //add_filter('redux/options/'.$this->args['custom_css'].'/compiler', array( $this, 'compiler_action' ), 10, 2);

       
            // Change the arguments after they've been declared, but before the panel is created
            //add_filter('redux/options/'.$this->args['opt_name'].'/args', array( $this, 'change_arguments' ) );

            
            // Change the default value of a field after it's been set, but before it's been useds
            //add_filter('redux/options/'.$this->args['opt_name'].'/defaults', array( $this,'change_defaults' ) );
            

            // Dynamically add a section. Can be also used to modify sections/fields
            //add_filter('redux/options/' . $this->args['opt_name'] . '/sections', array($this, 'dynamic_section'));

            $this->ReduxFramework = new ReduxFramework($this->sections, $this->args);

        }



        /**


          This is a test function that will let you see when the compiler hook occurs.
          It only runs if a field	set with compiler=>true is changed.

         * */

        function compiler_action($options, $css) {
            //echo '<h1>The compiler hook has run!';
            //print_r($options); //Option values
            //print_r($css); // Compiler selector CSS values  compiler => array( CSS SELECTORS )


            /*

              // Demo of how to use the dynamic CSS and write your own static CSS file
              $filename = dirname(__FILE__) . '/style' . '.css';
              global $wp_filesystem;
              if( empty( $wp_filesystem ) ) {
                require_once( ABSPATH .'/wp-admin/includes/file.php' );
              WP_Filesystem();
              }



              if( $wp_filesystem ) {
                $wp_filesystem->put_contents(
                    $filename,
                    $css,
                    FS_CHMOD_FILE // predefined mode settings for WP files
                );
              }

             */

        }


        /**

          Custom function for filtering the sections array. Good for child themes to override or add to the sections.
          Simply include this function in the child themes functions.php file.


          NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
          so you must use get_template_directory_uri() if you want to use any of the built in icons


         * */

        function dynamic_section($sections) {

            //$sections = array();

            $sections[] = array(
                'title' => __('Section via hook', 'mmenulite'),
                'desc' => __('<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'mmenulite'),
                'icon' => 'el-icon-paper-clip',
                // Leave this as a blank section, no options just some intro text set above.
                'fields' => array()
            );


            return $sections;

        }


        /**

          Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.

         * */

        function change_arguments($args) {

            //$args['dev_mode'] = true;

            return $args;

        }


        /**

          Filter hook for filtering the default value of any given field. Very useful in development mode.

         * */

        function change_defaults($defaults) {

            $defaults['str_replace'] = 'Testing filter hook!';

            return $defaults;

        }


        // Remove the demo link and the notice of integrated demo from the redux-framework plugin
        function remove_demo() {


            // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
            if (class_exists('ReduxFrameworkPlugin')) {
                remove_filter('plugin_row_meta', array(ReduxFrameworkPlugin::instance(), 'plugin_metalinks'), null, 2);


                // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
                remove_action('admin_notices', array(ReduxFrameworkPlugin::instance(), 'admin_notices'));

            }

        }


        public function setSections() {


            /**

              Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples

             * */

            // Background Patterns Reader

            $sample_patterns_path   = ReduxFramework::$_dir . '../sample/patterns/';
            $sample_patterns_url    = ReduxFramework::$_url . '../sample/patterns/';
            $sample_patterns        = array();


            if (is_dir($sample_patterns_path)) :


                if ($sample_patterns_dir = opendir($sample_patterns_path)) :
                    $sample_patterns = array();


                    while (( $sample_patterns_file = readdir($sample_patterns_dir) ) !== false) {



                        if (stristr($sample_patterns_file, '.png') !== false || stristr($sample_patterns_file, '.jpg') !== false) {
                            $name = explode('.', $sample_patterns_file);
                            $name = str_replace('.' . end($name), '', $sample_patterns_file);
                            $sample_patterns[]  = array('alt' => $name, 'img' => $sample_patterns_url . $sample_patterns_file);

                        }

                    }

                endif;

            endif;




            $item_info = ob_get_contents();

            ob_end_clean();

            $sampleHTML = '';

            if (file_exists(dirname(__FILE__) . '/info-html.html')) {
                /** @global WP_Filesystem_Direct $wp_filesystem  */
                global $wp_filesystem;
                if (empty($wp_filesystem)) {
                    require_once(ABSPATH . '/wp-admin/includes/file.php');
                    WP_Filesystem();
                }
                $sampleHTML = $wp_filesystem->get_contents(dirname(__FILE__) . '/info-html.html');
            }

            // ACTUAL DECLARATION OF SECTIONS

            $this->sections[] = array(

                'title'     => __('General Settings', 'mmenulite'),
                'desc'      => __('Configure the settings for your mmenu', 'mmenulite'),
                'icon'      => 'el-icon-wrench',
                'fields'    => array(
                    array(
                    'id'       => 'header',
                    'type'     => 'switch', 
                    'title'    => __('Header', 'mmenulite'),
                    'subtitle' => __('Turn the header on or off', 'mmenulite'),
                    'default'  => false,
                    ),
                    array(
                    'id' => 'headertitle',
                    'type' => 'text',
                    'required' => array('header','equals','1'),
                    'title' => __('Header Title', 'mmenlite'),
                    'subtitle' => __('Enter your own header title', 'mmenulite'),
                    ),
                    array(
                    'id'       => 'counters',
                    'type'     => 'switch', 
                    'title'    => __('Counters', 'mmenulite'),
                    'subtitle' => __('Turn the counters on or off', 'mmenulite'),
                    'default'  => false,
                    ),
                    array(
                    'id'       => 'slidingsubmenus',
                    'type'     => 'switch', 
                    'title'    => __('Sliding Submenus', 'mmenulite'),
                    'subtitle' => __('Turn the sliding submenus on or off', 'mmenulite'),
                    'default'  => true,
                    ),
                    array(
                    'id'       => 'searchfield',
                    'type'     => 'switch', 
                    'title'    => __('Search Field', 'mmenulite'),
                    'subtitle' => __('Turn the search field on or off', 'mmenulite'),
                    'default'  => false,
                    ),

                ),

            );

            $this->sections[] = array(
                'title'     => __('Themes / Position', 'mmenulite'),
                'desc'      => __('Change the theme and styles of your mmenu', 'mmenulite'),
                'icon'      => 'el-icon-brush',
                'fields'    => array(
                    array(
                    'id'       => 'theme',
                    'type'     => 'select',
                    'title'    => __('Themes', 'mmenulite'), 
                    'subtitle' => __('Applies a general style to the menu', 'mmenulite'),
                    'desc'     => __('You can further customize the look with the CSS editor below', 'mmenulite'),
                    // Must provide key => value pairs for select options
                    'options'  => array(
                        'default' => 'default',
                        'mm-light' => 'mm-light',
                        'mm-black' => 'mm-black',
                        'mm-white' => 'mm-white'
                    ),
                    'default'  => 'default',
                    ),
                    array(
                    'id'       => 'position',
                    'type'     => 'select',
                    'title'    => __('Position', 'mmenulite'), 
                    'subtitle' => __('Designates where the menu should originate from', 'mmenulite'),
                    //'desc'     => __('This is the description field, again good for additional info.', 'mmenulite'),
                    // Must provide key => value pairs for select options
                    'options'  => array(
                        'left' => 'left',
                        'right' => 'right',
                        'top' => 'top',
                        'bottom' => 'bottom'
                    ),
                    'default'  => 'left',
                    ),
                    array(
                    'id'       => 'zposition',
                    'type'     => 'select',
                    'title'    => __('Z-Position', 'mmenulite'), 
                    'subtitle' => __('By default, the menu will always be positioned behind the page and slide the page out to the right', 'mmenulite'),
                    'desc'     => __('Note that position: "top" and position: "bottom" only work in combination with z-position: "front"', 'mmenulite'),
                    // Must provide key => value pairs for select options
                    'options'  => array(
                        'back' => 'back',
                        'front' => 'front',
                        'next' => 'next',
                    ),
                    'default'  => 'front',
                    ),

                ),

            );              


            if (file_exists(trailingslashit(dirname(__FILE__)) . 'README.html')) {

                $tabs['docs'] = array(
                    'icon'      => 'el-icon-book',
                    'title'     => __('Documentation', 'mmenulite'),
                    'content'   => nl2br(file_get_contents(trailingslashit(dirname(__FILE__)) . 'README.html'))
                );

            }

        }



        public function setHelpTabs() {


            // Custom page help tabs, displayed using the help API. Tabs are shown in order of definition.
            $this->args['help_tabs'][] = array(
                'id'        => 'mmenu-lite-help-tab-1',
                'title'     => __('Creating Menus', 'mmenulite'),
                'content'   => __('<p>WP MMenu Lite uses default menus (see Appearances -> Menus within your dashboard).  After you have created a new menu and added all your pages and hit the Create Menu button you will then need to assign the menu to the Mobile Menu location.  If you are lost and do not know how to create menus, see the <a target="_blank" href="http://codex.wordpress.org/WordPress_Menu_User_Guide">WordPress Menu User Guide</a></p>', 'mmenulite')
            );


            $this->args['help_tabs'][] = array(
                'id'        => 'mmenu-lite-help-tab-2',
                'title'     => __('Using the Shortcode', 'mmenulite'),
                'content'   => __('<p>Here are two examples of how you can use the shortcode: [mmenu]example[/mmenu] (within your page content) <strong>OR</strong> &lt;a href=&quot;#mmenu&quot;&gt;example&lt;/a&gt; These do the exact same thing, so if you want to incorporate this plugin into a theme you can do the latter in any template file and it should work. <a target="_blank" href="http://mmenu.frebsite.nl/tutorial/open-and-close-the-menu.html">Learn more here.</a></p>', 'mmenulite')
            ); 


            $this->args['help_tabs'][] = array(
                'id'        => 'mmenu-lite-help-tab-3',
                'title'     => __('Fixed Elements', 'mmenulite'),
                'content'   => __('<p>You can add the css class mm-fixed-top or mm-fixed-bottom to any HTML element to make it fixed or in other words to move along with the menu when it opens and closes. <a target="_blank" href="http://mmenu.frebsite.nl/tutorial/fixed-elements.html">Learn more here.</a></p>', 'mmenulite')
            ); 


            /* Set the help sidebar
            $this->args['help_sidebar'] = __('<p>This is the sidebar content, HTML is allowed.</p>', 'mmenulite'); */

        }


        /**


          All the possible arguments for Redux.
          For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments

         * */

        public function setArguments() {

            //$theme = wp_get_theme(); // For use with some settings. Not necessary.


            $this->args = array(
                'opt_name' => 'mmenulite',
                'display_name' => 'Mobile Menu Lite',
                'display_version' => '1.0.0',
                'page_slug' => 'mmenu_options_lite',
                'page_title' => 'Mobile Menu Lite',
                'menu_type' => 'submenu',
                'menu_title' => 'Mobile Menu Lite',
                'allow_sub_menu' => '1',
                'page_parent' => 'options-general.php',
                'page_parent_post_type' => 'your_post_type',
                'hints' => 
                array(
                  'icon' => 'el-icon-question-sign',
                  'icon_position' => 'right',
                  'icon_size' => 'normal',
                  'tip_style' => 
                  array(
                    'color' => 'dark',
                    'style' => 'bootstrap',
                  ),
                  'tip_position' => 
                  array(
                    'my' => 'top left',
                    'at' => 'left center',
                  ),
                  'tip_effect' => 
                  array(
                    'show' => 
                    array(
                      'effect' => 'fade',
                      'duration' => '500',
                      'event' => 'mouseover',
                    ),
                    'hide' => 
                    array(
                      'effect' => 'fade',
                      'duration' => '500',
                      'event' => 'mouseleave unfocus',
                    ),

                  ),

                ),

                'output' => '1',
                'global_variable' => 'mmenu_options_lite',
                'page_icon' => 'icon-themes',
                'page_permissions' => 'manage_options',
                'save_defaults' => '1',
                'show_import_export' => '0',
                'database' => 'options',
                'transient_time' => '3600',
                'network_sites' => '1',
              );

        }


    }
    

    global $reduxConfig;
    $reduxConfig = new mmenulite_Redux_Framework_config();

}


/**
  Custom function for the callback referenced above
 */

if (!function_exists('admin_folder_my_custom_field')):
    function admin_folder_my_custom_field($field, $value) {
        print_r($field);
        echo '<br/>';
        print_r($value);
    }

endif;


/**
  Custom function for the callback validation referenced above
 * */

if (!function_exists('admin_folder_validate_callback_function')):
    function admin_folder_validate_callback_function($field, $value, $existing_value) {
        $error = false;
        $value = 'just testing';

        /*
          do your validation


          if(something) {
            $value = $value;
          } elseif(something else) {
            $error = true;
            $value = $existing_value;
            $field['msg'] = 'your custom error message';
          }

         */

        $return['value'] = $value;
        if ($error == true) {
            $return['error'] = $field;
        }

        return $return;

    }

endif;
