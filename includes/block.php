<?php

namespace ucf_college_multi_three_box\block;

/**
 * Returns the replacement html that WordPress uses in place of the shortcode
 *
 * @return mixed
 */
function replacement() {
	switch ( get_field( 'style_selection' ) ) {

		case 'image': // style 1 - image boxes
			return replacement_image_boxes();
			break;
		case 'icon': // style 2 - small icon boxes
		default:
			return replacement_small_icon_boxes();

	}
}

function replacement_print() {
	echo replacement();
}

const shortcode_slug        = 'ucf_college_multi_three_box'; // the shortcode text entered by the user (inside square brackets)
/**
 * Adds the shortcode to wordpress' index of shortcodes.
 * Deprecated, but kept for nursing until all pages use blocks.
 */
function add_shortcode() {
	if ( ! ( shortcode_exists( shortcode_slug ) ) ) {
		\add_shortcode( shortcode_slug, __NAMESPACE__ . '\\replacement' );
	}
}
add_action( 'init', __NAMESPACE__ . '\\add_shortcode' );


/**
 *
 */
function replacement_image_boxes() {
	$replacement_data = ''; //string of html to return

	if ( have_rows( 'triple_box_row' ) ) {
		$header           = get_field( 'header' );
		$replacement_data .= "
<div class='container'>
    <h2>{$header}</h2>
    <div class='grid-box'>";

		$row_count = 0;
		// print out each row of 3 boxes
		while ( have_rows( 'triple_box_row' ) ) {
			the_row();

			for ( $i = 1; $i <= 3; $i ++ ) {
				$acf_individual_box_group_id = 'box_' . $i;
				if ( have_rows( $acf_individual_box_group_id ) ) {

					// print out each individual box
					while ( have_rows( $acf_individual_box_group_id ) ) {
						the_row();
						$box_text = get_sub_field( 'box_text' );

						$background_image_id  = get_sub_field( 'background_image_id' );
						$size                 = 'large';
						$background_image     = wp_get_attachment_image_src( $background_image_id, $size );
						$background_image_url = $background_image[ 0 ];
						$box_url              = get_sub_field( 'box_url' );
						if (!$box_url){
							$box_url          = get_sub_field( 'box_link'); //@since 1.6.0
						}

						if ( $box_text || $background_image_url || $box_url ) {

							if ( $box_url ) {
								$replacement_data .= "
									<a
									class='{$acf_individual_box_group_id} inner-box' 
							    	style='background-image: url(\"{$background_image_url}\")' 
							    	href='{$box_url}'
							        >
							        	<span>{$box_text}<i class=\"fa fa-arrow-right\"></i></span>
				                    </a>
									";
							} else {
								$replacement_data .= "
									<div
									class='{$acf_individual_box_group_id} inner-box' 
							    	style='background-image: url(\"{$background_image_url}\")'
							        >
							        	<span>
							        		{$box_text}
					                    </span>
				                    </div>
									";
							}
						} else {
							// no data entered. put a blank box to fill in the space.
							$replacement_data .= "
								<div
								class='{$acf_individual_box_group_id} inner-box' 
						        
						        >
			                    </div>
								";
						}
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
function replacement_small_icon_boxes() {
	$replacement_data = ''; //string of html to return

	if ( have_rows( 'triple_box_row' ) ) {
		$header           = get_field( 'header' );
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
						$box_text = get_sub_field( 'box_text' );
						$box_url  = get_sub_field( 'box_url' );
						if ( $box_url ) {
							$box_url_start = "<a href='{$box_url}'>";
							$box_url_end   = "</a>";
						} else {
							$box_url_start = "";
							$box_url_end   = "";
						}

						$background_image_id  = get_sub_field( 'background_image_id' );
						$size                 = 'large';
						$background_image     = wp_get_attachment_image_src( $background_image_id, $size );
						$background_image_url = $background_image[ 0 ];

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


