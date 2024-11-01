<?php
/**
    Plugin Name: Post View
    Description: This plugin is used to find out the number of post views , In addition to a custom column inside the post display table.
    Author: MAHMOOD AHMED
    Version: 1.0
    Author URI: https://profiles.wordpress.org/mahmoodahmed/
*/


if (!function_exists('view_my_script')){
    add_action('wp_enqueue_scripts','view_my_script');
    function view_my_script(){
        wp_enqueue_style('view_post_style',plugin_dir_url(__FILE__).'css/style.css');

        wp_enqueue_style('fontawesome','https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css');
        wp_enqueue_script('fontawesome_js','https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js');

    }
}




if (!function_exists('VIPO_view_count_post')){
    function VIPO_view_count_post(){

        $post_id = get_the_ID();

        add_post_meta($post_id,'posts_views' , '0' , true);

        $count_posts_views = get_post_meta(  $post_id, 'posts_views',  true );

        $update_posts_views = $count_posts_views + 1 ;

        update_post_meta(  $post_id,  'posts_views' , $update_posts_views );

        ?>
        <div class='box-count'> <i class='fa-solid fa-eye'></i> <?php  esc_html_e($count_posts_views) . _e(' view') ?>     </div>
        <?php

    }

    add_filter('the_content' , 'VIPO_view_count_post' );
}






if (!function_exists('VIPO_view_add_new_col_table')){
    add_action('manage_post_posts_columns','VIPO_view_add_new_col_table');
    function VIPO_view_add_new_col_table($arg){
        $arg['posts_views'] = __('Views');
        return $arg;
    }
}

if (!function_exists('VIPO_view_add_value_to_table')){
    add_action('manage_post_posts_custom_column','VIPO_view_add_value_to_table',10,2);
    function VIPO_view_add_value_to_table($col , $id){
        if ($col == 'posts_views'){
            $view = get_post_meta($id, 'posts_views' , true );
            esc_html_e($view);
        }else{
            echo __('not data');
        }
    }
}




