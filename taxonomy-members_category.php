<?php get_header(); ?>
<?php get_template_part('templates/parts/banner'); ?>

<main id="primary" class="members">
	<div class="members__wrapper">
        <div class="members__companies">
            <?php if ( have_posts() ) :
            $term = get_queried_object(); ?>
                <div class="members__companies-grid">
                    <?php while ( have_posts() ) : the_post(); ?>
                    <?php
                        $member_logo = get_field('member_logo');
                        $member_url = get_field('member_url');
                        $member_keys = get_the_terms(get_the_ID(), 'members_keys'); // Fetch the terms of 'members_keys' taxonomy
                    ?>
                        <a href="<?php echo $member_url; ?>" class="members__companies-grid-item" data-aos="fade-up">
                            <div class="members__companies-grid-item-logo">
                                <img alt="<?php the_title(); ?>" src="<?php echo $member_logo; ?>" />
                            </div>
                        
                            <?php if ($member_keys && !is_wp_error($member_keys)) : ?>
                                <div class="members__companies-grid-item-keys">
                                    <?php foreach ($member_keys as $key) : 
                                        // Get the 'colour' custom field associated with this term
                                        $colour = get_field('colour', 'members_keys_' . $key->term_id);
                                    ?>
                                        <div class="members__companies-grid-item-keys-item" style="color: <?php echo esc_attr($colour); ?>; background-color: <?php echo esc_attr($colour); ?>;">
                                           <span class="sr-only"><?php echo esc_html($key->name); ?></span>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                        </a>
                    <?php endwhile; ?>
                </div>
            <?php endif; ?>
        </div>


        <div class="members__keys">
        <h3 data-aos="fade-up">Membership Keys</h3>

        <?php
            // Get all custom taxonomy terms
            $categoryKeys = get_terms(array(
                'taxonomy' => 'members_keys',
                'hide_empty' => true,
            ));

            if ( !empty($categoryKeys) && !is_wp_error($categoryKeys) ) : ?>
                <div class="members__keys-grid">
                    <?php foreach ( $categoryKeys as $categoryKey ) : 

                        $key_colour = get_field('colour', 'members_keys_' . $categoryKey->term_id);
                        ?>

                        <div class="members__keys-grid-item" data-aos="fade-up">

                            <div class="members__keys-grid-item-main" style="background-color: <?php echo esc_attr($key_colour); ?>;">
                                <h2 class="members__keys-grid-item-main-title"><?php echo esc_html( $categoryKey->name ); ?></h2>
                            </div>

                            <div class="members__keys-grid-item-secondary" style="background-color: <?php echo esc_attr(lighten_color($key_colour, 80)); ?>;">
                                <?php if( have_rows('requirements', 'members_keys_' . $categoryKey->term_id) ): ?>
                                
                                    <?php while( have_rows('requirements', 'members_keys_' . $categoryKey->term_id) ): the_row(); 
                                        $requirement = get_sub_field('requirement');
                                        ?>
                                        <p><?php echo esc_html($requirement); ?></p>
                                    <?php endwhile; ?>
                    
                                <?php endif; ?>
                            </div>

                        </div>
                    <?php endforeach; ?>
                </div>

            <?php else : ?>
                <p><?php esc_html_e( 'No membership keys found.', 'text-domain' ); ?></p>
            <?php endif; ?>


            </div>
	</div>
</main>

<?php get_footer(); ?>
