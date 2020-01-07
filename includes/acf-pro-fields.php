<?php

/**
 * Created by PhpStorm.
 * User: stephen
 * Date: 2019-02-01
 * Time: 1:47 PM
 */
class ucf_college_multi_three_box_acf_pro_fields {

    const shortcode = 'ucf_college_multi_three_box';

    function __construct() {
        add_action( 'acf/init', array( 'ucf_college_multi_three_box_acf_pro_fields', 'create_fields' ) );
    }

    static function create_fields() {

	    // check function exists
	    if( function_exists('acf_register_block') ) {
		    // register a testimonial block
		    acf_register_block(array(
			                       'name'				=> 'ucf_college_multi_three_box',
			                       'title'				=> __('Multi Three Box'),
			                       'description'		=> __('Three square boxes in a row with multiple row ability.'),
			                       'render_callback'	=> array('ucf_college_multi_three_box_shortcode','replacement_print'),
			                       'category'			=> 'formatting',
			                       'icon'				=> 'admin-comments',
			                       'keywords'			=> array( 'testimonial', 'quote' ),
		                       ));
	    }

        if ( function_exists( 'acf_add_local_field_group' ) ) {
            acf_add_local_field_group(
                array(
                    'key'                   => 'group_5c59f155c5f05',
                    'title'                 => 'Multi Three Box',
                    'fields'                => array(
                        array(
                            'key' => 'field_5c6332a0be8d8',
                            'label' => 'Box Style',
                            'name' => 'style_selection',
                            'type' => 'select',
                            'instructions' => '',
                            'required' => 0,
                            'conditional_logic' => 0,
                            'wrapper' => array(
                                'width' => '',
                                'class' => '',
                                'id' => '',
                            ),
                            'choices' => array(
                                'image' => 'Image Boxes',
                                'icon' => 'Icon Boxes',
                            ),
                            'default_value' => array(
                                0 => 'image',
                            ),
                            'allow_null' => 0,
                            'multiple' => 0,
                            'ui' => 1,
                            'ajax' => 0,
                            'return_format' => 'value',
                            'placeholder' => '',
                        ),
                        array(
                            'key'               => 'field_5c59f2f12fd06',
                            'label'             => 'Header',
                            'name'              => 'header',
                            'type'              => 'text',
                            'instructions'      => '',
                            'required'          => 0,
                            'conditional_logic' => array(
                                array(
                                    array(
                                        'field' => 'field_5c6332a0be8d8', // only show 'header' field if style is 'image' ('icon' doesn't use header text)
                                        'operator' => '==',
                                        'value' => 'image',
                                    ),
                                ),
                            ),
                            'wrapper'           => array(
                                'width' => '',
                                'class' => '',
                                'id'    => '',
                            ),
                            'default_value'     => '',
                            'placeholder'       => '',
                            'prepend'           => '',
                            'append'            => '',
                            'maxlength'         => '',
                        ),
                        array(
                            'key'               => 'field_5c59f15ac5579', // if this key is changed, modify the scss rule that matches
                            'label'             => 'Triple Box Row',
                            'name'              => 'triple_box_row',
                            'type'              => 'repeater',
                            'instructions'      => '',
                            'required'          => 0,
                            'conditional_logic' => 0,
                            'wrapper'           => array(
                                'width' => '',
                                'class' => '',
                                'id'    => '',
                            ),
                            'collapsed'         => '',
                            'min'               => 1,
                            'max'               => 0,
                            'layout'            => 'block',
                            'button_label'      => '',
                            'sub_fields'        => array(
                                array(
                                    'key'               => 'field_5c59f1de18314',
                                    'label'             => 'Box 1',
                                    'name'              => 'box_1',
                                    'type'              => 'group',
                                    'instructions'      => '',
                                    'required'          => 0,
                                    'conditional_logic' => 0,
                                    'wrapper'           => array(
                                        'width' => '',
                                        'class' => '',
                                        'id'    => '',
                                    ),
                                    'layout'            => 'block',
                                    'sub_fields'        => array(
                                        array(
                                            'key'               => 'field_5c59f20118315',
                                            'label'             => '',
                                            'name'              => 'box_text',
                                            'type'              => 'text',
                                            'instructions'      => '',
                                            'required'          => 0,
                                            'conditional_logic' => 0,
                                            'wrapper'           => array(
                                                'width' => '',
                                                'class' => '',
                                                'id'    => '',
                                            ),
                                            'default_value'     => '',
                                            'placeholder'       => 'Text',
                                            'prepend'           => '',
                                            'append'            => '',
                                            'maxlength'         => '',
                                        ),
                                        array(
                                            'key'               => 'field_5c59f20c18316',
                                            'label'             => '',
                                            'name'              => 'box_url',
                                            'type'              => 'url',
                                            'instructions'      => '',
                                            'required'          => 0,
                                            'conditional_logic' => 0,
                                            'wrapper'           => array(
                                                'width' => '',
                                                'class' => '',
                                                'id'    => '',
                                            ),
                                            'default_value'     => '',
                                            'placeholder'       => 'URL',
                                        ),
                                        array(
                                            'key'               => 'field_5c59f2221831d',
                                            'label'             => '',
                                            'name'              => 'background_image_id',
                                            'type'              => 'image',
                                            'instructions'      => '',
                                            'required'          => 0,
                                            'conditional_logic' => 0,
                                            'wrapper'           => array(
                                                'width' => '',
                                                'class' => '',
                                                'id'    => '',
                                            ),
                                            'return_format'     => 'id',
                                            'preview_size'      => 'thumbnail',
                                            'library'           => 'all',
                                            'min_width'         => '',
                                            'min_height'        => '',
                                            'min_size'          => '',
                                            'max_width'         => '',
                                            'max_height'        => '',
                                            'max_size'          => '',
                                            'mime_types'        => '',
                                        ),
                                    ),
                                ),
                                array(
                                    'key'               => 'field_5c59f21f18317',
                                    'label'             => 'Box 2',
                                    'name'              => 'box_2',
                                    'type'              => 'group',
                                    'instructions'      => '',
                                    'required'          => 0,
                                    'conditional_logic' => 0,
                                    'wrapper'           => array(
                                        'width' => '',
                                        'class' => '',
                                        'id'    => '',
                                    ),
                                    'layout'            => 'block',
                                    'sub_fields'        => array(
                                        array(
                                            'key'               => 'field_5c59f21f18318',
                                            'label'             => '',
                                            'name'              => 'box_text',
                                            'type'              => 'text',
                                            'instructions'      => '',
                                            'required'          => 0,
                                            'conditional_logic' => 0,
                                            'wrapper'           => array(
                                                'width' => '',
                                                'class' => '',
                                                'id'    => '',
                                            ),
                                            'default_value'     => '',
                                            'placeholder'       => 'Text',
                                            'prepend'           => '',
                                            'append'            => '',
                                            'maxlength'         => '',
                                        ),
                                        array(
                                            'key'               => 'field_5c59f21f18319',
                                            'label'             => '',
                                            'name'              => 'box_url',
                                            'type'              => 'url',
                                            'instructions'      => '',
                                            'required'          => 0,
                                            'conditional_logic' => 0,
                                            'wrapper'           => array(
                                                'width' => '',
                                                'class' => '',
                                                'id'    => '',
                                            ),
                                            'default_value'     => '',
                                            'placeholder'       => 'URL',
                                        ),
                                        array(
                                            'key'               => 'field_5c59f2221831e',
                                            'label'             => '',
                                            'name'              => 'background_image_id',
                                            'type'              => 'image',
                                            'instructions'      => '',
                                            'required'          => 0,
                                            'conditional_logic' => 0,
                                            'wrapper'           => array(
                                                'width' => '',
                                                'class' => '',
                                                'id'    => '',
                                            ),
                                            'return_format'     => 'id',
                                            'preview_size'      => 'thumbnail',
                                            'library'           => 'all',
                                            'min_width'         => '',
                                            'min_height'        => '',
                                            'min_size'          => '',
                                            'max_width'         => '',
                                            'max_height'        => '',
                                            'max_size'          => '',
                                            'mime_types'        => '',
                                        ),
                                    ),
                                ),
                                array(
                                    'key'               => 'field_5c59f2221831a',
                                    'label'             => 'Box 3',
                                    'name'              => 'box_3',
                                    'type'              => 'group',
                                    'instructions'      => '',
                                    'required'          => 0,
                                    'conditional_logic' => 0,
                                    'wrapper'           => array(
                                        'width' => '',
                                        'class' => '',
                                        'id'    => '',
                                    ),
                                    'layout'            => 'block',
                                    'sub_fields'        => array(
                                        array(
                                            'key'               => 'field_5c59f2221831b',
                                            'label'             => '',
                                            'name'              => 'box_text',
                                            'type'              => 'text',
                                            'instructions'      => '',
                                            'required'          => 0,
                                            'conditional_logic' => 0,
                                            'wrapper'           => array(
                                                'width' => '',
                                                'class' => '',
                                                'id'    => '',
                                            ),
                                            'default_value'     => '',
                                            'placeholder'       => 'Text',
                                            'prepend'           => '',
                                            'append'            => '',
                                            'maxlength'         => '',
                                        ),
                                        array(
                                            'key'               => 'field_5c59f2221831c',
                                            'label'             => '',
                                            'name'              => 'box_url',
                                            'type'              => 'url',
                                            'instructions'      => '',
                                            'required'          => 0,
                                            'conditional_logic' => 0,
                                            'wrapper'           => array(
                                                'width' => '',
                                                'class' => '',
                                                'id'    => '',
                                            ),
                                            'default_value'     => '',
                                            'placeholder'       => 'URL',
                                        ),
                                        array(
                                            'key'               => 'field_5c59f2221831f',
                                            'label'             => '',
                                            'name'              => 'background_image_id',
                                            'type'              => 'image',
                                            'instructions'      => '',
                                            'required'          => 0,
                                            'conditional_logic' => 0,
                                            'wrapper'           => array(
                                                'width' => '',
                                                'class' => '',
                                                'id'    => '',
                                            ),
                                            'return_format'     => 'id',
                                            'preview_size'      => 'thumbnail',
                                            'library'           => 'all',
                                            'min_width'         => '',
                                            'min_height'        => '',
                                            'min_size'          => '',
                                            'max_width'         => '',
                                            'max_height'        => '',
                                            'max_size'          => '',
                                            'mime_types'        => '',
                                        ),
                                    ),
                                ),
                            ),
                        ),
                    ),
                    'location'              => array(
                        array(
                            array(
                                'param'    => 'block',
                                'operator' => '==',
                                'value'    => 'acf/ucf-college-multi-three-box',
                            ),
                        ),
                        array(
                            array(
                            	'param'    => 'post_taxonomy',
	                            'operator' => '==',
	                            'value'    => 'ucf_college_shortcode_category:' . self::shortcode,
                            )
                        ),
                    ),
                    'menu_order'            => 0,
                    'position'              => 'normal',
                    'style'                 => 'default',
                    'label_placement'       => 'top',
                    'instruction_placement' => 'label',
                    'hide_on_screen'        => '',
                    'active'                => 1,
                    'description'           => '',
                ) );

        }
    }
}

new ucf_college_multi_three_box_acf_pro_fields();