<?php
// Register Custom Post Type 'information'
function information_cpt() {
    $labels = array(
        'name'                  => _x('Information', 'plural'),
        'singular_name'         => _x('Information Item', 'singular'),
        'menu_name'             => _x('Information', 'admin menu'),
        'name_admin_bar'        => _x('Information Item', 'admin bar'),
        'add_new'               => _x('Add New', 'add new'),
        'add_new_item'          => __('Add New Information Item'),
        'new_item'              => __('New Information Item'),
        'edit_item'             => __('Edit Information Item'),
        'view_item'             => __('View Information Item'),
        'all_items'             => __('All Information'),
        'search_items'          => __('Search Information'),
        'not_found'             => __('No Information items found.'),
    );

    $args = array(
        'labels'                => $labels,
        'public'                => true,
        'menu_icon'             => 'dashicons-media-document',
        'has_archive'           => true,
        'hierarchical'          => false, // Correctly set to false
        'show_in_rest'          => true,
        'supports'              => array('title', 'editor', 'thumbnail'), // Removed 'page-attributes'
        'rewrite'               => array('slug' => 'information'),
    );
    register_post_type('information', $args);
}

add_action('init', 'information_cpt');

// Register Custom Taxonomy information_category'
function information_taxonomy_category() {
    $labels = array(
        'name'                  => _x('Information Categories', 'taxonomy general name'),
        'singular_name'         => _x('Information Category', 'taxonomy singular name'),
        'search_items'          => __('Search Information Categories'),
        'all_items'             => __('All Information Categories'),
        'parent_item'           => __('Parent Information Category'),
        'parent_item_colon'     => __('Parent Information Category:'),
        'edit_item'             => __('Edit Information Category'),
        'update_item'           => __('Update Information Category'),
        'add_new_item'          => __('Add New Information Category'),
        'new_item_name'         => __('New Information Category Name'),
        'menu_name'             => __('Information Categories'),
    );

    $args = array(
        'hierarchical'          => true, // Set to true for hierarchical taxonomy
        'labels'                => $labels,
        'show_ui'               => true,  // Ensure this is true to display in admin
        'show_admin_column'     => true,
        'query_var'             => true,
        'rewrite'               => array('slug' => 'information-category'),
        'show_in_rest'          => true,  // Add this if you want it visible in the REST API
    );
    register_taxonomy('information_category', array('information'), $args);
}

add_action('init', 'information_taxonomy_category');




