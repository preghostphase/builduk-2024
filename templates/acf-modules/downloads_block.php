<?php if ( get_row_layout() == 'downloads_block' ) : ?>
<div class="page-builder-block">
    <div class="page-builder-block-wrapper">
        <div class="downloads-block">
            <div class="downloads-block__wrapper">
                <?php if(get_sub_field('block_title')) : ?>
                    <h2 class="downloads-block__title" data-aos="fade-up"><?php echo get_sub_field('block_title'); ?></h2>
                <?php endif; ?>

                <?php if( have_rows('downloadable_item') ): ?>
                    <div class="downloads-block__grid">
                        <?php while( have_rows('downloadable_item') ): the_row(); 
                            $title = get_sub_field('title');
                            $description = get_sub_field('description');
                            $url = get_sub_field('url');
                        ?>
                            <a href="<?php echo esc_url($url); ?>" class="downloads-block__item" data-aos="fade-up">
                                <div class="downloads-block__item-text user-content">
                                    <?php if($title) : ?>
                                        <h4 class="downloads-block__item-title"><?php echo $title; ?></h4>
                                    <?php endif; ?>
                                    <?php if($description) : ?>
                                        <p class="downloads-block__item-title"><?php echo $description; ?></p>
                                    <?php endif; ?>
                                </div>
                                <div class="downloads-block__item-icon">

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