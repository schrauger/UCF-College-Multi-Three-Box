<?php
/*
Plugin Name: UCF College Multi Three Box
Description: Provides a shortcode for a Multi Three Box, to be used in the UCF Colleges Theme
Version: 0.0.1
Author: Stephen Schrauger
Plugin URI: https://github.com/schrauger/UCF-College-multi-three-box
Github Plugin URI: schrauger/UCF-College-multi-three-box
*/
if ( ! defined( 'WPINC' ) ) {
    die;
}

include plugin_dir_path( __FILE__ ) . 'includes/tinymce.php';
include plugin_dir_path( __FILE__ ) . 'includes/shortcode-taxonomy.php';
include plugin_dir_path( __FILE__ ) . 'includes/ucf-college-multi-three-box-shortcode.php';
include plugin_dir_path( __FILE__ ) . 'includes/acf-pro-fields.php';

class ucf_college_multi_three_box {
    function __construct() {
        // plugin css/js
        add_action('wp_enqueue_scripts', array($this, 'add_css'));
        add_action('wp_enqueue_scripts', array($this, 'add_js'));

        // plugin activation hooks
        register_activation_hook( __FILE__, array($this,'activation'));
        register_deactivation_hook( __FILE__, array($this,'deactivation'));
        register_uninstall_hook( __FILE__, array($this,'deactivation'));
    }

    function add_css(){
        wp_enqueue_style(
            'ucf-college-multi-three-box-style',
            plugin_dir_url(__FILE__) . '/includes/plugin.css',
            false,
            filemtime( plugin_dir_path(__FILE__).'/includes/plugin.css'),
            false
        );
    }

    function add_js(){

        wp_enqueue_script(
            'ucf-college-multi-three-box-script',
            plugin_dir_url(__FILE__) . 'includes/plugin.js',
            false,
            filemtime( plugin_dir_path(__FILE__).'/includes/plugin.js'),
            false
        );
    }
    
    


    // run on plugin activation
    function activation(){
        // insert the shortcode for this plugin as a term in the taxonomy
        ucf_college_multi_three_box_shortcode::insert_shortcode_term();
    }

    // run on plugin deactivation
    function deactivation(){
        ucf_college_multi_three_box_shortcode::delete_shortcode_term();
    }

    // run on plugin complete uninstall
    function uninstall(){
        ucf_college_multi_three_box_shortcode::delete_shortcode_term();
    }
}

new ucf_college_multi_three_box();



