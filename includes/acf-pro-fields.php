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
        if ( function_exists( 'acf_add_local_field_group' ) ) {
            acf_add_local_field_group(
                array(
                    'key'                   => 'group_5c59f155c5f05',
                    'title'                 => 'Multi Three Box',
                    'fields'                => array(
                        array(
                            'key' => 'field_5c59f2f12fd06',
                            'label' => 'Header',
                            'name' => 'header',
                            'type' => 'text',
                            'instructions' => '',
                            'required' => 0,
                            'conditional_logic' => 0,
                            'wrapper' => array(
                                'width' => '',
                                'class' => '',
                                'id' => '',
                            ),
                            'default_value' => '',
                            'placeholder' => '',
                            'prepend' => '',
                            'append' => '',
                            'maxlength' => '',
                        ),
                        array(
                            'key'               => 'field_5c59f15ac5579',
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
                            'layout'            => 'table',
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
                                            'label'             => 'Box Text',
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
                                            'placeholder'       => '',
                                            'prepend'           => '',
                                            'append'            => '',
                                            'maxlength'         => '',
                                        ),
                                        array(
                                            'key'               => 'field_5c59f20c18316',
                                            'label'             => 'Box URL',
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
                                            'placeholder'       => '',
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
                                            'label'             => 'Box Text',
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
                                            'placeholder'       => '',
                                            'prepend'           => '',
                                            'append'            => '',
                                            'maxlength'         => '',
                                        ),
                                        array(
                                            'key'               => 'field_5c59f21f18319',
                                            'label'             => 'Box URL',
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
                                            'placeholder'       => '',
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
                                            'label'             => 'Box Text',
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
                                            'placeholder'       => '',
                                            'prepend'           => '',
                                            'append'            => '',
                                            'maxlength'         => '',
                                        ),
                                        array(
                                            'key'               => 'field_5c59f2221831c',
                                            'label'             => 'Box URL',
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
                                            'placeholder'       => '',
                                        ),
                                    ),
                                ),
                            ),
                        ),
                    ),
                    'location'              => array(
                        array(
                            array(
                                'param'    => 'post_taxonomy',
                                'operator' => '==',
                                'value'    => 'ucf_college_shortcode_category:' . self::shortcode,
                            ),
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