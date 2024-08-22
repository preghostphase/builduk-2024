<?php
function locations_cpt()
{
    $labels = array(
        'name' => _x('Locations', 'plural'),
        'singular_name' => _x('Locations', 'singular'),
        'menu_name' => _x('Locations', 'admin menu'),
        'name_admin_bar' => _x('Locations', 'admin bar'),
        'add_new' => _x('Add New Location', 'add new'),
        'add_new_item' => __('Add New Locations'),
        'new_item' => __('New Location'),
        'edit_item' => __('Edit Location'),
        'view_item' => __('View Location'),
        'all_items' => __('All Locations'),
        'search_items' => __('Search Locations'),
        'not_found' => __('No Locations found.'),
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'menu_icon' => 'dashicons-admin-site',
        'has_archive' => false,
        'hierarchical' => true,
        'show_in_rest' => true,
        'supports' => array('title', 'editor', 'thumbnail', 'page-attributes'),
        'rewrite' => array('slug' => 'locations'),
    );
    register_post_type('locations', $args);
}

add_action('init', 'locations_cpt');
