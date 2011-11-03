<?php
    
    /*
    Plugin Name: 	WP-Blocks
    Plugin URI: 	http://www.keirwhitaker.com/projects/
    Description: 	Editable regions for use in WordPress templates
    Version: 		1.4
    Author: 		Keir Whitaker
    Author URI: 	http://www.keirwhitaker.com
    */

    // wp-blocks version
    $wpb_version = "1.4";

	// Register activation hooks and actions
    register_activation_hook(__FILE__, 'wpb_activation');
    register_deactivation_hook(__FILE__, 'wpb_deactivation');
 	
	// Admin actions
	add_action('admin_menu', 'wpb_admin_actions');
    add_action('admin_init', 'wp_blocks_admin_init');

	// Add TinyMCW (http://blog.imwd8solutions.com/wordpress/wordpress-plugin-development-add-editor-to-plugin-admin-page/#codesyntax_2, http://wordpress.org/support/topic/356788)
	add_filter('admin_head','show_tinyMCE');

	/**
	 * Display the wp-blocks version number
	 *
	 * @return void
	 * @author Keir Whitaker
	 */
	function get_version()
	{
		echo $wpb_version;
	}

	/**
	 * Adds all the relevant scripts for TinyMCE integration
	 *
	 * @return void
	 * @author Keir Whitaker
	 */
	function show_tinyMCE() {
		
		/* TODO: Tidy up the order of these function calls */
		
	    wp_enqueue_script( 'common' );
		wp_enqueue_script( 'jquery-color' );
	    wp_print_scripts('editor');
	    if (function_exists('add_thickbox')) add_thickbox();
	    wp_print_scripts('media-upload');
		wp_enqueue_script('word-count');
	    if (function_exists('wp_tiny_mce')) wp_tiny_mce();
	    wp_admin_css();
	    wp_enqueue_script('utils');
	    do_action("admin_print_styles-post-php");
	    do_action('admin_print_styles');
	    remove_all_filters('mce_external_plugins');
	}

   /**
    * Add the WP-Blocks menu item to the settings menu
    *
    * @return void
    * @author Keir Whitaker
    */
    function wpb_admin_actions() {
	    add_options_page("WP-Blocks", "WP-Blocks", 1, "wpb-admin", "wpb_admin");
	};
	
	/**
	 * Includes the base (and only) controller
	 *
	 * @return void
	 * @author Keir Whitaker
	 */
	function wpb_admin() {
	    include(WP_PLUGIN_DIR.'/wp-blocks/controllers/index.php');
	} 
	
	/**
	 * Display the wp-blocks js and css only in the admin area
	 *
	 * @return void
	 * @author Keir Whitaker
	 */	
	function wp_blocks_admin_init() {
		// JS
		wp_register_script('wpb-js', WP_PLUGIN_URL.'/wp-blocks/js/wp-blocks.js');
		wp_enqueue_script('wpb-js');
		// CSS
		wp_register_style('wpb-styles', WP_PLUGIN_URL.'/wp-blocks/css/style.css');
		wp_enqueue_style('wpb-styles');
	}

   /**
    * Install the database table on plugin activation
    * Also checks for the version to see if there's a DB delta
	*
    * @return void
    * @author Keir Whitaker
    */
    function wpb_activation() {
    	wpb_db_install($wpb_version);
    }

   /**
    * Drops the table on plugin deactivation 
    * TO DO: Do not delete table on deactivation
	*
    * @return void
    * @author Keir Whitaker
    */
    function wpb_deactivation() {
		// global $wpdb;
		// 	$sql = "DROP TABLE {$wpdb->prefix}wpb_content;";
		// 	$wpdb->query($sql);
    }

	/**
	 * Installs the wpb_content table into the db
	 *
	 * @param string $wpb_version 
	 * @return void
	 * @author Keir Whitaker
	 */
    function wpb_db_install($wpb_version) {
        global $wpdb;
        global $wpb_db_version;
        
        $table_name = $wpdb->prefix."wpb_content";

        if($wpdb->get_var("show tables like '$table_name'") != $table_name) {

            $sql =  "CREATE TABLE ".$table_name." (
    	            id mediumint(9) NOT NULL AUTO_INCREMENT,
					name text NOT NULL,
                	content text NOT NULL,
					html_prepend text NOT NULL,
					html_append text NOT NULL,
					revision mediumint(9) DEFAULT '0' NOT NULL,
					active INT DEFAULT '1',
					created_at DATETIME,
					updated_at DATETIME,
                	UNIQUE KEY id (id)
    	            );";

          require_once(ABSPATH.'wp-admin/includes/upgrade.php');
          dbDelta($sql);
          add_option("wpb_version", $wpb_version);
       };
    }       

	/**
	 * Decides if you are calling the block by id or name
	 * and calls the appropriate helper function
	 *
	 * @param string $block_identifier 
	 * @return void
	 * @author Keir Whitaker
	 */
	function get_wp_block($block_identifier) {
		if(is_int($block_identifier)) {
			get_wp_block_by_id($block_identifier);
		} else {
			get_wp_block_by_slug($block_identifier);
		};
	}
	
	/**
	 * Gets the block data by 'name'
	 *
	 * @param string $block_slug 
	 * @return string
	 * @author Keir Whitaker
	 */
	function get_wp_block_by_slug($block_slug) {
		global $wpdb;
		$block_slug = trim($block_slug);
		$data = (array)$wpdb->get_row("SELECT * FROM {$wpdb->prefix}wpb_content WHERE name = '{$block_slug}' AND active = TRUE");	
		if($data) echo get_wrapped_block_content($data);
	}

	/**
	 * Gets the block data by id
	 *
	 * @param string $block_id 
	 * @return string
	 * @author Keir Whitaker
	 */
	function get_wp_block_by_id($block_id) {
		global $wpdb;
		$data = (array)$wpdb->get_row("SELECT * FROM {$wpdb->prefix}wpb_content WHERE id = {$block_id} AND active = TRUE");	
		if($data) echo get_wrapped_block_content($data);
	}
	
	/**
	 * Returns the block plus any designated HTML wrappers
	 *
	 * @return string
	 * @author Keir Whitaker
	 **/
	function get_wrapped_block_content($data) {
		$block = wp_kses_stripslashes($data['html_prepend']).wp_kses_stripslashes($data['content']).wp_kses_stripslashes($data['html_append']);
		return do_shortcode($block);
	}

	// NOT YET IMPLEMENTED DASHBOARD WIDGET CODE (PLEASE DO NOT UNCOMMENT)
	// function example_dashboard_widget_function() {
	// 		include(WP_PLUGIN_DIR.'/wp-blocks/inc/wpblocks.class.php');
	// 		$a = new WPBlocks();
	// 		$a->dashboard();
	// 	} 
	// 
	// 	function example_add_dashboard_widgets() {
	// 		wp_add_dashboard_widget('example_dashboard_widget', 'WP-Blocks List', 'example_dashboard_widget_function');	
	// 	} 
	// 
	// 	add_action('wp_dashboard_setup', 'example_add_dashboard_widgets' );

?>