<?php if ( get_row_layout() == 'image_and_text' ) : ?>
<div class="page-builder-block <?php echo get_sub_field('add_background') ? 'page-builder-block--background' : ''; ?>" data-aos="fade-up">
    <div class="page-builder-block-wrapper">
        <div class="image-and-text">
            <div class="image-and-text__wrapper <?php echo get_sub_field('reverse_order') ? 'reverse' : ''; ?>">
                <div class="image-and-text__image">
                    <img alt="" src="<?php echo get_sub_field('image'); ?>"/>
                </div>
                <div class="image-and-text__text user-content">
                    <?php echo get_sub_field('text'); ?>
                </div>
            </div> 
        </div>
    </div>
</div>
<?php endif; ?>