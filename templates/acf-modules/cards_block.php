<?php if ( get_row_layout() == 'cards_block' ) : ?>
<div class="page-builder-block">
    <div class="page-builder-block-wrapper">

        <div class="cards-block">
            <div class="cards-block__wrapper">

            <?php if(get_sub_field('block_title')) : ?>
                <h2 class="cards-block__title" data-aos="fade-up"><?php echo get_sub_field('block_title'); ?></h2>
            <?php endif; ?>

            <?php 
                $blockTitle = get_sub_field('block_title');
            ?>

            <?php if(have_rows('card_items')) : ?>
                <div class="cards-block__grid">
                    <?php while( have_rows('card_items') ) : the_row(); ?>

                        <?php 
                            $image = get_sub_field('image');
                            $title = get_sub_field('title');
                            $colour = get_sub_field('colour');
                            $url = get_sub_field('link');
                            $logo = get_sub_field('logo');
                        ?>

                        <a href="<?php echo esc_url($url); ?>" class="cards-block__grid-item">
                            <div class="cards-block__grid-item-image">

                                <div class="cards-block__grid-item-image-overlay" style="background-color: <?php echo esc_attr($colour ? $colour : get_field('secondary_colour', 'option')); ?>;"><span class="sr-only">Overlay</span></div>
                                
                                <img alt="<?php echo esc_attr($title); ?>" src="<?php echo esc_url($image); ?>" />
        
                            </div>
                            <div class="cards-block__grid-item-text">
                                <?php if($logo) : ?>
                                    <div class="cards-block__grid-item-text-logo">
                                        <img alt="" src="<?php echo $logo; ?>" />
                                    </div>
                                <?php endif; ?>
                                <h2><?php echo esc_html($title); ?></h2>
                            </div>
                        </a>

                    <?php endwhile; ?>
                </div>
            <?php endif; ?>

            </div>
        </div>
    </div>
</div>
<?php endif; ?>



