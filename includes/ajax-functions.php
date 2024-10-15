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
    
    // Handle filter info
    if (!empty($tax_query)) {
        $terms = get_terms([
            'taxonomy' => 'members_category',
            'slug' => $_POST['members_category'],
        ]);
        $filter_info = 'Showing results for: ' . implode(', ', wp_list_pluck($terms, 'name'));
    } else {
        $filter_info = 'Showing all Members';
    }
    
    echo '<div id="filter-info" class="members__filters-results-info">' . esc_html($filter_info) . '</div>';

    $loop = new WP_Query($args);
    if ($loop->have_posts()) {
        while ($loop->have_posts()) {
            $loop->the_post();
            $member_logo = get_field('member_logo');
            $member_url = get_field('member_url');
            $member_keys = get_the_terms(get_the_ID(), 'members_keys');
            ?>
            
            <a href="<?php echo $member_url; ?>" class="members__filters-results-item">
                <div class="members__filters-results-item-logo">
                    <img alt="<?php the_title(); ?>" src="<?php echo $member_logo; ?>" />
                </div>
                <?php if ($member_keys && !is_wp_error($member_keys)) : ?>
                    <div class="members__filters-results-item-keys">
                        <?php foreach ($member_keys as $key) : 
                            // Get the 'colour' custom field associated with this term
                            $colour = get_field('colour', 'members_keys_' . $key->term_id);
                        ?>
                            <div class="members__filters-results-item-keys-item" style="color: <?php echo esc_attr($colour); ?>;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"><path fill="<?php echo esc_attr($colour); ?>" d="M0 0h20v20H0z" data-name="Rectangle 39"/><path fill="#fff" d="m15.572 5.815-1.015-1.323a.608.608 0 0 0-1.014 0L8.65 10.886 6.457 8.014a.608.608 0 0 0-1.014 0L4.432 9.338a1.056 1.056 0 0 0-.209.662 1.055 1.055 0 0 0 .209.661l2.7 3.523 1.01 1.324a.608.608 0 0 0 1.014 0l1.015-1.324 5.4-7.046a1.056 1.056 0 0 0 .209-.662 1.056 1.056 0 0 0-.209-.662" data-name="Path 10"/></svg>
                                <span class="sr-only"><?php echo esc_html($key->name); ?></span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </a>
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

function ajax_search_information() {
    // Sanitize the search query
    $query = isset($_POST['query']) ? sanitize_text_field($_POST['query']) : '';

    // Perform the search query
    $args = array(
        'post_type' => 'information',
        's' => $query,
        'posts_per_page' => 10, // Limit the number of search results
    );

    $search_query = new WP_Query($args);


    if ($search_query->have_posts()) {
        while ($search_query->have_posts()) {
            $search_query->the_post();
        
            // Get the terms of the taxonomy 'information_category' for the current post
            $terms = get_the_terms(get_the_ID(), 'information_category');
            $theme_colour = '';
    
            // Check if terms exist and retrieve the 'theme_colour' from the first term
            if ($terms && !is_wp_error($terms)) {
                $term = $terms[0]; // Get the first term (you can adjust this if multiple terms exist)
                $theme_colour = get_field('category_theme', $term);
            }


    
            $information_link = get_field('information_link');
            $description = get_field('description');
            $newTab = get_field('open_link_in_new_tab');
            $overrideButtonText = get_field('override_button_text');
            ?>
            
            <a class="information__items-grid-item" href="<?php echo $information_link ? $information_link : the_permalink(); ?>" <?php echo $newTab ? 'target="_blank"' : ''; ?> style="border-color: <?php echo $theme_colour; ?>;">
                <div class="information__items-grid-item-main">
                    <h2 class="information__items-grid-item-title" style="color: <?php echo $theme_colour; ?>;"><?php the_title(); ?></h2>
                    <div class="information__items-grid-item-excerpt" style="color: <?php echo $theme_colour; ?>;">
                    <?php echo $description ? '<p>' . $description . '</p>' : the_excerpt(); ?></div>
                </div>
                <?php if($information_link) : ?>
                    <span class="information__items-grid-item-text" style="background-color: <?php echo $theme_colour; ?>;"><?php echo $overrideButtonText ? $overrideButtonText : 'Download'; ?></span>
                <?php else : ?>
                    <span class="information__items-grid-item-text" style="background-color: <?php echo $theme_colour; ?>;"><?php echo $overrideButtonText ? $overrideButtonText : 'Find out more'; ?></span>
                <?php endif; ?>
            </a>
    
        <?php }
    } else {
        echo '<p>Sorry, your search yielded no results.</p>';
    }
    

    wp_reset_postdata();

    // Always end with this when handling AJAX requests
    wp_die();
}
add_action('wp_ajax_search_information', 'ajax_search_information');
add_action('wp_ajax_nopriv_search_information', 'ajax_search_information');
