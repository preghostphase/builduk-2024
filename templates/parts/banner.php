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
    if (is_category() && get_field('category_featured_image', 'category_' . get_queried_object_id())) {
        return true;
    }
    if (is_tax('information_category') && get_field('category_image', get_queried_object())){
        return true;
    }
    return has_post_thumbnail($page_id);
}

// Determine if the banner should have an image
$banner_class = featured_image_check($page_id) ? 'banner--has-image' : '';

$banner_colour = get_field('banner_colour');

?>

<section class="banner <?php echo esc_attr($banner_class); ?> <?php echo $banner_colour ? 'banner--has-custom-colour' : ''; ?> <?php echo is_tax('members_category') ? 'banner--members-category' : ''; ?> <?php echo is_tax('information_category') ? 'banner--information-category' : ''; ?>">

    <?php if (is_category() && $category_image = get_field('category_featured_image', 'category_' . get_queried_object_id())) : ?>
        <div class="banner__image">
            <?php if($banner_colour) : ?>
                <div class="banner__image-overlay" style="<?php echo $banner_colour ? 'background-color: ' . esc_attr($banner_colour) . ';' : get_field( 'secondary_colour', 'option' ); ?>"><span class="sr-only">Overlay</span></div>
            <?php else : ?>
                <div class="banner__image-overlay" style="background-color: <?php echo get_field( 'secondary_colour', 'option' ); ?>"><span class="sr-only">Overlay</span></div>
            <?php endif; ?>
            <img alt="" src="<?php echo esc_url($category_image); ?>"/>
        </div>
    <?php elseif (is_tax('information_category') && get_field('category_image', get_queried_object())) : ?>
        
        <?php
            $category_colour = get_field('category_theme', get_queried_object());
            $category_image = get_field('category_image', get_queried_object());
        ?>

        <div class="banner__image">
            <?php if($category_colour) : ?>
                <div class="banner__image-overlay" style="<?php echo $category_colour ? 'background-color: ' . esc_attr($category_colour) . ';' : get_field( 'secondary_colour', 'option' ); ?>"><span class="sr-only">Overlay</span></div>
            <?php else : ?>
                <div class="banner__image-overlay" style="background-color: <?php echo get_field( 'secondary_colour', 'option' ); ?>"><span class="sr-only">Overlay</span></div>
            <?php endif; ?>
            <img alt="" src="<?php echo esc_url($category_image['url']); ?>"/>
        </div>

    <?php elseif (has_post_thumbnail($page_id)) : ?>
        <div class="banner__image">
            <?php if($banner_colour) : ?>
                <div class="banner__image-overlay" style="<?php echo $banner_colour ? 'background-color: ' . esc_attr($banner_colour) . ';' : get_field( 'secondary_colour', 'option' ); ?>"><span class="sr-only">Overlay</span></div>
            <?php else : ?>
                <div class="banner__image-overlay" style="background-color: <?php echo get_field( 'secondary_colour', 'option' ); ?>"><span class="sr-only">Overlay</span></div>
            <?php endif; ?>
            <?php echo get_the_post_thumbnail($page_id, 'full'); ?>
        </div>
    <?php else: ?>
        <div class="banner__background" style="<?php echo $banner_colour ? 'background-color: ' . esc_attr($banner_colour) . ';' : get_field( 'secondary_colour', 'option' ); ?>"></div>
    <?php endif; ?>

    <div class="banner__wrapper">
        <div class="banner__content">

            <?php if (is_tax('information_category')) : ?>
                <p>Information: </p>
            <?php elseif (is_tax('members_category')) : ?>
                <p>Members: </p>
            <?php elseif (is_archive() && !is_post_type_archive('members') && !is_post_type_archive('information')) : ?>
                <p class="mb2">Category:</p>
            <?php elseif (is_search()): ?>
                <p class="mb2">Search results for:</p>
            <?php endif; ?>


            <h1 class="custom-title-js">
                <?php
                if (is_home()):
                    echo 'Latest News';
                elseif (is_post_type_archive('members')):
                    echo 'Members';
                elseif (is_post_type_archive('information')):
                    echo 'Information';
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

            <?php if(is_post_type_archive('information')) : ?>
                <p>The Build UK Information Bank</p>
            <?php endif; ?>
        </div>

        <?php if(is_tax('members_category')) : ?>

            <div class="members__nav">
                <div class="members__nav-wrapper">
                <?php
                $memberTerms = get_terms([
                    'taxonomy' => 'members_category',
                    'hide_empty' => false,
                ]);

                if ( !empty( $memberTerms ) && !is_wp_error( $memberTerms ) ) : ?>
                    <div class="members__nav-grid">
                        <?php foreach ( $memberTerms as $memberTerm ) : 
                            $currentMemberCategory = get_queried_object();
                            $currentMemberCategoryName = $currentMemberCategory->name;
                        ?>
                            <a href="<?php echo esc_url( get_term_link( $memberTerm ) ); ?>" class="members__nav-grid-item <?php echo $currentMemberCategoryName === $memberTerm->name ? 'active' : ''; ?>">

                                <h2 class="members__nav-grid-item-title"><?php echo esc_html( $memberTerm->name ); ?></h2>

                            </a>
                        <?php endforeach; ?>
                    </div>
                <?php else : ?>
                    <p><?php esc_html_e( 'No information categories found.', 'text-domain' ); ?></p>
                <?php endif; ?>
         

                </div>

            </div>
        <?php endif; ?>

        <?php if(is_tax('information_category')) : ?>
            <div class="information__nav">
                <div class="information__nav-wrapper">
                <?php
                    // Get all custom taxonomy terms
                    $categoryTerms = get_terms(array(
                        'taxonomy' => 'information_category',
                        'hide_empty' => true,
                    ));

                    if ( !empty( $categoryTerms ) && !is_wp_error( $categoryTerms ) ) : ?>
                        <div class="information__nav-grid">
                            <?php foreach ( $categoryTerms as $categoryTerm ) : 
                                $category_theme = get_field('category_theme', 'information_category_' . $categoryTerm->term_id);
                                $category_image = get_field('category_image', 'information_category_' . $categoryTerm->term_id);
                            ?>

                            <?php 
                                $currentCategory = get_queried_object();
                                $currentCategoryName = $currentCategory->name;
                            ?>

                        
                            <a href="<?php echo esc_url( get_term_link( $categoryTerm ) ); ?>" class="information__nav-grid-item <?php echo $currentCategoryName === $categoryTerm->name ? 'active' : ''; ?>" style="background-color: <?php echo $category_theme; ?>; border: 3px solid <?php echo $category_theme; ?>; color: <?php echo $category_theme; ?>;">

                                <h2 class="information__nav-grid-item-title" style="color: <?php echo $category_theme; ?>;"><?php echo esc_html( $categoryTerm->name ); ?></h2>

                            </a>
                            <?php endforeach; ?>
                        </div>
                    <?php else : ?>
                        <p><?php esc_html_e( 'No information categories found.', 'text-domain' ); ?></p>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>
