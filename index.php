<?php
/**
 * Plugin Name: Show Custom Category
 * Plugin URI: https://sven.ir/scc
 * Description: This plugin will allow all categories to show in posts or you can select which ones to show. All you need to do is use shortcode [sven_category] in your post pages
 * Version: 1.0.0
 * Author: Ali Ghavidel (sven)
 * Author URI: https://sven.ir/ghavidel
 * License: GPL2
 * Text Domain: show-custom-category
 */
/**
 * Register meta boxes.
 * sscc is abbr of sven show custom category
 */
if ( ! function_exists( 'sscc_register_meta_boxes' ) && ! function_exists( 'sscc_display_callback' ) && ! function_exists( 'sscc_save_meta_box' ) ){

        function sscc_register_meta_boxes() {
            add_meta_box( 'sscc-1', 'show categories', 'sscc_display_callback', 'post', 'side' );
        }
        add_action( 'add_meta_boxes', 'sscc_register_meta_boxes' );

        /**
         * Meta box display callback.
         *
         * @param WP_Post $post Current post object.
         */
        function sscc_display_callback( $post ) {
            include plugin_dir_path( __FILE__ ) . './form.php';
        }
        /**
         * Save meta box content.
         *
         * @param int $post_id Post ID
         */
        function sscc_save_meta_box( $post_id ) {
            if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
            if ( $parent_id = wp_is_post_revision( $post_id ) ) {
                $post_id = $parent_id;
            }
            $fields = [
                'sscc_pricat',
                'sscc_classes',
            ];
            foreach ( $fields as $field ) {
                if ( array_key_exists( $field, $_POST ) ) {
                    update_post_meta( $post_id, $field, sanitize_text_field( $_POST[$field] ) );
                }
             }
        }
        add_action( 'save_post', 'sscc_save_meta_box' );
    
}
/*
* add shortcode to show categories
*/

function sscc_category_name_shortcode() {
    global $post;
    $post_id = $post->ID;
    $selected_cats = get_post_meta( $post_id, 'sscc_pricat', true );
    $catName = "";
    foreach((get_the_category($post_id)) as $category){
        if($selected_cats != ''){
            $arr = explode("/", $selected_cats);
            foreach($arr as $val){
                if($category->name == $val){
                    $catName .= ' ' . '<a class="' . get_post_meta( $post_id, 'sscc_classes', true ) .'" href="' . get_term_link($category) . '">' . $category->name . '</a>';
                }
            }
        }else{
            $catName .= ' ' . '<a class="' . get_post_meta( $post_id, 'sscc_classes', true ) .'" href="' . get_term_link($category) . '">' . $category->name . '</a>';
        }
    }
    
    
    return $catName;
}

add_shortcode( 'sven_category', 'sscc_category_name_shortcode' );
