<?php

class ucf_college_multi_three_box_shortcode {
	const shortcode_slug        = 'ucf_college_multi_three_box'; // the shortcode text entered by the user (inside square brackets)
	const shortcode_name        = 'Multi Three Box (deprecated - use blocks)';
	const shortcode_description = 'Deprecated. Tabbed sections with repeater list';

	//const get_param_group = 'people_group'; // group or category person is in

	function __construct() {

	}

	/**
	 * Adds the shortcode to wordpress' index of shortcodes
	 */
	static function add_shortcode() {
		if ( ! ( shortcode_exists( self::shortcode_slug ) ) ) {
			add_shortcode( self::shortcode_slug, array( 'ucf_college_multi_three_box_shortcode', 'replacement' ) );
		}
	}

	/**
	 * Adds the shortcode to the ckeditor dropdown menu
	 */
	static function add_ckeditor_shortcode( $shortcode_array ) {
		$shortcode_array[] = array(
			'slug'        => self::shortcode_slug,
			'name'        => self::shortcode_name,
			'description' => self::shortcode_description
		);

		return $shortcode_array;
	}

	/**
	 * Tells wordpress to listen for the 'people_group' parameter in the url. Used to filter down to specific profiles.
	 *
	 * @param $vars
	 *
	 * @return array
	 */
	static function add_query_vars_filter( $vars ) {
		//$vars[] = self::get_param_group;
		return $vars;
	}

	/**
	 * Returns the replacement html that WordPress uses in place of the shortcode
	 *
	 * @return mixed
	 */
	static function replacement() {
		switch ( get_field( 'style_selection' ) ) {

			case 'image': // style 1 - image boxes
				return self::replacement_image_boxes();
				break;
			case 'icon': // style 2 - small icon boxes
			default:
				return self::replacement_small_icon_boxes();

		}
	}

	static function replacement_print() {
		echo self::replacement();
	}


	/**
	 *
	 */
	static function replacement_image_boxes() {
		$replacement_data = ''; //string of html to return

		if ( have_rows( 'triple_box_row' ) ) {
			$header = get_field( 'header' );
			$replacement_data .= "
<div class='container'>
    <h2>{$header}</h2>
    <div class='grid-box'>";

			// print out each row of 3 boxes
			while ( have_rows( 'triple_box_row' ) ) {
				the_row();

				for ( $i = 1; $i <= 3; $i ++ ) {
					$acf_individual_box_group_id = 'box_' . $i;
					if ( have_rows( $acf_individual_box_group_id ) ) {

						// print out each individual box
						while ( have_rows( $acf_individual_box_group_id ) ) {
							the_row();
							$box_text             = get_sub_field( 'box_text' );

							$background_image_id = get_sub_field( 'background_image_id' );
							$size = 'large';
							$background_image = wp_get_attachment_image_src($background_image_id, $size);
							$background_image_url = $background_image[0];

							$box_url              = get_sub_field( 'box_url' );
							if ($box_url){
								$box_url_start = "<a 
							    class='{$acf_individual_box_group_id} inner-box' 
							    style='background-image: url(\"{$background_image_url}\")' 
							    href='{$box_url}'
							         >";
								$box_url_end = "</a>";
							} else {
								$box_url_start = "<div 
							    class='{$acf_individual_box_group_id} inner-box' 
							    style='background-image: url(\"{$background_image_url}\")' 
							         >";
								$box_url_end = "</div>";
							}
							$replacement_data .= "
    {$box_url_start}            
        <span>{$box_text}<i class=\"fa fa-arrow-right\"></i></span>
    {$box_url_end}";
						}
					}
				}


			}
			$replacement_data .= "
</div></div>";

		}

		return $replacement_data;
	}

	/**
	 *
	 */
	static function replacement_small_icon_boxes() {
		$replacement_data = ''; //string of html to return

		if ( have_rows( 'triple_box_row' ) ) {
			$header = get_field( 'header' );
			$replacement_data .= "
</div>
<div class='wide-box full-width'> <!-- break out of parent width restrictions -->
    <div class='container'>";

			// print out each row of 3 boxes
			while ( have_rows( 'triple_box_row' ) ) {
				the_row();

				for ( $i = 1; $i <= 3; $i ++ ) {
					$acf_individual_box_group_id = 'box_' . $i;
					if ( have_rows( $acf_individual_box_group_id ) ) {

						// print out each individual box
						while ( have_rows( $acf_individual_box_group_id ) ) {
							the_row();
							$box_text             = get_sub_field( 'box_text' );
							$box_url              = get_sub_field( 'box_url' );
							if ($box_url){
								$box_url_start = "<a href='{$box_url}'>";
								$box_url_end = "</a>";
							} else {
								$box_url_start = "";
								$box_url_end = "";
							}

							$background_image_id = get_sub_field( 'background_image_id' );
							$size = 'large';
							$background_image = wp_get_attachment_image_src($background_image_id, $size);
							$background_image_url = $background_image[0];

							$replacement_data .= "
        <div class='inner-box {$acf_individual_box_group_id}'>
            {$box_url_start}
                <img src='{$background_image_url}' />
                <br />
                <span>{$box_text}</span>
            {$box_url_end}
        </div>";
						}
					}
				}


			}
			$replacement_data .= "
    </div>
</div>
<div class='container mb-5 mt-3 mt-lg-5'>";

		}

		return $replacement_data;
	}


	/**
	 * Only run this on plugin activation, as it's stored in the database
	 */
	/*static function insert_shortcode_term() {
		$taxonomy = new ucf_college_shortcode_taxonomy;
		$taxonomy->create_taxonomy();
		wp_insert_term(
			self::shortcode_name,
			ucf_college_shortcode_taxonomy::taxonomy_slug,
			array(
				'description' => self::shortcode_description,
				'slug'        => self::shortcode_slug
			)
		);
	}*/

	/**
	 * Run when plugin is disabled and/or uninstalled. This removes the shortcode from the list of shortcodes in the
	 * taxonomy.
	 */
	/*static function delete_shortcode_term() {
		$taxonomy = new ucf_college_shortcode_taxonomy;
		$taxonomy->create_taxonomy();
		wp_delete_term( get_term_by( 'slug', self::shortcode_slug )->term_id, ucf_college_shortcode_taxonomy::taxonomy_slug );
	}*/


}

add_action( 'init', array( 'ucf_college_multi_three_box_shortcode', 'add_shortcode' ) );
add_filter( 'query_vars', array( 'ucf_college_multi_three_box_shortcode', 'add_query_vars_filter' ) ); // tell wordpress about new url parameters
//add_filter( 'ucf_college_shortcode_menu_item', array( 'ucf_college_multi_three_box_shortcode', 'add_ckeditor_shortcode' ) );

//new ucf_college_multi_three_box_shortcode();
