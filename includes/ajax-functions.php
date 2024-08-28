<?php

function ajax_filter_members() {
    // Check if there's a category filter
    $tax_query = [];
    if (isset($_POST['members_category']) && !empty($_POST['members_category'])) {
        $tax_query = [
            [
                'taxonomy' => 'members_category',
                'field'    => 'slug',
                'terms'    => $_POST['members_category'],
            ],
        ];
    }

    // WP Query with or without tax query
    $args = array(
        'post_type'      => 'members',
        'posts_per_page' => -1,
        'tax_query'      => $tax_query,
    );

    $loop = new WP_Query($args);
    if ($loop->have_posts()) {
        while ($loop->have_posts()) {
            $loop->the_post();
            ?>
            <div class="entry-content">
                <?php the_title(); ?>
            </div>
            <?php
        }
    } else {
        echo '<p>No members found matching your criteria.</p>';
    }
    wp_reset_postdata();
    
    die(); // Always end your AJAX functions with die() to stop WordPress from running the rest of the script
}

add_action('wp_ajax_filter_members', 'ajax_filter_members'); // For logged-in users
add_action('wp_ajax_nopriv_filter_members', 'ajax_filter_members'); // For non-logged-in users
