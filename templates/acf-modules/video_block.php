<?php if ( get_row_layout() == 'video_block' ) : ?>


    <?php

    // Call to Action Block Setup
	$videoTitle = get_sub_field('video_title');
	$videoEmbed = get_sub_field('embedded_video_url');
	$videoMP4 = get_sub_field('video_mp4');
	$videoMOV = get_sub_field('video_mov');
	$videoPoster = get_sub_field('video_poster');

    ?>
<div class="page-builder-block">
    <div class="page-builder-block-wrapper">
        <div class="video-block">
            <div class="video-block__wrapper">
                <?php if($videoTitle) : ?>
                    <h2 class="video-block__title" data-aos="fade-up"><?php echo $videoTitle; ?></h2>
                <?php endif; ?>

                <?php if($videoEmbed) : ?>

                    <a href="<?php echo esc_url($videoEmbed); ?>" target="_blank"  class="embedded-video" data-aos="fade-up">
                        <div class="video-block__poster">
                            <img alt="" src="<?php echo $videoPoster; ?>"/>
                        </div>
                    </a>

                <?php elseif ($videoMP4 && $videoMOV) : ?>

                    <a href="#flexible-video-1" target="_blank"  class="local-video" data-aos="fade-up">
                        <div class="video-block__poster">
                            <img alt="" src="<?php echo $videoPoster; ?>"/>
                        </div>
                    </a>

                    <?php if($videoMOV || $videoMP4) : ?>
                        <div id="flexible-video-1" class="local-video-popup mfp-hide">
                            <video controls preload="auto">
                                <source src="<?php echo $videoMP4; ?>" type="video/mp4">
                                <source src="<?php echo $videoMOV; ?>" type="video/mov">
                            </video>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            </div> 
        </div>
    </div>
</div>
<?php endif; ?>