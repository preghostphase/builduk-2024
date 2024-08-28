<?php get_header(); ?>
<?php get_template_part('templates/parts/banner'); ?>

<main id="primary" class="information">

    <div class="information__wrapper">

    <div class="information__categories">


    <?php
        // Get all custom taxonomy terms
        $categoryTerms = get_terms(array(
            'taxonomy' => 'information_category',
            'hide_empty' => true,
        ));

        if ( !empty( $categoryTerms ) && !is_wp_error( $categoryTerms ) ) : ?>
            <div class="information__categories-grid">
                <?php foreach ( $categoryTerms as $categoryTerm ) : 
                    $category_theme = get_field('category_theme', 'information_category_' . $categoryTerm->term_id);
                    $category_image = get_field('category_image', 'information_category_' . $categoryTerm->term_id);
                ?>

               
                        <a href="<?php echo esc_url( get_term_link( $categoryTerm ) ); ?>" class="information__categories-grid-item" style="background-color: <?php echo $category_theme; ?>">
                        <div class="information__categories-grid-item-image">
                            <div class="information__categories-grid-item-image-overlay" style="background-color: <?php echo $category_theme; ?>"><span class="sr-only">Overlay for image</span></div>
                            <img src="<?php echo esc_url( $category_image['url'] ); ?>" alt="<?php echo esc_attr( $category_image['alt'] ); ?>" />
                        </div>

                            <h2 class="information__categories-grid-item-title"><?php echo esc_html( $categoryTerm->name ); ?></h2>
                       

                        </a>
                <?php endforeach; ?>
            </div>
        <?php else : ?>
            <p><?php esc_html_e( 'No information categories found.', 'text-domain' ); ?></p>
        <?php endif; ?>

    </div>


 
    </div>

</main>

<?php get_footer(); ?>
