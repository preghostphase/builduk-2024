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
                                        <svg xmlns="http://www.w3.org/2000/svg" width="11.558" height="11.561" viewBox="0 0 11.558 11.561">
                                        <path id="Path_10" data-name="Path 10" d="M15.572,5.815,14.557,4.492a.608.608,0,0,0-1.014,0L8.65,10.886,6.457,8.014a.608.608,0,0,0-1.014,0L4.432,9.338a1.151,1.151,0,0,0,0,1.323l2.7,3.523,1.01,1.324a.608.608,0,0,0,1.014,0l1.015-1.324,5.4-7.046a1.153,1.153,0,0,0,0-1.324" transform="translate(-4.223 -4.22)" fill="#fff"/>
                                        </svg>

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

                                <div class="members__keys-grid-item-main-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20">
                                        <path fill="<?php echo esc_attr($key_colour); ?>" d="M0 0h20v20H0z" data-name="Rectangle 39"/>
                                        <path fill="#fff" d="m15.572 5.815-1.015-1.323a.608.608 0 0 0-1.014 0L8.65 10.886 6.457 8.014a.608.608 0 0 0-1.014 0L4.432 9.338a1.056 1.056 0 0 0-.209.662 1.055 1.055 0 0 0 .209.661l2.7 3.523 1.01 1.324a.608.608 0 0 0 1.014 0l1.015-1.324 5.4-7.046a1.056 1.056 0 0 0 .209-.662 1.056 1.056 0 0 0-.209-.662" data-name="Path 10"/>
                                    </svg>
                                </div>
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
