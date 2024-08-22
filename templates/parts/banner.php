<?php

// Determine the correct page ID
$page_id = is_home() ? get_option('page_for_posts') : get_the_ID();

// Get custom title or use the default title
$custom_title = get_field('custom_title');
$page_title = $custom_title ? $custom_title : get_the_title();

// Function to check if the featured image should be displayed
function featured_image_check($page_id) {
    if (is_404() || is_search() || strpos($_SERVER['REQUEST_URI'], 'search_keywords') !== false) {
        return false;
    }
    if (is_category() && get_field('category_featured_image', 'category_' . get_queried_object_id())) {
        return true;
    }
    return has_post_thumbnail($page_id);
}

// Determine if the banner should have an image
$banner_class = featured_image_check($page_id) ? 'banner--has-image' : '';

?>

<section class="banner <?php echo esc_attr($banner_class); ?>">
    <?php if (is_category() && $category_image = get_field('category_featured_image', 'category_' . get_queried_object_id())) : ?>
        <div class="banner__image">
            <img alt="" src="<?php echo esc_url($category_image); ?>"/>
        </div>
    <?php elseif (has_post_thumbnail($page_id)) : ?>
        <div class="banner__image">
            <?php echo get_the_post_thumbnail($page_id, 'full'); ?>
        </div>
    <?php else: ?>
        <div class="banner__background"></div>
    <?php endif; ?>

    <div class="banner__wrapper">
        <div class="banner__content">
            <?php if (is_archive()): ?>
                <p class="mb2">Category:</p>
            <?php elseif (is_search()): ?>
                <p class="mb2">Search results for:</p>
            <?php endif; ?>

            <h1 class="custom-title-js">
                <?php
                if (is_home()):
                    echo 'Latest News';
                elseif (is_archive()):
                    echo esc_html(single_term_title('', false));
                elseif (is_404()):
                    echo 'Page not found';
                elseif (is_search()):
                    echo esc_html(get_search_query());
                else:
                    echo esc_html($page_title);
                endif;
                ?>
            </h1>
        </div>
    </div>
</section>
