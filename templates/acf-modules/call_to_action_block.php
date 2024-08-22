<?php if ( get_row_layout() == 'call_to_action_block' ) : ?>
<div class="page-builder-block" data-aos="fade-up">
    <div class="page-builder-block-wrapper">

    <?php 

        $title = get_sub_field('title');
        $description = get_sub_field('description');
        $buttonText = get_sub_field('button_text'); 
        $link = get_sub_field('link');

    ?>
        <div class="cta-block">
            <div class="cta-block__wrapper">
                <div class="cta-block__item">
                    <?php if($title) : ?>
                        <h2 class="cta-block__item-title"><?php echo $title; ?></h2>
                    <?php endif; ?>
                    <?php if($description) : ?>
                        <p class="cta-block__item-text"><?php echo $description; ?></p>
                    <?php endif; ?>
                    <?php if($link) : ?>
                        <a href="<?php echo esc_url($link); ?>" class="button button--white-hover"><?php echo get_sub_field('button_text') ? $buttonText : 'Read more'; ?></a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

