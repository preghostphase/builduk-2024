<?php
// Register Custom Post Type 'members'
function members_cpt() {
    $labels = array(
        'name'                  => _x('Members', 'plural'),
        'singular_name'         => _x('Member', 'singular'),
        'menu_name'             => _x('Members', 'admin menu'),
        'name_admin_bar'        => _x('Member', 'admin bar'),
        'add_new'               => _x('Add New', 'add new'),
        'add_new_item'          => __('Add New Member'),
        'new_item'              => __('New Member'),
        'edit_item'             => __('Edit Member'),
        'view_item'             => __('View Member'),
        'all_items'             => __('All Members'),
        'search_items'          => __('Search Members'),
        'not_found'             => __('No Members found.'),
    );

    $args = array(
        'labels'                => $labels,
        'public'                => true,
        'menu_icon'             => 'dashicons-buddicons-buddypress-logo',
        'has_archive'           => true,
        'hierarchical'          => false, // Correctly set to false
        'show_in_rest'          => true,
        'supports'              => array('title', 'editor', 'thumbnail'), // Removed 'page-attributes'
        'rewrite'               => array('slug' => 'members'),
    );
    register_post_type('members', $args);
}

add_action('init', 'members_cpt');

// Register Custom Taxonomy 'members_category'
function members_taxonomy_category() {
    $labels = array(
        'name'                  => _x('Members Categories', 'taxonomy general name'),
        'singular_name'         => _x('Members Category', 'taxonomy singular name'),
        'search_items'          => __('Search Members Categories'),
        'all_items'             => __('All Members Categories'),
        'parent_item'           => __('Parent Members Category'),
        'parent_item_colon'     => __('Parent Members Category:'),
        'edit_item'             => __('Edit Members Category'),
        'update_item'           => __('Update Members Category'),
        'add_new_item'          => __('Add New Members Category'),
        'new_item_name'         => __('New Members Category Name'),
        'menu_name'             => __('Members Categories'),
    );

    $args = array(
        'hierarchical'          => true, // Set to true for hierarchical taxonomy
        'labels'                => $labels,
        'show_ui'               => true,  // Ensure this is true to display in admin
        'show_admin_column'     => true,
        'query_var'             => true,
        'rewrite'               => array('slug' => 'members-category'),
        'show_in_rest'          => true,  // Add this if you want it visible in the REST API
    );
    register_taxonomy('members_category', array('members'), $args);
}

add_action('init', 'members_taxonomy_category');

// Register Custom Taxonomy 'members_category'
function members_taxonomy_keys() {
    $labels = array(
        'name'                  => _x('Membership Keys', 'taxonomy general name'),
        'singular_name'         => _x('Membership Key', 'taxonomy singular name'),
        'search_items'          => __('Search Membership Keys'),
        'all_items'             => __('All Membership Keys'),
        'parent_item'           => __('Parent Membership Key'),
        'parent_item_colon'     => __('Parent Membership Key:'),
        'edit_item'             => __('Edit Membership Key'),
        'update_item'           => __('Update Membership Key'),
        'add_new_item'          => __('Add New Membership Key'),
        'new_item_name'         => __('New Membership Key Name'),
        'menu_name'             => __('Membership Keys'),
    );

    $args = array(
        'hierarchical'          => true, // Set to true for hierarchical taxonomy
        'labels'                => $labels,
        'show_ui'               => true,  // Ensure this is true to display in admin
        'show_admin_column'     => true,
        'query_var'             => true,
        'rewrite'               => array('slug' => 'members-keys'),
        'show_in_rest'          => true,  // Add this if you want it visible in the REST API
    );
    register_taxonomy('members_keys', array('members'), $args);
}

add_action('init', 'members_taxonomy_keys');


