<?php
/**
 * Please see the LICENSE file distributed with this repository
 */

/**
 * Simple script to replace the WP
 * Post Excerpt box with a WYSIWYG editor
 */

add_action( 'admin_init', 'excerpt_wysiwyg' );

function excerpt_wysiwyg()
{
    remove_meta_box('postexcerpt', 'post', 'normal');
    add_meta_box('postexcerpt', __('Post Excerpt'), 'post_excerpt', 'post', 'normal');
    add_meta_box('postexcerpt', __('Post Excerpt'), 'post_excerpt', 'page', 'normal');
}

function post_excerpt()
{
    global $wpdb,$post;
    $product_summary = $wpdb->get_row("SELECT post_excerpt FROM $wpdb->posts WHERE id = '$post->ID'");
    $post_excerpt 	 = $product_summary->post_excerpt;

    $settings = array(
        'text_area_name' => 'excerpt',
        'quicktags' => true,
        'tinymce' => true,
        'editor_css' => '<style type="text/css">#wp-excerpt-editor-container .wp-editor-area{height:150px; width:100%;}</style>'
    );

    $id = 'excerpt';
    wp_editor($post_excerpt, $id, $settings);
}