<?php
/*
Plugin Name: UCF College Multi Three Box
Description: Provides a shortcode for a Multi Three Box, to be used in the UCF Colleges Theme
Version: 1.9.0
Author: Stephen Schrauger
Plugin URI: https://github.com/schrauger/UCF-College-Multi-Three-Box
Github Plugin URI: schrauger/UCF-College-multi-three-box
*/

namespace ucf_college_multi_three_box;

if ( ! defined( 'WPINC' ) ) {
	die;
}

include plugin_dir_path( __FILE__ ) . 'includes/shortcode-taxonomy.php';
include plugin_dir_path( __FILE__ ) . 'includes/acf-pro-fields.php';
include plugin_dir_path( __FILE__ ) . 'includes/block.php';

// plugin css/js
add_action( 'enqueue_block_assets', __NAMESPACE__ . '\\add_css' );
add_action( 'enqueue_block_assets', __NAMESPACE__ . '\\add_js' );

// backwards compatibility
add_action('init', __NAMESPACE__ . '\\register_taxonomy');

// plugin activation hooks
register_activation_hook( __FILE__, __NAMESPACE__ . '\\activation' );
register_deactivation_hook( __FILE__, __NAMESPACE__ . '\\deactivation' );
register_uninstall_hook( __FILE__, __NAMESPACE__ . '\\deactivation' );


function add_css() {
	if ( file_exists( plugin_dir_path( __FILE__ ) . '/includes/plugin.css' ) ) {
		wp_enqueue_style(
			'ucf-college-multi-three-box-style',
			plugin_dir_url( __FILE__ ) . '/includes/plugin.css',
			false,
			filemtime( plugin_dir_path( __FILE__ ) . '/includes/plugin.css' ),
			false
		);
	}
}

function add_js() {
	if (is_admin()) {
		// only load this js on editor pages

		global $post;
		if ( has_shortcode( $post->post_content, block\shortcode_slug ) ) {
			// only load if the page has this legacy shortcode
			if ( file_exists( plugin_dir_path( __FILE__ ) . '/includes/plugin.js' ) ) {
				wp_enqueue_script(
					'ucf-college-multi-three-box-script',
					plugin_dir_url( __FILE__ ) . 'includes/plugin.js',
					array( 'jquery' ),
					filemtime( plugin_dir_path( __FILE__ ) . '/includes/plugin.js' ),
					true
				);
			}
		}
		if ( file_exists( plugin_dir_path( __FILE__ ) . 'includes/arrive.min.js' ) ) {
			wp_enqueue_script(
				'arrive',
				plugin_dir_url( __FILE__ ) . 'includes/arrive.min.js',
				array( 'jquery' ),
				filemtime( plugin_dir_path( __FILE__ ) . '/includes/arrive.min.js' ),
				false
			);
		}
		if ( file_exists( plugin_dir_path( __FILE__ ) . '/includes/plugin-editor-hide-taxonomy-if-unused.js' ) ) {
			wp_enqueue_script(
				'ucf-college-accordion-script-editor-hide-taxonomy-if-unused',
				plugin_dir_url( __FILE__ ) . 'includes/plugin-editor-hide-taxonomy-if-unused.js',
				array( 'jquery', 'arrive' ),
				filemtime( plugin_dir_path( __FILE__ ) . '/includes/plugin-editor-hide-taxonomy-if-unused.js' ),
				true
			);
		}
	}
}

function register_taxonomy() {
	\ucf_college_shortcode_taxonomy\create_taxonomy(acf_pro_fields\shortcode);
}


// run on plugin activation
function activation() {
	// insert the shortcode for this plugin as a term in the taxonomy

	sql_convert_incompatible_link();
}

// run on plugin deactivation
function deactivation() {
	//ucf_college_multi_three_box_shortcode::delete_shortcode_term();
}

// run on plugin complete uninstall
function uninstall() {
	//ucf_college_multi_three_box_shortcode::delete_shortcode_term();
}


/**
 * Runs a SQL UPDATE query. Modifies any uses of box_url that are actually ACF links.
 * Renames the fields to match with a newly added backwards compatible ACF field that references that data as an ACF link.
 * It keeps any existing references if the data type is actually an ACF url.
 * ACF url: just raw text that happens to be a link
 * ACF link: serialized object that has a link, link title, and optional action
 * Since we have separate fields for titles and other items, the link field was replaced in an early version of this plugin.
 * However, one site was already using an even earlier version with the incompatible data type.
 * @since 1.6.0
 * @return array|object|null
 */
function sql_convert_incompatible_link() {

	// replaces the following sql data:
	// # meta_id, post_id, meta_key, meta_value
	// '139147', '18', 'triple_box_row_0_box_1_box_url', 'a:3:{s:5:\"title\";s:0:\"\";s:3:\"url\";s:29:\"/academics/bachelors-degrees/\";s:6:\"target\";s:0:\"\";}'
	// '139438', '6937', '_triple_box_row_0_box_1_box_url', 'field_5c59f20c18316'


	// with this data:
	// # meta_id, post_id, meta_key, meta_value
	// '139147', '18', 'triple_box_row_0_box_1_box_link', 'a:3:{s:5:\"title\";s:0:\"\";s:3:\"url\";s:29:\"/academics/bachelors-degrees/\";s:6:\"target\";s:0:\"\";}'
	// '139438', '6937', '_triple_box_row_0_box_1_box_link', 'field_5c59f20c18316_old'

	// updates the end of the meta_key ("url" to "link") for both rows, and also updates the meta_value with the "field_" reference to add "_old" to the end.
	// Then this plugin has an extra ACF field that references the field_xyz_old field, and the box_link field.
	// This way, new data can be stored correctly in the box_url field that is used everywhere, with the correct new data type.


	global $wpdb;

	if ( function_exists( 'get_sites' ) && class_exists( 'WP_Site_Query' ) ) {
		// multisite detected. run query on all subsites.

		$original_blog_id = $wpdb->set_blog_id(0);

		// loop through each subsite
		$sites = get_sites();
		foreach ( $sites as $site ) {

			$wpdb->set_blog_id($site->blog_id); // sets sql prefix
			$wpdb->get_results(
				"
				UPDATE {$wpdb->postmeta} t1
				INNER JOIN {$wpdb->postmeta} t2 
				ON t2.meta_key = CONCAT('_', t1.meta_key)
				SET 
					t1.meta_key = REPLACE(t1.meta_key, 'url', 'link'),
					t2.meta_key = REPLACE(t2.meta_key, 'url', 'link'),
				    t2.meta_value = CONCAT(t2.meta_value, '_old')
				WHERE 
					t1.meta_key LIKE 'triple_box_row_%_box_url'
				    AND
				    t2.meta_key LIKE '_triple_box_row_%_box_url'
				    AND
				    t1.post_id = t2.post_id
				    AND
				    t1.meta_value like 'a:%'		
				"
			);
		}

		$wpdb->set_blog_id($original_blog_id); // after looping all sites, restore the blog id to the original

	} else {
		// not a multisite. Just run the query.
		$wpdb->get_results(
			"
			UPDATE {$wpdb->postmeta} t1
			INNER JOIN {$wpdb->postmeta} t2 
			ON t2.meta_key = CONCAT('_', t1.meta_key)
			SET 
				t1.meta_key = REPLACE(t1.meta_key, 'url', 'link'),
				t2.meta_key = REPLACE(t2.meta_key, 'url', 'link'),
			    t2.meta_value = CONCAT(t2.meta_value, '_old')
			WHERE 
				t1.meta_key LIKE 'triple_box_row_%_box_url'
			    AND
			    t2.meta_key LIKE '_triple_box_row_%_box_url'
			    AND
			    t1.post_id = t2.post_id
			    AND
			    t1.meta_value like 'a:%'		
			"
		);

	}



}




