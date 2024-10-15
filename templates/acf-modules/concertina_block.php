<?php if ( get_row_layout() == 'concertina_block' ) : ?>
<div class="page-builder-block">
    <div class="page-builder-block-wrapper">
        <div class="concertina-block">
            <div class="concertina-block__wrapper">
                <?php if(get_sub_field('block_title')) : ?>
                    <h2 class="concertina-block__title" data-aos="fade-up"><?php echo get_sub_field('block_title'); ?></h2>
                <?php endif; ?>

                <?php if( have_rows('concertina_item') ): 
                    $concertinaCount = 0;
                ?>
                    <div class="concertina-block__grid">
                        <?php while( have_rows('concertina_item') ): the_row(); 
                            $title = get_sub_field('title');
                            $content = get_sub_field('content');
                        ?>
                        <div class="concertina-block__item" data-aos="fade-up">
                            <button class="concertina-block__item-heading"><?php echo $title; ?><div class="concertina-block__item-heading-icon"><?php load_inline_svg('down')?></div></button>
                            <div class="concertina-block__item-body"><?php echo $content; ?></div>
                        </div>

                        <?php $concertinaCount++; ?>
                        <?php endwhile; ?>
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </div>
</div>
<?php endif; ?>

