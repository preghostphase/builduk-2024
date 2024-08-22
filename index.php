<?php get_header(); ?>
<?php get_template_part('templates/parts/banner'); ?>

<main id="primary" class="news">
    <div class="news__wrapper">

        <?php // Check to see if sticky post is set and fetch latest
        $sticky = get_option('sticky_posts');

        // Check if there are any sticky posts
        if ($sticky) {
            $args = array(
                'posts_per_page' => 1,
                'post__in' => $sticky,
                'ignore_sticky_posts' => 1,
            );
            $query = new WP_Query($args);
        ?>

        <h4 class="news__title">Featured Article</h4>

        <?php // Check if sticky post exists and not on paged listing
        if (!is_paged() && $query->have_posts()): ?>
        <article class="news__sticky">
            <?php while ($query->have_posts()): $query->the_post(); ?>
            <div class="sticky-article">
                <?php get_template_part('templates/parts/article-card'); ?>
            </div>
            <?php endwhile; ?>
        </article>

        <?php wp_reset_postdata(); ?>
        <?php endif; ?>
        <?php } // End if sticky ?>


        <?php 
        // Check if any blog filters are set
        $terms = get_field('news_filter_options', 'option'); 

        if ($terms): 
            $has_terms_with_posts = false; // Initialize flag to check if there are terms with posts

            // First, loop through the terms to check if any of them have posts
            foreach($terms as $term):
                $term_post_count = get_term($term)->count;
                if ($term_post_count > 0) {
                    $has_terms_with_posts = true;
                    break;
                }
            endforeach;

            // If there are terms with posts, display the filters
            if ($has_terms_with_posts): ?>
                <div class="news__filters">
                    <h4>Filter by Category</h4>
                    <div class="news__filters-buttons">
                        <?php foreach($terms as $term): 
                            $term_post_count = get_term($term)->count;
                            if ($term_post_count > 0): ?>
                                <a href="<?php echo esc_url(get_term_link($term)); ?>" class="button">
                                    <?php echo esc_html($term->name); ?>
                                </a>
                            <?php endif; 
                        endforeach; ?>
                    </div>
                </div>
            <?php endif; 
        endif; 
        ?>


        <?php get_template_part('templates/parts/blog-listings'); ?>
    </div>
</main>

<?php get_footer(); ?>
