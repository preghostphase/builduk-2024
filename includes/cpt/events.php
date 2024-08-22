<?php
function events_cpt()
{
    $labels = array(
        'name' => _x('Events', 'plural'),
        'singular_name' => _x('Events', 'singular'),
        'menu_name' => _x('Events', 'admin menu'),
        'name_admin_bar' => _x('Events', 'admin bar'),
        'add_new' => _x('Add New Event', 'add new'),
        'add_new_item' => __('Add New Events'),
        'new_item' => __('New Event'),
        'edit_item' => __('Edit Event'),
        'view_item' => __('View Event'),
        'all_items' => __('All Events'),
        'search_items' => __('Search Events'),
        'not_found' => __('No Events found.'),
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'menu_icon' => 'dashicons-tickets-alt',
        'has_archive' => false,
        'hierarchical' => true,
        'show_in_rest' => true,
        'supports' => array('title', 'editor', 'thumbnail', 'page-attributes'),
        'rewrite' => array('slug' => 'events'),
    );
    register_post_type('events', $args);
}

add_action('init', 'events_cpt');
