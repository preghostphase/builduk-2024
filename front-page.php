<?php get_header(); ?>

<main id="primary">
	<section class="home-banner <?php echo get_field('center_content') ? 'home-banner--center-content' : ''; ?>">
		<div class="home-banner__wrapper">
			<div class="home-banner__content">
				<?php if(get_field('banner_title')) : ?>
					<h1 class="home-banner__content-title" data-aos="fade-up" data-aos-delay="200"><?php echo get_field('banner_title'); ?></h1>
				<?php endif; ?>
				<?php if(get_field('banner_button_text') && get_field('banner_button_link')) : ?>
					<div class="home-banner__content-button" data-aos="fade-up" data-aos-delay="400">
						<a href="<?php echo esc_url(get_field('banner_button_link')); ?>" class="button"><?php echo get_field('banner_button_text'); ?></a>
					</div>
				<?php endif; ?>
			</div>
			<figure class="home-banner__image">
				<picture>
					<source media="(orientation: portrait)" srcset="<?php the_field('banner_image_mobile'); ?>">
					<source media="(orientation: landscape)" srcset="<?php the_field('banner_image_desktop'); ?>">
					<img src="<?php the_field('banner_image_desktop'); ?>" alt="Tonic Talent: Hospitality & Catering Recruitment Agency UK">
				</picture>
			</figure>
		</div>
	</section>

	<?php if(have_rows('home_blocks')) : ?>
    <section class="home-blocks">
        <div class="home-blocks__wrapper">
            <div class="home-blocks__grid">
                <?php while( have_rows('home_blocks') ) : the_row(); ?>

                    <?php 
                        $image = get_sub_field('image');
                        $title = get_sub_field('title');
                        $colour = get_sub_field('colour');
                        $url = get_sub_field('url');
						$logo = get_sub_field('logo');
                    ?>

                    <a href="<?php echo esc_url($url); ?>" class="home-blocks__grid-item" data-aos="flip-left" data-aos-duration="1000">
                        <div class="home-blocks__grid-item-image">

                            <div class="home-blocks__grid-item-image-overlay" style="background-color: <?php echo esc_attr($colour ? $colour : get_field('secondary_colour', 'option')); ?>;"><span class="sr-only">Overlay</span></div>
							
							<img alt="<?php echo esc_attr($title); ?>" src="<?php echo esc_url($image); ?>" />
     
						</div>
						<div class="home-blocks__grid-item-text">
							<?php if($logo) : ?>
								<div class="home-blocks__grid-item-text-logo">
									<img alt="" src="<?php echo $logo; ?>" />
								</div>
							<?php endif; ?>
							<h2><?php echo esc_html($title); ?></h2>
						</div>
                    </a>

                <?php endwhile; ?>
            </div>
        </div>
    </section>
<?php endif; ?>


</main>

<?php get_footer(); ?>

