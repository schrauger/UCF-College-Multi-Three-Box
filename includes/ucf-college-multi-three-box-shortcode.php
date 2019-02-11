<?php

class ucf_college_multi_three_box_shortcode {
    const shortcode_slug = 'ucf_college_multi_three_box'; // the shortcode text entered by the user (inside square brackets)
    const shortcode_name = 'Multi Three Box';
    const shortcode_description = 'Tabbed sections with repeater list';
    //const get_param_group = 'people_group'; // group or category person is in

    function __construct() {
        add_action( 'init', array( $this, 'add_shortcode' ) );
        add_filter( 'query_vars', array($this, 'add_query_vars_filter' )); // tell wordpress about new url parameters
        add_filter( 'ucf_college_shortcode_menu_item', array($this, 'add_ckeditor_shortcode'));
    }

    /**
     * Adds the shortcode to wordpress' index of shortcodes
     */
    function add_shortcode() {
        if ( ! ( shortcode_exists( self::shortcode_slug ) ) ) {
            add_shortcode( self::shortcode_slug, array($this, 'replacement' ));
        }
    }

    /**
     * Adds the shortcode to the ckeditor dropdown menu
     */
    function add_ckeditor_shortcode($shortcode_array){
        $shortcode_array[] = array(
            'slug' => self::shortcode_slug,
            'name' => self::shortcode_name,
            'description' => self::shortcode_description
        );
        return $shortcode_array;
    }

    /**
     * Tells wordpress to listen for the 'people_group' parameter in the url. Used to filter down to specific profiles.
     * @param $vars
     *
     * @return array
     */
    function add_query_vars_filter($vars){
        //$vars[] = self::get_param_group;
        return $vars;
    }

    /**
     * Returns the replacement html that WordPress uses in place of the shortcode
     *
     * @return mixed
     */
    function replacement( ) {
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
                            $box_text = get_sub_field( 'box_text' );
                            $box_url  = get_sub_field( 'box_url' );
                            $replacement_data .= "
    <a class='{$acf_individual_box_group_id}' href='{$box_url}'><span>{$box_text}</span></a>";
                        }
                    }
                }


            }
            $replacement_data .= "
</div>";

        }
        return $replacement_data;
    }

    /**
     * Only run this on plugin activation, as it's stored in the database
     */
    static function insert_shortcode_term(){
        $taxonomy = new ucf_college_shortcode_taxonomy;
        $taxonomy->create_taxonomy();
        wp_insert_term(
            self::shortcode_name,
            ucf_college_shortcode_taxonomy::taxonomy_slug,
            array(
                'description' => self::shortcode_description,
                'slug' => self::shortcode_slug
            )
        );
    }

    /**
     * Run when plugin is disabled and/or uninstalled. This removes the shortcode from the list of shortcodes in the taxonomy.
     */
    static function delete_shortcode_term(){
        $taxonomy = new ucf_college_shortcode_taxonomy;
        $taxonomy->create_taxonomy();
        wp_delete_term(get_term_by('slug', self::shortcode_slug)->term_id, ucf_college_shortcode_taxonomy::taxonomy_slug);
    }




}

new ucf_college_multi_three_box_shortcode();
