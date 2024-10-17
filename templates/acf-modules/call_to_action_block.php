<?php if ( get_row_layout() == 'call_to_action_block' ) : ?>

<div class="page-builder-block" data-aos="fade-up">
    <div class="page-builder-block-wrapper">

        <div class="cta-block">
            <div class="cta-block__wrapper">

            <?php if(get_sub_field('block_title')) : ?>
                <h2 class="cta-block__title" data-aos="fade-up"><?php echo get_sub_field('block_title'); ?></h2>
            <?php endif; ?>

            <?php 
                $blockTitle = get_sub_field('block_title');
            ?>

            <?php if(have_rows('call_to_actions')) : ?>
                <?php while(have_rows('call_to_actions')) : the_row(); ?>

                <?php
                    $title = get_sub_field('title');
                    $description = get_sub_field('description');
                    $buttonText = get_sub_field('button_text'); 
                    $link = get_sub_field('link');
                    $size = get_sub_field('size');
                ?>

                <div class="cta-block__item size--<?php echo $size; ?>" style="background-color: <?php echo get_field('banner_colour') ? get_field('banner_colour') : ''; ?>">
                    <?php if($title) : ?>
                        <h2 class="cta-block__item-title"><?php echo $title; ?></h2>
                    <?php endif; ?>
                    <?php if($description) : ?>
                        <p class="cta-block__item-text"><?php echo $description; ?></p>
                    <?php endif; ?>
                    <?php if($link) : ?>
                        <a href="<?php echo esc_url($link); ?>" class="button button--white"><?php echo get_sub_field('button_text') ? $buttonText : 'Read more'; ?></a>
                    <?php endif; ?>
                </div>

                <?php endwhile; ?>
            <?php endif; ?>

            </div>
        </div>
    </div>
</div>
<?php endif; ?>

